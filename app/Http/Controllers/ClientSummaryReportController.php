<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClientSummaryExport;
use Maatwebsite\Excel\Excel as MaatwebsiteExcel;



class ClientSummaryReportController extends Controller
{
    // 1️⃣ VIEW SUMMARY
    public function clientSummaryView(Request $request)
    {
       $clients = DB::table('transaction')
        ->select('client_name')
        ->whereNull('deleted_at')
        ->distinct()
        ->orderBy('client_name')
        ->simplePaginate(10);

    // Ambil summary data sesuai filter
    $summaryData = $this->buildClientSummaryQuery($request);

    return view('Report.client-summary', [
        'summaryData' => $summaryData,
        'clients'     => $clients,
        'startDate'   => $request->start_date,
        'endDate'     => $request->end_date,
        'clientName'  => $request->client_name,
    ]);
    }

    // 2️⃣ EXPORT PDF
    public function exportClientSummaryPdf(Request $request)
    {
        $summaryData = $this->buildClientSummaryQuery($request);

        $pdf = Pdf::loadView('Report.client-summary-pdf', [
            'summaryData' => $summaryData,
            'request'     => $request
        ])->setPaper('A4', 'landscape');

        return $pdf->stream('client-summary-report.pdf'); // buka di browser
    }

    // 3️⃣ EXPORT EXCEL
    public function exportClientSummaryExcel(Request $request)
    {
          $fileName = 'client-summary-report.xlsx';
    if (!empty($request->start_date) && !empty($request->end_date)) {
        $fileName = 'client-summary-' . $request->start_date . '_to_' . $request->end_date . '.xlsx';
    }

    // Query summary data
    $summaryData = DB::table('transaction as t')
        ->leftJoin('products as p', 'p.id', '=', 't.id_product')
        ->leftJoinjoin('clients as c','c.id','=','id_client')
        ->select(
            't.client_name',
            DB::raw("SUM(CASE WHEN p.quality = 'RON98' THEN t.quantity ELSE 0 END) AS RON98"),
            DB::raw("SUM(CASE WHEN p.quality = 'RON92' THEN t.quantity ELSE 0 END) AS RON92"),
            DB::raw("SUM(CASE WHEN p.quality = '10PPM' THEN t.quantity ELSE 0 END) AS '10PPM'"),
            DB::raw("SUM(CASE WHEN p.quality = 'JET-A1' THEN t.quantity ELSE 0 END) AS 'JET-A1'")
        )
        ->whereNull('c.tin')
        ->whereNull('t.deleted_at')
        ->when($request->start_date && $request->end_date, function ($q) use ($request) {
            $q->whereBetween(DB::raw('DATE(t.created_at)'), [$request->start_date, $request->end_date]);
        })
        ->when($request->client_name, function ($q) use ($request) {
            $q->where('t.client_name', $request->client_name);
        })
        ->groupBy('t.client_name')
        ->orderBy('t.client_name')
        ->get();

    // Hitung total
    $totalRON98 = $summaryData->sum('RON98');
    $totalRON92 = $summaryData->sum('RON92');
    $total10PPM = $summaryData->sum('10PPM');
    $totalJET_A1 = $summaryData->sum('JET-A1');

    // Download Excel dengan row total
    return Excel::download(new class($summaryData, $totalRON98, $totalRON92, $total10PPM, $totalJET_A1) implements \Maatwebsite\Excel\Concerns\FromCollection, \Maatwebsite\Excel\Concerns\WithHeadings {
        private $data;
        private $totalRON98;
        private $totalRON92;
        private $total10PPM;
        private $totalJET_A1;

        public function __construct($data, $totalRON98, $totalRON92, $total10PPM, $totalJET_A1)
        {
            $this->data = $data;
            $this->totalRON98 = $totalRON98;
            $this->totalRON92 = $totalRON92;
            $this->total10PPM = $total10PPM;
            $this->totalJET_A1 = $totalJET_A1;
        }

        public function collection()
        {
            $rows = collect($this->data)->map(function($row) {
                return [
                    $row->client_name,
                    $row->RON98,
                    $row->RON92,
                    $row->{'10PPM'},
                    $row->{'JET-A1'},
                ];
            });

            // Tambahkan row TOTAL
            $rows->push([
                'TOTAL',
                $this->totalRON98,
                $this->totalRON92,
                $this->total10PPM,
                $this->totalJET_A1,
            ]);

            return $rows;
        }

        public function headings(): array
        {
            return ['Client Name', 'RON98', 'RON92', '10PPM', 'JET-A1'];
        }
    }, $fileName);
    }

    // 4️⃣ CORE QUERY
    private function buildClientSummaryQuery(Request $request)
    {
        return DB::table('transaction as t')
            ->leftJoin('products as p', 'p.id', '=', 't.id_product')
            ->select(
                't.client_name',
                DB::raw("SUM(CASE WHEN p.quality = 'RON98' THEN t.quantity ELSE 0 END) AS ron98"),
                DB::raw("SUM(CASE WHEN p.quality = 'RON92' THEN t.quantity ELSE 0 END) AS ron92"),
                DB::raw("SUM(CASE WHEN p.quality = '10PPM' THEN t.quantity ELSE 0 END) AS ppm10"),
                DB::raw("SUM(CASE WHEN p.quality = 'JET-A1' THEN t.quantity ELSE 0 END) AS jeta1")
            )
            ->whereNull('t.deleted_at')
            ->when($request->start_date && $request->end_date, function ($q) use ($request) {
                $q->whereBetween(DB::raw('DATE(t.created_at)'), [
                    $request->start_date,
                    $request->end_date
                ]);
            })
            ->when($request->client_name, function ($q) use ($request) {
                $q->where('t.client_name', $request->client_name);
            })
            ->groupBy('t.client_name')
            ->orderBy('t.client_name')
            ->get();
    }
}

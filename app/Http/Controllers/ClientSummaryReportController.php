<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClientSummaryExport;

class ClientSummaryReportController extends Controller
{
    // ================= VIEW =================
    public function clientSummaryView(Request $request)
    {
        $startDate  = $request->start_date;
        $endDate    = $request->end_date;
        $clientName = $request->client_name;

        $summaryData = $this->buildClientSummaryQuery($request);

        $clients = DB::table('transaction')
            ->select('client_name')
            ->whereNull('deleted_at')
            ->distinct()
            ->orderBy('client_name')
            ->get();

        return view('Report.client-summary', [
            'summaryData' => $summaryData,
            'clients'     => $clients,
            'startDate'   => $startDate,
            'endDate'     => $endDate,
            'clientName'  => $clientName,
        ]);
    }

    // ================= PDF =================
    public function exportClientSummaryPdf(Request $request)
    {
        $summaryData = $this->buildClientSummaryQuery($request);

    $pdf = Pdf::loadView('Report.client-summary-pdf', [
        'summaryData' => $summaryData,
        'request'     => $request
    ])->setPaper('A4', 'landscape');

    // buka di browser
    return $pdf->stream('client-summary-report.pdf');
    }

    // ================= EXCEL =================
    public function exportClientSummaryExcel(Request $request)
    {
        return Excel::download(
            new ClientSummaryExport($request),
            'client-summary-report.xlsx'
        );
    }

    // ================= CORE QUERY =================
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

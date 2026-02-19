<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class TotalSummaryController extends Controller
{
    // ================= INDEX =================
    public function index(Request $request)
    {
        $summary = $this->getSummary($request);
        $start = $request->start_date;
        $end   = $request->end_date;

        return view('totalsummary.index', compact('summary', 'start', 'end'));
    }

    // ================= PDF PREVIEW =================
    public function pdf(Request $request)
    {
        $data = $this->getSummary($request);

        $pdf = Pdf::loadView('totalsummary.totalpdf', compact('data'))
        ->setPaper('A4', 'landscape'); // <-- ini untuk landscape
        return $pdf->stream('total-summary.pdf'); 
    }

    // ================= EXCEL =================
    public function excel(Request $request)
    {
        $data = $this->getSummary($request);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'Classification');
        $sheet->setCellValue('B1', 'Gasoline');
        $sheet->setCellValue('C1', 'Gasoleo');
        $sheet->setCellValue('D1', 'Jet A1');

        // Data
        $row = 2;
        foreach ($data as $type => $value) {
            $sheet->setCellValue("A{$row}", $type);
            $sheet->setCellValue("B{$row}", $value['GASOLINA']);
            $sheet->setCellValue("C{$row}", $value['GASÓLEO']);
            $sheet->setCellValue("D{$row}", $value['JET-A1']);
            $row++;
        }

        // Grand Total
        $grandTotalRow = $row;
        $sheet->setCellValue("A{$grandTotalRow}", 'GRAND TOTAL');
        $sheet->setCellValue("B{$grandTotalRow}", $data['Client']['GASOLINA'] + $data['ETO']['GASOLINA']);
        $sheet->setCellValue("C{$grandTotalRow}", $data['Client']['GASÓLEO'] + $data['ETO']['GASÓLEO']);
        $sheet->setCellValue("D{$grandTotalRow}", $data['Client']['JET-A1'] + $data['ETO']['JET-A1']);

        $writer = new Xlsx($spreadsheet);
        $fileName = 'total-summary.xlsx';
        $path = storage_path($fileName);
        $writer->save($path);

        return response()->download($path)->deleteFileAfterSend(true);
    }

    // ================= PRIVATE FUNCTION =================
    private function getSummary(Request $request)
    {
        $start = $request->start_date;
        $end   = $request->end_date;

        $query = DB::table('transaction as t')
            ->leftJoin('products as p', 'p.id', '=', 't.id_product')
            ->leftJoin('clients as c','c.id','=','t.id_client')
            ->select('c.tin', 't.quantity', 'p.product_name');

        if ($start && $end) {
            $query->whereBetween('t.created_at', [
                Carbon::parse($start)->startOfDay(),
                Carbon::parse($end)->endOfDay()
            ]);
        }

        $data = $query->get();

        // Filter Client & ETO
        $client = $data->whereNull('tin');
        $eto    = $data->where('tin', 10522139);

        return [
            'Client' => [
                'GASOLINA' => $client->where('product_name', 'GASOLINA')->sum('quantity'),
                'GASÓLEO'  => $client->where('product_name', 'GASÓLEO')->sum('quantity'),
                'JET-A1'   => $client->where('product_name', 'JET-A1')->sum('quantity'),
            ],
            'ETO' => [
                'GASOLINA' => $eto->where('product_name', 'GASOLINA')->sum('quantity'),
                'GASÓLEO'  => $eto->where('product_name', 'GASÓLEO')->sum('quantity'),
                'JET-A1'   => $eto->where('product_name', 'JET-A1')->sum('quantity'),
            ]
        ];
    }
}

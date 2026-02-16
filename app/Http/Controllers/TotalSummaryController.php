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


     public function index(Request $request)
    {
        $start = $request->start_date;
        $end   = $request->end_date;

        $query = DB::table('transaction as t')
            ->leftJoin('clients as c', 'c.id', '=', 't.id_client')
            ->leftJoin('products as p', 'p.id', '=', 't.id_product')
            ->select(
                'c.tin',
                't.quantity',
                'p.product_name'
            );

        if ($start && $end) {
            $query->whereBetween('t.created_at', [
                Carbon::parse($start)->startOfDay(),
                Carbon::parse($end)->endOfDay()
            ]);
        }

        $data = $query->get();

        // ================= CLASSIFICATION =================
        $client = $data->whereNull('c.tin');
        $eto    = $data->whereNotNull('c.tin');

        $summary = [
            'Client' => [
                'GASOLINA' => $client->where('product_name', 'GASOLINA')->sum('quantity'),
                'GASÓLEO'  => $client->where('product_name', 'GASÓLEO')->sum('quantity'),
                'JET-A1'      => $client->where('product_name', '')->sum('quantity'),
            ],
            'ETO' => [
                'GASOLINA' => $eto->where('product_name', 'GASOLINA')->sum('quantity'),
                'GASÓLEO'  => $eto->where('product_name', 'GASÓLEO')->sum('quantity'),
                'JET-A1'      => $eto->where('product_name', 'JET-A1')->sum('quantity'),
            ]
        ];

        return view('totalsummary.index', compact('summary', 'start', 'end'));
    }

    // ================= PDF =================
    public function pdf(Request $request)
    {
        $data = $this->getSummary($request);

         $pdf = Pdf::loadView('totalsummary.totalpdf', compact('data'));
        return $pdf->stream('total-summary.pdf');
    }

    // ================= EXCEL =================
    public function excel(Request $request)
    {
        $data = $this->getSummary($request);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Classification');
        $sheet->setCellValue('B1', 'Gasoline');
        $sheet->setCellValue('C1', 'Gasoleo');
        $sheet->setCellValue('D1', 'Jet');

        $row = 2;
        foreach ($data as $type => $value) {
            $sheet->setCellValue("A{$row}", $type);
            $sheet->setCellValue("B{$row}", $value['Gasoline']);
            $sheet->setCellValue("C{$row}", $value['Gasoleo']);
            $sheet->setCellValue("D{$row}", $value['Jet']);
            $row++;
        }

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
            ->leftJoin('clients as c','c.id','=','id_client')
            ->select('c.tin', 't.quantity', 'p.product_name');

        if ($start && $end) {
            $query->whereBetween('t.created_at', [
                Carbon::parse($start)->startOfDay(),
                Carbon::parse($end)->endOfDay()
            ]);
        }

        $data = $query->get();

        $client = $data->whereNull('c.tin');
        $eto    = $data->whereNotNull('c.tin');

        return [
            'Client' => [
                'Gasoline' => $client->where('product_name', 'Gasoline')->sum('quantity'),
                'Gasoleo'  => $client->where('product_name', 'Gasoleo')->sum('quantity'),
                'Jet'      => $client->where('product_name', 'Jet')->sum('quantity'),
            ],
            'ETO' => [
                'Gasoline' => $eto->where('product_name', 'Gasoline')->sum('quantity'),
                'Gasoleo'  => $eto->where('product_name', 'Gasoleo')->sum('quantity'),
                'Jet'      => $eto->where('product_name', 'Jet')->sum('quantity'),
            ]
        ];
    }
    


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class summaryTotalController extends Controller
{
    

    public function index(Request $request)
    {
        $transactions = $this->getFilteredTransactions($request)->get();

        return view('Report.summaryexel', compact('transactions'));
    }

    /* =========================
       EXCEL EXPORT
    ========================== */
    public function excel(Request $request)
    {
        $transactions = $this->getFilteredTransactions($request)->get();

        // TOTAL
        $totalGasolina = $transactions->where('product_name', 'GASOLINA')->sum('quantity');
        $totalGasole   = $transactions->where('product_name', 'GASÓLEO')->sum('quantity');
        $totalJetA1    = $transactions->where('product_name', 'JET-A1')->sum('quantity');

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Summary Report');

        $headers = [
            'No','DO Number','Client Name','LO Number',
            'Gasolina (L)','Gasole (L)','Jet-A1 (L)',
            'Payment Reference','Description','Date'
        ];
        $sheet->fromArray($headers, null, 'A1');
        $sheet->getStyle('A1:J1')->getFont()->setBold(true);

        $row = 2;
        foreach ($transactions as $i => $t) {
            $sheet->fromArray([
                $i + 1,
                $t->do_number,
                $t->client_name,
                $t->lo_number,
                $t->product_name === 'GASOLINA' ? $t->quantity : 0,
                $t->product_name === 'GASÓLEO'  ? $t->quantity : 0,
                $t->product_name === 'JET-A1'   ? $t->quantity : 0,
                $t->payment_reference ?? '-',
                $t->description ?? '-',
                date('d-m-Y', strtotime($t->created_at))
            ], null, 'A'.$row);
            $row++;
        }

        // TOTAL ROW
        $sheet->mergeCells("A{$row}:D{$row}");
        $sheet->setCellValue("A{$row}", 'TOTAL');
        $sheet->setCellValue("E{$row}", $totalGasolina);
        $sheet->setCellValue("F{$row}", $totalGasole);
        $sheet->setCellValue("G{$row}", $totalJetA1);
        $sheet->getStyle("A{$row}:J{$row}")->getFont()->setBold(true);

        foreach(range('A','J') as $col){
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'summary_report_'.date('Ymd_His').'.xlsx';

        return response()->streamDownload(fn() => $writer->save('php://output'), $filename);
    }

    /* =========================
       PDF EXPORT
    ========================== */
    public function pdf(Request $request)
    {
        $transactions = $this->getFilteredTransactions($request)->get();

        $totals = [
            'gasolina' => $transactions->where('product_name', 'GASOLINA')->sum('quantity'),
            'gasole'   => $transactions->where('product_name', 'GASÓLEO')->sum('quantity'),
            'jeta1'    => $transactions->where('product_name', 'JET-A1')->sum('quantity'),
        ];

        $pdf = Pdf::loadView('Report.summary_pdf', compact(
            'transactions','totals'
        ))->setPaper('A4', 'landscape');

        return $pdf->download('summary_report_'.date('Ymd_His').'.pdf');
    }

    /* =========================
       FILTER QUERY (SATU PINTU)
    ========================== */
    private function getFilteredTransactions(Request $request)
    {
        $query = DB::table('transaction as t')
            ->leftJoin('clients as c', 'c.id', '=', 't.id_client')
            ->leftJoin('products as p', 'p.id', '=', 't.id_product')
            ->select(
                't.*',
                DB::raw('COALESCE(c.client_name, t.client_name) as client_name'),
                'p.product_name'
            )
            ->whereNull('t.deleted_at');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('t.created_at', [
                $request->start_date.' 00:00:00',
                $request->end_date.' 23:59:59'
            ]);
        }

        return $query->orderBy('t.created_at','desc');

    }
}

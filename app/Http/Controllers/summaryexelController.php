<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class summaryexelController extends Controller
{
    /**
     * Show summary view with filter
     */
    public function index(Request $request)
    {
        $transactions = $this->getFilteredTransactions($request)
                             ->orderBy('transaction.created_at', 'desc')
                             ->get();

        return view('Report.summaryexel', compact('transactions'));
    }

    /**
     * Export summary to Excel
     */
    public function excel(Request $request)
    {
        $transactions = $this->getFilteredTransactions($request)->get();

        // Hitung TOTAL per produk
        $totalGasolina = $transactions->filter(fn($t) => strtoupper($t->product_name) === 'GASOLINA')->sum('quantity');
        $totalGasole   = $transactions->filter(fn($t) => strtoupper($t->product_name) === 'GASÓLEO')->sum('quantity');
        $totalJetA1    = $transactions->filter(fn($t) => strtoupper($t->product_name) === 'JET-A1')->sum('quantity');

        // Buat Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Summary Report');

        // Header
        $headers = [
            'No',
            'DO Number',
            'Client Name',
            'LO Number',
            'Gasolina (L)',
            'Gasole (L)',
            'Jet-A1 (L)',
            'Payment Reference',
            'Description',
            'Date'
        ];
        $sheet->fromArray($headers, null, 'A1');
        $sheet->getStyle('A1:J1')->getFont()->setBold(true);

        // Data
        $row = 2;
        foreach ($transactions as $i => $t) {
            $sheet->fromArray([
                $i + 1,
                $t->do_number,
                $t->client_name,
                $t->lo_number,
                strtoupper($t->product_name) === 'GASOLINA' ? $t->quantity : 0,
                strtoupper($t->product_name) === 'GASÓLEO' ? $t->quantity : 0,
                strtoupper($t->product_name) === 'JET-A1' ? $t->quantity : 0,
                $t->payment_reference ?? $t->so_number ?? '-',
                $t->description ?? '-',
                date('d-m-Y', strtotime($t->created_at))
            ], null, 'A'.$row);
            $row++;
        }

        // Row TOTAL
        $sheet->mergeCells("A{$row}:D{$row}");
        $sheet->setCellValue("A{$row}", 'TOTAL');
        $sheet->setCellValue("E{$row}", $totalGasolina);
        $sheet->setCellValue("F{$row}", $totalGasole);
        $sheet->setCellValue("G{$row}", $totalJetA1);

        // Style total
        $sheet->getStyle("A{$row}:J{$row}")->getFont()->setBold(true);
        $sheet->getStyle("A{$row}:J{$row}")
              ->getBorders()
              ->getTop()
              ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

        // Auto width
        foreach(range('A','J') as $col){
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Download Excel
        $writer = new Xlsx($spreadsheet);
        $filename = 'summary_report_'.date('Ymd_His').'.xlsx';

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename, [
            "Content-Type" => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
        ]);
    }

    /**
     * FILTER TRANSACTIONS (date optional)
     */
    private function getFilteredTransactions(Request $request)
    {
        $query = DB::table('transaction')
            ->leftJoin('clients', 'clients.id', '=', 'transaction.id_client')
            ->leftJoin('products', 'products.id', '=', 'transaction.id_product')
            ->select(
                'transaction.*',
                'clients.client_name as client_name',
                'products.product_name as product_name'
            );

        // DATE FILTER
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('transaction.created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date   . ' 23:59:59'
            ]);
        }

        return $query;
    }
}

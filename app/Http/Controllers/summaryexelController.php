<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;

class summaryexelController extends Controller
{
    

    public function index(Request $request){

        $transactions = $this->getFilteredTransactions($request)
        ->orderBy('transaction.created_at', 'desc')
        ->simplePaginate(10);


        return view('Report.summaryexel',compact('transactions'));
    }


    public function excel(Request $request)
{

             $transactions = $this->getFilteredTransactions($request)->get();

        // Hitung TOTAL per produk
        $totalGasolina = 0;
        $totalGasole   = 0;
        $totalJetA1    = 0;

        foreach ($transactions as $t) {
            if ($t->product_name === 'Gasolina') {
                $totalGasolina += $t->quantity;
            } elseif ($t->product_name === 'Gasole') {
                $totalGasole += $t->quantity;
            } elseif ($t->product_name === 'Jet-A1') {
                $totalJetA1 += $t->quantity;
            }
        }

        // Spreadsheet
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
            'Payment References',
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
                $t->product_name === 'Gasolina' ? $t->quantity : 0,
                $t->product_name === 'Gasole'   ? $t->quantity : 0,
                $t->product_name === 'Jet-A1'   ? $t->quantity : 0,
                $t->payment_references ?? '-',
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

        // Save & download
        $writer = new Xlsx($spreadsheet);
        $filename = 'summary_report_'.date('Ymd_His').'.xlsx';

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename, [
            "Content-Type" => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
        ]);


}

    /**
     * FILTER QUERY (WAJIB ADA)
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


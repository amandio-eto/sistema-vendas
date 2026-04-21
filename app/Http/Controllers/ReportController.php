<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;


class ReportController extends Controller
{
    /**
     * Report Page + Filter
     */
    public function index(Request $request)
    {
        $transactionsQuery = $this->getFilteredTransactions($request);

        // Ambil semua data untuk hitung total
        $allData = $transactionsQuery->get();

        $totalPerProduct = $allData->groupBy('product_name')
            ->map(fn($items, $product) => [
                'product' => $product,
                'total' => $items->sum('quantity')
            ]);

        $totalOverall = $allData->sum('quantity');

        // Paginate (13 per page)
        $transactions = $transactionsQuery->simplePaginate(13);


        $clients  = DB::table('clients')->get();
        $products = DB::table('products')->get();

       $btn = DB::table('checklist')
          ->where('id', 1)
          ->value('status_check');


        return view('Transaction.report', compact(
            'transactions',
            'clients',
            'products',
            'totalPerProduct',
            'totalOverall',
            'btn'
        ));
    }

    /**
     * Export PDF
     */
    public function pdf(Request $request)
    {
        $transactions = $this->getFilteredTransactions($request)->get();

        $totalPerProduct = $transactions->groupBy('product_name')
            ->map(fn($items, $product) => [
                'product' => $product,
                'total' => $items->sum('quantity')
            ]);

        $totalOverall = $transactions->sum('quantity');

        $pdf = FacadePdf::loadView(
            'Transaction.report_pdf',
            compact('transactions','totalPerProduct','totalOverall')
        )->setPaper('a4', 'landscape');

        return $pdf->stream('transaction_report.pdf');
    }

    /**
     * Export Excel
     */
    public function excel(Request $request)
    {
        $transactions = $this->getFilteredTransactions($request)->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Transaction Report');

        // Header
        $headers = [
            'No','DO Number','SO Number','LO Number','Date','Client',
            'Product','Quantity (L)','Driver','Status'
        ];

        $sheet->fromArray($headers,null,'A1');

        $sheet->getStyle('A1:J1')->applyFromArray([
            'font'=>['bold'=>true],
            'borders'=>[
                'allBorders'=>[
                    'borderStyle'=>\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                ]
            ]
        ]);

        // Data
        $row = 2;
        foreach ($transactions as $i => $t) {
            $sheet->fromArray([
                $i + 1,
                $t->do_number,
                $t->so_number,
                $t->lo_number,
                date('d-m-Y', strtotime($t->created_at)),
                $t->client_name,
                $t->product_name,
                number_format($t->quantity,2),
                $t->driver_name,
                $t->status ? 'Completed' : 'Pending'
            ], null, 'A'.$row);
            $row++;
        }

        // Totals
        $row++;
        $sheet->setCellValue('F'.$row,'Totals per Product:');

        foreach($transactions->groupBy('product_name') as $product => $items){
            $row++;
            $sheet->setCellValue('F'.$row, $product);
            $sheet->setCellValue('G'.$row, $items->sum('quantity'));
        }

        $row++;
        $sheet->setCellValue('F'.$row,'Total Overall');
        $sheet->setCellValue('G'.$row, $transactions->sum('quantity'));

        foreach(range('A','J') as $col){
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'transactions_report_'.date('Ymd_His').'.xlsx';

        return response()->streamDownload(function () use ($writer){
            $writer->save('php://output');
        }, $filename, [
            "Content-Type"=>"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
        ]);
    }



     public function qdb(Request $request)
    {
        $transactions = $this->getFilteredTransactions($request)->get();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Vendas Import Quickbooks');

    // Header
    $headers = [
        'Customer','Class','Date','No.Invoice','P.O NO.','Terms','Description','Class','Item','Site','Bin','Quantity','Rate','Amount','Memo'
    ];

    $sheet->fromArray($headers, null, 'A1');

    // Data
    $row = 2;
    foreach ($transactions as $t) {
        $sheet->fromArray([
            $t->client_name,
            "4 - HERA",
            date('d-m-y', strtotime($t->created_at)),
            "HR" . date('dmy', strtotime($t->created_at)) . $t->approve_number,
            $t->do_number,
            "",
            "DO: {$t->do_number} LO: {$t->lo_number} CLIENT: {$t->client_name} DRIVER: {$t->driver_name}",
            "4 - HERA",
            $t->product_name,
            "4 - HERA",
            "",
            number_format($t->quantity, 2),
            0,
            0,
            "LO: {$t->plat_number} {$t->client_name} {$t->driver_name}"
        ], null, 'A' . $row);

        $row++;
    }

    // Writer CSV
    $writer = new Csv($spreadsheet);
    $writer->setDelimiter(',');
    $writer->setEnclosure('"');
    $writer->setLineEnding("\n");
    $writer->setUseBOM(true); // biar Excel tidak rusak karakter

    $filename = 'transactions_report_' . date('Ymd_His') . '.csv';

    return response()->streamDownload(function () use ($writer) {
        $writer->save('php://output');
    }, $filename, [
        "Content-Type" => "text/csv"
    ]);
    }








    /**
     * Reusable Filter Query
     */
    private function getFilteredTransactions(Request $request)
    {
        $status = DB::table('checklist')->value('status_check');

        $query = DB::table('transaction as t')
            ->leftJoin('users as u','u.id','=','t.id_user')
            ->leftJoin('clients as c','c.id','=','t.id_client')
            ->leftJoin('products as p','p.id','=','t.id_product')
            ->leftJoin('drivers as d','d.id','=','t.id_driver')
            ->select(
                't.*',
                'u.name as user_name',
                'c.client_name',
                'c.tin',
                'p.product_name',
                'p.code_product as cp',
                'd.driver_name'
            )
            ->when($request->from && $request->to, function ($q) use ($request) {
                $q->whereBetween('t.created_at', [
                    $request->from.' 00:00:00',
                    $request->to.' 23:59:59'
                ]);
            })
            ->when($request->client && $request->client !== 'all', function ($q) use ($request) {
                $q->where('t.id_client', $request->client);
            })
            ->when($request->product && $request->product !== 'all', function ($q) use ($request) {
                $q->where('t.id_product', $request->product);
            });

        // 🔵 Logic TIN Filter
        if ($status == 1) {
            $query->whereNotNull('c.tin');
        } else {
            $query->whereNull('c.tin');
        }

        return $query->orderBy('t.do_number','ASC')
                     ->orderBy('t.created_at','ASC');
    }
}

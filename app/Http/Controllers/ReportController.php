<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportController extends Controller
{
    /**
     * Report Page + Filter Form
     */
    public function index(Request $request)
    {
        $transactionsQuery = $this->getFilteredTransactions($request);

    // Hitung total per product sebelum paginate
    $totalPerProduct = $transactionsQuery->get()
        ->groupBy('product_name')
        ->map(fn($items, $product) => [
            'product' => $product,
            'total' => $items->sum('quantity')
        ]);

    $totalOverall = $transactionsQuery->sum('quantity');

    // Paginate setelah menghitung total
    $transactions = $transactionsQuery->simplePaginate(13);

    $clients  = DB::table('clients')->get();
    $products = DB::table('products')->get();

    return view('Transaction.report', compact(
        'transactions',
        'clients',
        'products',
        'totalPerProduct',
        'totalOverall'
    ));
    }

    /**
     * Export PDF (Landscape)
     */
    public function pdf(Request $request)
    {
        $transactionsQuery = $this->getFilteredTransactions($request);
        $transactions = $transactionsQuery->get();

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

        return $pdf->stream('Transaction.report_pdf');
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

        // Header kolom
        $headers = [
            'No','DO Number','SO Number','LO Number','Date','Client','Product Type',
            'Product','Quantity (L)','Driver','Plat','Status'
        ];
        $sheet->fromArray($headers,null,'A1');

        // Style header
        $sheet->getStyle('A1:L1')->applyFromArray([
            'font'=>['bold'=>true],
            'borders'=>['allBorders'=>['borderStyle'=>\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]
        ]);

        // Isi data
        $row = 2;
        foreach ($transactions as $i => $t) {
            $sheet->fromArray([
                $i + 1,
                $t->do_number,
                $t->so_number,
                $t->lo_number,
                date('d-m-Y', strtotime($t->created_at)),
                $t->client_name,
                $t->product_type,
                $t->product_name,
                number_format($t->quantity,2),
                $t->driver_name,
                $t->plat_number,
                $t->status ? 'Completed' : 'Pending'
            ], null, 'A'.$row);
            $row++;
        }

        // Tambahkan baris kosong sebelum total
        $row++;
        $sheet->setCellValue('H'.$row,'Totals per Product:');
        foreach($transactions->groupBy('product_name') as $product => $items){
            $row++;
            $sheet->setCellValue('H'.$row, $product);
            $sheet->setCellValue('I'.$row, $items->sum('quantity'));
        }

        // Total keseluruhan
        $row++;
        $sheet->setCellValue('H'.$row,'Total Overall');
        $sheet->setCellValue('I'.$row, $transactions->sum('quantity'));

        // Auto width
        foreach(range('A','L') as $col){
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

    /**
     * Reusable Filter Query
     */
    private function getFilteredTransactions(Request $request)
    {
        return DB::table('transaction as t')
            ->leftJoin('users as u','u.id','=','t.id_user')
            ->leftJoin('clients as c','c.id','=','t.id_client')
            ->leftJoin('products as p','p.id','=','t.id_product')
            ->leftJoin('drivers as d','d.id','=','t.id_driver')
            ->select(
                't.*',
                'u.name as user_name',
                'c.client_name',
                'p.product_name',
                'p.code_product as cp',
                'p.quality',
                'p.code_product',
                'd.driver_name'
            )
            ->when($request->from && $request->to, fn($q) =>
                $q->whereBetween('t.created_at', [
                    $request->from.' 00:00:00',
                    $request->to.' 23:59:59'
                ])
            )
            ->when($request->client && $request->client!=='all', fn($q) =>
                $q->where('t.id_client',$request->client)
            )
            ->when($request->product && $request->product!=='all', fn($q) =>
                $q->where('t.id_product',$request->product)
            )
            ->orderByDesc('t.created_at');
    }




    
}

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\TransactionsExport; // nanti buat Excel export
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;




class ReportController extends Controller
{
    
    /**
     * Report Page + Filter Form
     */
    public function index(Request $request)
    {
        $transactions = $this->getFilteredTransactions($request)
            ->paginate(20);

        $clients  = DB::table('clients')->get();
        $products = DB::table('products')->get();

        return view('Transaction.report', compact(
            'transactions',
            'clients',
            'products'
        ));
    }

    /**
     * Export PDF (Landscape)
     */
    public function pdf(Request $request)
    {
        $transactions = $this->getFilteredTransactions($request)->get();

        $pdf = FacadePdf::loadView(
            'Transaction.report_pdf',
            compact('transactions')
        )->setPaper('a4', 'landscape');

        return $pdf->stream('Transaction_report.pdf');
    }

    /**
     * Export Excel
     */
    public function excel(Request $request)
{
    // 1️⃣ Ambil data hasil filter
    $transactions = $this->getFilteredTransactions($request)->get();

    // 2️⃣ Buat Spreadsheet baru
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Transaction Report');

    // 3️⃣ Header kolom
    $headers = [
        'No',
        'DO Number',
        'SO Number',
        'LO Number',
        'Date',
        'Client',
        'Product Type',
        'Product',
        'Quantity (L)',
        'Driver',
        'Plat',
        'Status',
    ];

    // 4️⃣ Isi header ke baris 1
    $sheet->fromArray($headers, null, 'A1');

    // 5️⃣ Style header (bold + border)
    $sheet->getStyle('A1:I1')->applyFromArray([
        'font' => ['bold' => true],
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            ]
        ]
    ]);

    // 6️⃣ Isi data
    $row = 2;
    foreach ($transactions as $i => $t) {
        $sheet->fromArray([
            $i + 1,
            $t->do_number,
            "#".$t->so_number,
            '#'.$t->lo_number,
            date('d-m-Y', strtotime($t->created_at)),
            $t->client_name,
            $t->product_type,
            $t->product_name,
            number_format($t->quantity),
            $t->driver_name,
            $t->plat_number,
            $t->status ? 'Completed' : 'Pending',
        ], null, 'A'.$row);

        $row++;
    }

    // 7️⃣ Auto width kolom
    foreach (range('A','I') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // 8️⃣ Output sebagai download
    $writer = new Xlsx($spreadsheet);
    $filename = 'transactions_report_'.date('Ymd_His').'.xlsx';

    return response()->streamDownload(function () use ($writer) {
        $writer->save('php://output');
    }, $filename, [
        "Content-Type" => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
    ]);
}

    /**
     * Reusable Filter Query (ONE SOURCE OF TRUTH)
     */
    private function getFilteredTransactions(Request $request)
    {
        return DB::table('transaction as t')
            ->leftJoin('users as u', 'u.id', '=', 't.id_user')
            ->leftJoin('clients as c', 'c.id', '=', 't.id_client')
            ->leftJoin('products as p', 'p.id', '=', 't.id_product')
            ->leftJoin('drivers as d', 'd.id', '=', 't.id_driver')
            ->select(
                't.*',
                't.id as tdi',
                'u.name as user_name',

                'c.client_name',
                'c.phone',
                'c.address',
                'c.email',

                'p.product_name',
                'p.quality as q',
                'p.code_product as cp',

                'd.driver_name'
            )

            /* FILTER DATE */
            ->when(
                $request->from && $request->to,
                fn ($q) =>
                    $q->whereBetween('t.created_at', [
                        $request->from . ' 00:00:00',
                        $request->to   . ' 23:59:59'
                    ])
            )

            /* FILTER CLIENT */
            ->when(
                $request->client && $request->client !== 'all',
                fn ($q) => $q->where('t.id_client', $request->client)
            )

            /* FILTER PRODUCT */
            ->when(
                $request->product && $request->product !== 'all',
                fn ($q) => $q->where('t.id_product', $request->product)
            )

            /* SEARCH */
            ->when(
                $request->search,
                function ($q) use ($request) {
                    $search = $request->search;
                    $q->where(function ($qq) use ($search) {
                        $qq->where('t.do_number', 'like', "%$search%")
                           ->orWhere('t.so_number', 'like', "%$search%")
                           ->orWhere('c.client_name', 'like', "%$search%")
                           ->orWhere('d.driver_name', 'like', "%$search%")
                           ->orWhere('p.product_name', 'like', "%$search%");
                    });
                }
            )

            ->orderByDesc('t.created_at');
    }
}
    







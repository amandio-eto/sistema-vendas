<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class loController extends Controller
{
    public function index(Request $request)
    {
        
        $los = DB::table('transaction')
            ->select(
                'so_number',
                'lo_number',
                'client_name',
                'product_name',
                'quantity',
                'created_at'
            )
            ->when($request->from && $request->to, function ($q) use ($request) {
                $q->whereBetween('created_at', [
                    $request->from.' 00:00:00',
                    $request->to.' 23:59:59'
                ]);
            })
            ->orderBy('lo_number')
            ->get();

        return view('Lo.index', compact('los'));
    }

    /* =========================
     | PDF EXPORT
     ========================= */
    public function pdf(Request $request)
    {
        $transactions = $this->baseQuery($request)->get();

        $pdf = Pdf::loadView(
            'Transaction.report_pdf',
            compact('transactions')
        )->setPaper('a4', 'landscape');

        return $pdf->stream('transaction_report.pdf');
    }

    /* =========================
     | EXCEL EXPORT
     ========================= */
    public function excel(Request $request)
    {
        $transactions = $this->baseQuery($request)->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [
            'Nu','SO','LO','LO Jump','LO Unregister',
            'Client','Quantity','Product','Date'
        ];
        $sheet->fromArray($headers, null, 'A1');
        $sheet->getStyle('A1:I1')->getFont()->setBold(true);

        $row = 2;
        foreach ($transactions as $i => $t) {

            [$jump, $missing] = $this->calculateLoIssue($t);

            $sheet->fromArray([
                $i + 1,
                $t->so_number,
                $t->lo_number,
                $jump ?: 'OK',
                count($missing) ? implode(',', $missing) : '-',
                $t->client_name,
                $t->quantity,
                $t->product_name,
                date('d-m-Y', strtotime($t->created_at)),
            ], null, 'A'.$row);

            $row++;
        }

        foreach (range('A','I') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);

        return response()->streamDownload(
            fn() => $writer->save('php://output'),
            'transaction_report.xlsx'
        );
    }

    /* =========================
     | BASE QUERY (REUSABLE)
     ========================= */
    private function baseQuery(Request $request)
    {
        return DB::table('transaction as t')
            ->leftJoin('clients as c','c.id','=','t.id_client')
            ->leftJoin('products as p','p.id','=','t.id_product')
            ->select(
                't.id',
                't.so_number',
                't.lo_number',
                't.quantity',
                't.created_at',
                'c.client_name',
                'p.product_name',
                DB::raw('LAG(t.lo_number) OVER (PARTITION BY t.so_number ORDER BY t.lo_number) as lo_previous')
            )
            ->when($request->from && $request->to, fn($q) =>
                $q->whereBetween('t.created_at', [
                    $request->from.' 00:00:00',
                    $request->to.' 23:59:59'
                ])
            )
            ->when($request->client && $request->client !== 'all', fn($q) =>
                $q->where('t.id_client', $request->client)
            )
            ->when($request->product && $request->product !== 'all', fn($q) =>
                $q->where('t.id_product', $request->product)
            )
            ->orderBy('t.so_number')
            ->orderBy('t.lo_number');
    }

    /* =========================
     | LO CHECK LOGIC
     ========================= */
    private function calculateLoIssue($t)
    {
        $jump = null;
        $missing = [];

        if (!is_null($t->lo_previous)) {
            $diff = $t->lo_number - $t->lo_previous;
            if ($diff > 1) {
                $jump = $diff - 1;
                for ($i = $t->lo_previous + 1; $i < $t->lo_number; $i++) {
                    $missing[] = $i;
                }
            }
        }

        return [$jump, $missing];
    }
}

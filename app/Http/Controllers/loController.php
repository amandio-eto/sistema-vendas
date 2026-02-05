<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LoController extends Controller
{
    /* =========================
     | INDEX (WEB VIEW)
     ========================= */
    public function index(Request $request)
    {
        $los = $this->baseQuery($request)
            ->paginate(20);


        // hitung LO jump & missing sekali saja
        $los->getCollection()->transform(function ($t) {
            [$jump, $missing] = $this->calculateLoIssue($t);
            $t->lo_jump = $jump;
            $t->lo_missing = $missing;
            return $t;
        });




        
        return view('Lo.index', compact('los'));
    }

    /* =========================
     | PDF EXPORT
     ========================= */
    public function pdf(Request $request)
    {
        $transactions = $this->baseQuery($request)->get();

        foreach ($transactions as $t) {
            [$jump, $missing] = $this->calculateLoIssue($t);
            $t->lo_jump = $jump;
            $t->lo_missing = $missing;
        }

        $pdf = Pdf::loadView(
            'Lo.report_pdf',
            compact('transactions')
        )->setPaper('a4', 'landscape');

        return $pdf->stream('lo_report.pdf');
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
            'No','SO','LO','LO Jump','LO Unregister',
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
                $jump ?? 'OK',
                count($missing) ? implode(',', $missing) : '-',
                $t->client_name,
                $t->quantity,
                $t->product_name,
                Carbon::parse($t->created_at)->format('d-m-Y'),
            ], null, 'A' . $row);

            $row++;
        }

        foreach (range('A','I') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);

        return response()->streamDownload(
            fn() => $writer->save('php://output'),
            'lo_report.xlsx'
        );
    }

    /* =========================
     | BASE QUERY (REUSABLE)
     ========================= */
    private function baseQuery(Request $request)
    {
        return DB::table('transaction as t')
            ->leftJoin('clients as c', 'c.id', '=', 't.id_client')
            ->leftJoin('products as p', 'p.id', '=', 't.id_product')
            ->select(
                't.id',
                't.so_number',
                't.lo_number',
                't.quantity',
                't.created_at',
                'c.client_name',
                'p.product_name',
                DB::raw(
                    'LAG(t.lo_number) OVER (PARTITION BY t.so_number ORDER BY t.lo_number) as lo_previous'
                )
            )
            ->when($request->from && $request->to, fn ($q) =>
                $q->whereBetween('t.created_at', [
                    Carbon::parse($request->from)->startOfDay(),
                    Carbon::parse($request->to)->endOfDay()
                ])
            )
            ->when($request->client && $request->client !== 'all', fn ($q) =>
                $q->where('t.id_client', $request->client)
            )
            ->when($request->product && $request->product !== 'all', fn ($q) =>
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

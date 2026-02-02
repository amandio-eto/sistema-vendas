<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleOrderController extends Controller
{
     public function index(Request $request)
    {
       $soList= DB::table('transaction as so')
    ->join('clients as c', 'c.id', '=', 'so.id_client')
    ->join('products as p', 'p.id', '=', 'so.id_product')
    ->leftJoin('transaction as do', function ($join) {
        $join->on('do.so_number', '=', 'so.so_number')
             ->whereNotNull('do.do_number')
             ->whereColumn('do.id_product', 'so.id_product');
    })
    ->whereNull('so.do_number') // hanya SO
    ->whereNull('so.deleted_at')
    ->groupBy('so.so_number', 'so.id_product', 'p.product_name', 'c.client_name', 'so.quantity')
    ->select(
        'so.so_number',
        'so.id_product',
        'p.product_name',
        'c.client_name',
        DB::raw('so.quantity as so_total'),
        DB::raw('COALESCE(SUM(do.quantity),0) as total_delivered'),
        DB::raw('(so.quantity - COALESCE(SUM(do.quantity),0)) as remaining'),
        DB::raw('CASE WHEN COALESCE(SUM(do.quantity),0) > so.quantity THEN 1 ELSE 0 END as over_delivery')
    )
    ->orderBy('so.so_number','desc')
    ->get();

        return view('sale_orders.index', compact('soList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'so_number' => 'required|string',
            'id_client' => 'required|integer',
            'id_product' => 'required|integer',
            'quantity' => 'required|numeric|min:0',
        ]);

        DB::table('sale_orders')->insert([
            'so_number' => $request->so_number,
            'id_client' => $request->id_client,
            'id_product' => $request->id_product,
            'quantity' => $request->quantity,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        toastr()->success('success','Sale Order created successfully');
        return back();
    }

    public function pdfReport(Request $request)
{
    $query = DB::table('sale_orders as so')
        ->join('clients as c', 'c.id', '=', 'so.id_client')
        ->join('products as p', 'p.id', '=', 'so.id_product')
        ->leftJoin('transaction as t', function($join){
            $join->on('t.so_number', '=', 'so.so_number')
                 ->on('t.id_client', '=', 'so.id_client')
                 ->on('t.id_product', '=', 'so.id_product');
        })
        ->select(
            'so.so_number',
            'c.client_name',
            'p.product_name',
            'so.quantity as so_total',
            DB::raw('COALESCE(SUM(t.quantity),0) as total_delivered'),
            DB::raw('(so.quantity - COALESCE(SUM(t.quantity),0)) as remaining'),
            DB::raw('CASE WHEN (so.quantity - COALESCE(SUM(t.quantity),0)) < 0 THEN 1 ELSE 0 END as over_delivery')
        )
        ->groupBy('so.so_number','so.id_client','so.id_product');

    // ================= Filter Search =================
    if($request->filled('so_number')){
        $query->where('so.so_number','like','%'.$request->so_number.'%');
    }
    if($request->filled('client_name')){
        $query->where('c.client_name','like','%'.$request->client_name.'%');
    }
    if($request->filled('product_name')){
        $query->where('p.product_name','like','%'.$request->product_name.'%');
    }

    $soList = $query->orderBy('so.so_number')->get();

    $pdf = Pdf::loadView('sale_orders.report', compact('soList'));
    return $pdf->download('sale_orders_report_'.date('Ymd_His').'.pdf');
}
}

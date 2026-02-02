<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
        $month = now()->translatedFormat('F Y');

        // ===================== PRODUCT SUMMARY =====================
        $prod = DB::table('products as p')
            ->leftJoin('transaction as t', function ($join) use ($currentYear) {
                $join->on('p.id', '=', 't.id_product')
                     ->whereYear('t.created_at', $currentYear);
            })
            ->select(
                'p.id', 'p.product_name', 'p.quality',
                DB::raw('COALESCE(SUM(t.quantity),0) as total_quantity')
            )
            ->groupBy('p.id','p.product_name','p.quality')
            ->orderByDesc('total_quantity')
            ->get();

        // ===================== MONTHLY COLUMN =====================
        $monthlyData = DB::table('transaction as t')
            ->join('products as p', 't.id_product', '=', 'p.id')
            ->select(
                DB::raw('MONTH(t.created_at) as month'),
                'p.product_name',
                DB::raw('SUM(t.quantity) as total_quantity')
            )
            ->whereYear('t.created_at', $currentYear)
            ->groupBy('month', 'p.product_name')
            ->orderBy('month')
            ->orderBy('p.product_name')
            ->get();

        $categories = array_map(fn($m) => date('F', mktime(0,0,0,$m,1)), range(1,12));
        $products = $monthlyData->pluck('product_name')->unique()->toArray();

        $series = [];
        foreach($products as $product) {
            $data = [];
            foreach(range(1,12) as $m) {
                $row = $monthlyData->first(fn($r) => $r->product_name === $product && $r->month == $m);
                $data[] = $row ? (float)$row->total_quantity : 0;
            }
            $series[] = [
                'name' => $product,
                'data' => $data
            ];
        }

        // ===================== PIE PRODUCT =====================
        $pieSeries = DB::table('transaction as t')
            ->join('products as p','p.id','=','t.id_product')
            ->select('p.product_name', DB::raw('SUM(t.quantity) as total_quantity'))
            ->whereYear('t.created_at', $currentYear)
            ->groupBy('p.product_name')
            ->get()
            ->map(fn($r)=>['name'=>$r->product_name,'y'=>(float)$r->total_quantity]);

        // ===================== LINE MONTHLY =====================
        $monthly = DB::table('transaction')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(quantity) as total_liter'))
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        $lineCategories = [];
        $seriesData = [];
        for ($m=1;$m<=12;$m++){
            $lineCategories[] = Carbon::create()->month($m)->translatedFormat('F');
            $seriesData[] = isset($monthly[$m]) ? (float)$monthly[$m]->total_liter : 0;
        }

        // ===================== CLIENT × PRODUCT (Bulan Saat Ini) =====================
        $clientRows = DB::table('transaction as t')
            ->join('products as p', 'p.id', '=', 't.id_product')
            ->select('t.client_name', 'p.product_name', DB::raw('SUM(t.quantity) as total_quantity'))
            ->whereYear('t.created_at', $currentYear)
            ->whereMonth('t.created_at', $currentMonth) // Hanya bulan saat ini
            ->groupBy('t.client_name', 'p.product_name')
            ->orderBy('t.client_name')
            ->orderBy('p.product_name')
            ->get();

        $clientNames = $clientRows->pluck('client_name')->unique()->values()->toArray();
        $clientProducts = $clientRows->pluck('product_name')->unique()->values()->toArray();

        $highchartSeries = [];
        foreach($clientProducts as $product){
            $data = [];
            foreach($clientNames as $client){
                $item = $clientRows->first(fn($r) => $r->client_name == $client && $r->product_name == $product);
                $data[] = $item ? (float)$item->total_quantity : 0;
            }
            $highchartSeries[] = [
                'name' => $product,
                'data' => $data
            ];
        }

        // ===================== PIE PER QUALITY =====================
        $productQuantitySummary = DB::table('transaction as t')
            ->join('products as p','p.id','=','t.id_product')
            ->select('p.quality', DB::raw('SUM(t.quantity) as total_quantity'))
            ->whereYear('t.created_at', $currentYear)
            ->groupBy('p.quality')
            ->orderByDesc('total_quantity')
            ->get();

        $pieSeriesData = $productQuantitySummary->map(fn($p)=>['name'=>$p->quality,'y'=>(float)$p->total_quantity]);
        $chartTitle = 'Total Quantity Per Product Year (L)';

        return view('Dashboard.index', compact(
            'prod','categories','series','pieSeries','lineCategories','seriesData','currentYear',
            'clientNames','highchartSeries','pieSeriesData','chartTitle','month'
        ));
    }
}

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
        $currentDate = Carbon::today();

        // ===================== PRODUCT SUMMARY =====================
       
            $prod = DB::table('products as p')
                ->leftJoin('transaction as t', function ($join) use ($currentDate) {
                    $join->on('p.id', '=', 't.id_product')
                        ->whereDate('t.created_at', $currentDate); // <-- filter hari ini
                })
                ->select(
                    'p.id',
                    'p.product_name',
                    'p.quality',
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

        $clientMonthRows = DB::table('transaction as t')
                ->join('products as p', 'p.id', '=', 't.id_product')
                ->join('clients as c', 'c.id', '=', 't.id_client')
                ->select(
                    'c.client_name',
                    'p.product_name',
                    DB::raw('SUM(t.quantity) as total_quantity')
                )
                ->whereYear('t.created_at', $currentYear)
                ->whereMonth('t.created_at', $currentMonth)
                ->groupBy('t.id_client', 'c.client_name', 'p.product_name')
                ->orderBy('c.client_name') // FIX DI SINI
                ->orderBy('p.product_name')
                ->get();
        

        $clientMonthNames = $clientMonthRows->pluck('client_name')->unique()->values()->toArray();
        $clientMonthProducts = $clientMonthRows->pluck('product_name')->unique()->values()->toArray();

        $clientMonthSeries = [];
        foreach($clientMonthProducts as $product){
            $data = [];
            foreach($clientMonthNames as $client){
                $item = $clientMonthRows->first(fn($r) => $r->client_name == $client && $r->product_name == $product);
                $data[] = $item ? (float)$item->total_quantity : 0;
            }
            $clientMonthSeries[] = [
                'name' => $product,
                'data' => $data
            ];
        }

        // ===================== TOTAL CLIENT × PRODUCT (Tahun Ini) =====================
        $clientYearRows = DB::table('transaction as t')
                ->join('products as p', 'p.id', '=', 't.id_product')
                ->join('clients as c', 'c.id', '=', 't.id_client') // TAMBAH INI
                ->select(
                    'c.client_name',
                    'p.product_name',
                    DB::raw('SUM(t.quantity) as total_quantity')
                )
                ->whereYear('t.created_at', $currentYear)
                ->groupBy('t.id_client', 'c.client_name', 'p.product_name') // FIX GROUP BY
                ->orderBy('c.client_name') // FIX ALIAS
                ->orderBy('p.product_name')
                ->get();

        $clientYearNames = $clientYearRows->pluck('client_name')->unique()->values()->toArray();
        $clientYearProducts = $clientYearRows->pluck('product_name')->unique()->values()->toArray();

        $clientYearSeries = [];
        foreach($clientYearProducts as $product){
            $data = [];
            foreach($clientYearNames as $client){
                $item = $clientYearRows->first(fn($r) => $r->client_name == $client && $r->product_name == $product);
                $data[] = $item ? (float)$item->total_quantity : 0;
            }
            $clientYearSeries[] = [
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


      
                $productToday = DB::table('transaction as t')
    ->join('products as p', 'p.id', '=', 't.id_product')
    ->join('clients as c', 'c.id', '=', 't.id_client')
    ->select(
        'p.product_name',

        // SUM LITER ETO
        DB::raw("
            SUM(CASE 
                WHEN c.tin = 10522139 THEN t.quantity 
                ELSE 0 
            END) as eto_liter
        "),

        // SUM LITER NON ETO
        DB::raw("
            SUM(CASE 
                WHEN c.tin IS NULL OR c.tin != 10522139 THEN t.quantity 
                ELSE 0 
            END) as client_liter
        ")
    )
    ->whereDate('t.created_at', Carbon::today())
    ->groupBy('p.product_name')
    ->orderBy('p.product_name')
    ->get();



    $doproductToday = DB::table('transaction as t')
    ->leftJoin('products as p', 'p.id', '=', 't.id_product')
    ->leftJoin('clients as c', 'c.id', '=', 't.id_client')
    ->select(
        'p.product_name',

        // jumlah transaksi client
        DB::raw("
            SUM(CASE 
                WHEN c.tin IS NULL OR c.tin != 10522139 
                THEN 1 ELSE 0 END
            ) as total_client_trans
        "),

        // jumlah transaksi ETO
        DB::raw("
            SUM(CASE 
                WHEN c.tin = 10522139 
                THEN 1 ELSE 0 END
            ) as total_eto_trans
        "),

        // total liter client
        DB::raw("
            COALESCE(SUM(CASE 
                WHEN c.tin IS NULL OR c.tin != 10522139 
                THEN t.quantity ELSE 0 END
            ),0) as total_client_liter
        "),

        // total liter ETO
        DB::raw("
            COALESCE(SUM(CASE 
                WHEN c.tin = 10522139 
                THEN t.quantity ELSE 0 END
            ),0) as total_eto_liter
        ")
    )
    ->whereDate('t.created_at', Carbon::today())
    ->groupBy('p.product_name')
    ->orderBy('p.product_name')
    ->get();

    $eto = DB::table('transaction as t')
    ->leftJoin('clients as c', 'c.id', '=', 't.id_client')
    ->where('c.tin', 10522139)
    ->whereDate('t.created_at', Carbon::today())
    ->selectRaw('COUNT(*) as total_transaksi, COALESCE(SUM(t.quantity),0) as total_liter')
    ->first();


    $client = DB::table('transaction as t')
    ->leftJoin('clients as c', 'c.id', '=', 't.id_client')
    ->whereDate('t.created_at', Carbon::today())
    ->where(function($q){
        $q->whereNull('c.tin')
          ->orWhere('c.tin','!=',10522139);
    })
    ->selectRaw('COUNT(*) as total_transaksi, COALESCE(SUM(t.quantity),0) as total_liter')
    ->first();


    #########################################


    $today = Carbon::today();
    $totalTransactionToday = DB::table('transaction')
    ->whereDate('created_at', $today)
    ->count();

/* =========================
   TOTAL LITER HARI INI
========================= */
$totalLiterToday = DB::table('transaction')
    ->whereDate('created_at', $today)
    ->sum('quantity');

/* default 0 jika null */
$totalLiterToday = $totalLiterToday ?? 0;

        return view('Dashboard.index', compact(
            'totalLiterToday','totalLiterToday',
            'prod','categories','series','pieSeries','lineCategories','seriesData','currentYear',
            'clientMonthNames','clientMonthSeries','clientYearNames','clientYearSeries',
            'pieSeriesData','chartTitle','month','productToday','eto','client'
        ));
    }
}

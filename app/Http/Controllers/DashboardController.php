<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Json;

class DashboardController extends Controller
{
    

    public function index(Request $request)
    {


        $year = Carbon::now()->year;

    // ==============================
    // Chart height (desktop/mobile)
    // ==============================
    $userAgent = $request->header('User-Agent');
    $isMobile = preg_match('/Mobile|Android|iPhone|iPad|Tablet/i', $userAgent);
    $defaultHeight = $isMobile ? null : 600;

    // ==============================
    // Monthly transactions (1-12)
    // ==============================
    $monthlyTransactions = DB::table('transaction')
        ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(quantity) as total_quantity'))
        ->whereYear('created_at', $year)
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->orderBy('month')
        ->get()
        ->keyBy('month');

    $allMonths = [];
    for ($m = 1; $m <= 12; $m++) {
        $allMonths[$m] = [
            'month' => $m,
            'month_name' => date('F', mktime(0,0,0,$m,1)),
            'total_quantity' => isset($monthlyTransactions[$m]) ? $monthlyTransactions[$m]->total_quantity : 0
        ];
    }
    $allMonths = collect($allMonths);

    // ==============================
    // Transactions per product
    // ==============================
    $transactions = DB::table('transaction as t')
        ->join('products as p', 'p.id', '=', 't.id_product')
        ->select('p.product_name','p.quality', DB::raw('SUM(t.quantity) as total_quantity'))
        ->whereYear('t.created_at', $year)
        ->groupBy('p.product_name','p.quality')
        ->get();

    // ==============================
    // Transactions per client
    // ==============================
    $clientsMonths = DB::table('transaction as t')
        ->join('clients as c', 'c.id', '=', 't.id_client')
        ->select('c.client_name', DB::raw('SUM(t.quantity) as total_quantity'))
        ->whereYear('t.created_at', $year)
        ->groupBy('c.client_name')
        ->get();

    // ==============================
    // Filter per product today
    // ==============================
    $filterDate = $request->date ?? Carbon::today()->toDateString();
    $prod = DB::table('products as p')
        ->leftJoin('transaction as t', function ($join) use ($filterDate) {
            $join->on('p.id', '=', 't.id_product')
                 ->whereDate('t.created_at', $filterDate);
        })
        ->select('p.id','p.product_name','p.quality', DB::raw('COALESCE(SUM(t.quantity), 0) as total_quantity'))
        ->groupBy('p.id','p.product_name','p.quality')
        ->orderByDesc('total_quantity')
        ->get();

    // ==============================
    // Highcharts data
    // ==============================
    $test = DB::table('transaction as t')
        ->join('products as p', 'p.id', '=', 't.id_product')
        ->select('p.product_name', DB::raw('SUM(t.quantity) as total_quantity'), DB::raw('MONTH(t.created_at) as month'))
        ->whereYear('t.created_at', $year)
        ->groupBy('p.product_name', DB::raw('MONTH(t.created_at)'))
        ->orderBy('month')
        ->get();

    $monthNames = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];

    $categories = [];
    foreach ($test as $t) {
        $t->nBulan = $monthNames[$t->month];
        if (!in_array($t->nBulan, $categories)) $categories[] = $t->nBulan;
    }

    $products = $test->pluck('product_name')->unique();
    $series = [];
    foreach ($products as $prodName) {
        $dataSeries = [];
        foreach ($categories as $monthName) {
            $item = $test->first(fn($t) => $t->product_name === $prodName && $t->nBulan === $monthName);
            $dataSeries[] = $item ? (float)$item->total_quantity : 0;
        }
        $series[] = ['name'=>$prodName, 'data'=>$dataSeries];
    }

    // ==============================
    // Safety fallback
    // ==============================
    $prod = $prod ?? collect([]);
    $allMonths = $allMonths ?? collect([]);
    $transactions = $transactions ?? collect([]);
    $clientsMonths = $clientsMonths ?? collect([]);
    $categories = $categories ?? [];
    $series = $series ?? [];



    ############### Pie Chart 

    $year = Carbon::now()->year;

// Mapping warna berdasarkan quality
$qualityColors = [
    'RON92'  => '#2787F5',
    'RON98'  => '#CA02F2',
    '10PPM'  => '#F5B727',
    'JET-A1' => '#02F226',
];

$year = date('Y');

$pieSeries = DB::table('transaction as t')
    ->join('products as p', 'p.id', '=', 't.id_product')
    ->select(
        'p.product_name',
        DB::raw('SUM(t.quantity) as total_quantity')
    )
    ->whereYear('t.created_at', $year)
    ->groupBy('p.product_name')
    ->orderByDesc('total_quantity')
    ->get()
    ->map(function ($row) {
        return [
            'name' => $row->product_name,
            'y'    => (float) $row->total_quantity // WAJIB numeric
        ];
    });


    #LineChart 
    $monthly = DB::table('transaction')
    ->select(
        DB::raw('MONTH(created_at) as month'),
        DB::raw('SUM(quantity) as total_liter')
    )
    ->whereYear('created_at', $year)
    ->groupBy(DB::raw('MONTH(created_at)'))
    ->orderBy('month')
    ->get()
    ->keyBy('month');

// Siapkan 12 bulan (biar bulan kosong tetap muncul)
$categories = [];
$seriesData = [];

for ($m = 1; $m <= 12; $m++) {
    $categories[] = Carbon::create()->month($m)->translatedFormat('F');
    $seriesData[] = isset($monthly[$m])
        ? (float) $monthly[$m]->total_liter
        : 0;
}


#Chart forecast 

$hourlyTransactions = DB::table('transaction as t')
    ->select(
        DB::raw('HOUR(t.created_at) as hour'),
        DB::raw('SUM(t.quantity) as total_quantity')
    )
    ->whereDate('t.created_at', now()->toDateString())
    ->groupBy(DB::raw('HOUR(t.created_at)'))
    ->orderBy('hour')
    ->get();

// Lengkapi 24 jam (00–23)
$hours = array_fill(0, 24, 0);

foreach ($hourlyTransactions as $row) {
    $hours[(int)$row->hour] = (float)$row->total_quantity;
}

$actualData = array_values($hours);

// Forecast sederhana (rata-rata transaksi berjalan)
$nonZero = array_filter($actualData);
$avg = count($nonZero) ? array_sum($nonZero) / count($nonZero) : 0;

// Forecast 5 jam ke depan
$forecastData = [];
for ($i = 0; $i < 5; $i++) {
    $forecastData[] = round($avg, 2);
}


   return view('Dashboard.index', array_merge(
    compact(
        'prod',
        'allMonths',
        'transactions',
        'year',
        'clientsMonths',
        'defaultHeight',
        'isMobile',
        'categories',
        'series',
        'pieSeries',
        'seriesData'
    ),
    [
        'actualData'   => json_encode($actualData),
        'forecastData' => json_encode($forecastData),
    ]
));



    }
}
                                                                                                                                                           
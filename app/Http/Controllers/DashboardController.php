<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Json;

class DashboardController extends Controller
{
    

    public function index()
    {

        #ida ba Iha Chart\// Tahun ini
$year = Carbon::now()->year;

// Ambil jumlah transaksi per bulan
$monthlyTransactions = DB::table('transaction')
    ->select(
        DB::raw('MONTH(created_at) as month'),
        DB::raw('SUM(quantity) as total_quantity')
    )
    ->whereYear('created_at', $year)
    ->groupBy(DB::raw('MONTH(created_at)'))
    ->orderBy('month')
    ->get()
    ->keyBy('month'); // jadikan key berdasarkan bulan

// Buat array bulan 1-12
$allMonths = [];
for ($m=1; $m<=12; $m++) {
    $allMonths[$m] = [
        'month' => $m,
        'month_name' => date('F', mktime(0,0,0,$m,1)),
        'total_quantity' => isset($monthlyTransactions[$m]) ? $monthlyTransactions[$m]->total_quantity : 0
    ];
}

// Konversi ke collection kalau mau
$allMonths = collect($allMonths);

#Ida nee mak Rohann husi Chart

$transactions = DB::table('transaction as t')
    ->join('products as p', 'p.id', '=', 't.id_product')
    ->select(
        'p.product_name','p.quality',
        DB::raw('SUM(t.quantity) as total_quantity')
    )
    ->whereYear('t.created_at', $year)
    ->groupBy('p.product_name','p.quality')
    ->get();

  $clientsMonths = DB::table('transaction as t')
        ->join('clients as c', 'c.id', '=', 't.id_client')
        ->select('c.client_name', DB::raw('SUM(t.quantity) as total_quantity'))
        ->whereYear('t.created_at', $year)
        ->groupBy('c.client_name')
        ->get();

          

#Ida mak Filter Perproduct 
$filterDate = $request->date ?? Carbon::today()->toDateString(); // default hari ini
$prod = DB::table('products as p')
    ->leftJoin('transaction as t', function ($join) use ($filterDate) {
        $join->on('p.id', '=', 't.id_product')
             ->whereDate('t.created_at', $filterDate);
    })
    ->select(
        'p.id',
        'p.product_name',
        'p.quality',
        DB::raw('COALESCE(SUM(t.quantity), 0) as total_quantity')
    )
    ->groupBy(
        'p.id',
        'p.product_name',
        'p.quality'
    )
    ->orderByDesc('total_quantity')
    ->get();
      #Ba iha Dashboard

      
    // Cek User Agent untuk device
   $userAgent = request()->header('User-Agent');
    $isMobile = preg_match('/Mobile|Android|iPhone|iPad|Tablet/i', $userAgent);

    // Default height chart (desktop only)
    $defaultHeight = $isMobile ? null : 600;

        $month = $month ?? date('m'); // default bulan sekarang
    $year = $year ?? date('Y');   // default tahun sekarang

    $data = DB::table('transaction as t')
            ->join('products as p', 'p.id', '=', 't.id_product')
            ->select(
        'p.product_name',
        DB::raw('SUM(t.quantity) as total_liter'),
        DB::raw('YEAR(t.created_at) as tahun'),
        DB::raw('MONTH(t.created_at) as bulan_number'),  // untuk sorting
        DB::raw('MONTHNAME(t.created_at) as bulan')
    )
    ->groupBy('p.product_name', 'tahun', 'bulan_number', 'bulan')
    ->orderBy('tahun', 'asc')
    ->orderBy('bulan_number', 'asc')
    ->orderBy('p.product_name')
    ->simplePaginate(3);



    return view('Dashboard.index',compact('prod','allMonths','transactions','year','clientsMonths','defaultHeight', 'isMobile','data'));
    }
}

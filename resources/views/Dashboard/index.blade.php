@extends('Master.Master')
@section('title','Dashboard')
@section('header')

@endsection

@section('content')

{{-- =======================
   PRODUCT SUMMARY CARDS
======================= --}}
<div class="row g-3 m-3">
@forelse($prod as $p)
    @php
        $qualityColors = [
            'RON92' => '#2787F5',
            'RON98' => '#CA02F2',
            '10PPM' => '#F5B727',
            'JET-A1'=> '#02F226',
        ];
        $cardColor = $qualityColors[strtoupper(trim($p->quality))] ?? '#6c757d';
    @endphp
    <div class="col-md-3" style="font-size:10px;">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center p-2">
                <div class="d-flex align-items-center ">
                    <div class="me-3 rounded-circle d-flex align-items-center justify-content-center"
                        style="width:50px; height:50px; background-color: {{ $cardColor }};">
                        <i class="bi bi-fuel-pump-fill text-white fs-5"></i>
                    </div>
                    <div>
                        <div class="fw-semibold text-truncate" style="font-size:12px">{{ $p->product_name }}</div>
                        <div class="text-muted" style="font-size:10px;">{{ $p->quality }}</div>
                    </div>
                </div>
                <div class="text-end">
                    <div class="fw-bold text-primary ml-2" style="font-size:12px; line-height:1">
                        {{ format_liter($p->total_quantity) }}
                    </div>
                    <div class="text-muted" style="font-size:12px">Total</div>
                </div>
            </div>
        </div>
    </div>
@empty
<div class="col-12">
    <div class="alert alert-light text-center border">Data is Empty</div>
</div>
@endforelse


<div class="row mt-2">
    @foreach($productToday as $row)
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h6 class="fw-bold">
                        {{ $row->product_name }}
                    </h6>

                    <div class="d-flex justify-content-between mt-3">

                        <div>
                            <small class="text-muted">ETO Liter</small>
                            <h5 class="text-primary mb-0">
                                {{ format_liter($row->eto_liter, 0) }}
                            </h5>
                        </div>

                        <div>
                            <small class="text-muted">Client Liter</small>
                            <h5 class="text-success mb-0">
                                {{ format_liter($row->client_liter, 0) }}
                            </h5>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    @endforeach
</div>


<div class="row ">

    <!-- ETO -->
    <div class="col-md-4">
        <div class="card pro-card eto">

            <div class="card-body">

                <div class="top">
                    <div class="title" style="font-size: 20px;">ETO TODAY</div>
                    <div class="icon">
                        <i class="fa-solid fa-gas-pump"></i>
                    </div>
                </div>

                <div class="number">
                    {{ $eto->total_transaksi ?? 0 }}
                </div>

                <div class="label">TRANSACTIONS</div>

                <div class="cardc_footer">
                    <span style="font-size: 30px;">{{ format_liter($eto->total_liter) ?? 0 }}</span>
                    <small>Total Liter</small>
                </div>

            </div>
        </div>
    </div>

    <!-- CLIENT -->
    <div class="col-md-4">
        <div class="card pro-card client">

            <div class="card-body">

                <div class="top">
                    <div class="title" style="font-size: 20px;">CLIENT TODAY</div>
                    <div class="icon">
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>

                <div class="number">
                    {{ ($client->total_transaksi ?? 0)  }}
                </div>

                <div class="label">TRANSACTIONS</div>

                <div class="cardc_footer">
                    <span style="font-size: 30px;">{{ format_liter($client->total_liter) ?? 0 }}</span>
                    <small>Total Liter</small>
                </div>

            </div>
        </div>
    </div>




     <div class="col-md-4">
        <div class="card pro-card client" class="card card-dash" style="background: linear-gradient(135deg,#1fa2ff,#12d8fa,#a6ffcb);">

            <div class="card-body">

                <div class="top">
                    <div class="title" style="font-size: 20px;"> TODAY</div>
                    <div class="icon">
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>

                <div class="number">
                    {{ ($client->total_transaksi ?? 0 ) + ($eto->total_transaksi ?? 0) }}
                </div>

                <div class="label">TRANSACTIONS</div>

                <div class="cardc_footer">
                    <span style="font-size: 30px;">{{format_liter( $totalLiterToday  ?? 0) }}</span>
                    <small>Total Liter</small>
                </div>

            </div>
        </div>
    </div>







  

    <!-- TOTAL LITER -->
  

</div>





</div>



{{-- =======================
   CHARTS ROW 1
======================= --}}
<div class="row g-3 m-3">
    <div class="col-md">
        <div class="card shadow-sm" style="border-radius:12px;">
           <div id="monthlyChart" style="height:400px;"></div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card shadow-sm" style="border-radius:12px;">
            <div class="card-body"><div id="pieProduct" style="height:400px"></div></div>
        </div>
    </div>
</div>

{{-- =======================
   CLIENT × PRODUCT CHART (Bulan Saat Ini)
======================= --}}
<div class="row g-3 m-3">
    <div class="col-md-12">
        <div class="card shadow-sm" style="border-radius:12px;">
            <div class="card-body">
                <div id="clientProductChart" style="height:420px"></div>
            </div>
        </div>
    </div>
</div>

{{-- =======================
   TOTAL CLIENT × PRODUCT (Tahun Ini) – BARU
======================= --}}


{{-- =======================
   OTHER CHARTS
======================= --}}
<div class="row g-3 m-3">
    <div class="col-md-12">
        <div class="card shadow-sm" style="border-radius:12px;">
            <div class="card-body"><div id="containe" style="width:100%; height:500px;"></div></div>
        </div>
    </div>
</div>

{{-- =======================
   LINE CHART & PIE QUALITY
======================= --}}
<div class="row g-3 m-3">
    <div class="col-md-7">
        <div class="card shadow-sm" style="border-radius:12px;">
            <div class="card-body"><div id="lineMonthly" style="height:420px"></div></div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card shadow-sm" style="border-radius:12px;">
            <div class="card-body"><div id="pieContainerLiters" style="width:100%;"></div></div>
        </div>
    </div>
</div>

@endsection

@section('footer')
<script src="https://code.highcharts.com/highcharts.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ===================== MONTHLY COLUMN =====================
    Highcharts.chart('monthlyChart', {
        chart: { type: 'column' },
        title: { text: 'Total Quantity per Product per Month {{ $currentYear }}' },
        xAxis: { categories: @json($categories), crosshair: true },
        yAxis: { min: 0, title: { text: 'Total Quantity (L)' } },
        tooltip: { shared: true, useHTML: true },
        plotOptions: { column: { pointPadding: 0.1, borderWidth: 0, dataLabels: { enabled: true } } },
        series: @json($series)
    });

    // ===================== PIE PRODUCT =====================
    Highcharts.chart('pieProduct', {
        chart: { type: 'pie' },
        title: { text: 'Total Transaction per Product {{ $currentYear }}' },
        series: [{ name: 'Quantity', colorByPoint: true, data: @json($pieSeries) }]
    });

    // ===================== CLIENT × PRODUCT (Bulan Saat Ini) =====================
   Highcharts.chart('clientProductChart', {
    chart: { type: 'column' },
    title: { text: 'Transaction Client Per Product ({{ $month }})' },
    xAxis: { categories: @json($clientMonthNames), title: { text: 'Client' } },
    yAxis: { min: 0, title: { text: 'Total Quantity (L)' } },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                     '<td style="padding:0"><b>{point.y:.2f} L</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: { column: { pointPadding: 0.1, borderWidth: 0, dataLabels: { enabled: true } } },
    series: @json($clientMonthSeries)
});

    // ===================== TOTAL CLIENT × PRODUCT (Tahun Ini) =====================
    

    // ===================== LINE MONTHLY =====================
    Highcharts.chart('lineMonthly', {
        chart: { type: 'line' },
        title: { text: 'Total Liter Month {{ $currentYear }}' },
        xAxis: { categories: @json($lineCategories) },
        yAxis: { title: { text: 'Total Liter (L)' } },
        series: [{ name: 'Total Liter', data: @json($seriesData) }]
    });

    // ===================== COLUMN PER CLIENT =====================
        Highcharts.chart('containe', {
            chart: { type: 'column' },
            title: { text: 'Total Quantity Per Client Year' },
            xAxis: { categories: @json($clientYearNames), crosshair: true },
            yAxis: { min: 0, title: { text: 'Total Quantity (L)' } },
            tooltip: { shared: true, useHTML: true },
            plotOptions: { column: { pointPadding: 0.1, borderWidth: 0, dataLabels: { enabled: true } } },
            series: @json($clientYearSeries)
        });


    // ===================== PIE PER QUALITY =====================
    Highcharts.chart('pieContainerLiters', {
        chart: { type: 'pie', animation: { duration: 2000, easing: 'easeOutBounce' } },
        title: { text: @json($chartTitle) },
        tooltip: {
            pointFormatter: function() {
                return '<b>' + this.name + '</b>: ' + this.y.toLocaleString('en-US', { minimumFractionDigits: 2 }) + ' L';
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: { enabled: true, formatter: function() { return '<b>' + this.point.name + '</b>: ' + this.y.toLocaleString('en-US', { minimumFractionDigits: 2 }) + ' L'; } },
                showInLegend: true,
                animation: { duration: 2000, easing: 'easeOutBounce' }
            }
        },
        series: [{ name: 'Quantity', colorByPoint: true, data: @json($pieSeriesData) }]
    });

});
</script>
@endsection

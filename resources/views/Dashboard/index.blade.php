@extends('Master.Master')
@section('title','Dashboard')

@section('content')

{{-- =======================
   PRODUCT SUMMARY CARDS
======================= --}}
<div class="row g-3 m-3">
@forelse($prod as $p)
    @php
        $colors = [
            'RON92' => '#2787F5',
            'RON98' => '#CA02F2',
            '10PPM' => '#F5B727',
            'JET-A1'=> '#02F226',
        ];
        $color = $colors[strtoupper(trim($p->quality))] ?? '#6c757d';
    @endphp

    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="me-2 rounded-circle d-flex align-items-center justify-content-center"
                         style="width:36px;height:36px;background:{{ $color }}">
                        <i class="bi bi-fuel-pump-fill text-white"></i>
                    </div>
                    <div>
                        <div class="fw-semibold" style="font-size:12px">{{ $p->product_name }}</div>
                        <div class="text-muted" style="font-size:11px">{{ $p->quality }}</div>
                    </div>
                </div>
                <div class="text-end">
                    <div class="fw-bold text-primary" style="font-size:12px">
                        {{ format_liter($p->total_quantity,2) }}
                    </div>
                    <div class="text-muted" style="font-size:11px">Total</div>
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="col-12">
        <div class="alert alert-light text-center border">Data is Empty</div>
    </div>
@endforelse
</div>

{{-- =======================
   CHARTS ROW 1
======================= --}}
<div class="row g-3 m-3">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <div id="monthlyChart" style="height:400px"></div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <div id="pieProduct" style="height:400px"></div>
            </div>
        </div>
    </div>
</div>

{{-- =======================
   CLIENT x PRODUCT CHART
======================= --}}
<div class="row g-3 m-3">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <div id="clientProductChart" style="height:420px"></div>
            </div>
        </div>
    </div>
</div>

{{-- =======================
   LINE CHART
======================= --}}
<div class="row g-3 m-3">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <div id="lineMonthly" style="height:420px"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')
<script src="https://code.highcharts.com/highcharts.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ================= Monthly Column =================
    Highcharts.chart('monthlyChart', {
        chart: { type: 'column' },
        title: { text: 'Total Sales per Month {{ $year }}' },
        xAxis: { categories: @json($categories) },
        yAxis: { title: { text: 'Total Quantity (L)' } },
        series: @json($series)
    });

    // ================= Pie Product =================
    Highcharts.chart('pieProduct', {
        chart: { type: 'pie' },
        title: { text: 'Total Transaction per Product {{ $year }}' },
        series: [{
            name: 'Quantity',
            colorByPoint: true,
            data: @json($pieSeries)
        }]
    });

    // ================= Client x Product =================
    Highcharts.chart('clientProductChart', {
        chart: { type: 'column' },
        title: { text: 'Transaksi Client per Product ({{ $month }})' },
        xAxis: {
            categories: {!! json_encode($clients) !!},
            title: { text: 'Client' }
        },
        yAxis: {
            min: 0,
            title: { text: 'Total Quantity' }
        },
        tooltip: { shared: true },
        plotOptions: {
            column: { dataLabels: { enabled: true } }
        },
        series: {!! json_encode($series) !!}
    });

    // ================= Line Monthly =================
    Highcharts.chart('lineMonthly', {
        chart: { type: 'line' },
        title: { text: 'Total Liter per Month {{ $year }}' },
        xAxis: { categories: @json($categories) },
        yAxis: { title: { text: 'Total Liter (L)' } },
        series: [{
            name: 'Total Liter',
            data: @json($seriesData)
        }]
    });

});
</script>
@endsection

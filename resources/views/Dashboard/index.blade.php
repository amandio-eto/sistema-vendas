@extends('Master.Master')
@section('title','Dashboard')

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

                        {{-- Icon & Product Info --}}
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

                        {{-- Total Quantity --}}
                        <div class="text-end">
                            <div class="fw-bold text-primary ml-2" style="font-size:12px; line-height:1">
                                {{ format_liter($p->total_quantity,2) }}
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
</div>

{{-- =======================
   CHARTS ROW 1
======================= --}}
<div class="row g-3 m-3">
    <div class="col-md">
        <div class="card shadow-sm" style="border-radius:12px;">
            <div class="card-body">
                <div id="monthlyChart" ></div>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card shadow-sm" style="border-radius:12px;">
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
        <div class="card shadow-sm" style="border-radius:12px;">
            <div class="card-body">
                <div id="clientProductChart" style="height:420px"></div>
            </div>
        </div>
    </div>
</div>

{{-- =======================
   OTHER CHART
======================= --}}
<div class="row g-3 m-3">
    <div class="col-md-12">
        <div class="card shadow-sm" style="border-radius:12px;">
            <div class="card-body">
                <div id="containe" style="width:100%; height:500px;"></div>
            </div>
        </div>
    </div>
</div>

{{-- =======================
   LINE CHART
======================= --}}
<div class="row g-3 m-3">
    <div class="col-md-6">
        <div class="card shadow-sm" style="border-radius:12px;">
            <div class="card-body">
                <div id="lineMonthly" style="height:420px"></div>
            </div>
        </div>
    </div>
     <div class="col-md-6">
        <div class="card shadow-sm" style="border-radius:12px;">
            <div class="card-body">
             <div id="pieContainerLiters" style="width:100%; ></div>
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
        title: { text: 'Transaction Client Per Product ({{ $month }})' },
        xAxis: {
            categories: {!! json_encode($clients) !!},
            title: { text: 'Client' }
        },
        yAxis: {
            min: 0,
            title: { text: 'Total Quantity' }
        },
        tooltip: { shared: true },
        plotOptions: { column: { dataLabels: { enabled: true } } },
        series: {!! json_encode($series) !!}
    });

    // ================= Line Monthly =================
    Highcharts.chart('lineMonthly', {
        chart: { type: 'line' },
        title: { text: 'Total Liter Month {{ $year }}' },
        xAxis: { categories: @json($categories) },
        yAxis: { title: { text: 'Total Liter (L)' } },
        series: [{
            name: 'Total Liter',
            data: @json($seriesData)
        }]
    });

    // ================= Column per Client =================
    Highcharts.chart('containe', {
        chart: { type: 'column' },
        title: { text: 'Total Quantity Per Client Year' },
        xAxis: {
            categories: @json($clientNames),
            crosshair: true
        },
        yAxis: { min: 0, title: { text: 'Total Quantity' } },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                         '<td style="padding:0"><b>{point.y:.2f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: { column: { pointPadding: 0.1, borderWidth: 0 } },
        series: @json($highchartSeries)
    });

    // ================= Pie Liters =================
    Highcharts.chart('pieContainerLiters', {
        chart: { type: 'pie', animation: { duration: 2000, easing: 'easeOutBounce' } },
        title: { text: @json($chartTitle) },
        tooltip: {
            pointFormatter: function() {
                return '<b>' + this.name + '</b>: ' + this.y.toLocaleString('en-US', {minimumFractionDigits: 2}) + ' L';
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    formatter: function() {
                        return '<b>' + this.point.name + '</b>: ' + this.y.toLocaleString('en-US', {minimumFractionDigits: 2}) + ' L';
                    }
                },
                showInLegend: true,
                animation: { duration: 2000, easing: 'easeOutBounce' }
            }
        },
        series: [{
            name: 'Quantity',
            colorByPoint: true,
            data: @json($pieSeriesData)
        }]
    });

});
</script>

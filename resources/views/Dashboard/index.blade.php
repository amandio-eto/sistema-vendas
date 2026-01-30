@extends('Master.Master')
@section('title','Dashboard')
@section('content')

<div class="row g-3 m-3">

@forelse($prod as $p)
    @php
        $colors = [
            'RON92' => '#2787F5',
            'RON98' => '#CA02F2',
            '10PPM' => '#F5B727',
            'JET-A1' => '#02F226',
        ];
        $color = $colors[strtoupper(trim($p->quality))] ?? '#6c757d';
    @endphp

    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="card border-0 shadow-sm h-100 product-card">
            <div class="card-body d-flex align-items-center justify-content-between p-3">

                {{-- Left --}}
                <div class="d-flex align-items-center">
                    <div class="icon-wrapper"
                         style="background-color: {{ $color }};">
                        <i class="bi bi-fuel-pump-fill text-white"></i>
                    </div>

                    <div class="ms-2 lh-sm">
                        <div class="fw-semibold text-dark text-truncate"
                             style="font-size:12px;"
                             title="{{ $p->product_name }}">
                            {{ $p->product_name }}
                        </div>
                        <div class="text-muted" style="font-size:11px;">
                            {{ $p->quality }}
                        </div>
                    </div>
                </div>

                {{-- Right --}}
                <div class="text-end">
                    <div class="fw-bold text-primary" style="font-size:12px;">
                        {{ format_liter($p->total_quantity, 2) }}
                    </div>
                    <div class="text-muted" style="font-size:11px;">
                        Total
                    </div>
                </div>

            </div>
        </div>
    </div>

@empty


    <div class="col-12">
        <div class="alert alert-light text-center border" style="font-size:12px;">
            <i class="bi bi-inbox d-block mb-1" style="font-size:22px;"></i>
            <span class="fw-semibold">Data is Empty</span>
        </div>
    </div>
@endforelse

</div>

<div class="row">
    <div class="col-md-6">
       
    <div class="card shadow-sm">
        <div class="card-body">
            <div id="container" ></div>
        </div>
    </div>
</div>


<div class="col-md-6">
    <div class="card border-0 shadow-sm">
    
    <div class="card-body">
      <div id="pieProduct" ></div>
    </div>
</div>
</div>
  

</div>




<div class="row">
    <div class="col">
        <div id="lineMonthly" style="height:420px;"></div>
    </div>
</div>

@endsection

@section('footer')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    Highcharts.chart('container', {
        chart: { type: 'column' },
        title: { text: 'Total Sales per Month {{ $year }}' },
        xAxis: { categories: @json($categories) },
        yAxis: { title: { text: 'Total Quantity (liter)' } },
        tooltip: { valueSuffix: ' liters' },
        series: @json($series)
    });
});
</script>



<script src="https://code.highcharts.com/highcharts.js"></script>

<script>
function formatLiter(value) {
    return new Intl.NumberFormat('id-ID', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(value);
}

Highcharts.chart('pieProduct', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Total Transaction Per Product - {{ $year }}'
    },
    tooltip: {
        pointFormatter: function () {
            return `<b>${formatLiter(this.y)}</b> L`;
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                style: {
                    fontSize: '12px'
                },
                formatter: function () {
                    return `<b>${this.point.name}</b><br>${formatLiter(this.y)} L`;
                }
            }
        }
    },
    series: [{
        name: 'Total Quantity',
        colorByPoint: true,
        data: @json($pieSeries)
    }]
});
</script>



<script>
function formatLiter(value) {
    return new Intl.NumberFormat('id-ID', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(value);
}

Highcharts.chart('lineMonthly', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Total Liter per Month - {{ $year }}'
    },
    xAxis: {
        categories: @json($categories),
        labels: {
            style: { fontSize: '12px' }
        }
    },
    yAxis: {
        title: {
            text: 'Total Liter (L)',
            style: { fontSize: '12px' }
        },
        labels: {
            formatter: function () {
                return formatLiter(this.value);
            },
            style: { fontSize: '12px' }
        }
    },
    tooltip: {
        formatter: function () {
            return `<b>${this.x}</b><br>
                    ${formatLiter(this.y)} L`;
        }
    },
    plotOptions: {
        line: {
            marker: {
                radius: 4
            },
            dataLabels: {
                enabled: true,
                style: { fontSize: '12px' },
                formatter: function () {
                    return formatLiter(this.y);
                }
            }
        }
    },
    series: [{
        name: 'Total Liter',
        data: @json($seriesData),
        color: '#2787F5'
    }]
});
</script>





@endsection

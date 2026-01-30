@extends('Master.Master')
@section('title','Dashboard')
@section('content')



                    <!-- [Invoices Awaiting Payment] start -->
               
                     
<div class="row g-3 m-3">

@forelse($prod as $p)

    @php
        // Mapping warna berdasarkan quality
        $colors = [
            'RON92'   => '#2787F5',
            'RON98'   => '#CA02F2',
            '10PPM'   => '#F5B727',
            'JET-A1'  => '#02F226',
        ];

        

        // Ambil warna, default abu-abu kalau tidak ada
        $color = $colors[strtoupper(trim($p->quality))] ?? '#6c757d';
    @endphp

    

    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="card border-0 shadow-sm h-100 hover-shadow">
            <div class="card-body d-flex align-items-center justify-content-between p-3">

                <!-- ICON TANK -->
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle d-flex align-items-center justify-content-center" 
                         style="width:40px; height:40px; background-color: {{ $color }};">
                        <i class="bi bi-fuel-pump-fill text-white fs-18"></i>
                    </div>

                    <div class="lh-1 ms-2">
                        <div class="fw-semibold text-dark fs-15 text-truncate" title="{{ $p->product_name }}">
                            {{ $p->product_name }}
                        </div>
                        <small class="text-muted fs-12">{{ $p->quality }}</small>
                    </div>
                </div>

                <!-- TOTAL QUANTITY -->
                <div class="text-end">
                    <div class="fw-bold text-primary fs-16">
                        {{ kl($p->total_quantity) }}
                    </div>
                    <small class="text-muted fs-11">Total</small>
                </div>

            </div>
        </div>
    </div>

@empty
    <div class="col-12">
        <div class="alert alert-light text-center border">
            <i class="bi bi-inbox fs-4 d-block mb-1"></i>
            <span class="fw-semibold fs-14">Data is Empty</span>
        </div>
    </div>
@endforelse

</div>





                    <!-- [Invoices Awaiting Payment] end -->
                 
                    <!-- [Converted Leads] end -->
                    <!-- [Projects In Progress] start -->
                   
                    <!-- [Conversion Rate] end -->
                    <!-- [Payment Records] start -->

                
                   <div class="row m-3">
                         <div class="col-md-7">
                        <div class="card stretch stretch-full">
                                <div class="card-header">
                                    <h5 class="card-title">Monthly Liter(L) Record</h5>
                                
                                </div>
                                <canvas id="myChart"></canvas>
                        </div>
                    </div>

                
                        
                        <div class="col-md-5">
    <div class="card shadow-sm h-100 border-0">
        {{-- Card Header --}}
        <div class="card-header bg-secondary text-white text-center py-2">
            <h5 class="mb-0 fw-bold fs-6" style="letter-spacing:1px; color:white;">
                Product Monthly Summary (Liter)
            </h5>
        </div>

        {{-- Card Body --}}
      
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-center" style="font-size:10px;">
                        <tr>
                            <th>Product</th>
                            <th style="width:160px">Total Liter (L)</th>
                            <th style="width:120px">Month</th>
                        </tr>
                    </thead>

                    <tbody style="font-size:10px;">
                        @foreach($data as $row)
                            @php
                                $product = strtoupper(trim($row->product_name));

                                // Warna produk
                                $colors = [
                                    'GASOLINE' => '#0d6efd',  // Blue
                                    'DIESEL'   => '#6c757d',  // Secondary
                                    'JET-A1'   => '#20c997',  // Light Green
                                ];

                                $color = $colors[$product] ?? '#adb5bd';
                            @endphp

                            <tr>
                                {{-- Product --}}
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                                             style="width:30px; height:30px; background-color: {{ $color }};">
                                            <i class="bi bi-fuel-pump-fill text-white" style="font-size:12px;"></i>
                                        </div>
                                        <span class="fw-semibold text-dark" style="font-size:10px;">
                                            {{ $row->product_name }}
                                        </span>
                                    </div>
                                </td>

                                {{-- Total Liter --}}
                                <td class="text-end fw-bold text-dark" style="font-size:10px;">
                                    {{ number_format($row->total_liter, 2) }}
                                </td>

                                {{-- Bulan --}}
                                <td class="text-center">
                                    <span class="badge rounded-pill px-2 py-1"
                                          style="background-color:#6c757d33; color:#212529; font-size:9px;">
                                        {{ $row->bulan }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                    {{-- Footer Total --}}
                    @if($data->count())
                        <tfoot class="table-secondary" style="font-size:10px;">
                            <tr>
                                <th class="text-end fw-semibold">TOTAL</th>
                                <th class="text-end fw-bold">
                                    {{ number_format($data->sum('total_liter'), 2) }}
                                </th>
                                <th></th>
                            </tr>
                        </tfoot>
                    @endif
                </table>
                <div class="row m-3">
                    <div class="col">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
  
</div>




                            
                    </div>
                </div>

                            </div>


                   </div>


                    
                    








                    
                  
                          
                           
                    
                    
        
                        <div class="col-md-12">
                            <div class="card stretch stretch-full h-100">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">CLIENT RECORD</h5>
                                </div>
                                <div class="card-body">
                                    <div style="position: relative; width: 100%; height: 400px;">
                                        <canvas id="mydataChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                   <div class="row g-3">
                                <div class="col-12 col-xxl-6">
                                    <div class="card shadow-sm h-100">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Client Record</h5>
                                        </div>
                                        <div class="card-body p-3">
                                            <div id="piechart"
                                                @if(!$isMobile) style="width: 100%; height: {{ $defaultHeight }}px;" @endif>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                           

                  
                 
              
                   
                 
                
                   

            


@endsection

@section('footer')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const ctx = document.getElementById('myChart').getContext('2d');

    // Data dari PHP / Laravel
    const labels = {!! json_encode($allMonths->pluck('month_name')->values()) !!};
    const dataValues = {!! json_encode($allMonths->pluck('total_quantity')->values()) !!};

    new Chart(ctx, {
        type: 'line', // ✅ Ubah jadi line chart
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Quantity per Month (Liters)',
                data: dataValues,
                fill: false, // garis tidak diisi
                borderColor: 'rgb(54, 162, 235)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                tension: 0.3, // membuat garis sedikit melengkung
                borderWidth: 2,
                pointRadius: 4,
                pointBackgroundColor: 'rgb(54, 162, 235)'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Monthly Transaction Quantity - {{ date("Y") }}'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

});
</script>







<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Product', 'Total Quantity'],
      @foreach($transactions as $t)
        ['{{ $t->product_name."/".$t->quality }}', {{ $t->total_quantity }}],
      @endforeach
    ]);

    var options = {
      title: 'Total Product Transactions - {{ $year }}',
      is3D: true,
      pieSliceText: 'value'
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
  }
</script>

<script>
    const ctx2 = document.getElementById('mydataChart').getContext('2d');

    // Data client dari PHP
    const clientLabels = {!! json_encode($clientsMonths->pluck('client_name')) !!};
    const clientData = {!! json_encode($clientsMonths->pluck('total_quantity')) !!};

    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: clientLabels,
            datasets: [{
                label: 'Total Quantity per Client (Liters)',
                data: clientData,
                backgroundColor: 'rgba(255, 159, 64, 0.6)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                title: {
                    display: true,
                    text: 'Total Quantity per Client - {{ $year }}'
                }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>














   

@endsection
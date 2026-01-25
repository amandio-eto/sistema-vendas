@extends('Master.Master')
@section('title','Dashboard')
@section('content')

<div class="main-content">
                <div class="row">
                    <!-- [Invoices Awaiting Payment] start -->
                    <div class="row">
                        @foreach($prod as $p)
                       
                        <div class="col">
                            <div class="card stretch stretch-full">
                                <div class="card-body">
                                    <div class="d-flex align-items-start justify-content-between mb-4">
                                        <div class="d-flex gap-4 align-items-center">
                                            <div class="avatar-text avatar-lg bg-gray-200">
                                               <img src="{{ asset('tank.jpg') }}" alt="" height="60" width="60">
                                            </div>
                                            <div>
                                                <div class="fs-4 fw-bold text-dark"><span class="counter">{{ format_ton($p->total_quantity) }}</span></div>
                                                <h3 class="fs-13 fw-semibold text-truncate-1-line">
                                                {{ $p->product_name . '/' . $p->quality }}
                                            </h3>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" class="">
                                            <i class="feather-more-vertical"></i>
                                        </a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                     @endforeach
                    <!-- [Invoices Awaiting Payment] end -->
                 
                    <!-- [Converted Leads] end -->
                    <!-- [Projects In Progress] start -->
                   
                    <!-- [Conversion Rate] end -->
                    <!-- [Payment Records] start -->
                    <div class="col-xxl-8">
                        <div class="card stretch stretch-full">
                            <div class="card-header">
                                <h5 class="card-title">Payment Record</h5>
                             
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div>
                                <canvas id="myChart"></canvas>
                                </div>
                                </div>
                            </div>
                          
                           
                        </div>
                    </div>
                

                 

                      <div class="col-xxl-8">
                        <div class="card stretch stretch-full">
                            <div class="card-header">
                                <h5 class="card-title">CLIENT RECORD</h5>
                             
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div>
                                    <canvas id="mydataChart"></canvas>
                                    </div>

                                 
                                </div>
                                </div>
                            </div>
                          
                           
                        </div>
                    </div>

                  
                 
              
                   
                 
                
                    <!--! END: [Upcoming Schedule] !-->
                    <!--! BEGIN: [Project Status] !-->
                    <div class="col-xxl-4">
                        <div class="card stretch stretch-full">
                            <div class="card-header">
                               <h5 class="card-title text-center">LITER RECORD | {{ \Carbon\Carbon::now()->format('Y') }}</h5>

                                
                            </div>
                            <div class="row">
                                <div class="col">
                                      <div class="p-4">
                                    <div id="piechart" style="width: 900px; height: 500px;"></div>
                                </div>
                                </div>
                            </div>
                           
                           
                        </div>
                    </div>
                    
                </div>
            </div>


@endsection

@section('footer')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart').getContext('2d');

    // Data dari PHP
    const labels = {!! json_encode($allMonths->pluck('month_name')) !!};
    const data = {!! json_encode($allMonths->pluck('total_quantity')) !!};

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Quantity per Month (Liters)',
                data: data,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
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
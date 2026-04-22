<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="keyword" content="" />
    <meta name="author" content="flexilecode" />
    <link rel="stylesheet"
 href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"><link rel="stylesheet"
 href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!--! The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags !-->
    <!--! BEGIN: Apps Title-->
    <title>Portal e-ETO || @yield('title')</title>
    <!--! END:  Apps Title-->
    <!--! BEGIN: Favicon-->
   <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('apple-icon-57x57.png') }}">
  
    <!--! END: Favicon-->
    <!--! BEGIN: Bootstrap CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <!--! END: Bootstrap CSS-->
    <!--! BEGIN: Vendors CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/vendors.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/daterangepicker.min.css') }}" />
    <!--! END: Vendors CSS-->
    <!--! BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/theme.min.css') }}" />
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!--! END: Custom CSS-->
    <!--! HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries !-->
    <!--! WARNING: Respond.js doesn"t work if you view the page via file: !-->
    <!--[if lt IE 9]>
			<script src="https:oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https:oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            
        
		<![endif]-->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />
           <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
           <script src="https://code.highcharts.com/highcharts.js"></script>
            <script src="https://code.highcharts.com/modules/series-label.js"></script>
            <script src="https://code.highcharts.com/modules/exporting.js"></script>
            <script src="https://code.highcharts.com/modules/export-data.js"></script>
            <script src="https://code.highcharts.com/modules/accessibility.js"></script>
             <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
             {{-- <script type="text/javascript" src="https://app.secureprivacy.ai/script/69dddf7bfb21f836d6454269.js"></script> --}}

        <style>
.timer {
   
  
   
   margin: 0;
     font-family: 'DS-Digital', monospace;
      display: flex;
      justify-content: center;
      align-items: center;
      background: #424346;
      color: #fff;
      font-family: Arial, sans-serif;
      border-radius: 20px;
       font-family: 'DS-Digital', monospace;
}

.clock {
    text-align: center;
}

.time {
   
    font-family: 'DS-Digital', monospace;
    font-size: 19px;
    letter-spacing: 5px;
    /* text-shadow: 
        0 0 10px #00ffcc,
        0 0 20px #00ffcc,
        0 0 40px #00ffcc; */
}

.date {
    font-size: 15px;
    margin-top: 15px;
    color: #00ffaa;
    text-shadow: 0 0 10px #00ffaa;
}


.pro-card{
    border: none;
    border-radius: 18px;
    color: #fff;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    transition: 0.25s ease;
}

.pro-card:hover{
    transform: translateY(-4px);
    box-shadow: 0 14px 35px rgba(0,0,0,0.12);
}

/* HEADER */
.top{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:10px;
}

.title{
    font-size:14px;
    letter-spacing:1px;
    font-weight:600;
    opacity:0.9;
}

/* ICON */
.icon{
    font-size:22px;
    opacity:0.85;
}

/* BIG NUMBER (MAIN FOCUS) */
.number{
    font-size:20px;
    font-weight:800;
    line-height:1;
    margin-top:10px;
}

/* LABEL */
.label{
    font-size:13px;
    letter-spacing:2px;
    opacity:0.9;
    margin-top:5px;
}

/* FOOTER */
.cardc_footer{
    margin-top:18px;
    display:flex;
    justify-content:space-between;
    font-size:14px;
    opacity:0.95;
}

/* ETO COLOR (orange fuel premium) */
.pro-card.eto{
    background: linear-gradient(135deg, #ffb300, #ff6f00);
}

/* CLIENT COLOR (blue clean corporate) */
.pro-card.client{
    background: linear-gradient(135deg, #1e88e5, #1565c0);
}



    .table-hover tbody tr:hover {
        background-color: #f1f9ff !important;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9fbfd;
    }
    .table-bordered {
        border: 1px solid #dee2e6;
    }
    .badge {
        font-size: 0.8rem;
    }

    #piechart {
    width: 40%%;
    height: 300px; /* default desktop */
    max-width: 40%;
}


.select2-container--default .select2-selection--single {
    min-height: 42px;
    border-radius: 0.5rem;
    border: 1px solid #ced4da;
    padding: 4px 10px;
    font-size: 14px;
    background-color: #fff;
    transition: border-color 0.3s, box-shadow 0.3s;
}
.select2-container--default .select2-selection--single:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13,110,253,.25);
}
.select2-selection__arrow { height: 36px; }
.select2-search__field { font-size: 14px; }

/* ====== Elegant Card Styling ====== */
.card {
    border-radius: 15px;           /* Membuat sudut lebih lembut */
    box-shadow: 0 8px 20px rgba(0,0,0,0.12); /* Shadow lebih elegan */
    transition: transform 0.3s, box-shadow 0.3s;
    overflow: hidden;
}

.card:hover {
    transform: translateY(-5px);   /* Hover effect */
    box-shadow: 0 12px 25px rgba(0,0,0,0.2);
}

.card .card-body {
    padding: 2rem 1.5rem;          /* Lebih spacious */
}

.card h5, .card h6 {
    color: #333;
    font-weight: 600;
}

.card small.text-muted {
    color: #6c757d !important;
}

.table {
    margin-bottom: 0;
}

.table thead th {
    border-bottom: 2px solid #dee2e6;
    color: #495057;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
    transition: 0.3s;
}

.btn-warning, .btn-danger, .btn-success {
    border-radius: 8px;   /* Membulatkan tombol */
}

.badge {
    font-weight: 500;
    font-size: 0.85rem;
}

/* Optional: Gradient header untuk card-body section */
.card-body h5 {
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}









/* Mobile / tablet */
@media (max-width: 767.98px) {
    #piechart {
        height: 300px; /* height lebih kecil di mobile */
    }



    
}
</style>
</head>

<body>
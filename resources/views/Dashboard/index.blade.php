@extends('Master.Master')
@section('title','Dashboard')
@section('content')

<div class="main-content">
                <div class="row">
                    <!-- [Invoices Awaiting Payment] start -->
                    <div class="row">
                        <div class="col">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between mb-4">
                                    <div class="d-flex gap-4 align-items-center">
                                        <div class="avatar-text avatar-lg bg-gray-200">
                                            <i class="feather-dollar-sign"></i>
                                        </div>
                                        <div>
                                            <div class="fs-4 fw-bold text-dark"><span class="counter">45</span>/<span class="counter">76</span></div>
                                            <h3 class="fs-13 fw-semibold text-truncate-1-line">Invoices Awaiting Payment</h3>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="">
                                        <i class="feather-more-vertical"></i>
                                    </a>
                                </div>
                                <div class="pt-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <a href="javascript:void(0);" class="fs-12 fw-medium text-muted text-truncate-1-line">Invoices Awaiting </a>
                                        <div class="w-100 text-end">
                                            <span class="fs-12 text-dark">$5,569</span>
                                            <span class="fs-11 text-muted">(56%)</span>
                                        </div>
                                    </div>
                                    <div class="progress mt-2 ht-3">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 56%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [Invoices Awaiting Payment] end -->
                    <!-- [Converted Leads] start -->
                    <div class="col-md">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between mb-4">
                                    <div class="d-flex gap-4 align-items-center">
                                        <div class="avatar-text avatar-lg bg-gray-200">
                                            <i class="feather-cast"></i>
                                        </div>
                                        <div>
                                            <div class="fs-4 fw-bold text-dark"><span class="counter">48</span>/<span class="counter">86</span></div>
                                            <h3 class="fs-13 fw-semibold text-truncate-1-line">Converted Leads</h3>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="">
                                        <i class="feather-more-vertical"></i>
                                    </a>
                                </div>
                                <div class="pt-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <a href="javascript:void(0);" class="fs-12 fw-medium text-muted text-truncate-1-line">Converted Leads </a>
                                        <div class="w-100 text-end">
                                            <span class="fs-12 text-dark">52 Completed</span>
                                            <span class="fs-11 text-muted">(63%)</span>
                                        </div>
                                    </div>
                                    <div class="progress mt-2 ht-3">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 63%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [Converted Leads] end -->
                    <!-- [Projects In Progress] start -->
                    <div class="col">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between mb-4">
                                    <div class="d-flex gap-4 align-items-center">
                                        <div class="avatar-text avatar-lg bg-gray-200">
                                            <i class="feather-briefcase"></i>
                                        </div>
                                        <div>
                                            <div class="fs-4 fw-bold text-dark"><span class="counter">16</span>/<span class="counter">20</span></div>
                                            <h3 class="fs-13 fw-semibold text-truncate-1-line">Projects In Progress</h3>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="">
                                        <i class="feather-more-vertical"></i>
                                    </a>
                                </div>
                                <div class="pt-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <a href="javascript:void(0);" class="fs-12 fw-medium text-muted text-truncate-1-line">Projects In Progress </a>
                                        <div class="w-100 text-end">
                                            <span class="fs-12 text-dark">16 Completed</span>
                                            <span class="fs-11 text-muted">(78%)</span>
                                        </div>
                                    </div>
                                    <div class="progress mt-2 ht-3">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 78%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [Projects In Progress] end -->
                    <!-- [Conversion Rate] start -->
                    <div class="col-md">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between mb-4">
                                    <div class="d-flex gap-4 align-items-center">
                                        <div class="avatar-text avatar-lg bg-gray-200">
                                            <i class="feather-activity"></i>
                                        </div>
                                        <div>
                                            <div class="fs-4 fw-bold text-dark"><span class="counter">46.59</span>%</div>
                                            <h3 class="fs-13 fw-semibold text-truncate-1-line">Conversion Rate</h3>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="">
                                        <i class="feather-more-vertical"></i>
                                    </a>
                                </div>
                                <div class="pt-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <a href="javascript:void(0);" class="fs-12 fw-medium text-muted text-truncate-1-line"> Conversion Rate </a>
                                        <div class="w-100 text-end">
                                            <span class="fs-12 text-dark">$2,254</span>
                                            <span class="fs-11 text-muted">(46%)</span>
                                        </div>
                                    </div>
                                    <div class="progress mt-2 ht-3">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 46%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- [Conversion Rate] end -->
                    <!-- [Payment Records] start -->
                    <div class="col-xxl-8">
                        <div class="card stretch stretch-full">
                            <div class="card-header">
                                <h5 class="card-title">Payment Record</h5>
                                <div class="card-header-action">
                                    <div class="card-header-btn">
                                        <div data-bs-toggle="tooltip" title="" data-bs-original-title="Delete">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-danger" data-bs-toggle="remove"> </a>
                                        </div>
                                        <div data-bs-toggle="tooltip" title="" data-bs-original-title="Refresh">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-warning" data-bs-toggle="refresh"> </a>
                                        </div>
                                        <div data-bs-toggle="tooltip" title="" data-bs-original-title="Maximize/Minimize">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-success" data-bs-toggle="expand"> </a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="dropdown" data-bs-offset="25, 25">
                                            <div data-bs-toggle="tooltip" title="" data-bs-original-title="Options">
                                                <i class="feather-more-vertical"></i>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-at-sign"></i>New</a>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-calendar"></i>Event</a>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-bell"></i>Snoozed</a>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-trash-2"></i>Deleted</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-settings"></i>Settings</a>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-life-buoy"></i>Tips &amp; Tricks</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body custom-card-action p-0" style="position: relative;">
                                <div id="payment-records-chart" style="min-height: 395px;"><div id="apexchartsur9jomdfh" class="apexcharts-canvas apexchartsur9jomdfh light" style="width: 890px; height: 380px;"><svg id="SvgjsSvg1256" width="890" height="380" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1258" class="apexcharts-inner apexcharts-graphical" transform="translate(56.578125, 30)"><defs id="SvgjsDefs1257"><clipPath id="gridRectMaskur9jomdfh"><rect id="SvgjsRect1263" width="826.421875" height="314.39300000000003" x="-1.5" y="-1.5" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath><clipPath id="gridRectMarkerMaskur9jomdfh"><rect id="SvgjsRect1264" width="825.421875" height="313.39300000000003" x="-1" y="-1" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath></defs><line id="SvgjsLine1262" x1="0" y1="0" x2="0" y2="311.39300000000003" stroke="#b6b6b6" stroke-dasharray="3" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="311.39300000000003" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><g id="SvgjsG1300" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1301" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"><text id="SvgjsText1302" font-family="Helvetica, Arial, sans-serif" x="34.309244791666664" y="340.39300000000003" text-anchor="middle" dominant-baseline="auto" font-size="10px" fill="#a0acbb" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1303" style="font-family: Helvetica, Arial, sans-serif;">JAN/23</tspan><title>JAN/23</title></text><text id="SvgjsText1304" font-family="Helvetica, Arial, sans-serif" x="102.927734375" y="340.39300000000003" text-anchor="middle" dominant-baseline="auto" font-size="10px" fill="#a0acbb" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1305" style="font-family: Helvetica, Arial, sans-serif;">FEB/23</tspan><title>FEB/23</title></text><text id="SvgjsText1306" font-family="Helvetica, Arial, sans-serif" x="171.54622395833334" y="340.39300000000003" text-anchor="middle" dominant-baseline="auto" font-size="10px" fill="#a0acbb" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1307" style="font-family: Helvetica, Arial, sans-serif;">MAR/23</tspan><title>MAR/23</title></text><text id="SvgjsText1308" font-family="Helvetica, Arial, sans-serif" x="240.16471354166666" y="340.39300000000003" text-anchor="middle" dominant-baseline="auto" font-size="10px" fill="#a0acbb" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1309" style="font-family: Helvetica, Arial, sans-serif;">APR/23</tspan><title>APR/23</title></text><text id="SvgjsText1310" font-family="Helvetica, Arial, sans-serif" x="308.78320312499994" y="340.39300000000003" text-anchor="middle" dominant-baseline="auto" font-size="10px" fill="#a0acbb" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1311" style="font-family: Helvetica, Arial, sans-serif;">MAY/23</tspan><title>MAY/23</title></text><text id="SvgjsText1312" font-family="Helvetica, Arial, sans-serif" x="377.40169270833326" y="340.39300000000003" text-anchor="middle" dominant-baseline="auto" font-size="10px" fill="#a0acbb" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1313" style="font-family: Helvetica, Arial, sans-serif;">JUN/23</tspan><title>JUN/23</title></text><text id="SvgjsText1314" font-family="Helvetica, Arial, sans-serif" x="446.0201822916666" y="340.39300000000003" text-anchor="middle" dominant-baseline="auto" font-size="10px" fill="#a0acbb" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1315" style="font-family: Helvetica, Arial, sans-serif;">JUL/23</tspan><title>JUL/23</title></text><text id="SvgjsText1316" font-family="Helvetica, Arial, sans-serif" x="514.638671875" y="340.39300000000003" text-anchor="middle" dominant-baseline="auto" font-size="10px" fill="#a0acbb" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1317" style="font-family: Helvetica, Arial, sans-serif;">AUG/23</tspan><title>AUG/23</title></text><text id="SvgjsText1318" font-family="Helvetica, Arial, sans-serif" x="583.2571614583334" y="340.39300000000003" text-anchor="middle" dominant-baseline="auto" font-size="10px" fill="#a0acbb" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1319" style="font-family: Helvetica, Arial, sans-serif;">SEP/23</tspan><title>SEP/23</title></text><text id="SvgjsText1320" font-family="Helvetica, Arial, sans-serif" x="651.8756510416667" y="340.39300000000003" text-anchor="middle" dominant-baseline="auto" font-size="10px" fill="#a0acbb" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1321" style="font-family: Helvetica, Arial, sans-serif;">OCT/23</tspan><title>OCT/23</title></text><text id="SvgjsText1322" font-family="Helvetica, Arial, sans-serif" x="720.4941406250001" y="340.39300000000003" text-anchor="middle" dominant-baseline="auto" font-size="10px" fill="#a0acbb" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1323" style="font-family: Helvetica, Arial, sans-serif;">NOV/23</tspan><title>NOV/23</title></text><text id="SvgjsText1324" font-family="Helvetica, Arial, sans-serif" x="789.1126302083335" y="340.39300000000003" text-anchor="middle" dominant-baseline="auto" font-size="10px" fill="#a0acbb" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1325" style="font-family: Helvetica, Arial, sans-serif;">DEC/23</tspan><title>DEC/23</title></text></g></g><g id="SvgjsG1336" class="apexcharts-grid"><g id="SvgjsG1337" class="apexcharts-gridlines-horizontal"></g><g id="SvgjsG1338" class="apexcharts-gridlines-vertical"></g><line id="SvgjsLine1340" x1="0" y1="311.39300000000003" x2="823.421875" y2="311.39300000000003" stroke="transparent" stroke-dasharray="0"></line><line id="SvgjsLine1339" x1="0" y1="1" x2="0" y2="311.39300000000003" stroke="transparent" stroke-dasharray="0"></line></g><g id="SvgjsG1266" class="apexcharts-bar-series apexcharts-plot-series"><g id="SvgjsG1267" class="apexcharts-series" rel="1" seriesName="PaymentxRejected" data:realIndex="0"><path id="undefined-0" d="M 24.016471354166665 311.39300000000003L 24.016471354166665 211.15135050223216Q 28.662858072916663 207.00496378348217 33.309244791666664 211.15135050223216L 33.309244791666664 311.39300000000003L 23.516471354166665 311.39300000000003" fill="rgba(52,84,209,0.85)" fill-opacity="1" stroke="#3454d1" stroke-opacity="1" stroke-linecap="round" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskur9jomdfh)" pathTo="M 24.016471354166665 311.39300000000003L 24.016471354166665 211.15135050223216Q 28.662858072916663 207.00496378348217 33.309244791666664 211.15135050223216L 33.309244791666664 311.39300000000003L 23.516471354166665 311.39300000000003" pathFrom="M 24.016471354166665 311.39300000000003L 24.016471354166665 311.39300000000003L 33.309244791666664 311.39300000000003L 33.309244791666664 311.39300000000003L 23.516471354166665 311.39300000000003" cy="209.07815714285715" cx="92.1349609375" j="0" val="23" barHeight="102.31484285714286" barWidth="10.2927734375"></path><path id="undefined-0" d="M 92.6349609375 311.39300000000003L 92.6349609375 264.5330076450893Q 97.28134765624999 260.3866209263393 101.927734375 264.5330076450893L 101.927734375 311.39300000000003L 92.1349609375 311.39300000000003" fill="rgba(52,84,209,0.85)" fill-opacity="1" stroke="#3454d1" stroke-opacity="1" stroke-linecap="round" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskur9jomdfh)" pathTo="M 92.6349609375 311.39300000000003L 92.6349609375 264.5330076450893Q 97.28134765624999 260.3866209263393 101.927734375 264.5330076450893L 101.927734375 311.39300000000003L 92.1349609375 311.39300000000003" pathFrom="M 92.6349609375 311.39300000000003L 92.6349609375 311.39300000000003L 101.927734375 311.39300000000003L 101.927734375 311.39300000000003L 92.1349609375 311.39300000000003" cy="262.4598142857143" cx="160.75345052083333" j="1" val="11" barHeight="48.93318571428572" barWidth="10.2927734375"></path><path id="undefined-0" d="M 161.25345052083333 311.39300000000003L 161.25345052083333 215.5998219308036Q 165.89983723958332 211.45343521205362 170.54622395833331 215.5998219308036L 170.54622395833331 311.39300000000003L 160.75345052083333 311.39300000000003" fill="rgba(52,84,209,0.85)" fill-opacity="1" stroke="#3454d1" stroke-opacity="1" stroke-linecap="round" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskur9jomdfh)" pathTo="M 161.25345052083333 311.39300000000003L 161.25345052083333 215.5998219308036Q 165.89983723958332 211.45343521205362 170.54622395833331 215.5998219308036L 170.54622395833331 311.39300000000003L 160.75345052083333 311.39300000000003" pathFrom="M 161.25345052083333 311.39300000000003L 161.25345052083333 311.39300000000003L 170.54622395833331 311.39300000000003L 170.54622395833331 311.39300000000003L 160.75345052083333 311.39300000000003" cy="213.5266285714286" cx="229.37194010416664" j="2" val="22" barHeight="97.86637142857144" barWidth="10.2927734375"></path><path id="undefined-0" d="M 229.87194010416664 311.39300000000003L 229.87194010416664 193.35746478794647Q 234.51832682291663 189.21107806919647 239.16471354166663 193.35746478794647L 239.16471354166663 311.39300000000003L 229.37194010416664 311.39300000000003" fill="rgba(52,84,209,0.85)" fill-opacity="1" stroke="#3454d1" stroke-opacity="1" stroke-linecap="round" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskur9jomdfh)" pathTo="M 229.87194010416664 311.39300000000003L 229.87194010416664 193.35746478794647Q 234.51832682291663 189.21107806919647 239.16471354166663 193.35746478794647L 239.16471354166663 311.39300000000003L 229.37194010416664 311.39300000000003" pathFrom="M 229.87194010416664 311.39300000000003L 229.87194010416664 311.39300000000003L 239.16471354166663 311.39300000000003L 239.16471354166663 311.39300000000003L 229.37194010416664 311.39300000000003" cy="191.28427142857146" cx="297.99042968749995" j="3" val="27" barHeight="120.10872857142857" barWidth="10.2927734375"></path><path id="undefined-0" d="M 298.49042968749995 311.39300000000003L 298.49042968749995 255.63606478794645Q 303.13681640625 251.48967806919646 307.78320312499994 255.63606478794645L 307.78320312499994 311.39300000000003L 297.99042968749995 311.39300000000003" fill="rgba(52,84,209,0.85)" fill-opacity="1" stroke="#3454d1" stroke-opacity="1" stroke-linecap="round" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskur9jomdfh)" pathTo="M 298.49042968749995 311.39300000000003L 298.49042968749995 255.63606478794645Q 303.13681640625 251.48967806919646 307.78320312499994 255.63606478794645L 307.78320312499994 311.39300000000003L 297.99042968749995 311.39300000000003" pathFrom="M 298.49042968749995 311.39300000000003L 298.49042968749995 311.39300000000003L 307.78320312499994 311.39300000000003L 307.78320312499994 311.39300000000003L 297.99042968749995 311.39300000000003" cy="253.56287142857144" cx="366.60891927083327" j="4" val="13" barHeight="57.830128571428574" barWidth="10.2927734375"></path><path id="undefined-0" d="M 367.10891927083327 311.39300000000003L 367.10891927083327 215.5998219308036Q 371.7553059895833 211.45343521205362 376.40169270833326 215.5998219308036L 376.40169270833326 311.39300000000003L 366.60891927083327 311.39300000000003" fill="rgba(52,84,209,0.85)" fill-opacity="1" stroke="#3454d1" stroke-opacity="1" stroke-linecap="round" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskur9jomdfh)" pathTo="M 367.10891927083327 311.39300000000003L 367.10891927083327 215.5998219308036Q 371.7553059895833 211.45343521205362 376.40169270833326 215.5998219308036L 376.40169270833326 311.39300000000003L 366.60891927083327 311.39300000000003" pathFrom="M 367.10891927083327 311.39300000000003L 367.10891927083327 311.39300000000003L 376.40169270833326 311.39300000000003L 376.40169270833326 311.39300000000003L 366.60891927083327 311.39300000000003" cy="213.5266285714286" cx="435.2274088541666" j="5" val="22" barHeight="97.86637142857144" barWidth="10.2927734375"></path><path id="undefined-0" d="M 435.7274088541666 311.39300000000003L 435.7274088541666 148.87275050223218Q 440.3737955729166 144.72636378348218 445.0201822916666 148.87275050223218L 445.0201822916666 311.39300000000003L 435.2274088541666 311.39300000000003" fill="rgba(52,84,209,0.85)" fill-opacity="1" stroke="#3454d1" stroke-opacity="1" stroke-linecap="round" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskur9jomdfh)" pathTo="M 435.7274088541666 311.39300000000003L 435.7274088541666 148.87275050223218Q 440.3737955729166 144.72636378348218 445.0201822916666 148.87275050223218L 445.0201822916666 311.39300000000003L 435.2274088541666 311.39300000000003" pathFrom="M 435.7274088541666 311.39300000000003L 435.7274088541666 311.39300000000003L 445.0201822916666 311.39300000000003L 445.0201822916666 311.39300000000003L 435.2274088541666 311.39300000000003" cy="146.79955714285717" cx="503.8458984374999" j="6" val="37" barHeight="164.59344285714286" barWidth="10.2927734375"></path><path id="undefined-0" d="M 504.3458984374999 311.39300000000003L 504.3458984374999 220.04829335937504Q 508.9922851562499 215.90190664062504 513.6386718749999 220.04829335937504L 513.6386718749999 311.39300000000003L 503.8458984374999 311.39300000000003" fill="rgba(52,84,209,0.85)" fill-opacity="1" stroke="#3454d1" stroke-opacity="1" stroke-linecap="round" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskur9jomdfh)" pathTo="M 504.3458984374999 311.39300000000003L 504.3458984374999 220.04829335937504Q 508.9922851562499 215.90190664062504 513.6386718749999 220.04829335937504L 513.6386718749999 311.39300000000003L 503.8458984374999 311.39300000000003" pathFrom="M 504.3458984374999 311.39300000000003L 504.3458984374999 311.39300000000003L 513.6386718749999 311.39300000000003L 513.6386718749999 311.39300000000003L 503.8458984374999 311.39300000000003" cy="217.97510000000003" cx="572.4643880208332" j="7" val="21" barHeight="93.4179" barWidth="10.2927734375"></path><path id="undefined-0" d="M 572.9643880208332 311.39300000000003L 572.9643880208332 117.73345050223215Q 577.6107747395832 113.58706378348215 582.2571614583333 117.73345050223215L 582.2571614583333 311.39300000000003L 572.4643880208332 311.39300000000003" fill="rgba(52,84,209,0.85)" fill-opacity="1" stroke="#3454d1" stroke-opacity="1" stroke-linecap="round" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskur9jomdfh)" pathTo="M 572.9643880208332 311.39300000000003L 572.9643880208332 117.73345050223215Q 577.6107747395832 113.58706378348215 582.2571614583333 117.73345050223215L 582.2571614583333 311.39300000000003L 572.4643880208332 311.39300000000003" pathFrom="M 572.9643880208332 311.39300000000003L 572.9643880208332 311.39300000000003L 582.2571614583333 311.39300000000003L 582.2571614583333 311.39300000000003L 572.4643880208332 311.39300000000003" cy="115.66025714285715" cx="641.0828776041666" j="8" val="44" barHeight="195.73274285714288" barWidth="10.2927734375"></path><path id="undefined-0" d="M 641.5828776041666 311.39300000000003L 641.5828776041666 215.5998219308036Q 646.2292643229166 211.45343521205362 650.8756510416666 215.5998219308036L 650.8756510416666 311.39300000000003L 641.0828776041666 311.39300000000003" fill="rgba(52,84,209,0.85)" fill-opacity="1" stroke="#3454d1" stroke-opacity="1" stroke-linecap="round" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskur9jomdfh)" pathTo="M 641.5828776041666 311.39300000000003L 641.5828776041666 215.5998219308036Q 646.2292643229166 211.45343521205362 650.8756510416666 215.5998219308036L 650.8756510416666 311.39300000000003L 641.0828776041666 311.39300000000003" pathFrom="M 641.5828776041666 311.39300000000003L 641.5828776041666 311.39300000000003L 650.8756510416666 311.39300000000003L 650.8756510416666 311.39300000000003L 641.0828776041666 311.39300000000003" cy="213.5266285714286" cx="709.7013671875" j="9" val="22" barHeight="97.86637142857144" barWidth="10.2927734375"></path><path id="undefined-0" d="M 710.2013671875 311.39300000000003L 710.2013671875 180.01205050223217Q 714.84775390625 175.86566378348218 719.494140625 180.01205050223217L 719.494140625 311.39300000000003L 709.7013671875 311.39300000000003" fill="rgba(52,84,209,0.85)" fill-opacity="1" stroke="#3454d1" stroke-opacity="1" stroke-linecap="round" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskur9jomdfh)" pathTo="M 710.2013671875 311.39300000000003L 710.2013671875 180.01205050223217Q 714.84775390625 175.86566378348218 719.494140625 180.01205050223217L 719.494140625 311.39300000000003L 709.7013671875 311.39300000000003" pathFrom="M 710.2013671875 311.39300000000003L 710.2013671875 311.39300000000003L 719.494140625 311.39300000000003L 719.494140625 311.39300000000003L 709.7013671875 311.39300000000003" cy="177.93885714285716" cx="778.3198567708333" j="10" val="30" barHeight="133.45414285714287" barWidth="10.2927734375"></path><path id="undefined-0" d="M 778.8198567708333 311.39300000000003L 778.8198567708333 220.04829335937504Q 783.4662434895833 215.90190664062504 788.1126302083334 220.04829335937504L 788.1126302083334 311.39300000000003L 778.3198567708333 311.39300000000003" fill="rgba(52,84,209,0.85)" fill-opacity="1" stroke="#3454d1" stroke-opacity="1" stroke-linecap="round" stroke-width="1" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskur9jomdfh)" pathTo="M 778.8198567708333 311.39300000000003L 778.8198567708333 220.04829335937504Q 783.4662434895833 215.90190664062504 788.1126302083334 220.04829335937504L 788.1126302083334 311.39300000000003L 778.3198567708333 311.39300000000003" pathFrom="M 778.8198567708333 311.39300000000003L 778.8198567708333 311.39300000000003L 788.1126302083334 311.39300000000003L 788.1126302083334 311.39300000000003L 778.3198567708333 311.39300000000003" cy="217.97510000000003" cx="846.9383463541667" j="11" val="21" barHeight="93.4179" barWidth="10.2927734375"></path><g id="SvgjsG1268" class="apexcharts-datalabels"></g></g><g id="SvgjsG1281" class="apexcharts-series" rel="2" seriesName="AwaitingxPayment" data:realIndex="2"><path id="undefined-1" d="M 34.309244791666664 311.39300000000003L 34.309244791666664 116.73345050223215Q 37.955631510416666 114.58706378348215 41.60201822916666 116.73345050223215L 41.60201822916666 311.39300000000003L 32.809244791666664 311.39300000000003" fill="rgba(225,227,234,1)" fill-opacity="1" stroke="#e1e3ea" stroke-opacity="1" stroke-linecap="round" stroke-width="3" stroke-dasharray="0" class="apexcharts-bar-area" index="2" clip-path="url(#gridRectMaskur9jomdfh)" pathTo="M 34.309244791666664 311.39300000000003L 34.309244791666664 116.73345050223215Q 37.955631510416666 114.58706378348215 41.60201822916666 116.73345050223215L 41.60201822916666 311.39300000000003L 32.809244791666664 311.39300000000003" pathFrom="M 34.309244791666664 311.39300000000003L 34.309244791666664 311.39300000000003L 41.60201822916666 311.39300000000003L 41.60201822916666 311.39300000000003L 32.809244791666664 311.39300000000003" cy="115.66025714285715" cx="101.427734375" j="0" val="44" barHeight="195.73274285714288" barWidth="10.2927734375"></path><path id="undefined-1" d="M 102.927734375 311.39300000000003L 102.927734375 67.80026478794643Q 106.57412109375 65.65387806919644 110.2205078125 67.80026478794643L 110.2205078125 311.39300000000003L 101.427734375 311.39300000000003" fill="rgba(225,227,234,1)" fill-opacity="1" stroke="#e1e3ea" stroke-opacity="1" stroke-linecap="round" stroke-width="3" stroke-dasharray="0" class="apexcharts-bar-area" index="2" clip-path="url(#gridRectMaskur9jomdfh)" pathTo="M 102.927734375 311.39300000000003L 102.927734375 67.80026478794643Q 106.57412109375 65.65387806919644 110.2205078125 67.80026478794643L 110.2205078125 311.39300000000003L 101.427734375 311.39300000000003" pathFrom="M 102.927734375 311.39300000000003L 102.927734375 311.39300000000003L 110.2205078125 311.39300000000003L 110.2205078125 311.39300000000003L 101.427734375 311.39300000000003" cy="66.72707142857143" cx="170.04622395833331" j="1" val="55" barHeight="244.6659285714286" barWidth="10.2927734375"></path><path id="undefined-1" d="M 171.54622395833331 311.39300000000003L 171.54622395833331 130.07886478794646Q 175.1926106770833 127.93247806919646 178.8389973958333 130.07886478794646L 178.8389973958333 311.39300000000003L 170.04622395833331 311.39300000000003" fill="rgba(225,227,234,1)" fill-opacity="1" stroke="#e1e3ea" stroke-opacity="1" stroke-linecap="round" stroke-width="3" stroke-dasharray="0" class="apexcharts-bar-area" index="2" clip-path="url(#gridRectMaskur9jomdfh)" pathTo="M 171.54622395833331 311.39300000000003L 171.54622395833331 130.07886478794646Q 175.1926106770833 127.93247806919646 178.8389973958333 130.07886478794646L 178.8389973958333 311.39300000000003L 170.04622395833331 311.39300000000003" pathFrom="M 171.54622395833331 311.39300000000003L 171.54622395833331 311.39300000000003L 178.8389973958333 311.39300000000003L 178.8389973958333 311.39300000000003L 170.04622395833331 311.39300000000003" cy="129.00567142857145" cx="238.66471354166663" j="2" val="41" barHeight="182.38732857142858" barWidth="10.2927734375"></path><path id="undefined-1" d="M 240.16471354166663 311.39300000000003L 240.16471354166663 14.418607645089299Q 243.81110026041662 12.2722209263393 247.45748697916662 14.418607645089299L 247.45748697916662 311.39300000000003L 238.66471354166663 311.39300000000003" fill="rgba(225,227,234,1)" fill-opacity="1" stroke="#e1e3ea" stroke-opacity="1" stroke-linecap="round" stroke-width="3" stroke-dasharray="0" class="apexcharts-bar-area" index="2" clip-path="url(#gridRectMaskur9jomdfh)" pathTo="M 240.16471354166663 311.39300000000003L 240.16471354166663 14.418607645089299Q 243.81110026041662 12.2722209263393 247.45748697916662 14.418607645089299L 247.45748697916662 311.39300000000003L 238.66471354166663 311.39300000000003" pathFrom="M 240.16471354166663 311.39300000000003L 240.16471354166663 311.39300000000003L 247.45748697916662 311.39300000000003L 247.45748697916662 311.39300000000003L 238.66471354166663 311.39300000000003" cy="13.345414285714298" cx="307.28320312499994" j="3" val="67" barHeight="298.04758571428573" barWidth="10.2927734375"></path><path id="undefined-1" d="M 308.78320312499994 311.39300000000003L 308.78320312499994 214.5998219308036Q 312.42958984374997 212.45343521205362 316.07597656249993 214.5998219308036L 316.07597656249993 311.39300000000003L 307.28320312499994 311.39300000000003" fill="rgba(225,227,234,1)" fill-opacity="1" stroke="#e1e3ea" stroke-opacity="1" stroke-linecap="round" stroke-width="3" stroke-dasharray="0" class="apexcharts-bar-area" index="2" clip-path="url(#gridRectMaskur9jomdfh)" pathTo="M 308.78320312499994 311.39300000000003L 308.78320312499994 214.5998219308036Q 312.42958984374997 212.45343521205362 316.07597656249993 214.5998219308036L 316.07597656249993 311.39300000000003L 307.28320312499994 311.39300000000003" pathFrom="M 308.78320312499994 311.39300000000003L 308.78320312499994 311.39300000000003L 316.07597656249993 311.39300000000003L 316.07597656249993 311.39300000000003L 307.28320312499994 311.39300000000003" cy="213.5266285714286" cx="375.90169270833326" j="4" val="22" barHeight="97.86637142857144" barWidth="10.2927734375"></path><path id="undefined-1" d="M 377.40169270833326 311.39300000000003L 377.40169270833326 121.1819219308036Q 381.0480794270833 119.0355352120536 384.69446614583325 121.1819219308036L 384.69446614583325 311.39300000000003L 375.90169270833326 311.39300000000003" fill="rgba(225,227,234,1)" fill-opacity="1" stroke="#e1e3ea" stroke-opacity="1" stroke-linecap="round" stroke-width="3" stroke-dasharray="0" class="apexcharts-bar-area" index="2" clip-path="url(#gridRectMaskur9jomdfh)" pathTo="M 377.40169270833326 311.39300000000003L 377.40169270833326 121.1819219308036Q 381.0480794270833 119.0355352120536 384.69446614583325 121.1819219308036L 384.69446614583325 311.39300000000003L 375.90169270833326 311.39300000000003" pathFrom="M 377.40169270833326 311.39300000000003L 377.40169270833326 311.39300000000003L 384.69446614583325 311.39300000000003L 384.69446614583325 311.39300000000003L 375.90169270833326 311.39300000000003" cy="120.1087285714286" cx="444.5201822916666" j="5" val="43" barHeight="191.28427142857143" barWidth="10.2927734375"></path><path id="undefined-1" d="M 446.0201822916666 311.39300000000003L 446.0201822916666 219.04829335937504Q 449.6665690104166 216.90190664062504 453.31295572916656 219.04829335937504L 453.31295572916656 311.39300000000003L 444.5201822916666 311.39300000000003" fill="rgba(225,227,234,1)" fill-opacity="1" stroke="#e1e3ea" stroke-opacity="1" stroke-linecap="round" stroke-width="3" stroke-dasharray="0" class="apexcharts-bar-area" index="2" clip-path="url(#gridRectMaskur9jomdfh)" pathTo="M 446.0201822916666 311.39300000000003L 446.0201822916666 219.04829335937504Q 449.6665690104166 216.90190664062504 453.31295572916656 219.04829335937504L 453.31295572916656 311.39300000000003L 444.5201822916666 311.39300000000003" pathFrom="M 446.0201822916666 311.39300000000003L 446.0201822916666 311.39300000000003L 453.31295572916656 311.39300000000003L 453.31295572916656 311.39300000000003L 444.5201822916666 311.39300000000003" cy="217.97510000000003" cx="513.1386718749999" j="6" val="21" barHeight="93.4179" barWidth="10.2927734375"></path><path id="undefined-1" d="M 514.6386718749999 311.39300000000003L 514.6386718749999 130.07886478794646Q 518.2850585937499 127.93247806919646 521.9314453124999 130.07886478794646L 521.9314453124999 311.39300000000003L 513.1386718749999 311.39300000000003" fill="rgba(225,227,234,1)" fill-opacity="1" stroke="#e1e3ea" stroke-opacity="1" stroke-linecap="round" stroke-width="3" stroke-dasharray="0" class="apexcharts-bar-area" index="2" clip-path="url(#gridRectMaskur9jomdfh)" pathTo="M 514.6386718749999 311.39300000000003L 514.6386718749999 130.07886478794646Q 518.2850585937499 127.93247806919646 521.9314453124999 130.07886478794646L 521.9314453124999 311.39300000000003L 513.1386718749999 311.39300000000003" pathFrom="M 514.6386718749999 311.39300000000003L 514.6386718749999 311.39300000000003L 521.9314453124999 311.39300000000003L 521.9314453124999 311.39300000000003L 513.1386718749999 311.39300000000003" cy="129.00567142857145" cx="581.7571614583333" j="7" val="41" barHeight="182.38732857142858" barWidth="10.2927734375"></path><path id="undefined-1" d="M 583.2571614583333 311.39300000000003L 583.2571614583333 63.35179335937501Q 586.9035481770833 61.20540664062501 590.5499348958333 63.35179335937501L 590.5499348958333 311.39300000000003L 581.7571614583333 311.39300000000003" fill="rgba(225,227,234,1)" fill-opacity="1" stroke="#e1e3ea" stroke-opacity="1" stroke-linecap="round" stroke-width="3" stroke-dasharray="0" class="apexcharts-bar-area" index="2" clip-path="url(#gridRectMaskur9jomdfh)" pathTo="M 583.2571614583333 311.39300000000003L 583.2571614583333 63.35179335937501Q 586.9035481770833 61.20540664062501 590.5499348958333 63.35179335937501L 590.5499348958333 311.39300000000003L 581.7571614583333 311.39300000000003" pathFrom="M 583.2571614583333 311.39300000000003L 583.2571614583333 311.39300000000003L 590.5499348958333 311.39300000000003L 590.5499348958333 311.39300000000003L 581.7571614583333 311.39300000000003" cy="62.27860000000001" cx="650.3756510416666" j="8" val="56" barHeight="249.11440000000002" barWidth="10.2927734375"></path><path id="undefined-1" d="M 651.8756510416666 311.39300000000003L 651.8756510416666 192.35746478794647Q 655.5220377604167 190.21107806919647 659.1684244791667 192.35746478794647L 659.1684244791667 311.39300000000003L 650.3756510416666 311.39300000000003" fill="rgba(225,227,234,1)" fill-opacity="1" stroke="#e1e3ea" stroke-opacity="1" stroke-linecap="round" stroke-width="3" stroke-dasharray="0" class="apexcharts-bar-area" index="2" clip-path="url(#gridRectMaskur9jomdfh)" pathTo="M 651.8756510416666 311.39300000000003L 651.8756510416666 192.35746478794647Q 655.5220377604167 190.21107806919647 659.1684244791667 192.35746478794647L 659.1684244791667 311.39300000000003L 650.3756510416666 311.39300000000003" pathFrom="M 651.8756510416666 311.39300000000003L 651.8756510416666 311.39300000000003L 659.1684244791667 311.39300000000003L 659.1684244791667 311.39300000000003L 650.3756510416666 311.39300000000003" cy="191.28427142857146" cx="718.994140625" j="9" val="27" barHeight="120.10872857142857" barWidth="10.2927734375"></path><path id="undefined-1" d="M 720.494140625 311.39300000000003L 720.494140625 121.1819219308036Q 724.14052734375 119.0355352120536 727.7869140625 121.1819219308036L 727.7869140625 311.39300000000003L 718.994140625 311.39300000000003" fill="rgba(225,227,234,1)" fill-opacity="1" stroke="#e1e3ea" stroke-opacity="1" stroke-linecap="round" stroke-width="3" stroke-dasharray="0" class="apexcharts-bar-area" index="2" clip-path="url(#gridRectMaskur9jomdfh)" pathTo="M 720.494140625 311.39300000000003L 720.494140625 121.1819219308036Q 724.14052734375 119.0355352120536 727.7869140625 121.1819219308036L 727.7869140625 311.39300000000003L 718.994140625 311.39300000000003" pathFrom="M 720.494140625 311.39300000000003L 720.494140625 311.39300000000003L 727.7869140625 311.39300000000003L 727.7869140625 311.39300000000003L 718.994140625 311.39300000000003" cy="120.1087285714286" cx="787.6126302083334" j="10" val="43" barHeight="191.28427142857143" barWidth="10.2927734375"></path><path id="undefined-1" d="M 789.1126302083334 311.39300000000003L 789.1126302083334 63.35179335937501Q 792.7590169270834 61.20540664062501 796.4054036458334 63.35179335937501L 796.4054036458334 311.39300000000003L 787.6126302083334 311.39300000000003" fill="rgba(225,227,234,1)" fill-opacity="1" stroke="#e1e3ea" stroke-opacity="1" stroke-linecap="round" stroke-width="3" stroke-dasharray="0" class="apexcharts-bar-area" index="2" clip-path="url(#gridRectMaskur9jomdfh)" pathTo="M 789.1126302083334 311.39300000000003L 789.1126302083334 63.35179335937501Q 792.7590169270834 61.20540664062501 796.4054036458334 63.35179335937501L 796.4054036458334 311.39300000000003L 787.6126302083334 311.39300000000003" pathFrom="M 789.1126302083334 311.39300000000003L 789.1126302083334 311.39300000000003L 796.4054036458334 311.39300000000003L 796.4054036458334 311.39300000000003L 787.6126302083334 311.39300000000003" cy="62.27860000000001" cx="856.2311197916667" j="11" val="56" barHeight="249.11440000000002" barWidth="10.2927734375"></path><g id="SvgjsG1282" class="apexcharts-datalabels"></g></g></g><g id="SvgjsG1295" class="apexcharts-line-series apexcharts-plot-series"><g id="SvgjsG1296" class="apexcharts-series" seriesName="PaymentxCompleted" data:longestSeries="true" rel="1" data:realIndex="1"><path id="undefined-0" d="M 34.309244791666664 115.66025714285715C 58.32571614583333 115.66025714285715 78.91126302083333 66.72707142857143 102.927734375 66.72707142857143C 126.94420572916665 66.72707142857143 147.52975260416665 129.00567142857145 171.54622395833331 129.00567142857145C 195.56269531249998 129.00567142857145 216.14824218749996 13.345414285714298 240.16471354166663 13.345414285714298C 264.18118489583327 13.345414285714298 284.7667317708333 213.5266285714286 308.78320312499994 213.5266285714286C 332.7996744791666 213.5266285714286 353.3852213541666 120.1087285714286 377.40169270833326 120.1087285714286C 401.4181640624999 120.1087285714286 422.00371093749993 217.97510000000003 446.0201822916666 217.97510000000003C 470.0366536458332 217.97510000000003 490.62220052083325 129.00567142857145 514.6386718749999 129.00567142857145C 538.6551432291666 129.00567142857145 559.2406901041666 62.27860000000001 583.2571614583333 62.27860000000001C 607.2736328125 62.27860000000001 627.8591796874999 191.28427142857146 651.8756510416666 191.28427142857146C 675.8921223958333 191.28427142857146 696.4776692708333 120.1087285714286 720.494140625 120.1087285714286C 744.5106119791667 120.1087285714286 765.0961588541667 129.00567142857145 789.1126302083334 129.00567142857145" fill="none" fill-opacity="1" stroke="rgba(162,172,199,0.25)" stroke-opacity="1" stroke-linecap="round" stroke-width="2" stroke-dasharray="0" class="apexcharts-line" index="1" clip-path="url(#gridRectMaskur9jomdfh)" pathTo="M 34.309244791666664 115.66025714285715C 58.32571614583333 115.66025714285715 78.91126302083333 66.72707142857143 102.927734375 66.72707142857143C 126.94420572916665 66.72707142857143 147.52975260416665 129.00567142857145 171.54622395833331 129.00567142857145C 195.56269531249998 129.00567142857145 216.14824218749996 13.345414285714298 240.16471354166663 13.345414285714298C 264.18118489583327 13.345414285714298 284.7667317708333 213.5266285714286 308.78320312499994 213.5266285714286C 332.7996744791666 213.5266285714286 353.3852213541666 120.1087285714286 377.40169270833326 120.1087285714286C 401.4181640624999 120.1087285714286 422.00371093749993 217.97510000000003 446.0201822916666 217.97510000000003C 470.0366536458332 217.97510000000003 490.62220052083325 129.00567142857145 514.6386718749999 129.00567142857145C 538.6551432291666 129.00567142857145 559.2406901041666 62.27860000000001 583.2571614583333 62.27860000000001C 607.2736328125 62.27860000000001 627.8591796874999 191.28427142857146 651.8756510416666 191.28427142857146C 675.8921223958333 191.28427142857146 696.4776692708333 120.1087285714286 720.494140625 120.1087285714286C 744.5106119791667 120.1087285714286 765.0961588541667 129.00567142857145 789.1126302083334 129.00567142857145" pathFrom="M -1 311.39300000000003L -1 311.39300000000003L 102.927734375 311.39300000000003L 171.54622395833331 311.39300000000003L 240.16471354166663 311.39300000000003L 308.78320312499994 311.39300000000003L 377.40169270833326 311.39300000000003L 446.0201822916666 311.39300000000003L 514.6386718749999 311.39300000000003L 583.2571614583333 311.39300000000003L 651.8756510416666 311.39300000000003L 720.494140625 311.39300000000003L 789.1126302083334 311.39300000000003"></path><g id="SvgjsG1297" class="apexcharts-series-markers-wrap"><g class="apexcharts-series-markers"><circle id="SvgjsCircle1346" r="0" cx="0" cy="0" class="apexcharts-marker w9mrid7en" stroke="#ffffff" fill="#a2acc7" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle></g></g><g id="SvgjsG1298" class="apexcharts-datalabels"></g></g></g><line id="SvgjsLine1341" x1="0" y1="0" x2="823.421875" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1342" x1="0" y1="0" x2="823.421875" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1343" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1344" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1345" class="apexcharts-point-annotations"></g></g><rect id="SvgjsRect1261" width="0" height="0" x="0" y="0" rx="0" ry="0" fill="#fefefe" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect><g id="SvgjsG1326" class="apexcharts-yaxis" rel="0" transform="translate(18.578125, 0)"><g id="SvgjsG1327" class="apexcharts-yaxis-texts-g"><text id="SvgjsText1328" font-family="Helvetica, Arial, sans-serif" x="20" y="31.7" text-anchor="end" dominant-baseline="auto" font-size="11px" fill="#a0acbb" class="apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">70K</text><text id="SvgjsText1329" font-family="Helvetica, Arial, sans-serif" x="20" y="76.28471428571429" text-anchor="end" dominant-baseline="auto" font-size="11px" fill="#a0acbb" class="apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">60K</text><text id="SvgjsText1330" font-family="Helvetica, Arial, sans-serif" x="20" y="120.86942857142857" text-anchor="end" dominant-baseline="auto" font-size="11px" fill="#a0acbb" class="apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">50K</text><text id="SvgjsText1331" font-family="Helvetica, Arial, sans-serif" x="20" y="165.45414285714284" text-anchor="end" dominant-baseline="auto" font-size="11px" fill="#a0acbb" class="apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">40K</text><text id="SvgjsText1332" font-family="Helvetica, Arial, sans-serif" x="20" y="210.03885714285713" text-anchor="end" dominant-baseline="auto" font-size="11px" fill="#a0acbb" class="apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">30K</text><text id="SvgjsText1333" font-family="Helvetica, Arial, sans-serif" x="20" y="254.6235714285714" text-anchor="end" dominant-baseline="auto" font-size="11px" fill="#a0acbb" class="apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">20K</text><text id="SvgjsText1334" font-family="Helvetica, Arial, sans-serif" x="20" y="299.2082857142857" text-anchor="end" dominant-baseline="auto" font-size="11px" fill="#a0acbb" class="apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">10K</text><text id="SvgjsText1335" font-family="Helvetica, Arial, sans-serif" x="20" y="343.793" text-anchor="end" dominant-baseline="auto" font-size="11px" fill="#a0acbb" class="apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">0K</text></g></g></svg><div class="apexcharts-legend"></div><div class="apexcharts-tooltip light"><div class="apexcharts-tooltip-title" style="font-family: Inter; font-size: 12px;"></div><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(52, 84, 209);"></span><div class="apexcharts-tooltip-text" style="font-family: Inter; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(162, 172, 199);"></span><div class="apexcharts-tooltip-text" style="font-family: Inter; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(225, 227, 234);"></span><div class="apexcharts-tooltip-text" style="font-family: Inter; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-xaxistooltip apexcharts-xaxistooltip-bottom light"><div class="apexcharts-xaxistooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div></div></div></div>
                            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 891px; height: 396px;"></div></div><div class="contract-trigger"></div></div></div>
                            <div class="card-footer">
                                <div class="row g-4">
                                    <div class="col-lg-3">
                                        <div class="p-3 border border-dashed rounded">
                                            <div class="fs-12 text-muted mb-1">Awaiting</div>
                                            <h6 class="fw-bold text-dark">$5,486</h6>
                                            <div class="progress mt-2 ht-3">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 81%"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="p-3 border border-dashed rounded">
                                            <div class="fs-12 text-muted mb-1">Completed</div>
                                            <h6 class="fw-bold text-dark">$9,275</h6>
                                            <div class="progress mt-2 ht-3">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 82%"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="p-3 border border-dashed rounded">
                                            <div class="fs-12 text-muted mb-1">Rejected</div>
                                            <h6 class="fw-bold text-dark">$3,868</h6>
                                            <div class="progress mt-2 ht-3">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 68%"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="p-3 border border-dashed rounded">
                                            <div class="fs-12 text-muted mb-1">Revenue</div>
                                            <h6 class="fw-bold text-dark">$50,668</h6>
                                            <div class="progress mt-2 ht-3">
                                                <div class="progress-bar bg-dark" role="progressbar" style="width: 75%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [Payment Records] end -->
                    <!-- [Total Sales] start -->
                    <div class="col-xxl-4">
                        <div class="card stretch stretch-full overflow-hidden">
                            <div class="bg-primary text-white" style="position: relative;">
                                <div class="p-4">
                                    <span class="badge bg-light text-primary text-dark float-end">12%</span>
                                    <div class="text-start">
                                        <h4 class="text-reset">30,569</h4>
                                        <p class="text-reset m-0">Total Sales</p>
                                    </div>
                                </div>
                                <div id="total-sales-color-graph" style="min-height: 150px;"><div id="apexchartszgztq5oti" class="apexcharts-canvas apexchartszgztq5oti light" style="width: 890px; height: 150px;"><svg id="SvgjsSvg1350" width="890" height="150" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1352" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs1351"><clipPath id="gridRectMaskzgztq5oti"><rect id="SvgjsRect1356" width="893" height="153" x="-1.5" y="-1.5" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath><clipPath id="gridRectMarkerMaskzgztq5oti"><rect id="SvgjsRect1357" width="892" height="152" x="-1" y="-1" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath></defs><line id="SvgjsLine1355" x1="0" y1="0" x2="0" y2="150" stroke="#b6b6b6" stroke-dasharray="3" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="150" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><g id="SvgjsG1365" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1366" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g></g><g id="SvgjsG1369" class="apexcharts-grid"><line id="SvgjsLine1371" x1="0" y1="150" x2="890" y2="150" stroke="transparent" stroke-dasharray="0"></line><line id="SvgjsLine1370" x1="0" y1="1" x2="0" y2="150" stroke="transparent" stroke-dasharray="0"></line></g><g id="SvgjsG1359" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG1360" class="apexcharts-series" seriesName="TotalxSales" data:longestSeries="true" rel="1" data:realIndex="0"><path id="undefined-0" d="M 0 150L 0 50C 51.916666666666664 50 96.41666666666669 100 148.33333333333334 100C 200.25 100 244.75000000000003 60 296.6666666666667 60C 348.58333333333337 60 393.08333333333337 90 445 90C 496.9166666666667 90 541.4166666666667 25 593.3333333333334 25C 645.25 25 689.75 100 741.6666666666666 100C 793.5833333333333 100 838.0833333333334 50 890 50C 890 50 890 50 890 150M 890 50z" fill="rgba(147,169,255,0.4)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskzgztq5oti)" pathTo="M 0 150L 0 50C 51.916666666666664 50 96.41666666666669 100 148.33333333333334 100C 200.25 100 244.75000000000003 60 296.6666666666667 60C 348.58333333333337 60 393.08333333333337 90 445 90C 496.9166666666667 90 541.4166666666667 25 593.3333333333334 25C 645.25 25 689.75 100 741.6666666666666 100C 793.5833333333333 100 838.0833333333334 50 890 50C 890 50 890 50 890 150M 890 50z" pathFrom="M -1 150L -1 150L 148.33333333333334 150L 296.6666666666667 150L 445 150L 593.3333333333334 150L 741.6666666666666 150L 890 150"></path><path id="undefined-0" d="M 0 50C 51.916666666666664 50 96.41666666666669 100 148.33333333333334 100C 200.25 100 244.75000000000003 60 296.6666666666667 60C 348.58333333333337 60 393.08333333333337 90 445 90C 496.9166666666667 90 541.4166666666667 25 593.3333333333334 25C 645.25 25 689.75 100 741.6666666666666 100C 793.5833333333333 100 838.0833333333334 50 890 50" fill="none" fill-opacity="1" stroke="#93a9ff" stroke-opacity="1" stroke-linecap="butt" stroke-width="3" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskzgztq5oti)" pathTo="M 0 50C 51.916666666666664 50 96.41666666666669 100 148.33333333333334 100C 200.25 100 244.75000000000003 60 296.6666666666667 60C 348.58333333333337 60 393.08333333333337 90 445 90C 496.9166666666667 90 541.4166666666667 25 593.3333333333334 25C 645.25 25 689.75 100 741.6666666666666 100C 793.5833333333333 100 838.0833333333334 50 890 50" pathFrom="M -1 150L -1 150L 148.33333333333334 150L 296.6666666666667 150L 445 150L 593.3333333333334 150L 741.6666666666666 150L 890 150"></path><g id="SvgjsG1361" class="apexcharts-series-markers-wrap"><g class="apexcharts-series-markers"><circle id="SvgjsCircle1377" r="0" cx="0" cy="0" class="apexcharts-marker wldia6k1hj no-pointer-events" stroke="#ffffff" fill="#93a9ff" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle></g></g><g id="SvgjsG1362" class="apexcharts-datalabels"></g></g></g><line id="SvgjsLine1372" x1="0" y1="0" x2="890" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1373" x1="0" y1="0" x2="890" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1374" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1375" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1376" class="apexcharts-point-annotations"></g></g><rect id="SvgjsRect1354" width="0" height="0" x="0" y="0" rx="0" ry="0" fill="#fefefe" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect><g id="SvgjsG1367" class="apexcharts-yaxis" rel="0" transform="translate(-21, 0)"><g id="SvgjsG1368" class="apexcharts-yaxis-texts-g"></g></g></svg><div class="apexcharts-legend"></div><div class="apexcharts-tooltip dark"><div class="apexcharts-tooltip-title" style="font-family: Inter; font-size: 12px;"></div><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(147, 169, 255);"></span><div class="apexcharts-tooltip-text" style="font-family: Inter; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div></div></div>
                            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 891px; height: 253px;"></div></div><div class="contract-trigger"></div></div></div>
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="hstack gap-3">
                                        <div class="avatar-image avatar-lg p-2 rounded">
                                            <img class="img-fluid" src="assets/images/brand/shopify.png" alt="">
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="d-block">Shopify eCommerce Store</a>
                                            <span class="fs-12 text-muted">Development</span>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">$1200</div>
                                        <div class="fs-12 text-end">6 Projects</div>
                                    </div>
                                </div>
                                <hr class="border-dashed my-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="hstack gap-3">
                                        <div class="avatar-image avatar-lg p-2 rounded">
                                            <img class="img-fluid" src="assets/images/brand/app-store.png" alt="">
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="d-block">iOS Apps Development</a>
                                            <span class="fs-12 text-muted">Development</span>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">$1450</div>
                                        <div class="fs-12 text-end">3 Projects</div>
                                    </div>
                                </div>
                                <hr class="border-dashed my-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="hstack gap-3">
                                        <div class="avatar-image avatar-lg p-2 rounded">
                                            <img class="img-fluid" src="assets/images/brand/figma.png" alt="">
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="d-block">Figma Dashboard Design</a>
                                            <span class="fs-12 text-muted">UI/UX Design</span>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">$1250</div>
                                        <div class="fs-12 text-end">5 Projects</div>
                                    </div>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="card-footer fs-11 fw-bold text-uppercase text-center py-4">Full Details</a>
                        </div>
                    </div>
                    <!-- [Total Sales] end !-->
                    <!-- [Mini] start -->
                    <div class="col-lg-4">
                        <div class="card mb-4 stretch stretch-full">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <div class="d-flex gap-3 align-items-center">
                                    <div class="avatar-text">
                                        <i class="feather feather-star"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold text-dark">Tasks Completed</div>
                                        <div class="fs-12 text-muted">22/35 completed</div>
                                    </div>
                                </div>
                                <div class="fs-4 fw-bold text-dark">22/35</div>
                            </div>
                            <div class="card-body d-flex align-items-center justify-content-between gap-4" style="position: relative;">
                                <div id="task-completed-area-chart" style="min-height: 100px;"><div id="apexchartsl28j7wpz" class="apexcharts-canvas apexchartsl28j7wpz light" style="width: 300px; height: 100px;"><svg id="SvgjsSvg1381" width="300" height="100" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1383" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs1382"><clipPath id="gridRectMaskl28j7wpz"><rect id="SvgjsRect1387" width="302" height="102" x="-1" y="-1" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath><clipPath id="gridRectMarkerMaskl28j7wpz"><rect id="SvgjsRect1388" width="302" height="102" x="-1" y="-1" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath><linearGradient id="SvgjsLinearGradient1394" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1395" stop-opacity="0.2" stop-color="rgba(52,84,209,0.2)" offset="0"></stop><stop id="SvgjsStop1396" stop-opacity="0.75" stop-color="rgba(255,255,255,0.75)" offset="0.9"></stop><stop id="SvgjsStop1397" stop-opacity="0.75" stop-color="rgba(255,255,255,0.75)" offset="1"></stop></linearGradient></defs><line id="SvgjsLine1386" x1="0" y1="0" x2="0" y2="100" stroke="#b6b6b6" stroke-dasharray="3" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="100" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><g id="SvgjsG1400" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1401" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g></g><g id="SvgjsG1404" class="apexcharts-grid"><line id="SvgjsLine1406" x1="0" y1="100" x2="300" y2="100" stroke="transparent" stroke-dasharray="0"></line><line id="SvgjsLine1405" x1="0" y1="1" x2="0" y2="100" stroke="transparent" stroke-dasharray="0"></line></g><g id="SvgjsG1390" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG1391" class="apexcharts-series" seriesName="TaskxCompleted" data:longestSeries="true" rel="1" data:realIndex="0"><path id="undefined-0" d="M 0 100L 0 77.77777777777777C 17.5 77.77777777777777 32.5 47.22222222222223 50 47.22222222222223C 67.5 47.22222222222223 82.5 86.1111111111111 100 86.1111111111111C 117.5 86.1111111111111 132.5 33.333333333333314 150 33.333333333333314C 167.5 33.333333333333314 182.5 55.55555555555554 200 55.55555555555554C 217.5 55.55555555555554 232.5 16.666666666666657 250 16.666666666666657C 267.5 16.666666666666657 282.5 58.333333333333314 300 58.333333333333314C 300 58.333333333333314 300 58.333333333333314 300 100M 300 58.333333333333314z" fill="url(#SvgjsLinearGradient1394)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskl28j7wpz)" pathTo="M 0 100L 0 77.77777777777777C 17.5 77.77777777777777 32.5 47.22222222222223 50 47.22222222222223C 67.5 47.22222222222223 82.5 86.1111111111111 100 86.1111111111111C 117.5 86.1111111111111 132.5 33.333333333333314 150 33.333333333333314C 167.5 33.333333333333314 182.5 55.55555555555554 200 55.55555555555554C 217.5 55.55555555555554 232.5 16.666666666666657 250 16.666666666666657C 267.5 16.666666666666657 282.5 58.333333333333314 300 58.333333333333314C 300 58.333333333333314 300 58.333333333333314 300 100M 300 58.333333333333314z" pathFrom="M -1 200L -1 200L 50 200L 100 200L 150 200L 200 200L 250 200L 300 200"></path><path id="undefined-0" d="M 0 77.77777777777777C 17.5 77.77777777777777 32.5 47.22222222222223 50 47.22222222222223C 67.5 47.22222222222223 82.5 86.1111111111111 100 86.1111111111111C 117.5 86.1111111111111 132.5 33.333333333333314 150 33.333333333333314C 167.5 33.333333333333314 182.5 55.55555555555554 200 55.55555555555554C 217.5 55.55555555555554 232.5 16.666666666666657 250 16.666666666666657C 267.5 16.666666666666657 282.5 58.333333333333314 300 58.333333333333314" fill="none" fill-opacity="1" stroke="#3454d1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskl28j7wpz)" pathTo="M 0 77.77777777777777C 17.5 77.77777777777777 32.5 47.22222222222223 50 47.22222222222223C 67.5 47.22222222222223 82.5 86.1111111111111 100 86.1111111111111C 117.5 86.1111111111111 132.5 33.333333333333314 150 33.333333333333314C 167.5 33.333333333333314 182.5 55.55555555555554 200 55.55555555555554C 217.5 55.55555555555554 232.5 16.666666666666657 250 16.666666666666657C 267.5 16.666666666666657 282.5 58.333333333333314 300 58.333333333333314" pathFrom="M -1 200L -1 200L 50 200L 100 200L 150 200L 200 200L 250 200L 300 200"></path><g id="SvgjsG1392" class="apexcharts-series-markers-wrap"><g class="apexcharts-series-markers"><circle id="SvgjsCircle1412" r="0" cx="0" cy="0" class="apexcharts-marker wf3nqn71ii no-pointer-events" stroke="#ffffff" fill="#3454d1" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle></g></g><g id="SvgjsG1393" class="apexcharts-datalabels"></g></g></g><line id="SvgjsLine1407" x1="0" y1="0" x2="300" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1408" x1="0" y1="0" x2="300" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1409" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1410" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1411" class="apexcharts-point-annotations"></g></g><rect id="SvgjsRect1385" width="0" height="0" x="0" y="0" rx="0" ry="0" fill="#fefefe" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect><g id="SvgjsG1402" class="apexcharts-yaxis" rel="0" transform="translate(-21, 0)"><g id="SvgjsG1403" class="apexcharts-yaxis-texts-g"></g></g></svg><div class="apexcharts-legend"></div><div class="apexcharts-tooltip light"><div class="apexcharts-tooltip-title" style="font-family: Inter; font-size: 12px;"></div><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(52, 84, 209);"></span><div class="apexcharts-tooltip-text" style="font-family: Inter; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div></div></div>
                                <div class="fs-12 text-muted text-nowrap">
                                    <span class="fw-semibold text-primary">28% more</span><br>
                                    <span>from last week</span>
                                </div>
                            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 891px; height: 151px;"></div></div><div class="contract-trigger"></div></div></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card mb-4 stretch stretch-full">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <div class="d-flex gap-3 align-items-center">
                                    <div class="avatar-text">
                                        <i class="feather feather-file-text"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold text-dark">New Tasks</div>
                                        <div class="fs-12 text-muted">0/20 tasks</div>
                                    </div>
                                </div>
                                <div class="fs-4 fw-bold text-dark">5/20</div>
                            </div>
                            <div class="card-body d-flex align-items-center justify-content-between gap-4" style="position: relative;">
                                <div id="new-tasks-area-chart" style="min-height: 100px;"><div id="apexchartsiintd1rk" class="apexcharts-canvas apexchartsiintd1rk light" style="width: 300px; height: 100px;"><svg id="SvgjsSvg1416" width="300" height="100" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1418" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs1417"><clipPath id="gridRectMaskiintd1rk"><rect id="SvgjsRect1422" width="302" height="102" x="-1" y="-1" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath><clipPath id="gridRectMarkerMaskiintd1rk"><rect id="SvgjsRect1423" width="302" height="102" x="-1" y="-1" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath><linearGradient id="SvgjsLinearGradient1429" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1430" stop-opacity="0.2" stop-color="rgba(37,184,101,0.2)" offset="0"></stop><stop id="SvgjsStop1431" stop-opacity="0.75" stop-color="rgba(255,255,255,0.75)" offset="0.9"></stop><stop id="SvgjsStop1432" stop-opacity="0.75" stop-color="rgba(255,255,255,0.75)" offset="1"></stop></linearGradient></defs><line id="SvgjsLine1421" x1="0" y1="0" x2="0" y2="100" stroke="#b6b6b6" stroke-dasharray="3" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="100" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><g id="SvgjsG1435" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1436" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g></g><g id="SvgjsG1439" class="apexcharts-grid"><line id="SvgjsLine1441" x1="0" y1="100" x2="300" y2="100" stroke="transparent" stroke-dasharray="0"></line><line id="SvgjsLine1440" x1="0" y1="1" x2="0" y2="100" stroke="transparent" stroke-dasharray="0"></line></g><g id="SvgjsG1425" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG1426" class="apexcharts-series" seriesName="NewxTasks" data:longestSeries="true" rel="1" data:realIndex="0"><path id="undefined-0" d="M 0 100L 0 77.77777777777777C 17.5 77.77777777777777 32.5 47.22222222222223 50 47.22222222222223C 67.5 47.22222222222223 82.5 86.1111111111111 100 86.1111111111111C 117.5 86.1111111111111 132.5 33.333333333333314 150 33.333333333333314C 167.5 33.333333333333314 182.5 55.55555555555554 200 55.55555555555554C 217.5 55.55555555555554 232.5 16.666666666666657 250 16.666666666666657C 267.5 16.666666666666657 282.5 58.333333333333314 300 58.333333333333314C 300 58.333333333333314 300 58.333333333333314 300 100M 300 58.333333333333314z" fill="url(#SvgjsLinearGradient1429)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskiintd1rk)" pathTo="M 0 100L 0 77.77777777777777C 17.5 77.77777777777777 32.5 47.22222222222223 50 47.22222222222223C 67.5 47.22222222222223 82.5 86.1111111111111 100 86.1111111111111C 117.5 86.1111111111111 132.5 33.333333333333314 150 33.333333333333314C 167.5 33.333333333333314 182.5 55.55555555555554 200 55.55555555555554C 217.5 55.55555555555554 232.5 16.666666666666657 250 16.666666666666657C 267.5 16.666666666666657 282.5 58.333333333333314 300 58.333333333333314C 300 58.333333333333314 300 58.333333333333314 300 100M 300 58.333333333333314z" pathFrom="M -1 200L -1 200L 50 200L 100 200L 150 200L 200 200L 250 200L 300 200"></path><path id="undefined-0" d="M 0 77.77777777777777C 17.5 77.77777777777777 32.5 47.22222222222223 50 47.22222222222223C 67.5 47.22222222222223 82.5 86.1111111111111 100 86.1111111111111C 117.5 86.1111111111111 132.5 33.333333333333314 150 33.333333333333314C 167.5 33.333333333333314 182.5 55.55555555555554 200 55.55555555555554C 217.5 55.55555555555554 232.5 16.666666666666657 250 16.666666666666657C 267.5 16.666666666666657 282.5 58.333333333333314 300 58.333333333333314" fill="none" fill-opacity="1" stroke="#25b865" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskiintd1rk)" pathTo="M 0 77.77777777777777C 17.5 77.77777777777777 32.5 47.22222222222223 50 47.22222222222223C 67.5 47.22222222222223 82.5 86.1111111111111 100 86.1111111111111C 117.5 86.1111111111111 132.5 33.333333333333314 150 33.333333333333314C 167.5 33.333333333333314 182.5 55.55555555555554 200 55.55555555555554C 217.5 55.55555555555554 232.5 16.666666666666657 250 16.666666666666657C 267.5 16.666666666666657 282.5 58.333333333333314 300 58.333333333333314" pathFrom="M -1 200L -1 200L 50 200L 100 200L 150 200L 200 200L 250 200L 300 200"></path><g id="SvgjsG1427" class="apexcharts-series-markers-wrap"><g class="apexcharts-series-markers"><circle id="SvgjsCircle1447" r="0" cx="0" cy="0" class="apexcharts-marker wph4d757b no-pointer-events" stroke="#ffffff" fill="#25b865" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle></g></g><g id="SvgjsG1428" class="apexcharts-datalabels"></g></g></g><line id="SvgjsLine1442" x1="0" y1="0" x2="300" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1443" x1="0" y1="0" x2="300" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1444" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1445" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1446" class="apexcharts-point-annotations"></g></g><rect id="SvgjsRect1420" width="0" height="0" x="0" y="0" rx="0" ry="0" fill="#fefefe" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect><g id="SvgjsG1437" class="apexcharts-yaxis" rel="0" transform="translate(-21, 0)"><g id="SvgjsG1438" class="apexcharts-yaxis-texts-g"></g></g></svg><div class="apexcharts-legend"></div><div class="apexcharts-tooltip light"><div class="apexcharts-tooltip-title" style="font-family: Inter; font-size: 12px;"></div><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(37, 184, 101);"></span><div class="apexcharts-tooltip-text" style="font-family: Inter; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div></div></div>
                                <div class="fs-12 text-muted text-nowrap">
                                    <span class="fw-semibold text-success">34% more</span><br>
                                    <span>from last week</span>
                                </div>
                            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 891px; height: 151px;"></div></div><div class="contract-trigger"></div></div></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card mb-4 stretch stretch-full">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <div class="d-flex gap-3 align-items-center">
                                    <div class="avatar-text">
                                        <i class="feather feather-airplay"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold text-dark">Project Done</div>
                                        <div class="fs-12 text-muted">20/30 project</div>
                                    </div>
                                </div>
                                <div class="fs-4 fw-bold text-dark">20/30</div>
                            </div>
                            <div class="card-body d-flex align-items-center justify-content-between gap-4" style="position: relative;">
                                <div id="project-done-area-chart" style="min-height: 100px;"><div id="apexchartsx3vvywrr" class="apexcharts-canvas apexchartsx3vvywrr light" style="width: 300px; height: 100px;"><svg id="SvgjsSvg1451" width="300" height="100" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1453" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs1452"><clipPath id="gridRectMaskx3vvywrr"><rect id="SvgjsRect1457" width="302" height="102" x="-1" y="-1" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath><clipPath id="gridRectMarkerMaskx3vvywrr"><rect id="SvgjsRect1458" width="302" height="102" x="-1" y="-1" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath><linearGradient id="SvgjsLinearGradient1464" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1465" stop-opacity="0.2" stop-color="rgba(209,59,76,0.2)" offset="0"></stop><stop id="SvgjsStop1466" stop-opacity="0.75" stop-color="rgba(255,255,255,0.75)" offset="0.9"></stop><stop id="SvgjsStop1467" stop-opacity="0.75" stop-color="rgba(255,255,255,0.75)" offset="1"></stop></linearGradient></defs><line id="SvgjsLine1456" x1="0" y1="0" x2="0" y2="100" stroke="#b6b6b6" stroke-dasharray="3" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="100" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><g id="SvgjsG1470" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1471" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g></g><g id="SvgjsG1474" class="apexcharts-grid"><line id="SvgjsLine1476" x1="0" y1="100" x2="300" y2="100" stroke="transparent" stroke-dasharray="0"></line><line id="SvgjsLine1475" x1="0" y1="1" x2="0" y2="100" stroke="transparent" stroke-dasharray="0"></line></g><g id="SvgjsG1460" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG1461" class="apexcharts-series" seriesName="ProjectxDone" data:longestSeries="true" rel="1" data:realIndex="0"><path id="undefined-0" d="M 0 100L 0 77.77777777777777C 17.5 77.77777777777777 32.5 47.22222222222223 50 47.22222222222223C 67.5 47.22222222222223 82.5 86.1111111111111 100 86.1111111111111C 117.5 86.1111111111111 132.5 33.333333333333314 150 33.333333333333314C 167.5 33.333333333333314 182.5 55.55555555555554 200 55.55555555555554C 217.5 55.55555555555554 232.5 16.666666666666657 250 16.666666666666657C 267.5 16.666666666666657 282.5 58.333333333333314 300 58.333333333333314C 300 58.333333333333314 300 58.333333333333314 300 100M 300 58.333333333333314z" fill="url(#SvgjsLinearGradient1464)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskx3vvywrr)" pathTo="M 0 100L 0 77.77777777777777C 17.5 77.77777777777777 32.5 47.22222222222223 50 47.22222222222223C 67.5 47.22222222222223 82.5 86.1111111111111 100 86.1111111111111C 117.5 86.1111111111111 132.5 33.333333333333314 150 33.333333333333314C 167.5 33.333333333333314 182.5 55.55555555555554 200 55.55555555555554C 217.5 55.55555555555554 232.5 16.666666666666657 250 16.666666666666657C 267.5 16.666666666666657 282.5 58.333333333333314 300 58.333333333333314C 300 58.333333333333314 300 58.333333333333314 300 100M 300 58.333333333333314z" pathFrom="M -1 200L -1 200L 50 200L 100 200L 150 200L 200 200L 250 200L 300 200"></path><path id="undefined-0" d="M 0 77.77777777777777C 17.5 77.77777777777777 32.5 47.22222222222223 50 47.22222222222223C 67.5 47.22222222222223 82.5 86.1111111111111 100 86.1111111111111C 117.5 86.1111111111111 132.5 33.333333333333314 150 33.333333333333314C 167.5 33.333333333333314 182.5 55.55555555555554 200 55.55555555555554C 217.5 55.55555555555554 232.5 16.666666666666657 250 16.666666666666657C 267.5 16.666666666666657 282.5 58.333333333333314 300 58.333333333333314" fill="none" fill-opacity="1" stroke="#d13b4c" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskx3vvywrr)" pathTo="M 0 77.77777777777777C 17.5 77.77777777777777 32.5 47.22222222222223 50 47.22222222222223C 67.5 47.22222222222223 82.5 86.1111111111111 100 86.1111111111111C 117.5 86.1111111111111 132.5 33.333333333333314 150 33.333333333333314C 167.5 33.333333333333314 182.5 55.55555555555554 200 55.55555555555554C 217.5 55.55555555555554 232.5 16.666666666666657 250 16.666666666666657C 267.5 16.666666666666657 282.5 58.333333333333314 300 58.333333333333314" pathFrom="M -1 200L -1 200L 50 200L 100 200L 150 200L 200 200L 250 200L 300 200"></path><g id="SvgjsG1462" class="apexcharts-series-markers-wrap"><g class="apexcharts-series-markers"><circle id="SvgjsCircle1482" r="0" cx="0" cy="0" class="apexcharts-marker w7esl7di2 no-pointer-events" stroke="#ffffff" fill="#d13b4c" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle></g></g><g id="SvgjsG1463" class="apexcharts-datalabels"></g></g></g><line id="SvgjsLine1477" x1="0" y1="0" x2="300" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1478" x1="0" y1="0" x2="300" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1479" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1480" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1481" class="apexcharts-point-annotations"></g></g><rect id="SvgjsRect1455" width="0" height="0" x="0" y="0" rx="0" ry="0" fill="#fefefe" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect><g id="SvgjsG1472" class="apexcharts-yaxis" rel="0" transform="translate(-21, 0)"><g id="SvgjsG1473" class="apexcharts-yaxis-texts-g"></g></g></svg><div class="apexcharts-legend"></div><div class="apexcharts-tooltip light"><div class="apexcharts-tooltip-title" style="font-family: Inter; font-size: 12px;"></div><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(209, 59, 76);"></span><div class="apexcharts-tooltip-text" style="font-family: Inter; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div></div></div>
                                <div class="fs-12 text-muted text-nowrap">
                                    <span class="fw-semibold text-danger">42% more</span><br>
                                    <span>from last week</span>
                                </div>
                            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 891px; height: 151px;"></div></div><div class="contract-trigger"></div></div></div>
                        </div>
                    </div>
                    <!-- [Mini] end !-->
                    <!-- [Leads Overview] start -->
                    <div class="col-xxl-4">
                        <div class="card stretch stretch-full">
                            <div class="card-header">
                                <h5 class="card-title">Leads Overview</h5>
                                <div class="card-header-action">
                                    <div class="card-header-btn">
                                        <div data-bs-toggle="tooltip" title="" data-bs-original-title="Delete">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-danger" data-bs-toggle="remove"> </a>
                                        </div>
                                        <div data-bs-toggle="tooltip" title="" data-bs-original-title="Refresh">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-warning" data-bs-toggle="refresh"> </a>
                                        </div>
                                        <div data-bs-toggle="tooltip" title="" data-bs-original-title="Maximize/Minimize">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-success" data-bs-toggle="expand"> </a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="dropdown" data-bs-offset="25, 25">
                                            <div data-bs-toggle="tooltip" title="" data-bs-original-title="Options">
                                                <i class="feather-more-vertical"></i>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-at-sign"></i>New</a>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-calendar"></i>Event</a>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-bell"></i>Snoozed</a>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-trash-2"></i>Deleted</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-settings"></i>Settings</a>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-life-buoy"></i>Tips &amp; Tricks</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body custom-card-action" style="position: relative;">
                                <div id="leads-overview-donut" style="min-height: 286.39px;"><div id="apexcharts6hqmil13" class="apexcharts-canvas apexcharts6hqmil13 light" style="width: 328px; height: 286.39px;"><svg id="SvgjsSvg1485" width="328" height="286.39024390243907" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1487" class="apexcharts-inner apexcharts-graphical" transform="translate(29.5, 0)"><defs id="SvgjsDefs1486"><clipPath id="gridRectMask6hqmil13"><rect id="SvgjsRect1488" width="271" height="293" x="0" y="0" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath><clipPath id="gridRectMarkerMask6hqmil13"><rect id="SvgjsRect1489" width="273" height="295" x="-1" y="-1" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath></defs><g id="SvgjsG1491" class="apexcharts-pie" data:innerTranslateX="0" data:innerTranslateY="-25"><g id="SvgjsG1492" transform="translate(0, -5) scale(1)"><circle id="SvgjsCircle1493" r="108.9658536585366" cx="135.5" cy="135.5" fill="transparent"></circle><g id="SvgjsG1494" class="apexcharts-slices"><g id="SvgjsG1495" class="apexcharts-series apexcharts-pie-series" seriesName="New" rel="1" data:realIndex="0"><path id="SvgjsPath1496" d="M 135.5 7.304878048780466 A 128.19512195121953 128.19512195121953 0 0 1 242.09034834785803 64.27860622558464 L 226.1017960956793 74.96181529174694 A 108.9658536585366 108.9658536585366 0 0 0 135.5 26.534146341463398 L 135.5 7.304878048780466 z" fill="rgba(52,84,209,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-0" index="0" j="0" data:angle="56.25" data:startAngle="0" data:strokeWidth="0" data:value="20" data:pathOrig="M 135.5 7.304878048780466 A 128.19512195121953 128.19512195121953 0 0 1 242.09034834785803 64.27860622558464 L 226.1017960956793 74.96181529174694 A 108.9658536585366 108.9658536585366 0 0 0 135.5 26.534146341463398 L 135.5 7.304878048780466 z"></path></g><g id="SvgjsG1497" class="apexcharts-series apexcharts-pie-series" seriesName="Contacted" rel="2" data:realIndex="1"><path id="SvgjsPath1498" d="M 242.09034834785803 64.27860622558464 A 128.19512195121953 128.19512195121953 0 0 1 262.30760332621685 154.3101310667654 L 243.2864628272843 151.48861140675058 A 108.9658536585366 108.9658536585366 0 0 0 226.1017960956793 74.96181529174694 L 242.09034834785803 64.27860622558464 z" fill="rgba(21,101,192,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-1" index="0" j="1" data:angle="42.1875" data:startAngle="56.25" data:strokeWidth="0" data:value="15" data:pathOrig="M 242.09034834785803 64.27860622558464 A 128.19512195121953 128.19512195121953 0 0 1 262.30760332621685 154.3101310667654 L 243.2864628272843 151.48861140675058 A 108.9658536585366 108.9658536585366 0 0 0 226.1017960956793 74.96181529174694 L 242.09034834785803 64.27860622558464 z"></path></g><g id="SvgjsG1499" class="apexcharts-series apexcharts-pie-series" seriesName="Qualified" rel="3" data:realIndex="2"><path id="SvgjsPath1500" d="M 262.30760332621685 154.3101310667654 A 128.19512195121953 128.19512195121953 0 0 1 238.4672874502993 211.86574498566415 L 223.0221943327544 200.41088323781452 A 108.9658536585366 108.9658536585366 0 0 0 243.2864628272843 151.48861140675058 L 262.30760332621685 154.3101310667654 z" fill="rgba(25,118,210,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-2" index="0" j="2" data:angle="28.125" data:startAngle="98.4375" data:strokeWidth="0" data:value="10" data:pathOrig="M 262.30760332621685 154.3101310667654 A 128.19512195121953 128.19512195121953 0 0 1 238.4672874502993 211.86574498566415 L 223.0221943327544 200.41088323781452 A 108.9658536585366 108.9658536585366 0 0 0 243.2864628272843 151.48861140675058 L 262.30760332621685 154.3101310667654 z"></path></g><g id="SvgjsG1501" class="apexcharts-series apexcharts-pie-series" seriesName="Working" rel="4" data:realIndex="3"><path id="SvgjsPath1502" d="M 238.4672874502993 211.86574498566415 A 128.19512195121953 128.19512195121953 0 0 1 141.79023649426608 263.54070531254604 L 140.84670102012618 244.33459951566414 A 108.9658536585366 108.9658536585366 0 0 0 223.0221943327544 200.41088323781452 L 238.4672874502993 211.86574498566415 z" fill="rgba(30,136,229,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-3" index="0" j="3" data:angle="50.625" data:startAngle="126.5625" data:strokeWidth="0" data:value="18" data:pathOrig="M 238.4672874502993 211.86574498566415 A 128.19512195121953 128.19512195121953 0 0 1 141.79023649426608 263.54070531254604 L 140.84670102012618 244.33459951566414 A 108.9658536585366 108.9658536585366 0 0 0 223.0221943327544 200.41088323781452 L 238.4672874502993 211.86574498566415 z"></path></g><g id="SvgjsG1503" class="apexcharts-series apexcharts-pie-series" seriesName="Customer" rel="5" data:realIndex="4"><path id="SvgjsPath1504" d="M 141.79023649426608 263.54070531254604 A 128.19512195121953 128.19512195121953 0 0 1 80.6895226568399 251.38701767455655 L 88.91109425831392 234.00396502337307 A 108.9658536585366 108.9658536585366 0 0 0 140.84670102012618 244.33459951566414 L 141.79023649426608 263.54070531254604 z" fill="rgba(33,150,243,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-4" index="0" j="4" data:angle="28.125" data:startAngle="177.1875" data:strokeWidth="0" data:value="10" data:pathOrig="M 141.79023649426608 263.54070531254604 A 128.19512195121953 128.19512195121953 0 0 1 80.6895226568399 251.38701767455655 L 88.91109425831392 234.00396502337307 A 108.9658536585366 108.9658536585366 0 0 0 140.84670102012618 244.33459951566414 L 141.79023649426608 263.54070531254604 z"></path></g><g id="SvgjsG1505" class="apexcharts-series apexcharts-pie-series" seriesName="Proposal" rel="6" data:realIndex="5"><path id="SvgjsPath1506" d="M 80.6895226568399 251.38701767455655 A 128.19512195121953 128.19512195121953 0 0 1 17.06315066147991 184.55814928075398 L 34.82867806225792 177.19942688864086 A 108.9658536585366 108.9658536585366 0 0 0 88.91109425831392 234.00396502337307 L 80.6895226568399 251.38701767455655 z" fill="rgba(66,165,245,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-5" index="0" j="5" data:angle="42.1875" data:startAngle="205.3125" data:strokeWidth="0" data:value="15" data:pathOrig="M 80.6895226568399 251.38701767455655 A 128.19512195121953 128.19512195121953 0 0 1 17.06315066147991 184.55814928075398 L 34.82867806225792 177.19942688864086 A 108.9658536585366 108.9658536585366 0 0 0 88.91109425831392 234.00396502337307 L 80.6895226568399 251.38701767455655 z"></path></g><g id="SvgjsG1507" class="apexcharts-series apexcharts-pie-series" seriesName="Leads" rel="7" data:realIndex="6"><path id="SvgjsPath1508" d="M 17.06315066147991 184.55814928075398 A 128.19512195121953 128.19512195121953 0 0 1 17.06315066147988 86.4418507192461 L 34.82867806225789 93.8005731113592 A 108.9658536585366 108.9658536585366 0 0 0 34.82867806225792 177.19942688864086 L 17.06315066147991 184.55814928075398 z" fill="rgba(100,181,246,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-6" index="0" j="6" data:angle="45" data:startAngle="247.5" data:strokeWidth="0" data:value="16" data:pathOrig="M 17.06315066147991 184.55814928075398 A 128.19512195121953 128.19512195121953 0 0 1 17.06315066147988 86.4418507192461 L 34.82867806225789 93.8005731113592 A 108.9658536585366 108.9658536585366 0 0 0 34.82867806225792 177.19942688864086 L 17.06315066147991 184.55814928075398 z"></path></g><g id="SvgjsG1509" class="apexcharts-series apexcharts-pie-series" seriesName="Prograss" rel="8" data:realIndex="7"><path id="SvgjsPath1510" d="M 17.06315066147988 86.4418507192461 A 128.19512195121953 128.19512195121953 0 0 1 75.06923783518425 22.441995965488914 L 84.13385215990662 39.40069657066559 A 108.9658536585366 108.9658536585366 0 0 0 34.82867806225789 93.8005731113592 L 17.06315066147988 86.4418507192461 z" fill="rgba(144,202,249,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-7" index="0" j="7" data:angle="39.375" data:startAngle="292.5" data:strokeWidth="0" data:value="14" data:pathOrig="M 17.06315066147988 86.4418507192461 A 128.19512195121953 128.19512195121953 0 0 1 75.06923783518425 22.441995965488914 L 84.13385215990662 39.40069657066559 A 108.9658536585366 108.9658536585366 0 0 0 34.82867806225789 93.8005731113592 L 17.06315066147988 86.4418507192461 z"></path></g><g id="SvgjsG1511" class="apexcharts-series apexcharts-pie-series" seriesName="Others" rel="9" data:realIndex="8"><path id="SvgjsPath1512" d="M 75.06923783518425 22.441995965488914 A 128.19512195121953 128.19512195121953 0 0 1 135.47762573048314 7.304880001303815 L 135.48098187091065 26.53414800110825 A 108.9658536585366 108.9658536585366 0 0 0 84.13385215990662 39.40069657066559 L 75.06923783518425 22.441995965488914 z" fill="rgba(170,214,250,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-8" index="0" j="8" data:angle="28.125" data:startAngle="331.875" data:strokeWidth="0" data:value="10" data:pathOrig="M 75.06923783518425 22.441995965488914 A 128.19512195121953 128.19512195121953 0 0 1 135.47762573048314 7.304880001303815 L 135.48098187091065 26.53414800110825 A 108.9658536585366 108.9658536585366 0 0 0 84.13385215990662 39.40069657066559 L 75.06923783518425 22.441995965488914 z"></path></g></g></g></g><line id="SvgjsLine1513" x1="0" y1="0" x2="271" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1514" x1="0" y1="0" x2="271" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line></g></svg><div class="apexcharts-legend"></div><div class="apexcharts-tooltip dark"><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(52, 84, 209);"></span><div class="apexcharts-tooltip-text" style="font-family: Inter; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(21, 101, 192);"></span><div class="apexcharts-tooltip-text" style="font-family: Inter; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(25, 118, 210);"></span><div class="apexcharts-tooltip-text" style="font-family: Inter; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(30, 136, 229);"></span><div class="apexcharts-tooltip-text" style="font-family: Inter; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(33, 150, 243);"></span><div class="apexcharts-tooltip-text" style="font-family: Inter; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(66, 165, 245);"></span><div class="apexcharts-tooltip-text" style="font-family: Inter; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(100, 181, 246);"></span><div class="apexcharts-tooltip-text" style="font-family: Inter; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(144, 202, 249);"></span><div class="apexcharts-tooltip-text" style="font-family: Inter; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(170, 214, 250);"></span><div class="apexcharts-tooltip-text" style="font-family: Inter; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div></div></div>
                                <div class="row g-2">
                                    <div class="col-4">
                                        <a href="javascript:void(0);" class="p-2 hstack gap-2 rounded border border-dashed border-gray-5">
                                            <span class="wd-7 ht-7 rounded-circle d-inline-block" style="background-color: #3454d1"></span>
                                            <span>New<span class="fs-10 text-muted ms-1">(20K)</span></span>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="javascript:void(0);" class="p-2 hstack gap-2 rounded border border-dashed border-gray-5">
                                            <span class="wd-7 ht-7 rounded-circle d-inline-block" style="background-color: #0d519e"></span>
                                            <span>Contacted<span class="fs-10 text-muted ms-1">(15K)</span></span>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="javascript:void(0);" class="p-2 hstack gap-2 rounded border border-dashed border-gray-5">
                                            <span class="wd-7 ht-7 rounded-circle d-inline-block" style="background-color: #1976d2"></span>
                                            <span>Qualified<span class="fs-10 text-muted ms-1">(10K)</span></span>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="javascript:void(0);" class="p-2 hstack gap-2 rounded border border-dashed border-gray-5">
                                            <span class="wd-7 ht-7 rounded-circle d-inline-block" style="background-color: #1e88e5"></span>
                                            <span>Working<span class="fs-10 text-muted ms-1">(18K)</span></span>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="javascript:void(0);" class="p-2 hstack gap-2 rounded border border-dashed border-gray-5">
                                            <span class="wd-7 ht-7 rounded-circle d-inline-block" style="background-color: #2196f3"></span>
                                            <span>Customer<span class="fs-10 text-muted ms-1">(10K)</span></span>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="javascript:void(0);" class="p-2 hstack gap-2 rounded border border-dashed border-gray-5">
                                            <span class="wd-7 ht-7 rounded-circle d-inline-block" style="background-color: #42a5f5"></span>
                                            <span>Proposal<span class="fs-10 text-muted ms-1">(15K)</span></span>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="javascript:void(0);" class="p-2 hstack gap-2 rounded border border-dashed border-gray-5">
                                            <span class="wd-7 ht-7 rounded-circle d-inline-block" style="background-color: #64b5f6"></span>
                                            <span>Leads<span class="fs-10 text-muted ms-1">(16K)</span></span>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="javascript:void(0);" class="p-2 hstack gap-2 rounded border border-dashed border-gray-5">
                                            <span class="wd-7 ht-7 rounded-circle d-inline-block" style="background-color: #90caf9"></span>
                                            <span>Progress<span class="fs-10 text-muted ms-1">(14K)</span></span>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="javascript:void(0);" class="p-2 hstack gap-2 rounded border border-dashed border-gray-5">
                                            <span class="wd-7 ht-7 rounded-circle d-inline-block" style="background-color: #aad6fa"></span>
                                            <span>Others<span class="fs-10 text-muted ms-1">(10K)</span></span>
                                        </a>
                                    </div>
                                </div>
                            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 891px; height: 472px;"></div></div><div class="contract-trigger"></div></div></div>
                        </div>
                    </div>
                    <!-- [Leads Overview] end -->
                    <!-- [Latest Leads] start -->
                    <div class="col-xxl-8">
                        <div class="card stretch stretch-full">
                            <div class="card-header">
                                <h5 class="card-title">Latest Leads</h5>
                                <div class="card-header-action">
                                    <div class="card-header-btn">
                                        <div data-bs-toggle="tooltip" title="" data-bs-original-title="Delete">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-danger" data-bs-toggle="remove"> </a>
                                        </div>
                                        <div data-bs-toggle="tooltip" title="" data-bs-original-title="Refresh">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-warning" data-bs-toggle="refresh"> </a>
                                        </div>
                                        <div data-bs-toggle="tooltip" title="" data-bs-original-title="Maximize/Minimize">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-success" data-bs-toggle="expand"> </a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="dropdown" data-bs-offset="25, 25">
                                            <div data-bs-toggle="tooltip" title="" data-bs-original-title="Options">
                                                <i class="feather-more-vertical"></i>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-at-sign"></i>New</a>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-calendar"></i>Event</a>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-bell"></i>Snoozed</a>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-trash-2"></i>Deleted</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-settings"></i>Settings</a>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-life-buoy"></i>Tips &amp; Tricks</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body custom-card-action p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr class="border-b">
                                                <th scope="row">Users</th>
                                                <th>Proposal</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th class="text-end">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="avatar-image">
                                                            <img src="assets/images/avatar/2.png" alt="" class="img-fluid">
                                                        </div>
                                                        <a href="javascript:void(0);">
                                                            <span class="d-block">Archie Cantones</span>
                                                            <span class="fs-12 d-block fw-normal text-muted">arcie.tones@gmail.com</span>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-gray-200 text-dark">Sent</span>
                                                </td>
                                                <td>11/06/2023 10:53</td>
                                                <td>
                                                    <span class="badge bg-soft-success text-success">Completed</span>
                                                </td>
                                                <td class="text-end">
                                                    <a href="javascript:void(0);"><i class="feather-more-vertical"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="avatar-image">
                                                            <img src="assets/images/avatar/3.png" alt="" class="img-fluid">
                                                        </div>
                                                        <a href="javascript:void(0);">
                                                            <span class="d-block">Holmes Cherryman</span>
                                                            <span class="fs-12 d-block fw-normal text-muted">golms.chan@gmail.com</span>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-gray-200 text-dark">New</span>
                                                </td>
                                                <td>11/06/2023 10:53</td>
                                                <td>
                                                    <span class="badge bg-soft-primary text-primary">In Progress </span>
                                                </td>
                                                <td class="text-end">
                                                    <a href="javascript:void(0);"><i class="feather-more-vertical"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="avatar-image">
                                                            <img src="assets/images/avatar/4.png" alt="" class="img-fluid">
                                                        </div>
                                                        <a href="javascript:void(0);">
                                                            <span class="d-block">Malanie Hanvey</span>
                                                            <span class="fs-12 d-block fw-normal text-muted">lanie.nveyn@gmail.com</span>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-gray-200 text-dark">Sent</span>
                                                </td>
                                                <td>11/06/2023 10:53</td>
                                                <td>
                                                    <span class="badge bg-soft-success text-success">Completed</span>
                                                </td>
                                                <td class="text-end">
                                                    <a href="javascript:void(0);"><i class="feather-more-vertical"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="avatar-image">
                                                            <img src="assets/images/avatar/5.png" alt="" class="img-fluid">
                                                        </div>
                                                        <a href="javascript:void(0);">
                                                            <span class="d-block">Kenneth Hune</span>
                                                            <span class="fs-12 d-block fw-normal text-muted">nneth.une@gmail.com</span>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-gray-200 text-dark">Returning</span>
                                                </td>
                                                <td>11/06/2023 10:53</td>
                                                <td>
                                                    <span class="badge bg-soft-warning text-warning">Not Interested</span>
                                                </td>
                                                <td class="text-end">
                                                    <a href="javascript:void(0);"><i class="feather-more-vertical"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="avatar-image">
                                                            <img src="assets/images/avatar/6.png" alt="" class="img-fluid">
                                                        </div>
                                                        <a href="javascript:void(0);">
                                                            <span class="d-block">Valentine Maton</span>
                                                            <span class="fs-12 d-block fw-normal text-muted">alenine.aton@gmail.com</span>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-gray-200 text-dark">Sent</span>
                                                </td>
                                                <td>11/06/2023 10:53</td>
                                                <td>
                                                    <span class="badge bg-soft-success text-success">Completed</span>
                                                </td>
                                                <td class="text-end">
                                                    <a href="javascript:void(0);"><i class="feather-more-vertical"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <ul class="list-unstyled d-flex align-items-center gap-2 mb-0 pagination-common-style">
                                    <li>
                                        <a href="javascript:void(0);"><i class="bi bi-arrow-left"></i></a>
                                    </li>
                                    <li><a href="javascript:void(0);" class="active">1</a></li>
                                    <li><a href="javascript:void(0);">2</a></li>
                                    <li>
                                        <a href="javascript:void(0);"><i class="bi bi-dot"></i></a>
                                    </li>
                                    <li><a href="javascript:void(0);">8</a></li>
                                    <li><a href="javascript:void(0);">9</a></li>
                                    <li>
                                        <a href="javascript:void(0);"><i class="bi bi-arrow-right"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- [Latest Leads] end -->
                    <!--! BEGIN: [Upcoming Schedule] !-->
                    <div class="col-xxl-4">
                        <div class="card stretch stretch-full">
                            <div class="card-header">
                                <h5 class="card-title">Upcoming Schedule</h5>
                                <div class="card-header-action">
                                    <div class="card-header-btn">
                                        <div data-bs-toggle="tooltip" title="" data-bs-original-title="Delete">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-danger" data-bs-toggle="remove"> </a>
                                        </div>
                                        <div data-bs-toggle="tooltip" title="" data-bs-original-title="Refresh">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-warning" data-bs-toggle="refresh"> </a>
                                        </div>
                                        <div data-bs-toggle="tooltip" title="" data-bs-original-title="Maximize/Minimize">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-success" data-bs-toggle="expand"> </a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="dropdown" data-bs-offset="25, 25">
                                            <div data-bs-toggle="tooltip" title="" data-bs-original-title="Options">
                                                <i class="feather-more-vertical"></i>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-at-sign"></i>New</a>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-calendar"></i>Event</a>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-bell"></i>Snoozed</a>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-trash-2"></i>Deleted</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-settings"></i>Settings</a>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-life-buoy"></i>Tips &amp; Tricks</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <!--! BEGIN: [Events] !-->
                                <div class="p-3 border border-dashed rounded-3 mb-3">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="wd-50 ht-50 bg-soft-primary text-primary lh-1 d-flex align-items-center justify-content-center flex-column rounded-2 schedule-date">
                                                <span class="fs-18 fw-bold mb-1 d-block">20</span>
                                                <span class="fs-10 fw-semibold text-uppercase d-block">Dec</span>
                                            </div>
                                            <div class="text-dark">
                                                <a href="javascript:void(0);" class="fw-bold mb-2 text-truncate-1-line">React Dashboard Design</a>
                                                <span class="fs-11 fw-normal text-muted text-truncate-1-line">11:30am - 12:30pm</span>
                                            </div>
                                        </div>
                                        <div class="img-group lh-0 ms-3 justify-content-start d-none d-sm-flex">
                                            <a href="javascript:void(0)" class="avatar-image avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Janette Dalton">
                                                <img src="assets/images/avatar/2.png" class="img-fluid" alt="image">
                                            </a>
                                            <a href="javascript:void(0)" class="avatar-image avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Michael Ksen">
                                                <img src="assets/images/avatar/3.png" class="img-fluid" alt="image">
                                            </a>
                                            <a href="javascript:void(0)" class="avatar-image avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Socrates Itumay">
                                                <img src="assets/images/avatar/4.png" class="img-fluid" alt="image">
                                            </a>
                                            <a href="javascript:void(0)" class="avatar-image avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Marianne Audrey">
                                                <img src="assets/images/avatar/6.png" class="img-fluid" alt="image">
                                            </a>
                                            <a href="javascript:void(0)" class="avatar-text avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Explorer More">
                                                <i class="feather-more-horizontal"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!--! BEGIN: [Events] !-->
                                <div class="p-3 border border-dashed rounded-3 mb-3">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="wd-50 ht-50 bg-soft-warning text-warning lh-1 d-flex align-items-center justify-content-center flex-column rounded-2 schedule-date">
                                                <span class="fs-18 fw-bold mb-1 d-block">30</span>
                                                <span class="fs-10 fw-semibold text-uppercase d-block">Dec</span>
                                            </div>
                                            <div class="text-dark">
                                                <a href="javascript:void(0);" class="fw-bold mb-2 text-truncate-1-line">Admin Design Concept</a>
                                                <span class="fs-11 fw-normal text-muted text-truncate-1-line">10:00am - 12:00pm</span>
                                            </div>
                                        </div>
                                        <div class="img-group lh-0 ms-3 justify-content-start d-none d-sm-flex">
                                            <a href="javascript:void(0)" class="avatar-image avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Janette Dalton">
                                                <img src="assets/images/avatar/2.png" class="img-fluid" alt="image">
                                            </a>
                                            <a href="javascript:void(0)" class="avatar-image avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Michael Ksen">
                                                <img src="assets/images/avatar/3.png" class="img-fluid" alt="image">
                                            </a>
                                            <a href="javascript:void(0)" class="avatar-image avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Marianne Audrey">
                                                <img src="assets/images/avatar/5.png" class="img-fluid" alt="image">
                                            </a>
                                            <a href="javascript:void(0)" class="avatar-image avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Marianne Audrey">
                                                <img src="assets/images/avatar/6.png" class="img-fluid" alt="image">
                                            </a>
                                            <a href="javascript:void(0)" class="avatar-text avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Explorer More">
                                                <i class="feather-more-horizontal"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!--! BEGIN: [Events] !-->
                                <div class="p-3 border border-dashed rounded-3 mb-3">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="wd-50 ht-50 bg-soft-success text-success lh-1 d-flex align-items-center justify-content-center flex-column rounded-2 schedule-date">
                                                <span class="fs-18 fw-bold mb-1 d-block">17</span>
                                                <span class="fs-10 fw-semibold text-uppercase d-block">Dec</span>
                                            </div>
                                            <div class="text-dark">
                                                <a href="javascript:void(0);" class="fw-bold mb-2 text-truncate-1-line">Standup Team Meeting</a>
                                                <span class="fs-11 fw-normal text-muted text-truncate-1-line">8:00am - 9:00am</span>
                                            </div>
                                        </div>
                                        <div class="img-group lh-0 ms-3 justify-content-start d-none d-sm-flex">
                                            <a href="javascript:void(0)" class="avatar-image avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Janette Dalton">
                                                <img src="assets/images/avatar/2.png" class="img-fluid" alt="image">
                                            </a>
                                            <a href="javascript:void(0)" class="avatar-image avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Michael Ksen">
                                                <img src="assets/images/avatar/3.png" class="img-fluid" alt="image">
                                            </a>
                                            <a href="javascript:void(0)" class="avatar-image avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Socrates Itumay">
                                                <img src="assets/images/avatar/4.png" class="img-fluid" alt="image">
                                            </a>
                                            <a href="javascript:void(0)" class="avatar-image avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Marianne Audrey">
                                                <img src="assets/images/avatar/5.png" class="img-fluid" alt="image">
                                            </a>
                                            <a href="javascript:void(0)" class="avatar-text avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Explorer More">
                                                <i class="feather-more-horizontal"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!--! BEGIN: [Events] !-->
                                <div class="p-3 border border-dashed rounded-3 mb-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="wd-50 ht-50 bg-soft-danger text-danger lh-1 d-flex align-items-center justify-content-center flex-column rounded-2 schedule-date">
                                                <span class="fs-18 fw-bold mb-1 d-block">25</span>
                                                <span class="fs-10 fw-semibold text-uppercase d-block">Dec</span>
                                            </div>
                                            <div class="text-dark">
                                                <a href="javascript:void(0);" class="fw-bold mb-2 text-truncate-1-line">Zoom Team Meeting</a>
                                                <span class="fs-11 fw-normal text-muted text-truncate-1-line">03:30pm - 05:30pm</span>
                                            </div>
                                        </div>
                                        <div class="img-group lh-0 ms-3 justify-content-start d-none d-sm-flex">
                                            <a href="javascript:void(0)" class="avatar-image avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Janette Dalton">
                                                <img src="assets/images/avatar/2.png" class="img-fluid" alt="image">
                                            </a>
                                            <a href="javascript:void(0)" class="avatar-image avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Socrates Itumay">
                                                <img src="assets/images/avatar/4.png" class="img-fluid" alt="image">
                                            </a>
                                            <a href="javascript:void(0)" class="avatar-image avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Marianne Audrey">
                                                <img src="assets/images/avatar/5.png" class="img-fluid" alt="image">
                                            </a>
                                            <a href="javascript:void(0)" class="avatar-image avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Marianne Audrey">
                                                <img src="assets/images/avatar/6.png" class="img-fluid" alt="image">
                                            </a>
                                            <a href="javascript:void(0)" class="avatar-text avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Explorer More">
                                                <i class="feather-more-horizontal"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="card-footer fs-11 fw-bold text-uppercase text-center py-4">Upcomming Schedule</a>
                        </div>
                    </div>
                    <!--! END: [Upcoming Schedule] !-->
                    <!--! BEGIN: [Project Status] !-->
                    <div class="col-xxl-4">
                        <div class="card stretch stretch-full">
                            <div class="card-header">
                                <h5 class="card-title">Project Status</h5>
                                <div class="card-header-action">
                                    <div class="card-header-btn">
                                        <div data-bs-toggle="tooltip" title="" data-bs-original-title="Delete">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-danger" data-bs-toggle="remove"> </a>
                                        </div>
                                        <div data-bs-toggle="tooltip" title="" data-bs-original-title="Refresh">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-warning" data-bs-toggle="refresh"> </a>
                                        </div>
                                        <div data-bs-toggle="tooltip" title="" data-bs-original-title="Maximize/Minimize">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-success" data-bs-toggle="expand"> </a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="dropdown" data-bs-offset="25, 25">
                                            <div data-bs-toggle="tooltip" title="" data-bs-original-title="Options">
                                                <i class="feather-more-vertical"></i>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-at-sign"></i>New</a>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-calendar"></i>Event</a>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-bell"></i>Snoozed</a>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-trash-2"></i>Deleted</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-settings"></i>Settings</a>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-life-buoy"></i>Tips &amp; Tricks</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body custom-card-action">
                                <div class="mb-3">
                                    <div class="mb-4 pb-1 d-flex">
                                        <div class="d-flex w-50 align-items-center me-3">
                                            <img src="assets/images/brand/app-store.png" alt="laravel-logo" class="me-3" width="35">
                                            <div>
                                                <a href="javascript:void(0);" class="text-truncate-1-line">Apps Development</a>
                                                <div class="fs-11 text-muted">Applications</div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-grow-1 align-items-center">
                                            <div class="progress w-100 me-3 ht-5">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 54%" aria-valuenow="54" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="text-muted">54%</span>
                                        </div>
                                    </div>
                                    <hr class="border-dashed my-3">
                                    <div class="mb-4 pb-1 d-flex">
                                        <div class="d-flex w-50 align-items-center me-3">
                                            <img src="assets/images/brand/figma.png" alt="figma-logo" class="me-3" width="35">
                                            <div>
                                                <a href="javascript:void(0);" class="text-truncate-1-line">Dashboard Design</a>
                                                <div class="fs-11 text-muted">App UI Kit</div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-grow-1 align-items-center">
                                            <div class="progress w-100 me-3 ht-5">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 86%" aria-valuenow="86" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="text-muted">86%</span>
                                        </div>
                                    </div>
                                    <hr class="border-dashed my-3">
                                    <div class="mb-4 pb-1 d-flex">
                                        <div class="d-flex w-50 align-items-center me-3">
                                            <img src="assets/images/brand/facebook.png" alt="vue-logo" class="me-3" width="35">
                                            <div>
                                                <a href="javascript:void(0);" class="text-truncate-1-line">Facebook Marketing</a>
                                                <div class="fs-11 text-muted">Marketing</div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-grow-1 align-items-center">
                                            <div class="progress w-100 me-3 ht-5">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="text-muted">90%</span>
                                        </div>
                                    </div>
                                    <hr class="border-dashed my-3">
                                    <div class="mb-4 pb-1 d-flex">
                                        <div class="d-flex w-50 align-items-center me-3">
                                            <img src="assets/images/brand/github.png" alt="react-logo" class="me-3" width="35">
                                            <div>
                                                <a href="javascript:void(0);" class="text-truncate-1-line">React Dashboard Github</a>
                                                <div class="fs-11 text-muted">Dashboard</div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-grow-1 align-items-center">
                                            <div class="progress w-100 me-3 ht-5">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: 37%" aria-valuenow="37" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="text-muted">37%</span>
                                        </div>
                                    </div>
                                    <hr class="border-dashed my-3">
                                    <div class="d-flex">
                                        <div class="d-flex w-50 align-items-center me-3">
                                            <img src="assets/images/brand/paypal.png" alt="sketch-logo" class="me-3" width="35">
                                            <div>
                                                <a href="javascript:void(0);" class="text-truncate-1-line">Paypal Payment Gateway</a>
                                                <div class="fs-11 text-muted">Payment</div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-grow-1 align-items-center">
                                            <div class="progress w-100 me-3 ht-5">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 29%" aria-valuenow="29" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="text-muted">29%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="card-footer fs-11 fw-bold text-uppercase text-center">Upcomming Projects</a>
                        </div>
                    </div>
                    <!--! END: [Project Status] !-->
                    <!--! BEGIN: [Team Progress] !-->
                    <div class="col-xxl-4">
                        <div class="card stretch stretch-full">
                            <div class="card-header">
                                <h5 class="card-title">Team Progress</h5>
                                <div class="card-header-action">
                                    <div class="card-header-btn">
                                        <div data-bs-toggle="tooltip" title="" data-bs-original-title="Delete">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-danger" data-bs-toggle="remove"> </a>
                                        </div>
                                        <div data-bs-toggle="tooltip" title="" data-bs-original-title="Refresh">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-warning" data-bs-toggle="refresh"> </a>
                                        </div>
                                        <div data-bs-toggle="tooltip" title="" data-bs-original-title="Maximize/Minimize">
                                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-success" data-bs-toggle="expand"> </a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="dropdown" data-bs-offset="25, 25">
                                            <div data-bs-toggle="tooltip" title="" data-bs-original-title="Options">
                                                <i class="feather-more-vertical"></i>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-at-sign"></i>New</a>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-calendar"></i>Event</a>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-bell"></i>Snoozed</a>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-trash-2"></i>Deleted</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-settings"></i>Settings</a>
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-life-buoy"></i>Tips &amp; Tricks</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body custom-card-action">
                                <div class="hstack justify-content-between border border-dashed rounded-3 p-3 mb-3">
                                    <div class="hstack gap-3">
                                        <div class="avatar-image">
                                            <img src="assets/images/avatar/1.png" alt="" class="img-fluid">
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);">Alexandra Della</a>
                                            <div class="fs-11 text-muted">Frontend Developer</div>
                                        </div>
                                    </div>
                                    <div class="team-progress-1" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="40"><svg version="1.1" width="100" height="100" viewBox="0 0 100 100" class="circle-progress"><circle class="circle-progress-circle" cx="50" cy="50" r="47" fill="none" stroke="#ddd" stroke-width="8"></circle><path d="M 50 3 A 47 47 0 0 1 77.62590685774623 88.02379873562253" class="circle-progress-value" fill="none" stroke="#00E699" stroke-width="8"></path><text class="circle-progress-text" x="50" y="50" font="16px Arial, sans-serif" text-anchor="middle" fill="#999" dy="0.4em">40%</text></svg></div>
                                </div>
                                <div class="hstack justify-content-between border border-dashed rounded-3 p-3 mb-3">
                                    <div class="hstack gap-3">
                                        <div class="avatar-image">
                                            <img src="assets/images/avatar/2.png" alt="" class="img-fluid">
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);">Archie Cantones</a>
                                            <div class="fs-11 text-muted">UI/UX Designer</div>
                                        </div>
                                    </div>
                                    <div class="team-progress-2" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="65"><svg version="1.1" width="100" height="100" viewBox="0 0 100 100" class="circle-progress"><circle class="circle-progress-circle" cx="50" cy="50" r="47" fill="none" stroke="#ddd" stroke-width="8"></circle><path d="M 50 3 A 47 47 0 1 1 11.976201264377472 77.62590685774624" class="circle-progress-value" fill="none" stroke="#00E699" stroke-width="8"></path><text class="circle-progress-text" x="50" y="50" font="16px Arial, sans-serif" text-anchor="middle" fill="#999" dy="0.4em">65%</text></svg></div>
                                </div>
                                <div class="hstack justify-content-between border border-dashed rounded-3 p-3 mb-3">
                                    <div class="hstack gap-3">
                                        <div class="avatar-image">
                                            <img src="assets/images/avatar/3.png" alt="" class="img-fluid">
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);">Malanie Hanvey</a>
                                            <div class="fs-11 text-muted">Backend Developer</div>
                                        </div>
                                    </div>
                                    <div class="team-progress-3" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="50"><svg version="1.1" width="100" height="100" viewBox="0 0 100 100" class="circle-progress"><circle class="circle-progress-circle" cx="50" cy="50" r="47" fill="none" stroke="#ddd" stroke-width="8"></circle><path d="M 50 3 A 47 47 0 0 1 50 97" class="circle-progress-value" fill="none" stroke="#00E699" stroke-width="8"></path><text class="circle-progress-text" x="50" y="50" font="16px Arial, sans-serif" text-anchor="middle" fill="#999" dy="0.4em">50%</text></svg></div>
                                </div>
                                <div class="hstack justify-content-between border border-dashed rounded-3 p-3 mb-2">
                                    <div class="hstack gap-3">
                                        <div class="avatar-image">
                                            <img src="assets/images/avatar/4.png" alt="" class="img-fluid">
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);">Kenneth Hune</a>
                                            <div class="fs-11 text-muted">Digital Marketer</div>
                                        </div>
                                    </div>
                                    <div class="team-progress-4" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="75"><svg version="1.1" width="100" height="100" viewBox="0 0 100 100" class="circle-progress"><circle class="circle-progress-circle" cx="50" cy="50" r="47" fill="none" stroke="#ddd" stroke-width="8"></circle><path d="M 50 3 A 47 47 0 1 1 3 50.00000000000001" class="circle-progress-value" fill="none" stroke="#00E699" stroke-width="8"></path><text class="circle-progress-text" x="50" y="50" font="16px Arial, sans-serif" text-anchor="middle" fill="#999" dy="0.4em">75%</text></svg></div>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="card-footer fs-11 fw-bold text-uppercase text-center">Update 30 Min Ago</a>
                        </div>
                    </div>
                    <!--! END: [Team Progress] !-->
                </div>
            </div>


@endsection
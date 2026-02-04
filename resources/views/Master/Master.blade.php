
@include('Master.Header')
    <!--! ================================================================ !-->
    <!--! [Start] Navigation Manu !-->
    <!--! ================================================================ !-->

    @php

    $tx = DB::table('transaction')
        ->where('status', false)
        ->orWhere('statusedit', true);
         $hour = now()->hour;


    use Carbon\Carbon;

    $now = now(); // Waktu sekarang sesuai timezone Laravel
    $hour = $now->hour;

    // Greeting
    if ($hour < 12) {
        $greeting = '🌅 Good Morning';
    } elseif ($hour < 18) {
        $greeting = '🌞 Good Afternoon';
    } else {
        $greeting = '🌙 Good Evening';
    }

    // Nama user & title
    $title = Auth::user()->gender === 'female' ? 'Mis.' : 'Mr.';
    $name = Auth::user()->name;

    // Format tanggal hari ini
    $date = $now->format('l, d-F-Y : h:i:s A'); 

   
                                                  
    @endphp

  
  
                 
    <nav class="nxl-navigation">
        <div class="navbar-wrapper">
            <div class="m-header">
               
                    <!-- ========   change your logo hear   ============ -->
                   <img src="{{ asset('oil.png') }}" class="text-center" alt="" height="60" width="60">
                   <p. class="pt-2">Oil Management</p.>
        
              
            </div>
            <div class="navbar-content">
                <ul class="nxl-navbar">
                    <li class="nxl-item nxl-caption">
                        <label>Navigation</label>
                    </li>
                    <li class="nxl-item nxl-hasmenu {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-airplay text-primary"></i></span>
                            <span class="nxl-mtext">Dashboards</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>

                        <ul class="nxl-submenu {{ request()->routeIs('dashboard.*') ? 'show' : '' }}">
                            <li class="nxl-item {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                                <a class="nxl-link" href="{{ route('dashboard.index') }}">
                                    <i class="bi bi-speedometer"></i> Daily
                                </a>
                            </li>

                            {{-- <li class="nxl-item  ? 'active' : '' }}">
                                <a class="nxl-link" href="">
                                    <i class="bi bi-calendar-week"></i> Weekly
                                </a>
                            </li> --}}
                        </ul>
                    </li>

                   


                                                    <li class="nxl-item nxl-hasmenu {{ request()->routeIs('transaction.*') ? 'active' : '' }}">
                                <a href="javascript:void(0);" class="nxl-link">
                                    <span class="nxl-micon"><i class="bi bi-fuel-pump-diesel-fill text-info"></i></span>
                                    <span class="nxl-mtext">Delivery Order</span>
                                    <span class="nxl-arrow">
                                        <i class="feather-chevron-right {{ request()->routeIs('transaction.*') ? 'rotate-90' : '' }}"></i>
                                    </span>
                                </a>

                                <ul class="nxl-submenu {{ request()->routeIs('transaction.*') ? 'show' : '' }}">
                                    {{-- Delivery Order --}}
                                    <li class="nxl-item {{ request()->routeIs('transaction.index') ? 'active' : '' }}">
                                        <a class="nxl-link" href="{{ route('transaction.index') }}">
                                            <i class="bi bi-truck-flatbed"></i> Delivery Order
                                        </a>
                                    </li>

                                    {{-- Approve DO (only for authorized roles) --}}
                                    @auth
                                        @if(in_array(Auth::user()->roles, ['manager', 'administrator']))
                                            <li class="nxl-item {{ request()->routeIs('transaction.approve') ? 'active' : '' }}">
                                                <a class="nxl-link position-relative" href="{{ route('transaction.approve') }}">
                                                    <i class="bi bi-bell"></i> Approve DO

                                                    @if(isset($tx) && $tx->count() > 0)
                                                        <sup class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger shadow-sm">
                                                            {{ $tx->count() }}
                                                        </sup>
                                                    @endif
                                                </a>
                                            </li>
                                        @endif
                                    @endauth
                                </ul>
                            </li>



                        {{-- <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-dollar-sign"></i></span>
                            <span class="nxl-mtext">Sales Order</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu" style="display: none;">
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('sale-orders.index') }}">Sales Order</a></li>
                            
                        </ul>
                    </li> --}}


                    <li class="nxl-item nxl-hasmenu {{ request()->routeIs('transactions.report') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="bi bi-journal-text text-success"></i></span>
                        <span class="nxl-mtext">Report</span>
                        <span class="nxl-arrow">
                            <i class="feather-chevron-right {{ request()->routeIs('transactions.report') ? 'rotate-90' : '' }}"></i>
                         
                        </span>
                    </a>

                    <ul class="nxl-submenu {{ request()->routeIs('transactions.report') ? 'show' : '' }}">
                        <li class="nxl-item {{ request()->routeIs('transactions.report') ? 'active' : '' }}">
                            <a class="nxl-link" href="{{ route('transactions.report') }}">
                                <i class="bi bi-journal"></i> Detail Report
                            </a>
                            
                        </li>

                          <li class="nxl-item {{ request()->routeIs('clientSummaryView.index') ? 'active' : '' }}">
                            <a class="nxl-link" href="{{ route('clientSummaryView.index') }}">
                                <i class="bi bi-journal-bookmark text-warning"></i>  Summary Client Report
                            </a>
                        </li>

                         <li class="nxl-item {{ request()->routeIs('summaryexel.index') ? 'active' : '' }}">
                            <a class="nxl-link" href="{{ route('summaryexel.index') }}">
                                <i class="bi bi-filetype-exe text-success"></i>  Summary Daily Exel
                            </a>
                        </li>
                    </ul>
                </li>


                    {{-- Drivers Menu --}}
<li class="nxl-item nxl-hasmenu {{ request()->routeIs('drivers.*') ? 'active' : '' }}">
    <a href="javascript:void(0);" class="nxl-link">
        <span class="nxl-micon"><i class="bi bi-truck text-warning"></i></span>
        <span class="nxl-mtext">Drivers</span>
        <span class="nxl-arrow">
            <i class="feather-chevron-right {{ request()->routeIs('drivers.*') ? 'rotate-90' : '' }}"></i>
        </span>
    </a>

    <ul class="nxl-submenu {{ request()->routeIs('drivers.*') ? 'show' : '' }}">
        <li class="nxl-item {{ request()->routeIs('drivers.index') ? 'active' : '' }}">
            <a class="nxl-link" href="{{ route('drivers.index') }}">
                <i class="bi bi-person-badge"></i> List Driver
            </a>
        </li>
    </ul>
</li>

                {{-- Clients Menu --}}
                <li class="nxl-item nxl-hasmenu {{ request()->routeIs('client.*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-users text-dark"></i></span>
                        <span class="nxl-mtext">Clients</span>
                        <span class="nxl-arrow">
                            <i class="feather-chevron-right {{ request()->routeIs('client.*') ? 'rotate-90' : '' }}"></i>
                        </span>
                    </a>

                    <ul class="nxl-submenu {{ request()->routeIs('client.*') ? 'show' : '' }}">
                        <li class="nxl-item {{ request()->routeIs('client.index') ? 'active' : '' }}">
                            <a class="nxl-link" href="{{ route('client.index') }}">
                                <i class="bi bi-file-earmark-person-fill"></i> List Client
                            </a>
                        </li>
                    </ul>
                </li>


                


                   @if(Auth::user()->roles=='administrator')
                    {{-- Products Menu --}}
            <li class="nxl-item nxl-hasmenu {{ request()->routeIs('product.*') ? 'active' : '' }}">
   

                        <ul class="nxl-submenu {{ request()->routeIs('product.*') ? 'show' : '' }}">
                            <li class="nxl-item {{ request()->routeIs('product.index') ? 'active' : '' }}">
                                <a class="nxl-link" href="{{ route('product.index') }}">
                                    <i class="bi bi-fuel-pump-fill text-success"></i> My Products
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Authentication Menu --}}
                    <li class="nxl-item nxl-hasmenu {{ request()->routeIs('users.*') || request()->routeIs('logs.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-power text-danger"></i></span>
                            <span class="nxl-mtext">Authentication</span>
                            <span class="nxl-arrow">
                                <i class="feather-chevron-right {{ request()->routeIs('users.*') || request()->routeIs('logs.*') ? 'rotate-90' : '' }}"></i>
                            </span>
                        </a>

                        <ul class="nxl-submenu {{ request()->routeIs('users.*') || request()->routeIs('logs.*') ? 'show' : '' }}">
                            <li class="nxl-item {{ request()->routeIs('users.list') ? 'active' : '' }}">
                                <a class="nxl-link" href="{{ route('users.list') }}">
                                    <i class="bi bi-person-fill-lock"></i> User
                                </a>
                            </li>
                            <li class="nxl-item {{ request()->routeIs('logs.index') ? 'active' : '' }}">
                                <a class="nxl-link" href="{{ route('logs.index') }}">
                                    <i class="bi bi-funnel-fill"></i> User Logs
                                </a>
                            </li>
                        </ul>
                    </li>


                   @else

                  
                        
                       
                   
            
                   
                   
                 
                    
                 @endif
                                    

                   
                    
                </ul>
                
            </div>
        </div>
    </nav>
    <!--! ================================================================ !-->
    <!--! [End]  Navigation Manu !-->
    <!--! ================================================================ !-->
    <!--! ================================================================ !-->
    <!--! [Start] Header !-->
    <!--! ================================================================ !-->
    <header class="nxl-header">
        <div class="header-wrapper">
            <!--! [Start] Header Left !-->
            <div class="header-left d-flex align-items-center gap-4">
                <!--! [Start] nxl-head-mobile-toggler !-->
                <a href="javascript:void(0);" class="nxl-head-mobile-toggler" id="mobile-collapse">
                    <div class="hamburger hamburger--arrowturn">
                        <div class="hamburger-box">
                            <div class="hamburger-inner"></div>
                        </div>
                    </div>
                </a>
                <!--! [Start] nxl-head-mobile-toggler !-->
                <!--! [Start] nxl-navigation-toggle !-->
                <div class="nxl-navigation-toggle">
                    <a href="javascript:void(0);" id="menu-mini-button">
                        <i class="feather-align-left"></i>
                    </a>
                    <a href="javascript:void(0);" id="menu-expend-button" style="display: none">
                        <i class="feather-arrow-right"></i>
                    </a>
                </div>
                <!--! [End] nxl-navigation-toggle !-->
                <!--! [Start] nxl-lavel-mega-menu-toggle !-->
                <div class="nxl-lavel-mega-menu-toggle d-flex d-lg-none">
                    <a href="javascript:void(0);" id="nxl-lavel-mega-menu-open">
                        <i class="feather-align-left"></i>
                    </a>
                </div>
                <!--! [End] nxl-lavel-mega-menu-toggle !-->
                <!--! [Start] nxl-lavel-mega-menu !-->
                <div class="nxl-drp-link nxl-lavel-mega-menu">
                    <div class="nxl-lavel-mega-menu-toggle d-flex d-lg-none">
                        <a href="javascript:void(0)" id="nxl-lavel-mega-menu-hide">
                            <i class="feather-arrow-left me-2"></i>
                            <span>Back</span>
                        </a>
                    </div>
                    <!--! [Start] nxl-lavel-mega-menu-wrapper !-->
                  
                    <!--! [End] nxl-lavel-mega-menu-wrapper !-->
                </div>
                <!--! [End] nxl-lavel-mega-menu !-->
            </div>
            <!--! [End] Header Left !-->
            <!--! [Start] Header Right !-->
            <div class="header-right ms-auto">
                <div class="d-flex align-items-center">
                    
                    
                    <div class="nxl-h-item d-none d-sm-flex">
                        <div class="full-screen-switcher">
                            <a href="javascript:void(0);" class="nxl-head-link me-0" onclick="$('body').fullScreenHelper('toggle');">
                                <i class="feather-maximize maximize"></i>
                                <i class="feather-minimize minimize"></i>
                            </a>
                        </div>
                    </div>
                    <div class="nxl-h-item dark-light-theme">
                        <a href="javascript:void(0);" class="nxl-head-link me-0 dark-button">
                            <i class="feather-moon"></i>
                        </a>
                        <a href="javascript:void(0);" class="nxl-head-link me-0 light-button" style="display: none">
                            <i class="feather-sun"></i>
                        </a>
                    </div>

                    @if(Auth::user()->roles==='administrator' || Auth::user()->roles==='manager')
                    <div class="dropdown nxl-h-item">
                        <a class="nxl-head-link me-3" data-bs-toggle="dropdown" href="#" role="button" data-bs-auto-close="outside">
                            <i class="feather-bell"></i>

                            @if($tx->count() > 0)
                              <span class="badge bg-danger nxl-h-badge">{{  $tx->count() }}</span>

                            @else

                            @endif
                          
                        </a>
                  
                       <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-notifications-menu">
                            <div class="d-flex justify-content-between align-items-center notifications-head">
                                <h6 class="fw-bold text-dark mb-0">Notifications</h6>
                                <a href="javascript:void(0);" class="fs-11 text-success text-end ms-auto" data-bs-toggle="tooltip" title="Make as Read">
                                    <i class="feather-check"></i>
                                    <span>Make as Read</span>
                                </a>
                            </div>

                        @php
                        $notifications = DB::table('transaction')
                        ->where('status', false)
                        ->orderBy('created_at', 'desc')
                        ->limit(3)
                        ->get();
                        @endphp
                         @foreach ($notifications as $n)
                            <div class="notifications-item">
                               
                                    
                            
                               
                                <div class="notifications-desc">
                                    <a href="{{ route('transaction.approve') }}" class="font-body text-truncate-2-line"> {{ "Do :".$n->do_number }}<span class="fw-semibold text-dark"></span> {{ 

                                    "Product: ".$n->product_type. "Company Name :".$n->client_name
                                        
                                        
                                        }}</a>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="notifications-date text-muted border-bottom border-bottom-dashed">
                                            {{ \Carbon\Carbon::parse($n->created_at)->diffForHumans() }}
                                        </div>
                                        <div class="d-flex align-items-center float-end gap-2">
                                            <a href="javascript:void(0);" class="d-block wd-8 ht-8 rounded-circle bg-gray-300" data-bs-toggle="tooltip" title="Make as Read"></a>
                                            <a href="javascript:void(0);" class="text-danger" data-bs-toggle="tooltip" title="Remove">
                                                <i class="feather-x fs-12"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                              
                            </div>
                              @endforeach
                            
                           
                            <div class="text-center notifications-footer">
                                <a href="{{ route('transaction.approve') }}" class="fs-13 fw-semibold text-dark">Alls Notifications</a>
                            </div>
                        </div>
                    </div>

                    @endif
                 
                    <div class="dropdown nxl-h-item">
                        <a href="javascript:void(0);" data-bs-toggle="dropdown" role="button" data-bs-auto-close="outside">
                          <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('users.png') }}" 
                         alt="Profile Photo" 
                         id="preview" 
                         class="rounded-circle shadow-sm" 
                         style="width:50px; height:50px; object-fit:cover; border:2px solid #ddd;">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-user-dropdown">
                            <div class="dropdown-header">
                                <div class="d-flex align-items-center">
                                   <img class="mr-2" src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('users.png') }}" 
                         alt="Profile Photo" 
                         id="preview" 
                         class="rounded-circle shadow-sm" 
                         style="width:55px; height:55px; object-fit:cover; border:2px solid #ddd;">
                        </a>
                                    <div>
                                        <h6 class="text-dark mb-0">{{ Auth::user()->name }}</h6>
                                        <span class="fs-12 fw-medium text-muted">{{  maskEmail(Auth::user()->email)  }}</span>
                                    </div>
                                </div>
                            </div>
                           
                           
                           
                          
                            <a href="{{ route('profile.image') }}" class="dropdown-item">
                                <i class="feather-user"></i>
                                <span>Change Profile</span>
                            </a>
                            <a href="{{ route('password.edit') }}" class="dropdown-item">
                                <i class="bi bi-key"></i>
                                <span>Change Password</span>
                            </a>
                           
                            {{-- <a href="javascript:void(0);" class="dropdown-item">
                                <i class="feather-bell"></i>
                                <span>Notifications</span>
                            </a>
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="feather-settings"></i>
                                <span>Account Settings</span>
                            </a> --}}
                            <div class="dropdown-divider"></div>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="feather-log-out"></i>
                                <span>Logout</span>
                            </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--! [End] Header Right !-->
        </div>
    </header>
    <!--! ================================================================ !-->
    <!--! [End] Header !-->
    <!--! ================================================================ !-->
    <!--! ================================================================ !-->
    <!--! [Start] Main Content !-->
    <!--! ================================================================ !-->

  

    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                       <h5 class="m-b-10">{{ Str::upper(request()->path()) }}</h5>
                    </div>
                    <ul class="breadcrumb">

                                            <li>
                            {{ $greeting }}, {{ $title }} {{ $name }}
                            <br>
                            <small>{{ $date }}</small>
                        </li>
                        <br>
                        
                       
                  
                       
                    </ul>
                </div>
                <div class="page-header-right ms-auto">
                    <div class="page-header-right-items">
                        <div class="d-flex d-md-none">
                            <a href="javascript:void(0)" class="page-header-right-close-toggle">
                                <i class="feather-arrow-left me-2"></i>
                                <span>Back</span>
                            </a>
                        </div>

                      



                       
                    </div>
                </div>
            </div>
            <!-- [ page-header ] end -->
            <!-- [ Main Content ] start -->
         
            <!-- [ Main Content ] end -->

            
                     @yield('content')
                
        </div>
        <!-- [ Footer ] start -->
        <footer class="footer">
            <p class="fs-11 text-muted fw-medium text-uppercase mb-0 copyright">
                <span>Copyright ©</span>
                <script>
                    document.write(new Date().getFullYear());
                </script>
            </p>
            <p><span>By: <a target="_blank" href="https://wrapbootstrap.com/user/theme_ocean" target="_blank">IT ETO Group</a></span> • <span>Distributed by: <a target="_blank" href="https://themewagon.com" target="_blank">ETO Moving Energy</a></span></p>
           
        </footer>
        <!-- [ Footer ] end -->
    </main>
    <!--! ================================================================ !-->
    <!--! [End] Main Content !-->
    <!--! ================================================================ !-->
    <!--! ================================================================ !-->
    <!--! BEGIN: Theme Customizer !-->
    <!--! ================================================================ !-->
   
   
@include('Master.Footer')
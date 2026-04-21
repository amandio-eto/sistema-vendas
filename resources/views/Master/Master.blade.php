@include('Master.Header')

@php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

// Unread inbox
$unreadInbox = Auth::check()
    ? DB::table('inboxes')->where('receiver_id', Auth::id())->where('is_read', 0)->count()
    : 0;

// Pending transactions
$tx = DB::table('transaction')->where('status', false)->orWhere('statusedit', true)->get();

// Latest notifications
$notifications = DB::table('transaction')
    ->where('status', false)
    ->orderBy('created_at', 'desc')
    ->limit(3)
    ->get();


 $hour = now()->hour;
    $greeting = $hour < 12 ? '🌅 Good Morning' : ($hour < 18 ? '🌞 Good Afternoon' : '🌙 Good Evening');

    $user = Auth::user();

    if ($user) {
        $title = $user->gender === 'female' ? 'Ms.' : 'Mr.';
        $name = $user->name;
    } else {
        $title = '';
        $name = 'Guest';
    }

    $date = now()->format('l, d-F-Y : h:i:s A');
@endphp

<!-- ========================= Sidebar ========================= -->
<nav class="nxl-navigation">
    <div class="navbar-wrapper">
        <div class="m-header">
            <img src="{{ asset('oil.png') }}" alt="Logo" height="60" width="60">
            <p class="pt-2">Oil Management</p>
        </div>

        <div class="navbar-content">
            <ul class="nxl-navbar">
                <!-- Dashboard -->
                <li class="nxl-item nxl-hasmenu {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-airplay text-primary"></i></span>
                        <span class="nxl-mtext">Dashboards</span>
                        <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu {{ request()->routeIs('dashboard.*') ? 'show' : '' }}">
                        <li class="nxl-item {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                            <a class="nxl-link" href="{{ route('dashboard.index') }}"><i class="bi bi-speedometer"></i> Daily</a>
                        </li>
                    </ul>
                </li>


               {{-- <li class="nxl-item nxl-hasmenu {{ request()->routeIs('rafa.*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon">
                           <i class="bi bi-broadcast-pin"></i>
                        </span>
                        <span class="nxl-mtext">Rafa Fm 103.5</span>
                        <span class="nxl-arrow">
                            <i class="feather-chevron-right"></i>
                        </span>
                    </a>

                    <ul class="nxl-submenu {{ request()->routeIs('rafa.*') ? 'show' : '' }}">
                        <li class="nxl-item {{ request()->routeIs('rafa.index') ? 'active' : '' }}">
                            <a class="nxl-link" href="{{ route('rafa.index') }}">
                              <i class="bi bi-boombox-fill"></i> Rafa FM 103.5
                            </a>
                        </li>
                    </ul>
        </li> --}}

                <!-- Delivery Order -->
                <li class="nxl-item nxl-hasmenu {{ request()->routeIs('transaction.*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="bi bi-fuel-pump-diesel-fill text-info"></i></span>
                        <span class="nxl-mtext">Delivery Order</span>
                        <span class="nxl-arrow">
                            <i class="feather-chevron-right {{ request()->routeIs('transaction.*') ? 'rotate-90' : '' }}"></i>
                        </span>
                    </a>
                    <ul class="nxl-submenu {{ request()->routeIs('transaction.*') ? 'show' : '' }}">
                        <li class="nxl-item {{ request()->routeIs('transaction.index') ? 'active' : '' }}">
                            <a class="nxl-link" href="{{ route('transaction.index') }}"><i class="bi bi-truck-flatbed"></i> Delivery Order</a>
                        </li>

                        @auth
                            @if(in_array(Auth::user()->roles, ['manager', 'administrator']))
                                <li class="nxl-item {{ request()->routeIs('transaction.approve') ? 'active' : '' }}">
                                    <a class="nxl-link position-relative" href="{{ route('transaction.approve') }}">
                                        <i class="bi bi-bell"></i> Approve DO
                                        @if($tx->count() > 0)
                                            <sup class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger shadow-sm">
                                                {{ $tx->count() }}
                                            </sup>
                                        @endif
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                     <li class="nxl-item {{ request()->routeIs('reinput.index') ? 'active' : '' }}">
                        <a class="nxl-link" href="{{ route('reinput.index') }}">
                            <i class="bi bi-arrow-repeat text-primary me-2"></i>
                            Re-Input Data
                        </a>
                 </li>
                </li>

                

                <!-- Report -->
                {{-- <li class="nxl-item nxl-hasmenu {{ request()->routeIs('transactions.report') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="bi bi-journal-text text-success"></i></span>
                        <span class="nxl-mtext">Report</span>
                        <span class="nxl-arrow"><i class="feather-chevron-right {{ request()->routeIs('transactions.report') ? 'rotate-90' : '' }}"></i></span>
                    </a>
                    <ul class="nxl-submenu {{ request()->routeIs('transactions.report') ? 'show' : '' }}">
                        <li class="nxl-item {{ request()->routeIs('transactions.report') ? 'active' : '' }}">
                            <a class="nxl-link" href="{{ route('transactions.report') }}"><i class="bi bi-journal"></i> Detail Report</a>
                        </li>
                        <li class="nxl-item {{ request()->routeIs('clientSummaryView.index') ? 'active' : '' }}">
                            <a class="nxl-link" href="{{ route('clientSummaryView.index') }}"><i class="bi bi-journal-bookmark text-warning"></i> Summary Client Report</a>
                        </li>
                        <li class="nxl-item {{ request()->routeIs('summaryexel.index') ? 'active' : '' }}">
                            <a class="nxl-link" href="{{ route('summaryexel.index') }}"><i class="bi bi-filetype-exe text-success"></i> Summary Daily Excel</a>
                        </li>
                    </ul>
                </li> --}}



                <li class="nxl-item nxl-hasmenu 
{{ request()->routeIs('transactions.report') 
   || request()->routeIs('clientSummaryView.index') 
   || request()->routeIs('summaryexel.index') 
   || request()->routeIs('totalsummary.index') ? 'active' : '' }}">

    <a href="javascript:void(0);" class="nxl-link">
        <span class="nxl-micon">
            <i class="bi bi-journal-text text-success"></i>
        </span>
        <span class="nxl-mtext">Report</span>
        <span class="nxl-arrow">
            <i class="feather-chevron-right 
            {{ request()->routeIs('transactions.report') 
               || request()->routeIs('clientSummaryView.index') 
               || request()->routeIs('summaryexel.index') 
               || request()->routeIs('totalsummary.index') ? 'rotate-90' : '' }}">
            </i>
        </span>
    </a>

                <ul class="nxl-submenu 
                {{ request()->routeIs('transactions.report') 
                || request()->routeIs('clientSummaryView.index') 
                || request()->routeIs('summaryexel.index') 
                || request()->routeIs('totalsummary.index') ? 'show' : '' }}">

                    <li class="nxl-item {{ request()->routeIs('transactions.report') ? 'active' : '' }}">
                        <a class="nxl-link" href="{{ route('transactions.report') }}">
                            <i class="bi bi-journal"></i> Detail Report
                        </a>
                    </li>

                    <li class="nxl-item {{ request()->routeIs('clientSummaryView.index') ? 'active' : '' }}">
                        <a class="nxl-link" href="{{ route('clientSummaryView.index') }}">
                            <i class="bi bi-journal-bookmark text-warning"></i> Summary Client Report
                        </a>
                    </li>

                    <li class="nxl-item {{ request()->routeIs('summaryexel.index') ? 'active' : '' }}">
                        <a class="nxl-link" href="{{ route('summaryexel.index') }}">
                            <i class="bi bi-filetype-exe text-success"></i> Summary Daily Excel
                        </a>
                    </li>

                    {{-- 🔥 TOTAL SUMMARY --}}
                    <li class="nxl-item {{ request()->routeIs('totalsummary.index') ? 'active' : '' }}">
                        <a class="nxl-link" href="{{ route('totalsummary.index') }}">
                            <i class="bi bi-bar-chart-line text-danger"></i> Total Summary Report
                        </a>
                    </li>

                   

                </ul>
            </li>



                <li class="nxl-item nxl-hasmenu {{ request()->routeIs('drivers.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="bi bi-person-badge text-primary"></i></span>
                            <span class="nxl-mtext">Drivers</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right {{ request()->routeIs('drivers.*') ? 'rotate-90' : '' }}"></i></span>
                        </a>

                        <ul class="nxl-submenu {{ request()->routeIs('drivers.*') ? 'show' : '' }}">
                            <li class="nxl-item {{ request()->routeIs('drivers.index') ? 'active' : '' }}">
                                <a class="nxl-link" href="{{ route('drivers.index') }}">
                                    <i class="bi bi-list-ul"></i> Data Drivers
                                </a>
                            </li>
                            
                          
                        </ul>
                    </li>



                   

                <!-- LO Controls -->
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="bi bi-journal-bookmark-fill text-info"></i></span>
                        <span class="nxl-mtext">Lo Controls</span>
                        <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu {{ request()->routeIs('lo.index') ? 'active' : '' }}">
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('lo.index') }}"><i class="bi bi-journal-check text-warning"></i> Controls LO</a></li>
                    </ul>
                </li>

                <!-- Inbox -->
                <li class="nxl-item nxl-hasmenu {{ request()->routeIs('inbox.*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="bi bi-inbox-fill text-primary"></i></span>
                        <span class="nxl-mtext">Inbox
                            @if($unreadInbox > 0)
                                <span class="badge bg-danger">{{ $unreadInbox }}</span>
                            @endif
                        </span>
                        <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu {{ request()->routeIs('inbox.*') ? 'show' : '' }}">
                        <li class="nxl-item"><a class="nxl-link {{ request()->routeIs('inbox.index') ? 'active' : '' }}" href="{{ route('inbox.index') }}"><i class="bi bi-inbox"></i> Inbox</a></li>
                        <li class="nxl-item"><a class="nxl-link {{ request()->routeIs('inbox.create') ? 'active' : '' }}" href="{{ route('inbox.create') }}"><i class="bi bi-send"></i> New Message</a></li>
                    </ul>
                </li>

                <!-- Clients -->
                <li class="nxl-item nxl-hasmenu {{ request()->routeIs('client.*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-users text-dark"></i></span>
                        <span class="nxl-mtext">Clients</span>
                        <span class="nxl-arrow"><i class="feather-chevron-right {{ request()->routeIs('client.*') ? 'rotate-90' : '' }}"></i></span>
                    </a>
                    <ul class="nxl-submenu {{ request()->routeIs('client.*') ? 'show' : '' }}">
                        <li class="nxl-item {{ request()->routeIs('client.index') ? 'active' : '' }}">
                            <a class="nxl-link" href="{{ route('client.index') }}"><i class="bi bi-file-earmark-person-fill"></i> List Client</a>
                        </li>
                    </ul>
                </li>

      
@auth
    @if(in_array(auth()->user()->roles, ['administrator', 'manager']))

            <li class="nxl-item nxl-hasmenu {{ request()->routeIs('tank.*') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="nxl-link">
                <span class="nxl-micon">
                    <i class="bi bi-droplet-fill text-info"></i>
                </span>
                <span class="nxl-mtext">
                    Tank Management
                </span>
                <span class="nxl-arrow">
                    <i class="feather-chevron-right"></i>
                </span>
            </a>

            <ul class="nxl-submenu {{ request()->routeIs('tank.*') ? 'show' : '' }}">
                <li class="nxl-item">
                    <a class="nxl-link {{ request()->routeIs('tank.index') ? 'active' : '' }}"
                    href="{{ route('tank.index') }}">
                        <i class="bi bi-list-ul text-primary"></i> Tank List
                    </a>
                </li>

                <li class="nxl-item">
                    <a class="nxl-link {{ request()->routeIs('tank.create') ? 'active' : '' }}"
                    href="{{ route('tank.create') }}">
                        <i class="bi bi-plus-circle text-info"></i> Add Tank
                    </a>
                </li>
                 <li class="nxl-item">
            <a class="nxl-link {{ request()->routeIs('tank.stock.history') ? 'active' : '' }}"
               href="{{ route('tank.stock.history') }}">
                <i class="bi bi-clock-history text-success"></i> Stock History
            </a>
        </li>
            @endif
        @endauth

                

       
    </ul>
</li>



                <!-- Products + Auth (Admin only) -->
                @auth
                @if(auth()->user()->roles === 'administrator')
                <li class="nxl-item nxl-hasmenu {{ request()->routeIs('product.*') ? 'active' : '' }}">
                    <ul class="nxl-submenu {{ request()->routeIs('product.*') ? 'show' : '' }}">
                        <li class="nxl-item {{ request()->routeIs('product.index') ? 'active' : '' }}">
                            <a class="nxl-link" href="{{ route('product.index') }}"><i class="bi bi-fuel-pump-fill text-success"></i> My Products</a>
                        </li>
                    </ul>
                </li>

                <li class="nxl-item nxl-hasmenu {{ request()->routeIs('users.*') || request()->routeIs('logs.*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="nxl-link"><span class="nxl-micon"><i class="feather-power text-danger"></i></span><span class="nxl-mtext">Authentication</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span></a>
                    <ul class="nxl-submenu {{ request()->routeIs('users.*') || request()->routeIs('logs.*') ? 'show' : '' }}">
                        <li class="nxl-item {{ request()->routeIs('users.list') ? 'active' : '' }}"><a class="nxl-link" href="{{ route('users.list') }}"><i class="bi bi-person-fill-lock"></i> User</a></li>
                        <li class="nxl-item {{ request()->routeIs('logs.index') ? 'active' : '' }}"><a class="nxl-link" href="{{ route('logs.index') }}"><i class="bi bi-funnel-fill"></i> User Logs</a></li>
                    </ul>
                </li>
                @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- ========================= Header ========================= -->
<header class="nxl-header">
    
    <div class="header-wrapper d-flex align-items-center justify-content-between">
        <div class="header-left d-flex align-items-center gap-3">
            
            <a href="javascript:void(0);" class="nxl-head-mobile-toggler" id="mobile-collapse">
                <div class="hamburger hamburger--arrowturn"><div class="hamburger-box"><div class="hamburger-inner"></div></div></div>
            </a>

            <div class="dropdown nxl-h-item">
</div>
            

            <div class="nxl-navigation-toggle d-flex align-items-center gap-2">
                <a href="javascript:void(0);" id="menu-mini-button"><i class="feather-align-left"></i></a>
                <a href="javascript:void(0);" id="menu-expend-button" style="display:none;"><i class="feather-arrow-right"></i></a>
            </div>
            <div class="row" style="color: black;">

              
           
        </div>

        

            
        </div>

      

<!-- Audio Player (hidden) -->

        

        <div class="header-right d-flex align-items-center gap-3">
            <!-- Dark/Light Mode -->
            <a href="javascript:void(0);" class="nxl-head-link dark-button"><i class="feather-moon"></i></a>
            <a href="javascript:void(0);" class="nxl-head-link light-button" style="display:none;"><i class="feather-sun"></i></a>

            <!-- Notifications -->
          @auth
             @if(in_array(auth()->user()->roles, ['administrator', 'manager']))
            <div class="dropdown nxl-h-item">
                <a class="nxl-head-link" data-bs-toggle="dropdown" href="javascript:void(0);">
                    <i class="feather-bell"></i>
                    @if($tx->count() > 0)
                        <span class="badge bg-danger">{{ $tx->count() }}</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-notifications-menu">
                    <div class="container">

                 
                    <h6 class="fw-bold text-dark mb-2">Notifications</h6>
                    @foreach($notifications as $n)
                        <div class="notifications-item">
                            <div class="notifications-desc">
                                <a href="{{ route('transaction.approve') }}" class="text-truncate">
                                    DO: {{ $n->do_number }}  <br>| Product: {{ $n->product_type }} <br>| Company: {{ $n->client_name }}
                                </a>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($n->created_at)->diffForHumans() }}</small>
                            </div>
                        </div>
                    @endforeach
                    <div class="text-center mt-2"><a href="{{ route('transaction.approve') }}">All Notifications</a></div>
                </div>
                   </div>
            </div>
            @endif
        @endauth

            <!-- Profile -->
            <div class="dropdown nxl-h-item">
                <a href="javascript:void(0);" data-bs-toggle="dropdown">
                    @auth
            
                    <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('users.png') }}" class="rounded-circle" style="width:50px;height:50px;object-fit:cover;border:2px solid #ddd;">
                    @endauth
                </a>
                <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-user-dropdown">
                    <div class="dropdown-header">
                        @auth
                            
                       
                        <h6>{{ Auth::user()->name }}</h6>
                        <small>{{ maskEmail(Auth::user()->email) }}</small>
                         @endauth
                    </div>
                    <a href="{{ route('profile.image') }}" class="dropdown-item"><i class="feather-user"></i> Change Profile</a>
                    <a href="{{ route('password.edit') }}" class="dropdown-item"><i class="bi bi-key"></i> Change Password</a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item"><i class="feather-log-out"></i> Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- ========================= Main Content ========================= -->
<main class="nxl-container">
    
    <div class="nxl-content">
        
        <div class="page-header">
            
            <div class="page-header-left">
                <h5>{{ Str::upper(request()->path()) }}
            </div>
             <p style='font-size:12px;'>{{ $greeting }}, {{ $title }} {{ $name }} <br><small>{{ $date }}</small></p>
        </div>
        @yield('content')
    </div>

    <footer class="footer text-center mt-4">
        <p class="fs-11 text-muted mb-0">Copyright © <script>document.write(new Date().getFullYear());</script></p>
        <p>By: <a href="https://wrapbootstrap.com/user/theme_ocean" target="_blank">IT ETO Group</a> • Distributed by: <a href="https://themewagon.com" target="_blank">ETO Moving Energy</a></p>
    </footer>
</main>

@include('Master.Footer')

<!-- ========================= JS ========================= -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sidebar collapse
    document.getElementById('mobile-collapse').addEventListener('click', function() {
        document.body.classList.toggle('sidebar-collapsed');
    });

    // Mini/Expand
    document.getElementById('menu-mini-button').addEventListener('click', function() {
        document.body.classList.add('sidebar-mini');
        this.style.display = 'none';
        document.getElementById('menu-expend-button').style.display = 'inline-block';
    });
    document.getElementById('menu-expend-button').addEventListener('click', function() {
        document.body.classList.remove('sidebar-mini');
        this.style.display = 'none';
        document.getElementById('menu-mini-button').style.display = 'inline-block';
    });

    // Dark/Light Mode
    document.querySelector('.dark-button').addEventListener('click', function() {
        document.body.classList.add('dark-mode');
        this.style.display = 'none';
        document.querySelector('.light-button').style.display = 'inline-block';
    });
    document.querySelector('.light-button').addEventListener('click', function() {
        document.body.classList.remove('dark-mode');
        this.style.display = 'none';
        document.querySelector('.dark-button').style.display = 'inline-block';
    });

    // Submenu toggle
    document.querySelectorAll('.nxl-hasmenu > a').forEach(function(item) {
        item.addEventListener('click', function() {
            const submenu = this.nextElementSibling;
            if(submenu) submenu.classList.toggle('show');
        });
    });
});



</script>



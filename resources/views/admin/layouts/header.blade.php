<!-- begin app-header -->
<header class="app-header top-bar">
    <!-- begin navbar -->
    <nav class="navbar navbar-expand-md">

        <!-- begin navbar-header -->
        <div class="navbar-header d-flex align-items-center">
            <a href="javascript:void:(0)" class="mobile-toggle"><i class="ti ti-align-right"></i></a>
            <a class="navbar-brand" href="{{ route('home-admin-index',['locale' => app()->getlocale()]) }}">
                <img src="/admin-assets/img/logo.png" class="img-fluid logo-desktop" alt="Shop" />
                <img src="/admin-assets/img/favicon.ico" class="img-fluid rounded-circle logo-mobile" alt="Shop" />
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="ti ti-align-left"></i>
        </button>
        <!-- end navbar-header -->
        <!-- begin navigation -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="navigation d-flex">
                <ul class="navbar-nav nav-right ml-auto">
                    @if(Auth::user()->role == 'admin')

                    @if(isset($unreaded_orders) && count($unreaded_orders) > 0)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti ti-bell"></i>
                                @if(isset($unreaded_orders) && count($unreaded_orders) > 0)
                                    <span class="notify"><span class="blink"></span><span class="dot"></span></span>
                                @endif
                            </a>
                            <div class="dropdown-menu extended animated fadeIn" aria-labelledby="navbarDropdown">
                                <ul>
                                    <li class="dropdown-header bg-gradient p-4 text-white text-left">Bookings
                                        <label class="label label-info label-round">{{ count($unreaded_orders) }}</label>
                                    </li>
                                    <li class="dropdown-body">
                                        <ul class="scrollbar scroll_dark max-h-240">
                                            @if(isset($unreaded_orders) && count($unreaded_orders) > 0)
                                                @foreach($unreaded_orders as $unreaded_order)
                                                <li>
                                                    <a href="javascript:void(0)">
                                                        <div class="notification d-flex flex-row align-items-center">
                                                            <div class="notify-message">
                                                                <p class="font-weight-bold">{{ $unreaded_order['name'] }}</p>
                                                                <small>{{ mb_substr($unreaded_order['message'],0,30) }}..</small>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </li>
                                    <li class="dropdown-footer">
                                        <a class="font-13" href="{{ route('orders-admin-index',['locale' => app()->getLocale()]) }}"> View All Orders </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link search" href="javascript:void(0)">
                            <i class="ti ti-search"></i>
                        </a>
                        <div class="search-wrapper">
                            <div class="close-btn">
                                <i class="ti ti-close"></i>
                            </div>
                            <div class="search-content">
                                <form id="search-form" action="" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <i class="ti ti-search magnifier"></i>
                                        <input type="text" class="form-control autocomplete" placeholder="Search Here" name="search" required max="255" min="1" form="search-form" id="autocomplete-ajax" autofocus="autofocus">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>
                    @endif
{{--                        @dd('skskss')--}}
                    <li class="nav-item dropdown user-profile">
                        <a href="javascript:void(0)" class="nav-link dropdown-toggle " id="navbarDropdown4" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="/admin-assets/img/admin/default.png" alt="{{ Auth::user()->first_name }}">
                            <span class="bg-success user-status"></span>
                        </a>
                        <div class="dropdown-menu animated fadeIn" aria-labelledby="navbarDropdown">
                            <div class="bg-gradient px-4 py-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="mr-1">
                                        <h4 class="text-white mb-0">{{ Auth::user()->first_name }}</h4>
                                        <small class="text-white">{{ Auth::user()->email }}</small>
                                    </div>

                                    <form action="{{ route('admin-log-out',['locale' => app()->getLocale()]) }}" method="get">
                                        @csrf
                                        <button type="submit" class="btn text-white font-20 tooltip-wrapper" data-toggle="tooltip" data-placement="top" title="Logout" data-original-title="Logout">
                                            <i class="zmdi zmdi-power"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="p-4">
                                <a class="dropdown-item d-flex nav-link" href="{{ route('profile-admin-index',['locale' => app()->getLocale()]) }}">
                                    <i class="fa fa-user pr-2 text-success"></i> Profile</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- end navigation -->
    </nav>
    <!-- end navbar -->
</header>
<!-- end app-header -->

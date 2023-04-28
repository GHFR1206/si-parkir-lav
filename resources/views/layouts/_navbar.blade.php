<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ !request()->routeIs('home') ? 'active' : '' }}"
                href="{{ route('parkir.index') }}">Parkir</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        @if (request()->routeIs('parkir.index', 'parkir.data-keluar'))
            <!-- Navbar Search -->
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline" method="get"
                        action="@if (request()->routeIs('parkir.index')) {{ route('parkir.index') }} @else {{ route('parkir.data-keluar') }} @endif">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" name="search"
                                placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
        @endif

        @if (Auth::user()->role->role == 'Admin')
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('register') }}" class="nav-link"><i class="nav-icon fas fa-user-plus"></i></a>
            </li>
        @endif
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();"
                class="nav-link"><i class="nav-icon fas fa-right-from-bracket"></i></a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </ul>
</nav>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        @if (Auth::user()->role == 0)
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('register') }}" class="nav-link"><i class="nav-icon fas fa-user-plus"></i></a>
            </li>
        @endif
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#"
                onclick="event.preventDefault(); 
        document.getElementById('logout-form').submit();"
                class="nav-link"><i class="nav-icon fas fa-right-from-bracket"></i></a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </ul>
</nav>
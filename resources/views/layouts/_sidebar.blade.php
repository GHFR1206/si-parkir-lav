<div>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('parkir.index') }}" class="brand-link">
            <img src="{{ asset('img/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">GHFRParkNet.Id</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('img/profile.png') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="{{ route('profile') }}" class="d-block">{{ Auth::user()->username }}
                        @if (Auth::user()->role == '0')
                            <small class="text-muted">(admin)</small>
                        @endif
                        @if (Auth::user()->role == '1')
                            <small class="text-muted">(petugas)</small>
                        @endif
                    </a>
                </div>
            </div>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{ route('parkir.index') }}"
                            class="nav-link {{ request()->routeIs('parkir.index', 'parkir.data-keluar') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-parking    "></i>
                            <p>
                                Data Kendaraan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('parkir.create') }}"
                            class="nav-link {{ request()->routeIs('parkir.create') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-solid fa-plus"></i>
                            <p>
                                Masuk / Keluar
                            </p>
                        </a>
                    </li>
                    @if (Auth::user()->role == 0)
                        <li class="nav-item">
                            <a href="{{ route('akun.index') }}"
                                class="nav-link {{ request()->routeIs('akun.index') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-user" aria-hidden="true"></i>
                                <p>
                                    Akun
                                </p>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ route('report.getLaporan') }}"
                            class="nav-link {{ request()->routeIs('report.getLaporan') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-file" aria-hidden="true"></i>
                            <p>
                                Laporan
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</div>

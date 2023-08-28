<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GHFRParkNet.Id</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('logo.ico') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    @include('includes._styles')
</head>

<body class="hold-transition sidebar-collapse layout-top-nav">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('img/logo.png') }}" alt="AdminLTELogo" height="100"
                width="100">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="{{ route('home') }}" class="navbar-brand">
                    <img src="{{ asset('img/logo.png') }}" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">GHFRParkNet.Id</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                    class="fas fa-bars"></i></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('home') }}"
                                class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                                href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('parkir.index') }}" class="nav-link">Parkir</a>
                        </li>
                    </ul>
                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="brand-link">
                <img src="{{ asset('img/logo.png') }}" alt="GHFRParkNet.Id Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">GHFRParkNet.Id</span>
            </a>

            <!-- Sidebar -->
            @include('layouts._sidebar')
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">

                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content mt-5">
                <div class="container">
                    <div class="row d-flex">
                        <div class="col-6">
                            <h4 class="mb-5 pr-5"><b>Kelola Tempat Parkir Anda Dalam Satu Sentuhan !</b></h4>
                            <p class="mb-1">Selamat datang, {{ Auth::user()->role->role }}
                                <b>{{ Auth::user()->username }}</b>, di
                                Sistem Informasi Parkir, <b>GHFRParkNet.Id</b>
                            </p>
                            <p>Silahkan mulai kelola data parkir anda</p>
                            <a href="{{ route('parkir.index') }}"
                                class="btn btn-outline-primary rounded-pill px-5">Disini</a>
                        </div>
                        <div class="col-6">
                            <img src="{{ asset('img/parkingimage.png') }}" style="padding-left: 100px;" alt=""
                                srcset="">
                        </div>
                    </div>
                    {{-- /.row --}}

                    {{-- row --}}
                    <div class="row mt-5 mb-5">
                        <div class="col-lg-12">
                            <h4><b>Berikut Statistik per - Bulan</b></h4>
                            {!! $chart->container() !!}
                        </div>
                    </div>
                    <!-- /.row -->

                    <div class="row mt-5 mb-3">
                        <img src="{{ asset('img/logo.png') }}" width="110px" alt="">
                        <div class="col-sm-4 d-flex align-middle ml-3">
                            <p><b>GHFRParkNet.Id</b>, aplikasi ini dibuat oleh seorang siswa SMKN 1 Ciomas atas dasar
                                projek
                                tugas sekaligus projek uji level. Siswa tersebut bernama <a
                                    href="https://ghfr1206.github.io" target="_blank" class="text-primary">Ghifari
                                    Hamdanigiar</a>.
                            </p>
                        </div>
                        <div class="col-sm-6 d-flex justify-content-end">
                            <div class="button-group">
                                <a href="https://ghfr1206.github.io" target="_blank"
                                    class="btn btn-app bg-indigo rounded"><i class="fas fa-globe"></i>Website</a>
                                <a href="https://mailto:aghifari1206@gmail.com" target="_blank"
                                    class="btn btn-app bg-blue rounded"><i class="fas fa-envelope"></i>Email</a>
                                <a href="https://www.instagram.com/ghifari_hamdanigiar/" target="_blank"
                                    class="btn btn-app bg-indigo rounded"><i class="fab fa-instagram"></i>Instagram</a>
                                <a href="https://id.pinterest.com/Ghfr1206/" target="_blank"
                                    class="btn btn-app bg-red rounded"><i class="fab fa-pinterest"></i>Pinterest</a>
                                <a href="https://github.com/GHFR1206" target="_blank"
                                    class="btn btn-app bg-gray rounded"><i class="fab fa-github"></i>GitHub</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            @include('includes._footer')
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}

    @include('includes._scripts')
</body>

</html>

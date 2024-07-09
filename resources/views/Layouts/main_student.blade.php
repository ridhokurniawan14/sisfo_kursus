<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png"
        href="{{ isset($profile->logo) && $profile->logo ? '/storage/' . $profile->logo : '/img/unknown.png' }}">

    <title> {{ $halaman }} - SIS</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/css/adminlte.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-JwJnpBLf7o3soPQrB16T0w6rnj4N94D0qP5KXCTu7lNQHKuBKJtDYqE0QD4U9+9EnBMrfVvA8tY0lRQOhmTDnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-qgLJwA0zOJ0wW3hIOULYhKiVSHVex8zLYRYb6wMgQI1jQ2zax7+RGv5Pw0Wkzovv4G3edTffit1x6y4c1aYQPA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="#" class="navbar-brand">
                    <img src="{{ isset($profile->logo) && $profile->logo ? '/storage/' . $profile->logo : '/img/unknown.png' }}"
                        alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">Sistem Informasi Siswa</span>
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
                            <a href="{{ route('dashboard.index') }}"
                                class="nav-link {{ Request::is('siswa/dashboard*') ? 'active' : '' }}">Dashboard</a>
                        </li>
                        <li
                            class="nav-item dropdown {{ Request::is('siswa/kuesioner*', 'siswa/nilai*') ? 'active' : '' }}">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" class="nav-link dropdown-toggle">Akademik</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li><a href="{{ route('nilai.index') }}"
                                        class="dropdown-item {{ Request::is('siswa/nilai*') ? 'active' : '' }}">Nilai
                                    </a></li>
                                <li><a href="{{ route('kuesioner.index') }}"
                                        class="dropdown-item {{ Request::is('siswa/kuesioner*') ? 'active' : '' }}">Kuesioner</a>
                                </li>
                                <!-- End Level two -->
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('jam.index') }}"
                                class="nav-link {{ Request::is('siswa/jam*') ? 'active' : '' }}">Jam Kursus</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('contact.index') }}"
                                class="nav-link {{ Request::is('siswa/contact*') ? 'active' : '' }}">Contact</a>
                        </li>
                    </ul>
                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item dropdown">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" class="nav-link dropdown-toggle">Selamat Datang,
                            {{ ucwords(auth()->user()->nm_lengkap) }}</a>
                        <ul aria-labelledby="dropdownSubMenu1"
                            class="dropdown-menu dropdown-menu-right border-0 shadow">
                            <li><a href="{{ route('ganti-password.index') }}" class="dropdown-item"><i
                                        class="nav-icon fas fa-user"></i>
                                    Profile </a></li>
                            <li><a href="{{ route('ganti-password.index') }}" class="dropdown-item"><i
                                        class="nav-icon fas fa-key"></i>
                                    Ganti Password </a></li>
                            <li class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout.siswa') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i
                                            class="nav-icon fas fa-sign-out-alt"></i>
                                        Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">{{ $halaman }}</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">{{ $title }}</a></li>
                                <li class="breadcrumb-item active">{{ $tab_title }}</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div>
            <!-- /.content-header -->
            <!-- isi konten -->
            @yield('container')
            <!-- penutup konten -->
        </div>

        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2017-<?= date('Y') ?> <a target="_blank"
                    href="https://www.instagram.com/ridhoo_kurniawaan/">Ridho Kurniawan</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 2.5
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Toastr -->
    <script src="/plugins/toastr/toastr.min.js"></script>
    @if (Session::has('message'))
        <script>
            toastr.options = {
                "progressBar": true,
                "closeButton": true
            }
            toastr.success('{{ Session::get('message') }}', 'Success!', {
                timeOut: 5000
            });
        </script>
    @endif
    @if ($messages = Session::get('info'))
        <script>
            toastr.options = {
                "progressBar": true,
                "closeButton": true
            }
            toastr.info('{{ $messages }}', 'Information', {
                timeOut: 5000
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            toastr.options = {
                "progressBar": true,
                "closeButton": true
            }
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}', 'Failed!', {
                    timeOut: 5000
                });
            @endforeach
        </script>
    @endif
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="icon" type="image/png" href="/img/Logo-PTCC.png">
  <title> {{ $halaman }}  - SIM</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="/plugins/toastr/toastr.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/pendaftaran/create" class="nav-link">Pendaftaran</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/pendaftaran/" class="nav-link">Data Peserta</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      {{-- @auth --}}
        <li class="nav-item dropdown">
          <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Selamat Datang, {{ ucwords(auth()->user()->nm_lengkap) }}</a>
          <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu dropdown-menu-right border-0 shadow">
            <li><a href="/ganti-password" class="dropdown-item"><i class="nav-icon fas fa-key"></i> Ganti Password </a></li>
            <li class="dropdown-divider"></li>
              <li>
                <form action="/logout" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item"><i class="nav-icon fas fa-sign-out-alt"></i> Logout</button>
                </form>
              </li>
          </ul>
        </li>
      {{-- @else
        <li class="nav-item d-none d-sm-inline-block">
          <a href="/login" class="nav-link">Login</a>
        </li>      
      @endauth --}}
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="/img/Logo-PTCC.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light" style="font-size: 11.5pt;">Sistem Informasi Manajemen</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if (auth()->user()->foto)
            <img src="{{ asset('storage/' . auth()->user()->foto) }}" class="img-circle elevation-2" alt="User Image">
          @else
            <img src="/img/user.png" class="img-circle elevation-2" alt="User Image">
          @endif
        </div>
        <div class="info">
          {{-- <a href="#" class="d-block">{{ ucwords(auth()->user()->name) }}</a> --}}
          <a href="#" class="d-block">Ridho Kurniawan</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      {{-- @auth --}}
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-header">GENERAL NAVIGATION</li>
            <li class="nav-item">
                <a href="/dashboard" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('jam*','program-pilihan*','program-paket*','user-category*','user/create', 'sarana-prasarana/create', 'pengumuman*') ? 'menu-open' : ''  }}">
                <a href="#" class="nav-link {{ Request::is('jam*','program-pilihan*','program-paket*','user-category*','user/create', 'sarana-prasarana/create', 'pengumuman*') ? 'active' : ''  }}">
                    <i class="nav-icon fas fa-database"></i>
                    <p>Data Master <i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="/jam" class="nav-link {{ Request::is('jam*') ? 'active' : ''  }}">
                            <i class="far fa-clock nav-icon"></i>
                            <p>Jam</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/program-pilihan" class="nav-link {{ Request::is('program-pilihan*') ? 'active' : ''  }}">
                            <i class="fa fa-tag nav-icon"></i>
                            <p>Program Pilihan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/program-paket" class="nav-link {{ Request::is('program-paket*') ? 'active' : ''  }}">
                            <i class="fa fa-tags nav-icon"></i>
                            <p>Program Paket</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/user-category" class="nav-link {{ Request::is('user-category*') ? 'active' : ''  }}">
                            <i class="fa fa-key nav-icon"></i>
                            <p>Hak Akses</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/user/create" class="nav-link {{ Request::is('user/create') ? 'active' : ''  }}">
                            <i class="far fa-user nav-icon"></i>
                            <p>Personalia</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/sarana-prasarana/create" class="nav-link {{ Request::is('sarana-prasarana/create') ? 'active' : ''  }}">
                            <i class="far fa-building nav-icon"></i>
                            <p>Sarana dan Prasarana</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/pengumuman" class="nav-link {{ Request::is('pengumuman*') ? 'active' : ''  }}">
                            <i class="nav-icon fas fa-bullhorn"></i>
                            <p>Pengumuman</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="/pendaftaran" class="nav-link">
                    <i class="nav-icon fas fa-user-plus"></i>
                    <p>Pendaftaran</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/kalender-pendidikan" class="nav-link">
                    <i class="nav-icon far fa-calendar-alt"></i>
                    <p>Kalender Pendidikan</p>
                </a>
            </li>
            <li class="nav-header">REPORT</li>
            <li class="nav-item {{ Request::is('user', 'user/*', 'user/*/edit', 'user/*/', 'sarana-prasarana', 'sarana-prasarana/*', 'sarana-prasarana/*/edit', 'sarana-prasarana/*/') && !Request::is('sarana-prasarana/create') && !Request::is('user/create') ? 'menu-open' : ''  }}">
                <a href="#" class="nav-link {{ Request::is('user', 'user/*', 'user/*/edit', 'user/*/', 'sarana-prasarana', 'sarana-prasarana/*', 'sarana-prasarana/*/edit', 'sarana-prasarana/*/') && !Request::is('sarana-prasarana/create') && !Request::is('user/create') ? 'active' : ''  }}">
                    <i class="nav-icon fas fa-landmark"></i>
                    <p>Data Lembaga <i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="/user" class="nav-link {{ Request::is('user', 'user/*', 'user/*/edit', 'user/*/') && !Request::is('user/create') ? 'active' : '' }}">
                            <i class="far fa-user nav-icon"></i>
                            <p>Data Personalia</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/profil-lembaga" class="nav-link">
                            <i class="far fa-id-card nav-icon"></i>
                            <p>Profil Lembaga</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/sarana-prasarana" class="nav-link {{ Request::is('sarana-prasarana', 'sarana-prasarana/*', 'sarana-prasarana/*/edit', 'sarana-prasarana/*/') && !Request::is('sarana-prasarana/create') ? 'active' : '' }}">
                            <i class="far fa-building nav-icon"></i>
                            <p>Sarana dan Prasarana</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/berkas-pendukung" class="nav-link">
                            <i class="far fa-file-alt nav-icon"></i>
                            <p>Berkas Pendukung Lembaga</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/data-angket-peserta" class="nav-link">
                            <i class="far fa-edit nav-icon"></i>
                            <p>Data Angket Peserta Didik</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/data-angket-penilaian" class="nav-link">
                            <i class="far fa-edit nav-icon"></i>
                            <p>Data Angket Penilaian Kinerja</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="/data-peserta-didik" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Data Peserta Didik</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/pendaftar-online" class="nav-link">
                    <i class="nav-icon fas fa-user-check"></i>
                    <p>Pendaftar Online</p>
                </a>
            </li>
            <li class="nav-header">INFORMATION</li>
            <li class="nav-item">
                <a href="/information" class="nav-link">
                    <i class="nav-icon fas fa-info-circle"></i>
                    <p>Information</p>
                </a>
            </li>
            <li class="nav-item">
              <a href="/log" class="nav-link">
                  <i class="nav-icon fas fa-history"></i>
                  <p>Log Activity</p>
              </a>
            </li>          
            
        </ul>
      </nav>
      {{-- @endauth --}}
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
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
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- isi konten -->
    @yield('container')
    <!-- penutup konten -->
  </div>

  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2017-<?= date("Y") ?> <a target="_blank" href="https://www.instagram.com/ridhoo_kurniawaan/">Ridho Kurniawan</a>.</strong>
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
<!-- jQuery UI 1.11.4 -->
<script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/plugins/jszip/jszip.min.js"></script>
<script src="/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- ChartJS -->
<script src="/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/plugins/moment/moment.min.js"></script>
<script src="/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/js/adminlte.js"></script>
<!-- Toastr -->
<script src="/plugins/toastr/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
{{-- <script src="js/demo.js"></script> --}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="js/pages/dashboard.js"></script> --}}
<!-- Page specific script -->
<script>
  function previewImage(inputId) {
      const input = document.querySelector(`#${inputId}`);
      const imgPreview = document.querySelector('.img-preview');
      imgPreview.style.display = 'block';
      const oFReader = new FileReader();
      oFReader.readAsDataURL(input.files[0]);
      oFReader.onload = function (oFREvent) {
          imgPreview.src = oFREvent.target.result;
      }
  }
  function checkMaxLength(input) {
      const maxLength = 16; // Panjang maksimum NIK
      if (input.value.length > maxLength) {
          input.value = input.value.slice(0, maxLength);
      }
  }
</script>
<script>
  document.querySelectorAll('.toggle-password').forEach(function(button) {
      button.addEventListener('click', function() {
          var targetId = this.dataset.target;
          var input = document.getElementById(targetId);
          var icon = this.querySelector('i');
          var type = input.getAttribute('type') === 'password' ? 'text' : 'password';
          input.setAttribute('type', type);

          // Toggle kelas ikon
          if (type === 'password') {
              icon.classList.remove('fa-eye-slash');
              icon.classList.add('fa-eye');
          } else {
              icon.classList.remove('fa-eye');
              icon.classList.add('fa-eye-slash');
          }
      });
  });
</script>
<script>
  function formatRupiah(input) {
      // Menghilangkan semua karakter kecuali angka
      var angka = input.value.replace(/[^0-9]/g, '');
      
      // Memisahkan angka menjadi grup-grup dengan titik setiap tiga digit
      var formattedAngka = angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      
      // Memasukkan angka yang telah diformat kembali ke input
      input.value = formattedAngka;
  }
</script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "paging": true, 
      "buttons": ["copy", "csv", "excel", "pdf", "print"],
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"], // yg sebelumnya
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
@if(Session::has('message'))
<script>
    toastr.options = {
      "progressBar" : true,
      "closeButton" : true
    }
    toastr.success('{{ Session::get('message') }}','Success!',{timeOut:5000});
</script>
@endif
@if ($messages = Session::get('info'))
  <script>
    toastr.options = {
      "progressBar": true,
      "closeButton": true
    }
    toastr.info('{{ $messages }}', 'Information', { timeOut: 5000 });
  </script>
@endif
@if ($errors->any())
  <script>
    toastr.options = {
      "progressBar": true,
      "closeButton": true
    }
    @foreach ($errors->all() as $error)
      toastr.error('{{ $error }}', 'Failed!', { timeOut: 5000 });
    @endforeach
  </script>
@endif
</body>
</html>

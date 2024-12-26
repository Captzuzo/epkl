<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
      E-PKL | 
      @if(Route::currentRouteName())
          {{ ucwords(last(explode('.', Route::currentRouteName()))) }}
      @else
          Dashboard
      @endif
  </title>
  
  <link rel="icon" href="{{ asset('img/Logo SMKN 3 Kudus.png') }}" sizes="32x32" type="image/png" />
  <!-- SweetAlert 2 CSS -->

  <link href="{{ asset('sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('lte/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('lte/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('lte/plugins/summernote/summernote-bs4.min.css') }}">
  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="{{ asset('lte/plugins/summernote/summernote-bs4.min.css') }}">
  <!-- Link CSS Leaflet -->
  <link rel="stylesheet" href="{{ asset ('leaflet/dist/leaflet.css') }}" />
  {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" /> --}}
  
  <style>
  
  /* Dropdown Master */
  #dataMasterMenu {
      padding-left: 0px; /* Adjust this value to shift more or less */
  }

  /* Adjust the position of the dropdown items */
  #dataMasterDropdown {
      margin-left: 20px; /* Add left margin to indent the items */
  }

  /* Dropdown Transaksi */
  #dataTransaksiMenu {
      padding-left: 0px; /* Adjust this value to shift more or less */
  }

  /* Adjust the position of the dropdown items */
  #dataTransaksiDropdown {
      margin-left: 20px; /* Add left margin to indent the items */
  }
  
  /* Dropdown Laporan */
  #dataLaporanMenu {
      padding-left: 0px; /* Adjust this value to shift more or less */
  }

  /* Adjust the position of the dropdown items */
  #dataLaporanDropdown {
      margin-left: 20px; /* Add left margin to indent the items */
  }

  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  {{-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('img/Logo SMKN 3 Kudus.png') }}" alt="E-PKL" height="100" width="100">
  </div> --}}

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
            <i></i> {{ Auth::user()->nama }} <!-- Nama Pengguna -->
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-divider"></div>
            <!-- Button logout yang memicu SweetAlert -->
            <a href="{{ route('logout') }}" class="nav-link logout">
              <p>Logout</p>
            </a>
            <!-- Form logout yang akan dikirim setelah konfirmasi -->
            <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                @csrf
            </form>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4 text-dark">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-center">
      <img src="{{ asset('img/Logo SMKN 3 Kudus.png') }}" alt="E-PKL Logo" class="brand-image img-circle elevation-3 center" style="opacity: .8; display: block; margin-left: auto; margin-right: auto;">
      <span class="brand-text font-weight-light">E-PKL</span>
    </a>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('admin.dashboardAdmin') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
          </li>
          @role('koordinator_pkl')
          <!-- Data Master Dropdown -->
          <li class="nav-item has-treeview" id="dataMasterMenu">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-database"></i>
                <p>
                    Data Master
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" id="dataMasterDropdown">
                <li class="nav-item"><a href="{{ route('admin.user') }}" class="nav-link"><i class="nav-icon fas fa-users"></i><p> Data User</p></a></li>
                {{-- <li class="nav-item"><a href="{{ route('admin.roles') }}" class="nav-link"><i class="fas fa-user-shield"></i><p> Roles</p></a></li>
                <li class="nav-item"><a href="{{ route('permissions.index') }}" class="nav-link"><i class="fas fa-user-shield"></i><p> Permission</p></a></li>
                <li class="nav-item"><a href="{{ route('admin.rolehash') }}" class="nav-link"><i class="fas fa-key"></i><p> Role Permissions</p></a></li>
                <li class="nav-item"><a href="{{ route('admin.modelhasroles.index') }}" class="nav-link"><i class="fas fa-users-cog"></i><p>Model Permission</p></a></li>
                <li class="nav-item"><a href="{{ route('admin.hashPermissions') }}" class="nav-link"><i class="fas fa-users-cog"></i><p>Model Has Role</p></a></li> --}}
                <li class="nav-item"><a href="{{ route('admin.periode') }}" class="nav-link"><i class="fas fa-calendar-day"></i><p> Periode</p></a></li>
                <li class="nav-item"><a href="{{ route('admin.jurusan') }}" class="nav-link"><i class="fas fa-graduation-cap"></i><p> Jurusan</p></a></li>
                <li class="nav-item"><a href="{{ route('admin.siswa') }}" class="nav-link"><i class="fas fa-user-graduate"></i><p> Siswa</p></a></li>
                <li class="nav-item"><a href="{{ route('admin.pembimbing') }}" class="nav-link"><i class="fas fa-chalkboard-teacher"></i><p>Pembimbing</p></a></li>
                <li class="nav-item"><a href="{{ route('admin.instansi') }}" class="nav-link"><i class="fas fa-building"></i><p>Instansi</p></a></li>
                {{-- <li class="nav-item"><a href="{{ route('admin.instansi') }}" class="nav-link"><i class="fas fa-building"></i><p>Instansi</p></a></li> --}}
            </ul>
          </li>
          @endrole

          @role('koordinator_pkl')
          <!-- Data Transaksi Dropdown -->
          <li class="nav-item has-treeview" id="dataTransaksiMenu">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-exchange-alt"></i>
                <p>
                    Data Transaksi
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" id="dataTransaksiDropdown">
                <li class="nav-item"><a href="{{ route('admin.pengajuan') }}" class="nav-link"><i class="fas fa-map-marker-alt"></i><p>Pengajuan Tempat</p></a></li>
                <li class="nav-item"><a href="{{ route('admin.pembagian') }}" class="nav-link"><i class="fas fa-share-alt"></i><p>Pembagian</p></a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-check-circle"></i><p>Absensi</p></a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-file-alt"></i><p>Log Harian</p></a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-bus"></i><p>Kunjungan</p></a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-file-invoice"></i><p>Laporan</p></a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-chart-line"></i><p>Evaluasi</p></a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-star"></i><p>Penilaian</p></a></li>
            </ul>
          </li>
          @endrole

          @role('siswa')
          <!-- Data Transaksi Dropdown -->
          <li class="nav-item has-treeview" id="dataTransaksiMenu">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-exchange-alt"></i>
                <p>
                    Data Transaksi
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" id="dataTransaksiDropdown">
                <li class="nav-item"><a href="{{ route('siswa.pengajuan') }}" class="nav-link"><i class="fas fa-map-marker-alt"></i><p>Pengajuan Tempat</p></a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-share-alt"></i><p>Pembagian</p></a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-check-circle"></i><p>Absensi</p></a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-file-alt"></i><p>Log Harian</p></a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-bus"></i><p>Kunjungan</p></a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-file-invoice"></i><p>Laporan</p></a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-chart-line"></i><p>Evaluasi</p></a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-star"></i><p>Penilaian</p></a></li>
            </ul>
          </li>
          @endrole

          @role('koordinator_pkl')
          {{-- Data Laporan --}}
          <li class="nav-item has-treeview" id="dataLaporanMenu">
            <a href="#" class="nav-link">
              <i class="fas fa-file"></i>
              <p>
                Data Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" id="dataLaporanDropdown">
              <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-map-marker-alt"></i><p>Laporan Pengajuan</p></a></li>
              <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-share-alt"></i><p>Laporan Pembagian</p></a></li>
              <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-check-circle"></i><p>Laporan Absensi</p></a></li>
              <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-file-alt"></i><p>Laporan Log Harian</p></a></li>
              <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-bus"></i><p>Laporan Kunjungan</p></a></li>
              <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-file-invoice"></i><p>Laporan</p></a></li>
              <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-chart-line"></i><p>Laporan Evaluasi</p></a></li>
              <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-star"></i><p>Laporan Penilaian</p></a></li>
            </ul>
          </li>
          @endrole

          

          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link">
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
    </aside>

  <!-- Content Wrapper. Contains page content -->
    @yield('content')
  <!-- /.content-wrapper -->
  @stack('scripts')  <!-- Add this if you use stack('scripts') for extra JS files -->
  @yield('scripts') 
  <!-- Footer -->
  <footer class="main-footer text-center">
    <strong>COPYRIGHT &copy; <?php echo date("Y"); ?> E-PKL 
      <a href="https://smk3kudus.sch.id/">SMK NEGERI 3 KUDUS</a>.</strong>
    <div class="float-right d-none d-sm-inline-block">
    </div>
  </footer>

</div>
<!-- ./wrapper -->

 <!-- Memuat jQuery sebelum skrip lainnya -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

 {{-- <!-- Memuat JS Anda -->
 <script src="{{ asset('js/app.js') }}"></script> <!-- atau file js lain --> --}}

<!-- Leaflet JS -->
<script src="{{ asset('leaflet/dist/leaflet.js') }}"></script>
<!-- jQuery -->
<script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('lte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('lte/dist/js/adminlte.js') }}"></script>
<!-- SweetAlert -->
<script src="{{ asset('/sweetalert2/dist/sweetalert2.min.js') }}"></script>

@yield('scripts')

    <!-- Add the SweetAlert 2 JS and the scripts section here -->


<script>
    $(document).ready(function() {
        setTimeout(function() {
            $(".preloader").fadeOut(); // Hide preloader
        }, 500); // 3 seconds timeout

        // Handle opening Data Master dropdown
        $('#dataMasterMenu a').on('click', function() {
            $('#dataTransaksiDropdown').hide(); // Close Data Transaksi dropdown
            $('#dataMasterDropdown').toggle(); // Toggle Data Master dropdown (open/close)
            $('#dataLaporanDropdown').hide(); // Hide Data Laporan dropdown
        });

        // Handle opening Data Transaksi dropdown
        $('#dataTransaksiMenu a').on('click', function() {
            $('#dataMasterDropdown').hide(); // Close Data Master dropdown
            $('#dataTransaksiDropdown').toggle(); // Toggle Data Transaksi dropdown (open/close)
            $('#dataLaporanDropdown').hide(); // Hide Data Laporan dropdown
        });

        // Handle opening Data Laporan dropdown
        $('#dataLaporanMenu a').on('click', function() {
            $('#dataMasterDropdown').hide(); // Close Data Master dropdown
            $('#dataTransaksiDropdown').hide(); // Close Data Transaksi dropdown
            $('#dataLaporanDropdown').toggle(); // Toggle Data Laporan dropdown (open/close)
        });

    });

    $(document).ready(function() {
    // Toggle Data Master dropdown
    $('#dataMasterMenu a').on('click', function(e) {
        var $parent = $(this).parent();
        if ($parent.hasClass('has-treeview')) {
            $parent.toggleClass('menu-open');
            $parent.find('.nav-treeview').stop(true, true).slideToggle();
        }
    });
});


    document.querySelector('.nav-link.logout').addEventListener('click', function(event) {
        event.preventDefault();
        
        Swal.fire({
            title: 'Apakah Anda yakin ingin keluar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yakin',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    });
</script>

</body>
</html>

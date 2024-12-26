<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> E-PKL | Login</title>
  <link rel="icon" href="{{ asset('img/Logo SMKN 3 Kudus.png') }}" sizes="32x32" type="image/png" />

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
  
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">

</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-header text-center">
        <a href="{{ route('login') }}" class="h1 animation__shake">
          <b>E-PKL</b> SMKN 3 Kudus
        </a>
      </div>

      <div class="card-body">
        <p class="login-box-msg">Silahkan Login</p>
        <form action="{{ route('login-proses') }}" method="POST">
          @csrf
          <div class="input-group mb-3">
            <input type="username" for="username" class="form-control" id="username" name="username" placeholder="Masukkan Username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
      
          <button type="submit" class="btn btn-primary">Login</button>
      </form>
      
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>

  <!-- Bootstrap 4 -->
  <script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- AdminLTE App -->
  <script src="{{ asset('lte/dist/js/adminlte.min.js') }}"></script>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  @if ($message = Session::get('failed'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Login Gagal',
            text: "{{ $message }}",
            position: 'top-end',  // Menempatkan di kanan atas
            toast: true,          // Menampilkan sebagai toast
            showConfirmButton: false,  // Menyembunyikan tombol konfirmasi
            timer: 3000,          // Durasi munculnya toast
            timerProgressBar: true,  // Menampilkan progress bar
            width: '250px'        // Ukuran kecil
        });
    </script>
@endif

@if ($message = Session::get('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Logout Berhasil',
            text: "{ $message }}",  // Perbaikan di sini
            position: 'top-end',  // Menempatkan di kanan atas
            toast: true,          // Menampilkan sebagai toast
            showConfirmButton: false,  // Menyembunyikan tombol konfirmasi
            timer: 5000,          // Durasi munculnya toast
            timerProgressBar: true,  // Menampilkan progress bar
            width: '400px'        // Ukuran kecil
        });
    </script>
@endif

    </script>
</body>
</html>

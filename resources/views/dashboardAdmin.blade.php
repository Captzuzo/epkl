@extends('layout.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard Admin</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">

      <!-- Data Master -->
      <div class="col-12">
        <h4 class="mb-3">Data Master</h4>
        <div class="row">

          <!-- Data User -->
          <div class="col-lg-3 col-md-6 col-12">
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>{{ $jumlah_user }}</h3>
                <p>Jumlah User</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="{{ route('admin.user') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- Data Siswa -->
          <div class="col-lg-3 col-md-6 col-12">
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>{{ $jumlah_siswa }}</h3>
                <p>Jumlah Siswa</p>
              </div>
              <div class="icon">
                <i class="ion ion-graduation-cap"></i>
              </div>
              <a href="{{ route('admin.siswa') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- Data Guru Pembimbing -->
          <div class="col-lg-3 col-md-6 col-12">
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>{{ $jumlah_pembimbing }}</h3>
                <p>Jumlah Guru</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="{{ route('admin.pembimbing') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- Data Instansi -->
          <div class="col-lg-3 col-md-6 col-12">
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>{{ $jumlah_instansi }}</h3>
                <p>Jumlah Instansi</p>
              </div>
              <div class="icon">
                <i class="ion ion-business"></i>
              </div>
              <a href="{{ route('admin.instansi') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div>
      </div>

      <!-- Data Transaksi -->
      <div class="col-12 mt-4">
        <h4 class="mb-3">Data Transaksi</h4>
        <div class="row">

          <!-- Data Pengajuan -->
          <div class="col-lg-3 col-md-6 col-12">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $jumlah_pengajuan }}</h3>
                <p>Jumlah Pengajuan Tempat</p>
              </div>
              <div class="icon">
                <i class="ion ion-document-text"></i>
              </div>
              <a href="{{ route('admin.pengajuan') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div>
      </div>

    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->


        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
@section('scripts')
@if ($message = Session::get('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Login Berhasil',
            text: 'Selamat datang, {{ session("nama") }}!',
            position: 'top-end',  // Menempatkan di kanan atas
            toast: true,          // Menampilkan sebagai toast
            showConfirmButton: false,  // Menyembunyikan tombol konfirmasi
            timer: 3000,          // Durasi munculnya toast
            timerProgressBar: true,  // Menampilkan progress bar
            width: '400px'        // Ukuran kecil
        });
    </script>
@endif
@endsection
@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Instansi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Instansi</li>
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
            <div class="col-12">
                <a href="{{ route('admin.instansi.create') }}" class="btn btn-primary mb-3">Tambah Instansi</a>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Instansi</h3>
                  <div class="card-tools">
                    <form method="GET" action="{{ route('admin.siswa') }}">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="search" class="form-control float-right" placeholder="Search" value="{{ request()->get('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 300px;">
                  <table class="table table-head-fixed text-nowrap">
                    <thead>
                      <tr>
                          <th>No</th>
                          <th>Nama Instansi</th>
                          <th>No Telp</th>
                          <th>Kota</th>
                          <th>Alamat</th>
                          <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($instansis as $instansi)
                          <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $instansi->nama_instansi }}</td>
                              <td>{{ $instansi->no_telp }}</td>
                              <td>{{ $instansi->alamat }}</td>
                              <td>{{ $instansi->kota }}</td>
                              <td>
                                  <a href="{{ route('admin.instansi.edit', $instansi->id_instansi) }}" class="btn btn-warning">Edit</a>
                                  <form action="{{ route('admin.instansi.hapus', $instansi->id_instansi) }}" method="POST" style="display:inline;">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger">Hapus</button>
                                  </form>
                              </td>
                          </tr>
                      @endforeach
                    </tbody>                    
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
@section('scripts')
    
    <!-- Script untuk menampilkan alert berdasarkan session -->
    @if(session('error'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "{{ session('error') }}",
            });
        </script>
    @endif

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session("success") }}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    @if($errors->has('nama_jurusan'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Gagal!",
                text: "{{ $errors->first('nama_jurusan') }}",
            });
        </script>
    @endif
@endsection
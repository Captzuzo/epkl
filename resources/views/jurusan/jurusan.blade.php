@extends('layout.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Jurusan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Jurusan</li>
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
                    <a href="{{ route('admin.jurusan.create') }}" class="btn btn-primary mb-3">Tambah Data Jurusan</a>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Jurusan</h3>
                            <div class="card-tools">
                                <form method="GET" action="{{ route('admin.jurusan') }}">
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
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: 300px;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Jurusan</th>
                                        <th>Tanggal Buat</th>
                                        <th>Tanggal Edit</th>
                                        <th>Kelola</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $d->nama_jurusan }}</td>
                                            <td>{{ $d->created_at }}</td>
                                            <td>{{ $d->updated_at }}</td>
                                            <td>
                                                <a href="{{ route('admin.jurusan.edit', ['id_jurusan' => $d->id_jurusan]) }}" class="btn btn-primary">
                                                    <i class="fas fa-pen"></i> Edit
                                                </a>
                                                <a data-toggle="modal" data-target="#modal-hapus{{ $d->id_jurusan }}" class="btn btn-danger">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- Modal Hapus -->
                                        <div class="modal fade" id="modal-hapus{{ $d->id_jurusan }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Konfirmasi Hapus Data Jurusan</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah kamu yakin ingin menghapus data jurusan <b>{{ $d->nama_jurusan }}</b>?</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                                                        <form action="{{ route('admin.jurusan.hapus', ['id_jurusan' => $d->id_jurusan]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.modal -->
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
@endsection

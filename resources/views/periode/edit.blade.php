@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Periode</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Periode</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Edit Periode</h3>
                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->
                        <form action="{{ route('admin.periode.update', ['id_periode' => $data->id_periode]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama_periode">Nama Periode</label>
                                    <input type="text" class="form-control" id="nama_periode" name="nama_periode" value="{{ $data->nama_periode }}" placeholder="Masukkan Nama Periode">
                                    @error('nama_periode')
                                       <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tgl_mulai">Tanggal Mulai</label>
                                    <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" value="{{ $data->tgl_mulai }}" placeholder="Masukkan Tanggal Mulai" onchange="setEndDate()">
                                    @error('tgl_mulai')
                                       <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tgl_selesai">Tanggal Selesai (otomatis 6 bulan setelah mulai)</label>
                                    <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai" value="{{ $data->tgl_selesai }}" readonly>
                                    @error('tgl_selesai')
                                       <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection

@section('scripts')
<!-- SweetAlert untuk pesan sukses -->
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 2500,
            showConfirmButton: false
        });
    </script>
@endif

<!-- SweetAlert untuk pesan error -->
@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('error') }}',
        });
    </script>
@endif

<!-- SweetAlert untuk pesan info (tidak ada perubahan) -->
@if(session('info'))
    <script>
        Swal.fire({
            icon: 'info',
            title: 'Tidak Ada Perubahan!',
            text: '{{ session('info') }}',
            timer: 2000,
            showConfirmButton: false
        });
    </script>
@endif

<!-- SweetAlert untuk validasi form -->
@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Validasi Gagal!',
            text: 'Silakan cek kembali inputan Anda.',
        });
    </script>
@endif
@endsection
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
                        <li class="breadcrumb-item active">Tambah Periode</li>
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
                            <h3 class="card-title">Form Tambah Periode</h3>
                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->
                        <form action="{{ route('admin.periode.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama_periode">Nama Periode</label>
                                    <input type="text" class="form-control" id="nama_periode" name="nama_periode" placeholder="Masukkan Nama Periode">
                                    @error('nama_periode')
                                       <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tgl_mulai">Tanggal Mulai</label>
                                    <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" placeholder="Masukkan Tanggal Mulai">
                                    @error('tgl_mulai')
                                       <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tgl_selesai">Tanggal Selesai</label>
                                    <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai" placeholder="Masukkan Tanggal Selesai" readonly>
                                    @error('tgl_selesai')
                                       <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <script>
                                // Mengatur tanggal selesai otomatis 6 bulan setelah tanggal mulai
                                document.getElementById('tgl_mulai').addEventListener('change', function() {
                                    var startDate = new Date(this.value); // Ambil nilai tanggal mulai
                                    if (startDate.getTime()) { // Pastikan tanggal valid
                                        startDate.setMonth(startDate.getMonth() + 6); // Tambahkan 6 bulan
                            
                                        var month = startDate.getMonth() + 1;  // JavaScript months are 0-indexed, jadi tambahkan 1
                                        var day = startDate.getDate();
                                        var year = startDate.getFullYear();
                            
                                        // Format tanggal dengan format YYYY-MM-DD
                                        var formattedDate = year + '-' + (month < 10 ? '0' + month : month) + '-' + (day < 10 ? '0' + day : day);
                            
                                        // Set tanggal selesai ke input
                                        document.getElementById('tgl_selesai').value = formattedDate;
                                    }
                                });
                            </script>

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
            timer: 2000,
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


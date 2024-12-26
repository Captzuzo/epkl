@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Guru Pembimbing</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Guru Pembimbing</li>
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
                <a href="{{ route('admin.pembimbing.create') }}" class="btn btn-primary mb-3">Tambah Guru Pembimbing</a>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Guru Pembimbing</h3>
                        <div class="card-tools">
                            <form method="GET" action="{{ route('admin.pembimbing') }}">
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
                                    <th>NIP</th>
                                    <th>Nama Guru</th>
                                    <th>Email</th>
                                    <th>Jurusan</th>
                                    <th>No Telp</th>
                                    {{-- <th>Username</th>
                                    <th>Password</th> --}}
                                    <th>Tanggal Buat</th>
                                    <th>Tanggal Edit</th>
                                    <th>Kelola</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->nip }}</td>
                                    <td>{{ $d->nama_guru }}</td>
                                    <td>{{ $d->email }}</td>
                                    <td>{{ $d->jurusan ? $d->jurusan->nama_jurusan : 'Tidak Ada Data' }}</td>
                                    <td>{{ $d->no_telp }}</td>
                                    {{-- <td>{{ $d->username }}</td>
                                    <td>****</td> <!-- Masking password --> --}}
                                    <td>{{ $d->created_at }}</td>
                                    <td>{{ $d->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.pembimbing.edit', ['nip' => $d->nip]) }}" class="btn btn-primary"><i class="fas fa-pen"></i> Edit </a>
                                        <a data-toggle="modal" data-target="#modal-hapus{{ $d->nip }}" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Hapus </a>
                                    </td>
                                  
                                </tr>

                                <!-- Modal Hapus -->
                                <div class="modal fade" id="modal-hapus{{ $d->nip }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Konfirmasi Hapus Data Guru Pembimbing</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah kamu yakin ingin menghapus data guru pembimbing <b>{{ $d->nama_guru }}</b>?</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                                <form action="{{ route('admin.pembimbing.hapus', ['nip' => $d->nip]) }}" method="POST">
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
@endsection
@section('scripts')
    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session("error") }}',
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

    @if($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ $errors->first() }}',
            });
        </script>
    @endif
@endsection

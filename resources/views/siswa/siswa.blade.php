@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Siswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Siswa</li>
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
                <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary mb-3">Tambah Siswa</a>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Siswa</h3>
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
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>Periode</th>
                        <th>Alamat</th>
                        <th>Kota</th>
                        {{-- <th>ttl</th> --}}
                        {{-- <th>No Telp</th> --}}
                        {{-- <th>Email</th> --}}
                        {{-- <th>Username</th> --}}
                        {{-- <th>Password</th> --}}
                        {{-- <th>Role</th> --}}
                        <th>Tanggal Buat</th>
                        <th>Tanggal Edit</th>
                        <th>Kelola</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->nis }}</td>
                            <td>{{ $d->nama_siswa }}</td>
                            <td>{{ $d->kelas }}</td>
                            <td>{{ $d->jurusan ? $d->jurusan->nama_jurusan : 'Tidak Ada Data' }}</td>
                            <td>{{ $d->periode ? $d->periode->nama_periode : 'Tidak Ada Data' }}</td>
                            <td>{{ $d->alamat }}</td>
                            <td>{{ $d->kota }}</td>
                            {{-- <td>{{ $d->ttl }}</td> --}}
                            {{-- <td>{{ $d->no_telp }}</td> --}}
                            {{-- <td>{{ $d->email }}</td> --}}
                            {{-- <td>{{ $d->username }}</td> --}}
                            {{-- <td>{{ $d->password }}</td> --}}
                            {{-- <td>{{ implode(', ', $d->getRoleNames()->toArray()) }}</td> --}}
                            <td>{{ $d->created_at }}</td>
                            <td>{{ $d->updated_at }}</td>
                            <td>
                                <a href="{{ route('admin.siswa.edit', ['nis' => $d->nis]) }}" class="btn btn-primary"><i class="fas fa-pen"></i> Edit </a>
                                <a data-toggle="modal" data-target="#modal-hapus{{ $d->nis }}" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Hapus </a>
                            </td>
                        </tr>
                    
                        <!-- Modal Hapus -->
                        <div class="modal fade" id="modal-hapus{{ $d->nis }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Konfirmasi Hapus Data Siswa</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah kamu yakin ingin menghapus data siswa <b>{{ $d->nama_siswa }}</b>?</p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                        <form action="{{ route('admin.siswa.hapus', ['nis' => $d->nis]) }}" method="POST">
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
@if (session('success'))
    <script>
        Swal.fire({
            position: "top-end",
            icon: 'success',
            title: 'Berhasil',
            showConfirmButton: false,
            timer: 1500,
            text: @json(session('success'))
        });
    </script>
@elseif (session('error'))
    <script>
        Swal.fire({
        position: "top-end",
        icon: "error",
        title: "Gagal",
        showConfirmButton: false,
        timer: 1500,
        text: @json(session('error'))
      });
    </script>
@endif
@endsection

@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Pengajuan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Pengajuan</li>
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
                    <!-- Button for adding new Pengajuan -->
                    <a href="{{ route('admin.pengajuan.create') }}" class="btn btn-primary mb-3">Tambah Pengajuan</a>
                    
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Pengajuan</h3>
                            <!-- Search form -->
                            <div class="card-tools">
                                <form method="GET" action="{{ route('admin.pengajuan') }}">
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
                        
                        <div class="card-body table-responsive p-0" style="height: 300px;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>Jurusan</th>
                                        <th>Instansi</th>
                                        <th>Periode</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @role('koordinator_pkl')
                                        @foreach ($pengajuan as $item)
                                            <tr>
                                                <td>{{ $item->siswa->nis }}</td>
                                                <td>{{ $item->siswa->nama_siswa }}</td>
                                                <td>{{ $item->jurusan->nama_jurusan }}</td>
                                                <td>{{ $item->instansi->nama_instansi }}</td>
                                                <td>{{ $item->periode->nama_periode }}</td>
                                                <td>{{ $item->status }}</td>
                                                <td>
                                                    @if ($item->status == 'menunggu')
                                                        <form action="{{ route('admin.pengajuan.setujui', $item->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                                                        </form>

                                                        <form action="{{ route('admin.pengajuan.tolak', $item->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                                        </form>
                                                    @endif
                                                    
                                                    @if ($item->status == 'setujui')
                                                        <a href="{{ route('admin.pengajuan.surat', $item->id) }}" class="btn btn-info btn-sm">Cetak Surat</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endrole

                                    @role('siswa')
                                        @foreach ($pengajuan as $item)
                                            <tr>
                                                <td>{{ $item->siswa->nis }}</td>
                                                <td>{{ $item->siswa->nama_siswa }}</td>
                                                <td>{{ $item->jurusan->nama_jurusan }}</td>
                                                <td>{{ $item->instansi->nama_instansi }}</td>
                                                <td>{{ $item->periode->nama_periode }}</td>
                                                <td>{{ $item->status }}</td>
                                                <td>
                                                    <a href="{{ route('admin.pengajuan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('admin.pengajuan.destroy', $item->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endrole
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

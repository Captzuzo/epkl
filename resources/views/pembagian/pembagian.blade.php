@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daftar Pembagian</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Pembagian</li>
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
            <div class="col-12">
                <a href="{{ route('admin.pembagian.create') }}" class="btn btn-primary mb-3">Tambah Pembagian</a>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Pembagian</h3>
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
                </div>

                @role('koordinator_pkl')
                <div class="card-body table-responsive p-0" style="height: 300px;">
                  <table class="table table-head-fixed text-nowrap">
                    <thead>
                      <tr>
                          <th>No</th>
                          <th>NIS</th>
                          <th>NIP Pembimbing</th>
                          <th>Nama Siswa</th>
                          <th>Nama Pembimbing</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($pembagians as $index => $pembagian)
                          <tr>
                              <td>{{ $index + 1 }}</td>
                              <td>{{ $pembagian->nis }}</td>
                              <td>{{ $pembagian->nip }}</td>
                              <td>{{ $pembagian->siswa->nama }}</td>
                              <td>{{ $pembagian->pembimbing->nama }}</td>
                          </tr>
                      @endforeach
                  </tbody>              
                  </table>
                </div>
                @endrole


              </div>
            </div>
        </div><!-- /.row (main row) -->
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

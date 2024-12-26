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
                        <li class="breadcrumb-item active">Tambah Siswa</li>
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
                            <h3 class="card-title">Form Tambah Siswa</h3>
                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->
                        <form action="{{ route('admin.siswa.update', ['nis' => $data->nis]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                {{-- <div class="form-group">
                                    <label for="nis">NIS</label>
                                    <input type="text" class="form-control" id="nis" name="nis" value="{{ $data->nis }}" placeholder="Masukkan NIS">
                                    @error('nis')
                                       <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div> --}}
                                <div class="form-group">
                                    <label for="nama_siswa">Nama Siswa</label>
                                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="{{ $data->nama_siswa }}" placeholder="Masukkan Nama Siswa">
                                    @error('nama_siswa')
                                       <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <input type="kelas" class="form-control" id="kelas" name="kelas" value="{{ $data->kelas }}" placeholder="Masukkan Kelas">
                                    @error('kelas')
                                       <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="id_periode">Periode</label>
                                    <select class="form-control" id="id_periode" name="id_periode">
                                        <option value="">Pilih Periode</option>
                                        @foreach ($periodes as $periode)
                                            <option value="{{ $periode->id_periode }}" 
                                                {{ old('id_periode', $data->id_periode) == $periode->id_periode ? 'selected' : '' }}>
                                                {{ $periode->nama_periode }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_periode')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>                                
                                
                                <div class="form-group">
                                    <label for="id_jurusan">Jurusan</label>
                                    <select class="form-control" id="id_jurusan" name="id_jurusan">
                                        <option value="">Pilih Jurusan</option>
                                        @foreach ($jurusans as $jurusan)
                                            <option value="{{ $jurusan->id_jurusan }}" 
                                                {{ old('id_jurusan', $data->id_jurusan) == $jurusan->id_jurusan ? 'selected' : '' }}>
                                                {{ $jurusan->nama_jurusan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_jurusan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                
                                
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" value="{{ $data->alamat }}"  name="alamat" placeholder="Masukkan Alamat">
                                    @error('alamat')
                                       <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kota">Kota</label>
                                    <input type="text" class="form-control" id="kota" name="kota" value="{{ $data->kota }}" placeholder="Masukkan Kota">
                                    @error('kota')
                                       <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="ttl">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="ttl" name="ttl" value="{{ $data->ttl }}" placeholder="Masukkan Tanggal Lahir">
                                    @error('ttl')
                                       <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="no_telp">No Telp</label>
                                    <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ $data->no_telp }}" placeholder="Masukkan No Telp">
                                    @error('no_telp')
                                       <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $data->email }}" placeholder="Masukkan Email">
                                    @error('email')
                                       <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                {{-- <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" value="{{ $data->username }}" placeholder="Masukkan Username">
                                    @error('username')
                                       <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password">
                                    @error('password')
                                       <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div> --}}
                                {{-- <div class="form-group">
                                    <label for="role">Role</label>
                                    <select name="role" class="form-control" required>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                            </div>

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

@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Role</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Role</li>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Role</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.roles.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="role_name">Nama Role</label>
                                    <input type="text" name="name" class="form-control" id="role_name" placeholder="Masukkan Nama Role" required>
                                </div>
                                <div class="form-group">
                                    <label for="guard_name">Guard Name</label>
                                    <select name="guard_name" class="form-control" id="guard_name" required>
                                        <option value="web" {{ old('guard_name') == 'web' ? 'selected' : '' }}>Web</option>
                                        <option value="api" {{ old('guard_name') == 'api' ? 'selected' : '' }}>API</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan Role</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

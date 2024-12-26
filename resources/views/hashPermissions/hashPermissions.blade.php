@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Model Permissions</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.hashPermissions') }}">Home</a></li>
                        <li class="breadcrumb-item active">Data Model Permissions</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <a href="{{ route('admin.hashPermissions.create') }}" class="btn btn-primary mb-3">Role Permission</a>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Model Permissions</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Permission ID</th>
                                        <th>Model Type</th>
                                        <th>Model ID</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hashPermissions as $hashPermission)
                                        <tr>
                                            <td>{{ $hashPermission->id }}</td>
                                            <td>{{ $hashPermission->permission_id }}</td>
                                            <td>{{ $hashPermission->model_type }}</td>
                                            <td>{{ $hashPermission->model_id }}</td>
                                            <td>
                                                <a href="{{ route('hashPermissions.edit', $hashPermission->id) }}" class="btn btn-warning">Edit</a>
                                                <form action="{{ route('hashPermissions.destroy', $hashPermission->id) }}" method="POST" style="display:inline;">
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
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

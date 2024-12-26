@extends('layout.main')

@section('content')
<div class="container">
    <h1>Daftar Role</h1>
    <a href="{{ route('admin.rolehash.create') }}" class="btn btn-primary mb-3">Tambah Role</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Role</th>
                <th>Permissions</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        @foreach($role->permissions as $permission)
                            <span class="badge badge-primary">{{ $permission->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <!-- Mengarahkan ke halaman edit dengan role_id -->
                        <a href="{{ route('admin.rolehash.edit', $role->id) }}" class="btn btn-primary">Edit Permissions</a>
                        
                        <!-- Hapus role dengan konfirmasi -->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-{{ $role->id }}">
                            Hapus Role
                        </button>

                        <!-- Modal Konfirmasi Hapus -->
                        <div class="modal fade" id="modal-delete-{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-delete-label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-delete-label">Konfirmasi Hapus Role</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus role <strong>{{ $role->name }}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <form action="{{ route('admin.rolehash.destroy', $role->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus Role</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection



@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Role Permissions</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <a href="{{ route('admin.rolehash.create') }}" class="btn btn-primary mb-3">Tambah Role Permissions</a>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Role Permission</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Role</th>
                                        <th>Permissions</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roles as $role)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            @foreach($role->permissions as $permission)
                                                <span class="badge badge-primary">{{ $permission->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.rolehash.edit', $role->id) }}" class="btn btn-primary">Edit Permissions</a>
                                            <form action="{{ route('admin.rolehash.destroy', $role->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus Permissions</button>
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

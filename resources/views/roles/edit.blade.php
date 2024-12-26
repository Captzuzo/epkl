@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Role</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Edit Role</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="role_name">Nama Role</label>
                                    <input type="text" name="name" class="form-control" id="role_name" value="{{ old('name', $role->name) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="guard_name">Guard Name</label>
                                    <input type="text" name="guard_name" class="form-control" id="guard_name" value="{{ old('guard_name', $role->guard_name) }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Role</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
@endsection

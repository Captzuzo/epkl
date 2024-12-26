@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Assign Role to Model Permission</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.hashPermissions.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="permission_id">Permission</label>
                    <select name="permission_id" id="permission_id" class="form-control" required>
                        @foreach ($permissions as $permission)
                            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="model_type">Model Type</label>
                    <select name="model_type" id="model_type" class="form-control" required>
                        <option value="User">User</option>
                        <option value="Admin">Admin</option>
                        <!-- Tambahkan model lainnya jika perlu -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="model_id">Model ID</label>
                    <input type="number" name="model_id" id="model_id" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
            
        </div>
    </section>
</div>
@endsection

@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Model Role</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.modelhasroles.update', $modelHasRole->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Role</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="role_id">Role</label>
                            <select name="role_id" id="role_id" class="form-control" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ $role->id == $modelHasRole->role_id ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="model_id">Model</label>
                            <select name="model_id" id="model_id" class="form-control" required>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $user->id == $modelHasRole->model_id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="model_type" value="App\Models\User"> <!-- Add the model type -->
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update Role</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection

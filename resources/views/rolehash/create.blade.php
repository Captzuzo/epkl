@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Role Permissions</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.rolehash.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Role Permissions</h3>
                    </div>
                    <div class="card-body">
                        <!-- Role Selection -->
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role_id" id="role" class="form-control" required>
                                <option value="" disabled selected>Pilih Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Permissions Selection -->
<div class="form-group">
    <label for="permissions">Permissions</label>
    @foreach($permissions as $permission)
        <div class="custom-control custom-checkbox">
            <input 
                class="custom-control-input" 
                type="checkbox" 
                id="permission_{{ $permission->id }}" 
                name="permissions[]" 
                value="{{ $permission->id }}" 
                @if(in_array($permission->id, $role->permissions->pluck('id')->toArray())) checked @endif>
            <label for="permission_{{ $permission->id }}" class="custom-control-label">
                {{ $permission->name }}
            </label>
        </div>
    @endforeach
    @error('permissions')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection

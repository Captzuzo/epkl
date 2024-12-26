@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Role Permissions</h1>
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
                            <h3 class="card-title">Edit Role Permissions</h3>
                        </div>

                        <form action="{{ route('admin.rolehash.update', $role->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="permissions">Permissions</label>
                                
                                    @foreach($permissions as $permission)
                                        <div class="custom-control custom-checkbox">
                                            <input 
                                                type="checkbox" 
                                                class="custom-control-input" 
                                                name="permissions[]" 
                                                value="{{ $permission->id }}" 
                                                id="permission_{{ $permission->id }}"
                                                @if($role->permissions->contains($permission->id)) checked @endif
                                            >
                                            <label class="custom-control-label" for="permission_{{ $permission->id }}">
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
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

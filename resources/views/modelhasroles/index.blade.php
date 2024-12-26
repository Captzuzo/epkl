@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Model Role</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboardAdmin') }}">Home</a></li>
                        <li class="breadcrumb-item active">Data Model Role</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            {{-- <a href="{{ route('admin.modelhasroles.create') }}" class="btn btn-primary mb-3">Assign Role</a> --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Model Role</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Role</th>
                                        <th>Model Type</th>
                                        {{-- <th>Model</th>
                                        <th>Actions</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($modelHasRoles as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->role->name }}</td>
                                        <td>{{ $item->model_type }}</td>
                                        {{-- <td>{{ $item->user->name ?? 'No model' }}</td>
                                        <td>
                                            <a href="{{ route('admin.modelhasroles.edit', $item->role_id) }}" class="btn btn-info">Edit</a>
                                            <form action="{{ route('admin.modelhasroles.destroy', $item->role_id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td> --}}
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

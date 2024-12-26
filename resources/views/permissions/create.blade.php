@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Create Permission</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Daftar Role Permission</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Role Permissions</h3>
                        </div>
                        <form action="{{ route('permissions.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <!-- Name Input -->
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">Permission Name:</label>
                                    <input type="text" name="name" id="name" class="form-control" required placeholder="Enter permission name">
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="card-footer d-flex justify-content-between">
                                <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Back to List</a>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}'
        });
    </script>
@elseif (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session('error') }}'
        });
    </script>
@endif
@endsection

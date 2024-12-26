@extends('layouts.main')

@section('content')
    <h1>Edit Permission</h1>

    <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ $permission->name }}" required>
        </div>

        <button type="submit">Update</button>
    </form>
@endsection

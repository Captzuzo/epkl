@extends('layouts.app')

@section('title', 'Forbidden')

@section('content')
<div class="error-page">
    <h2 class="headline text-warning"> 403</h2>
    <div class="error-content">
        <h3><i class="fas fa-exclamation-triangle text-warning"></i> Akses ditolak.</h3>
        <p>
            Anda tidak memiliki izin untuk mengakses halaman ini.
        </p>
    </div>
</div>
@endsection

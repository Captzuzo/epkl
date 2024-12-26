@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Pembagian Pembimbing</h1>
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            Daftar Siswa yang Belum Mendapatkan Pembimbing
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Jurusan</th>
                        <th>Instansi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pembagians as $p)
                    <tr>
                        <td>{{ $p->nis }}</td>
                        <td>{{ $p->nama_siswa }}</td>
                        <td>{{ $p->jurusan->nama_jurusan }}</td>
                        <td>{{ $p->instansi->nama_instansi }}</td>
                        <td>
                            <form action="{{ route('pembagian.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="nis" value="{{ $p->nis }}">
                                <select name="nip" class="form-select" required>
                                    @foreach($guruPembimbing as $guru)
                                    <option value="{{ $guru->nip }}">{{ $p->nama_guru }}</option>
                                    @endforeach
                                </select>
                                <select name="id_instansi" class="form-select" required>
                                    @foreach($instansi as $inst)
                                    <option value="{{ $inst->id_instansi }}">{{ $inst->nama_instansi }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary">Bagi Pembimbing</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

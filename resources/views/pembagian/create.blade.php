<!-- resources/views/pembagian/create.blade.php -->

@extends('layout.main')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Form Pembagian Pembimbing</h2>
                </div>

                <div class="card-body">
                    <!-- Daftar Siswa yang Belum Mendapatkan Pembimbing -->
                    <h4 class="mb-3">Daftar Siswa yang Belum Mendapatkan Pembimbing</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>NIS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($siswaBelumDibimbing as $index => $siswa)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $siswa->nama_siswa }}</td>
                                        <td>{{ $siswa->nis }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Tidak ada siswa yang belum mendapatkan pembimbing.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Form Pembagian Pembimbing -->
                    <form action="{{ route('admin.pembagian.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nis">Pilih Siswa</label>
                            <select name="nis" id="nis" class="form-control" required>
                                <option value="">Pilih Siswa</option>
                                @foreach($siswaBelumDibimbing as $siswa)
                                    <option value="{{ $siswa->nis }}">{{ $siswa->nama_siswa }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nip">Pilih Pembimbing</label>
                            <select name="nip" id="nip" class="form-control" required>
                                <option value="">Pilih Pembimbing</option>
                                @foreach($pembimbing as $pembimbing)
                                    <option value="{{ $pembimbing->nip }}">{{ $pembimbing->nama_guru }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success mt-3">Bagi Pembimbing</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

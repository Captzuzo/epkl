@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Pengajuan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Pengajuan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Pengajuan</h3>
                        </div>

                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('admin.pengajuan.store') }}" method="POST">
                                @csrf

                                <!-- Jurusan -->
                                <div class="form-group">
                                    <label for="id_jurusan">Jurusan</label>
                                    <select name="id_jurusan" id="id_jurusan" class="form-control">
                                        <option value="">Select Jurusan</option>
                                        @foreach ($jurusans as $jurusan)
                                            <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                  
                                <!-- NIS (Siswa) -->
                                <div class="form-group">
                                    <label for="nis">Siswa</label>
                                    <select name="nis" id="nis" class="form-control">
                                        <option value="">Select Siswa</option>
                                    </select>
                                </div>

                                <!-- Instansi -->
                                <div class="form-group">
                                    <label for="id_instansi">Instansi</label>
                                    <select name="id_instansi" id="id_instansi" class="form-control">
                                        <option value="">Select Instansi</option>
                                        @foreach ($instansis as $instansi)
                                            <option value="{{ $instansi->id }}">{{ $instansi->nama_instansi }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Periode -->
                                <div class="form-group">
                                    <label for="id_periode">Periode</label>
                                    <select name="id_periode" id="id_periode" class="form-control">
                                        <option value="">Select Periode</option>
                                        @foreach ($periodes as $periode)
                                            <option value="{{ $periode->id }}" 
                                                data-start="{{ $periode->start_date }}" 
                                                data-end="{{ $periode->end_date }}">
                                                {{ $periode->nama_periode }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Tanggal Mulai -->
                                <div class="form-group">
                                    <label for="tgl_mulai">Tanggal Mulai</label>
                                    <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control" required>
                                </div>

                                <!-- Tanggal Selesai -->
                                <div class="form-group">
                                    <label for="tgl_selesai">Tanggal Selesai</label>
                                    <input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control" required readonly>
                                </div>

                                <button type="submit" class="btn btn-success">Submit</button>
                                <a href="{{ route('admin.pengajuan') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</div>
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    // When a jurusan is selected, get the students that belong to that jurusan
    $('#id_jurusan').change(function() {
        var jurusanId = $(this).val();
        
        if (jurusanId) {
            $.ajax({
                url: "{{ route('admin.getSiswaByJurusan') }}",
                method: "GET",
                data: { jurusan_id: jurusanId },
                success: function(response) {
                    $('#nis').empty().append('<option value="">Select Siswa</option>'); // Clear existing options
                    $.each(response, function(index, siswas) {
                        $('#nis').append('<option value="' + siswas.nis + '">' + siswas.nama_siswa + ' (NIS: ' + siswas.nis + ')</option>');
                    });
                },
                error: function() {
                    alert('Failed to fetch siswa data.');
                }
            });
        } else {
            $('#nis').empty().append('<option value="">Select Siswa</option>');
        }
    });

    // Set tanggal selesai (6 months later) when tanggal mulai is selected
    $('#tgl_mulai').change(function() {
        var tglMulai = new Date($(this).val());
        if (!isNaN(tglMulai.getTime())) {
            tglMulai.setMonth(tglMulai.getMonth() + 6);
            $('#tgl_selesai').val(tglMulai.toISOString().split('T')[0]);
        }
    });
</script>
@endsection

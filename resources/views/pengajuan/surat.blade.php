<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Surat Pengajuan PKL</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #000;
        }
        .header {
            text-align: center;
            margin-bottom: 0;
            color: #000;
        }
        .header * {
            border: none;
            color: #000;
        }
        .header h1 {
            font-size: 22px;
        }
        .content {
            margin: 0 50px;
        }
        .logo {
            vertical-align: middle;
        }
        .header-content {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header-content img {
            margin-right: 10px;
        }

        .underline {
            border-bottom: 2px solid #000;
            margin: 20px 0;
            padding-bottom: 10px;
        }
        .footer {
            text-align: justify;
            margin: 40px 50px;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #f4f4f4;
        }
        .tanggal {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header content underline">
        <div class="header-content">
            <img src="{{ asset('img/logo jateng.png') }}" width="110px" alt="Logo SMKN 3 Kudus" class="logo">
            <div>
                <h3>PEMERINTAH PROVINSI JAWA TENGAH</h3>
                <h3>DINAS PENDIDIKAN DAN KEBUDAYAAN</h3>
                <h1>SEKOLAH MENENGAH KEJURUAN NEGERI 3 KUDUS</h1>
                <p class="alamat">
                Jalan Babalan – Prawoto, Kalirejo Undaan Kudus
                Telepon (0291) 4257006  KUDUS 59372 
                Website: http://www.smk3kudus.sch.id -  Email: smk3.kds@gmail.com
                </p>
            </div>
        </div>
    </div>
    
    <div class="tanggal">
        <p>Kudus, {{ $tanggal_indo }}</p>
    </div>
    
    <div class="content">
        <p>Nomor: </p>
        <p>Kepada Yth.</p>
        <p>Bapak/Ibu Pimpinan</p>
        <p>{{ $pengajuans->instansis->nama_instansi }}</p>
        <p>Di Tempat</p>

        <p>Dengan hormat,</p>
        <p>Perkenankan dengan segala kerendahan hati kami memohonkan kepada Bapak/Ibu pimpinan perusahaan untuk dapat memberikan tempat untuk Praktik Kerja Lapangan (PKL) bagi para siswa Teknik Kendaraan Ringan Otomotif dibawah ini guna meningkatkan sikap, pengetahuan dan keterampilan siswa.</p>
        <p>Adapun pelaksanaan PKL sebagai berikut:</p>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>Jurusan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>{{ $pengajuans->siswa->nama_siswa }}</td>
                    <td>{{ $pengajuans->siswa->nis }}</td>
                    <td>{{ $pengajuans->jurusan->nama_jurusan }}</td>
                </tr>
            </tbody>
        </table>
        
        <p>Demikian permohonan kami ajukan, besar harapan kami untuk terkabulnya permohonan ini, atas perhatian dan kerja sama yang baik, kami ucapkan terima kasih.</p>
    </div>

    <div class="footer">
        <div class="signature">
            <p>Hormat kami,</p>
            <p>Kepala Sekolah</p>
            <p><br><br></p>
            <p><strong>Aries Budiyono, S. Pd., M. T</strong></p>
            <p><strong>NIP. 19760711 200312 1 006</strong></p>
        </div>
    </div>
</body>

<script>
    window.onload = function() {
        window.print();
    }
</script>
</html>


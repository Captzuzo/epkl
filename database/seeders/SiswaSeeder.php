<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data dummy untuk siswa
        $siswas = [
            [
                'nis' => '10001',
                'nama_siswa' => 'Andi Pratama',
                'kelas' => '11',
                'id_periode' => 4,
                'id_jurusan' => 1,
                'alamat' => 'Jl. Raya No. 1',
                'kota' => 'Jakarta',
                'ttl' => '2005-01-01',
                'no_telp' => '081234567890',
                'email' => 'andi.pratama@example.com',
                'username' => 'andi.pratama',
                'password' => Hash::make('10001'), // Nis dijadikan password yang di-hash
            ],
            [
                'nis' => '10002',
                'nama_siswa' => 'Budi Santoso',
                'kelas' => '11',
                'id_periode' => 4,
                'id_jurusan' => 2,
                'alamat' => 'Jl. Merdeka No. 2',
                'kota' => 'Bandung',
                'ttl' => '2005-02-02',
                'no_telp' => '081234567891',
                'email' => 'budi.santoso@example.com',
                'username' => 'budi.santoso',
                'password' => Hash::make('10002'),
            ],
            [
                'nis' => '10003',
                'nama_siswa' => 'Citra Dewi',
                'kelas' => '11',
                'id_periode' => 4,
                'id_jurusan' => 3,
                'alamat' => 'Jl. Sukajadi No. 3',
                'kota' => 'Surabaya',
                'ttl' => '2005-03-03',
                'no_telp' => '081234567892',
                'email' => 'citra.dewi@example.com',
                'username' => 'citra.dewi',
                'password' => Hash::make('10003'),
            ],
            [
                'nis' => '10004',
                'nama_siswa' => 'Doni Setiawan',
                'kelas' => '11',
                'id_periode' => 4,
                'id_jurusan' => 4,
                'alamat' => 'Jl. Pahlawan No. 4',
                'kota' => 'Yogyakarta',
                'ttl' => '2005-04-04',
                'no_telp' => '081234567893',
                'email' => 'doni.setiawan@example.com',
                'username' => 'doni.setiawan',
                'password' => Hash::make('10004'),
            ],
            [
                'nis' => '10005',
                'nama_siswa' => 'Eka Putri',
                'kelas' => '11',
                'id_periode' => 4,
                'id_jurusan' => 1,
                'alamat' => 'Jl. Melati No. 5',
                'kota' => 'Medan',
                'ttl' => '2005-05-05',
                'no_telp' => '081234567894',
                'email' => 'eka.putri@example.com',
                'username' => 'eka.putri',
                'password' => Hash::make('10005'),
            ],
            [
                'nis' => '10006',
                'nama_siswa' => 'Fahmi Alfarizi',
                'kelas' => '11',
                'id_periode' => 4,
                'id_jurusan' => 2,
                'alamat' => 'Jl. Cendana No. 6',
                'kota' => 'Semarang',
                'ttl' => '2005-06-06',
                'no_telp' => '081234567895',
                'email' => 'fahmi.alfarizi@example.com',
                'username' => 'fahmi.alfarizi',
                'password' => Hash::make('10006'),
            ],
            [
                'nis' => '10007',
                'nama_siswa' => 'Gita Aulia',
                'kelas' => '11',
                'id_periode' => 4,
                'id_jurusan' => 3,
                'alamat' => 'Jl. Duku No. 7',
                'kota' => 'Bali',
                'ttl' => '2005-07-07',
                'no_telp' => '081234567896',
                'email' => 'gita.aulia@example.com',
                'username' => 'gita.aulia',
                'password' => Hash::make('10007'),
            ],
            [
                'nis' => '10008',
                'nama_siswa' => 'Hendra Wijaya',
                'kelas' => '11',
                'id_periode' => 4,
                'id_jurusan' => 4,
                'alamat' => 'Jl. Raya No. 8',
                'kota' => 'Surakarta',
                'ttl' => '2005-08-08',
                'no_telp' => '081234567897',
                'email' => 'hendra.wijaya@example.com',
                'username' => 'hendra.wijaya',
                'password' => Hash::make('10008'),
            ],
            [
                'nis' => '10009',
                'nama_siswa' => 'Indah Wulandari',
                'kelas' => '11',
                'id_periode' => 4,
                'id_jurusan' => 1,
                'alamat' => 'Jl. Kamboja No. 9',
                'kota' => 'Malang',
                'ttl' => '2005-09-09',
                'no_telp' => '081234567898',
                'email' => 'indah.wulandari@example.com',
                'username' => 'indah.wulandari',
                'password' => Hash::make('10009'),
            ],
            [
                'nis' => '10010',
                'nama_siswa' => 'Joko Santoso',
                'kelas' => '11',
                'id_periode' => 4,
                'id_jurusan' => 2,
                'alamat' => 'Jl. Mangga No. 10',
                'kota' => 'Bandung',
                'ttl' => '2005-10-10',
                'no_telp' => '081234567899',
                'email' => 'joko.santoso@example.com',
                'username' => 'joko.santoso',
                'password' => Hash::make('10010'),
            ],
            // Tambahkan 10 data lainnya sesuai pola yang sama.
        ];

        // Menyimpan data dummy ke database
        foreach ($siswas as $siswa) {
            Siswa::create($siswa);
        }
    }
}

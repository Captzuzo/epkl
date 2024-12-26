<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Pastikan role koordinator_pkl sudah ada
       $role = Role::firstOrCreate(['name' => 'koordinator_pkl']);
        
       // Membuat User dengan data yang diinginkan
       $user = User::create([
           'nis' => '0', // NIS
           'nip' => '0', // NIP (kosong jika tidak ada)
           'nama' => 'Admin', // Nama pengguna
           'no_telp' => '08111', // Nomor telepon
           'email' => 'admin@gmail.com', // Email pengguna
           'username' => 'admin', // Username
           'password' => Hash::make('admin'), // Password yang sudah di-hash
       ]);

       // Menambahkan role koordinator_pkl ke user yang baru dibuat
       $user->assignRole('koordinator_pkl');
    }
}

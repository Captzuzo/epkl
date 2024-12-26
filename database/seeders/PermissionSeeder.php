<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat role
        $role_koordinator = Role::updateOrCreate(['name' => 'koordinator_pkl']);
        $role_pembimbing = Role::updateOrCreate(['name' => 'pembimbing']);
        $role_siswa = Role::updateOrCreate(['name' => 'siswa']);

        // Membuat permission
        $permission = Permission::updateOrCreate([
            'name' => 'view_dashboardAdmin',
        ], [
            'name' => 'view_dashboardAdmin',
        ]);

        // Membuat permission
        $permission2 = Permission::updateOrCreate([
            'name' => 'view_dashboardPembimbing',
        ], [
            'name' => 'view_dashboardPembimbing',
        ]);
        
        // Membuat permission
        $permission3 = Permission::updateOrCreate([
            'name' => 'view_dashboardSiswa',
        ], [
            'name' => 'view_dashboardSiswa',
        ]);
        // Memberikan permission kepada role yang sesuai
        $role_koordinator->givePermissionTo($permission); // Memberikan permission ke koordinator
        $role_siswa->givePermissionTo($permission3);  // Memberikan permission ke siswa
        $role_pembimbing->givePermissionTo($permission2);  // Memberikan permission ke pembimbing

        // Menugaskan role 'koordinator_pkl' ke user dengan ID 1
        $user = User::find(1);  // Cari user dengan ID 1


        $user->assignRole('koordinator_pkl');

                
    }
}

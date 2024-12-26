<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    // Menampilkan semua role
    public function index()
    {
        $roles = Role::all(); // Mengambil semua role dari tabel roles
        return view('roles.roles', compact('roles')); // Ubah 'roles.roles' menjadi 'roles.index' jika view file Anda bernama 'index.blade.php'
    }

    // Menampilkan form untuk membuat role baru
    public function create()
    {
        return view('roles.create'); // Mengarahkan ke view create
    }

    // Menyimpan role baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:roles,name|max:255',  // Validasi name role
            'guard_name' => 'required|max:255', // Validasi guard_name
        ]);

        // Membuat role baru
        Role::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        return redirect()->route('admin.roles')->with('success', 'Role berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit role
    public function edit($role_id)
    {
        $role = Role::findOrFail($role_id);
        return view('roles.edit', compact('role')); // Mengarahkan ke view edit
    }

    // Mengupdate role
    public function update(Request $request, $role_id)
    {
        $validated = $request->validate([
            'name' => 'required|unique:roles,name,' . $role_id . '|max:255', // Validasi name role
            'guard_name' => 'required|max:255',
        ]);

        $role = Role::findOrFail($role_id);
        $role->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        return redirect()->route('admin.roles')->with('success', 'Role berhasil diupdate!');
    }

    // Menghapus role
    public function hapus($role_id)
    {
        $role = Role::findOrFail($role_id);

        // Pastikan role 'admin' tidak dapat dihapus
        if ($role->name !== 'admin') {
            $role->delete();
            return redirect()->route('admin.roles')->with('success', 'Role berhasil dihapus!');
        }

        return redirect()->route('admin.roles')->with('error', 'Role admin tidak bisa dihapus!');
    }
}

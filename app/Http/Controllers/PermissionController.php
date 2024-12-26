<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    // Menampilkan daftar permissions
    public function index()
    {
        $permissions = Permission::all();
        return view('permissions.index', compact('permissions'));
    }

    // Menampilkan form untuk membuat permission baru
    public function create()
    {
        $permissions = Permission::all(); // Misal mengambil data permission
        return view('permissions.create');
    }

    // Menyimpan permission baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions',
        ]);

        Permission::create(['name' => $request->name]);

        return redirect()->route('permissions.index')->with('success', 'Permission berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit permission
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.edit', compact('permission'));
    }

    // Mengupdate permission yang sudah ada
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $id,
        ]);

        $permission = Permission::findOrFail($id);
        $permission->update(['name' => $request->name]);

        return redirect()->route('permissions.index')
            ->with('success', 'Permission berhasil diperbarui.');
    }

    // Menghapus permission
    public function destroy($id)
    {
        Permission::findOrFail($id)->delete();

        return redirect()->route('permissions.index')
            ->with('success', 'Permission berhasil dihapus.');
    }
}

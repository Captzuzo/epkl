<?php

namespace App\Http\Controllers;

use App\Models\HashPermission;
use App\Models\Permission;
use Illuminate\Http\Request;

class HashPermissionController extends Controller
{
    // Menampilkan daftar hash_permissions
    public function index()
    {
        

        $hashPermissions = HashPermission::all();
        // Mengambil semua data permissions dari tabel permissions

        $permissions = Permission::all();
        return view('hashPermissions.hashPermissions', compact('hashPermissions','permissions'));
    }

    // Menampilkan form untuk membuat hash_permission baru
    public function create()
    {
        $permissions = Permission::all();
        return view('hashpermissions.create', compact('permissions'));
        // return view('hashPermissions.create');
    }

    // Menyimpan hash_permission baru
    public function store(Request $request)
    {
        $request->validate([
            'permission_id' => 'required|exists:permissions,id',
            'model_type' => 'required|string',
            'model_id' => 'required|integer',
        ]);

        HashPermission::create($request->all());
        $permissions = Permission::all();

        return redirect()->route('hashPermissions', 'permissions')->with('success', 'Hash Permission berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit hash_permission
    public function edit($id)
    {
        $hashPermission = HashPermission::findOrFail($id);
        return view('hashPermissions.hashPermissions', compact('hashPermission'));
    }

    // Menyimpan perubahan hash_permission
    public function update(Request $request, $id)
    {
        $request->validate([
            'permission_id' => 'required|exists:permissions,id',
            'model_type' => 'required|string',
            'model_id' => 'required|integer',
        ]);

        $hashPermission = HashPermission::findOrFail($id);
        $hashPermission->update($request->all());

        return redirect()->route('model_has_permissions.model_has_permissions')->with('success', 'Hash Permission berhasil diperbarui.');
    }

    // Menghapus hash_permission
    public function destroy($id)
    {
        $hashPermission = HashPermission::findOrFail($id);
        $hashPermission->delete();

        return redirect()->route('model_has_permissions.model_has_permissions')->with('success', 'Hash Permission berhasil dihapus.');
    }
}

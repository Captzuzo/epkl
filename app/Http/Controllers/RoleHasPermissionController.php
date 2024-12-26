<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleHasPermissionController extends Controller
{
    // Menampilkan daftar role dan permissions
    public function index()
    {
        $roles = Role::all(); // Ambil semua role
        return view('rolehash.rolehash', compact('roles'));
    }

    
    // Menampilkan form untuk mengelola permissions untuk role
    public function edit($role_id)
    {
        $role = Role::findOrFail($role_id);
        $permissions = Permission::all(); // Ambil semua permission
        return view('rolehash.edit', compact('role', 'permissions'));
    }

    public function create()
    {
        // Get all roles and permissions from the database
        $roles = Role::all();
        $permissions = Permission::all();

        // Return the view with roles and permissions
        return view('rolehash.create', compact('roles', 'permissions'));
    }

    // Mengupdate permissions untuk role
    // public function update(Request $request, $role_id)
    // {
    //     $role = Role::findOrFail($role_id);

    //     // Menyinkronkan permissions yang dipilih untuk role
    //     $role->syncPermissions($request->permissions);

    //     return redirect()->route('rolehash')->with('success', 'Permissions untuk role berhasil diperbarui!');
    // }

    public function store(Request $request)
{
    $request->validate([
        'role_id' => 'required|exists:roles,id',
        'permissions' => 'required|array',
    ]);

    // Sync the permissions with the role
    $role = Role::findOrFail($request->role_id);
    $role->permissions()->sync($request->permissions);  // Sync permissions by their IDs

    return redirect()->route('rolehash.index')->with('success', 'Role permissions updated successfully.');
}

public function update(Request $request, $roleId)
{
    $request->validate([
        'permissions' => 'required|array',
    ]);

    $role = Role::findOrFail($roleId);
    $role->permissions()->sync($request->permissions);  // Sync permissions by their IDs

    return redirect()->route('admin.rolehash')->with('success', 'Permissions updated successfully.');
}

    // Menghapus permission dari role
    public function destroy($role_id, $permission_id)
    {
        $role = Role::findOrFail($role_id);
        $permission = Permission::findOrFail($permission_id);

        $role->revokePermissionTo($permission);

        return redirect()->route('rolehash')->with('success', 'Permission berhasil dihapus dari role!');
    }
}


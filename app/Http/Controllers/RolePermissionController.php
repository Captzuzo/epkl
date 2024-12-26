<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    // Show the list of roles and permissions
    public function index()
    {
        $roles = Role::all();
        return view('rolepermissions.rolepermissions', compact('roles'));
    }

    // Show the form to create a new role
    public function create()
    {
        $permissions = Permission::all();
        return view('rolepermissions.create', compact('permissions'));
    }

    // Store a new role
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array',
        ]);

        // Create the role
        $role = Role::create(['name' => $request->name]);

        // Attach the permissions to the role
        $role->givePermissionTo($request->permissions);

        return redirect()->route('rolepermissions.index')->with('success', 'Role created successfully');
    }

    // Show the form to edit a role
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('rolepermissions.edit', compact('role', 'permissions'));
    }

    // Update the role
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
            'permissions' => 'required|array',
        ]);

        $role = Role::findOrFail($id);
        $role->update(['name' => $request->name]);

        // Sync the permissions
        $role->syncPermissions($request->permissions);

        return redirect()->route('rolepermissions.index')->with('success', 'Role updated successfully');
    }

    // Delete the role
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('rolepermissions.index')->with('success', 'Role deleted successfully');
    }
}

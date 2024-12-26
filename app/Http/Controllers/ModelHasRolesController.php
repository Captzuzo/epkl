<?php

namespace App\Http\Controllers;

use App\Models\ModelHasRole;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class ModelHasRolesController extends Controller
{
    // Display the list of model roles
    public function index()
    {
        $modelHasRoles = ModelHasRole::with('user')->get(); // 'user' harus sesuai dengan nama fungsi relasi

        return view('modelhasroles.index', compact('modelHasRoles'));
    }

    // Show the form to assign roles to a model
    public function create()
    {
        // Get all roles and users
        $roles = Role::all();
        $users = User::all();
        return view('modelhasroles.create', compact('roles', 'users'));
    }

    // Store the new model role assignment
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'model_id' => 'required|exists:users,id',
            'model_type' => 'required|in:App\Models\User',  // Ensure that only User models can be assigned
        ]);

        // Create the model role assignment
        ModelHasRole::create([
            'role_id' => $request->role_id,
            'model_id' => $request->model_id,
            'model_type' => $request->model_type,
        ]);

        return redirect()->route('modelhasroles.index')->with('success', 'Role assigned successfully');
    }

    // Show the form to edit an existing model role assignment
    public function edit($id)
    {
        // Find the model role assignment
        $modelHasRole = ModelHasRole::findOrFail($id);
        $roles = Role::all();
        $users = User::all();
        return view('modelhasroles.edit', compact('modelHasRole', 'roles', 'users'));
    }

    // Update the model role assignment
    public function update(Request $request, $id)
    {
        // Find the model role assignment
        $modelHasRole = ModelHasRole::findOrFail($id);

        // Validate the input
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'model_id' => 'required|exists:users,id',
            'model_type' => 'required|in:App\Models\User',
        ]);

        // Update the model role assignment
        $modelHasRole->update([
            'role_id' => $request->role_id,
            'model_id' => $request->model_id,
            'model_type' => $request->model_type,
        ]);

        return redirect()->route('modelhasroles.index')->with('success', 'Role updated successfully');
    }

    // Delete a model role assignment
    public function destroy($id)
    {
        // Find the model role assignment and delete it
        $modelHasRole = ModelHasRole::findOrFail($id);
        $modelHasRole->delete();

        return redirect()->route('modelhasroles.index')->with('success', 'Role deleted successfully');
    }
}

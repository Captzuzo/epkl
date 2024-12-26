<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Spatie\Permission\Models\Role;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = auth()->user();
        $roles = Role::all();
        // Memeriksa apakah pengguna memiliki salah satu dari banyak role
        // foreach ($roles as $role) {
        //     // Make sure we're passing the role name to hasRole()
        //     if ($user->hasRole($role->name)) {
        //         return $next($request);
        //     }
        // }

        // Jika pengguna tidak memiliki salah satu role yang diperlukan
        return redirect('/')->with('error', 'You do not have permission to access this page.');
    }
}
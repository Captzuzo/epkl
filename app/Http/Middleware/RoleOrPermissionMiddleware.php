<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Spatie\Permission\Traits\HasRoles;

class RoleOrPermissionMiddleware
{
    use HasRoles;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$rolesAndPermissions
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$rolesAndPermissions)
    {
        // Check if user has any of the roles or permissions
        $user = auth()->user();
        
        foreach ($rolesAndPermissions as $roleOrPermission) {
            if ($user->hasRole($roleOrPermission) || $user->can($roleOrPermission)) {
                return $next($request);
            }
        }

        // If none of the roles or permissions match, redirect with error
        return redirect('/')->with('error', 'You do not have permission to access this page.');
    }
}

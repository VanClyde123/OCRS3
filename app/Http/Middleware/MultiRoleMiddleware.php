<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class MultiRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles)
    {
         
        if (!Auth::check()) {
            return redirect('/')->with('error', 'Please log in to access this page.');
        }

        $roles = explode('|', $roles);

        foreach ($roles as $role) {
            if ($this->checkRole($role)) {
                return $next($request);
            }
        }

        Auth::logout();
        return redirect('/')->with('error', 'Unauthorized access.');
    }

    private function checkRole($role)
    {
        $user = Auth::user();

        switch ($role) {
            case 'admin':
                return $user->role == 1 || $user->secondary_role == 2;
            case 'instructor':
                return $user->role == 2 || $user->secondary_role == 1;
            case 'secretary':
                return $user->role == 4 || $user->secondary_role == 1;
            default:
                return false;
        }
    }
}

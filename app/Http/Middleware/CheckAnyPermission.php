<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAnyPermission
{
    public function handle($request, Closure $next, ...$permissions)
    {
        if (Auth::check()) {
            foreach ($permissions as $permission) {
                if ($request->user()->can($permission)) {
                    return $next($request);
                }
            }
        }

        abort(403, 'No tienes permiso para acceder a esta página.');
    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role !== $role) {
                abort(403, 'Bu sayfaya erişim yetkiniz yok.');
            }
        }

        return $next($request);
    }
}

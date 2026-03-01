<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;

class EnsureUserOwnsTeam
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        $routeTeamSlug = $request->route('team_slug');

        if ($user->isSuperAdmin()) {
            return $next($request); // Süper admin her takımı görebilir
        }

        if (!$user->team || $user->team->slug !== $routeTeamSlug) {
            abort(403, 'Bu takıma erişim yetkiniz yok.');
        }

        return $next($request);
    }
}

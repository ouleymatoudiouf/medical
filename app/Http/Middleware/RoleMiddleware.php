<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Vous devez être connecté.');
        }

        // Utilisation de Spatie pour vérifier le rôle
        if (!auth()->user()->hasRole($role)) {
            abort(403, "Accès refusé. Vous n'avez pas le rôle requis.");
        }

        return $next($request);
    }
}

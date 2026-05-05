<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifie si utilisateur connecté ET admin
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // Sinon on bloque
        return redirect('/')->with('error', 'Accès refusé');
    }
}

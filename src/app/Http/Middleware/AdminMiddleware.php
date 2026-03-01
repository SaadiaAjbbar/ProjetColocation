<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }else{
            return redirect()->route('dashboardAdmin')->with('error', 'Accès refusé : vous devez être admin global.');
        }

        abort(403, 'Accès refusé : vous devez être admin global.');

    }
}



<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class virifie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user->role == 'utilisateur') {
            $adhesions = $user->adhesions()->where('left_at', null)->first();
            if ($adhesions && $adhesions->role == 'owner') {
                return redirect()->route('dashboardOwner', ['colocation' => $adhesions->colocation_id]);
            }elseif ($adhesions && $adhesions->role == 'member') {
                return redirect()->route('dashboardMember', ['colocation' => $adhesions->colocation_id]);
            }
            return $next($request);
        } elseif ($user->role == 'admin') {
            return redirect()->route('dashboardAdmin');
        } else {
            return redirect()->route('login');
        }
    }
}

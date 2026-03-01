<?php

namespace App\Http\Middleware;

use App\Models\Adhesion;
use App\Models\Colocation;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class is_owner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $colocation = $request->route('colocation');
        $user = Auth::user();
        if (!is_string($colocation)) {
            $colocation = $colocation->id;
        }
        // dd($colocation);
        // die();

        if ($user->role == 'utilisateur') {
            $adhesion = Adhesion::where('user_id', $user->id)->where('colocation_id', $colocation)->where('left_at', null)->first();

            if ($adhesion && $adhesion->role == 'owner') {
                return $next($request);
            } else {
                return redirect()->route('dashboardUser');
            }
        } else {
            $adhesion = Adhesion::where('user_id', $user->id)->where('colocation_id', $colocation)->where('left_at', null)->first();

            if ($adhesion && $adhesion->role == 'owner') {
                return $next($request);
            } else {
                return redirect()->route('dashboardUser');
            }
            return redirect()->route('dashboardAdmin');
        }
    }
}

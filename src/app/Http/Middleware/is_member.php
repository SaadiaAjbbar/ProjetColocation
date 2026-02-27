<?php

namespace App\Http\Middleware;

use App\Models\Adhesion;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class is_member
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
            $adhesion = Adhesion::where('user_id', $user->id)->where('left_at', null)->first();

            if ($adhesion && $adhesion->role == "member") {
                return $next($request);
            }else{
                return redirect()->route("dashboard");
            }
        } else {
            return redirect()->route("dashboardAdmin");
        }
    }
}

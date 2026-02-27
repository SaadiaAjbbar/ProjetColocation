<?php

namespace App\Http\Middleware;

use App\Models\Adhesion;
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
        $user = Auth::user();
        $adhesion = Adhesion::where('user_id', $user->id)->where('left_at', null)->first();
        if ($user && $adhesion->role == "owner") {
            return $next($request);
        }else if($user && $adhesion->role=="member"){
            return redirect()->route('dashboardMember');
        }else{
            return abort(403);
        }
    }
}

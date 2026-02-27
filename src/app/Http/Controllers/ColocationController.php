<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColocationController extends Controller
{
    public function dashboard(Colocation $colocation)
{
    $user = Auth::user();

    // Check if owner
    if ($colocation->owner_id === $user->id) {

        return view('admin.colocations.dashboard_owner', compact('colocation'));
    }

    $isMember = $colocation->adhesions()
        ->where('user_id', $user->id)
        ->exists();

    if ($isMember) {

        return view('admin.colocations.dashboard_member', compact('colocation'));
    }

    // Not authorized
    abort(403);
}
}

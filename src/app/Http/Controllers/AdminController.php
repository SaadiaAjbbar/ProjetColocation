<?php

namespace App\Http\Controllers;

use App\Models\Adhesion;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Colocation;
use App\Models\Depense;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_colocations' => Colocation::count(),
            'total_depenses' => Depense::count(),
            'banned_users' => User::where('is_banni', true)->count(),
        ];

        $colocations = Colocation::with('owner', 'adhesions')->get();

        return view('admin.dashboard', compact('stats', 'colocations'));
    }

    public function createColocation()
{
    return view('admin.create_colocation');
}
public function storeColocation(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

        $colocation = Colocation::create([
            'name' => $request->name,
            'status' => 'active',
            'owner_id' => Auth::id()
        ]);

        Adhesion::create([
            'user_id' => Auth::id(),
            'colocation_id' => $colocation->id,
            'role' => 'owner'
        ]);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Colocation créée avec succès');
    }

}

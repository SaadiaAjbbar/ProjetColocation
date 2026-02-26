<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Colocation;
use App\Models\Depense;

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
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Colocation;
use App\Models\Depense;
use App\Models\DepenseParticipant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashbordController extends Controller
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
    public function dashboardOwner($id)
    {
        $colocation = Colocation::findOrFail($id);
        return view('admin.colocations.dashboard_owner', compact('colocation'));
    }

    public function dashboardUser()
    {
        return view('user.dashboard');
    }





    public function dashboardMember(Colocation $colocation)
    {


        $user = Auth::user();



        // MEMBER
        $isMember = $colocation->adhesions()
            ->where('user_id', $user->id)
            ->exists();

        if ($isMember) {

            //Total depenses de colocation
            $totalDepenses = Depense::where('colocation_id', $colocation->id)
                ->sum('montant');

            //Ma part (montant_du)
            $maPart = DepenseParticipant::whereHas('depense', function ($q) use ($colocation) {
                $q->where('colocation_id', $colocation->id);
            })
                ->where('utilisateur_id', $user->id)
                ->sum('montant_du');

            // Total que jai payee
            $jaiPaye = Depense::where('colocation_id', $colocation->id)
                ->where('payeur_id', $user->id)
                ->sum('montant');

            // Balance
            $balance = $jaiPaye - $maPart;

            // Nombre membres
            $membersCount = $colocation->adhesions()->count();

            return view('admin.colocations.dashboard_member', compact(
                'colocation',
                'totalDepenses',
                'maPart',
                'jaiPaye',
                'balance',
                'membersCount'
            ));
        }

        abort(403);
    }
}

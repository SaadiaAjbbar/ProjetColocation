<?php

namespace App\Http\Controllers;

use App\Models\Adhesion;
use App\Models\User;
use App\Models\Colocation;
use App\Models\Depense;
use App\Models\DepenseParticipant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashbordController extends Controller
{
    public function dashboardAdmin()
    {
        $stats = [
            'total_users' => User::count(),
            'total_colocations' => Colocation::count(),
            'total_depenses' => Depense::count()
        ];

        $colocations = Colocation::with('owner', 'adhesions')->get();

        return view('admin.dashboard', compact('stats', 'colocations'));
    }
    public function dashboardOwner($id)
    {
        $colocation = Colocation::findOrFail($id);
        //li khales howa li kayn f depense payeur_id
        $depenses = Depense::where('colocation_id', $id)->where('payeur_id', Auth::id())->get();
        $usersTotals = [];
        foreach ($depenses as $depense) {
            $participants = DepenseParticipant::where('depense_id', $depense->id)->where('is_paid', false)->get();
            foreach ($participants as $participant) {
                $user = User::find($participant->utilisateur_id);

                if (!isset($usersTotals[$user->id])) {

                    $usersTotals[$user->id] = [
                        'user' => $user,
                        'montant_du' => 0,
                    ];

                }
                $usersTotals[$user->id]['montant_du'] += $participant->montant_du;
            }
        }
        // hado likhalso 3elih
        $colocationParticipants = DepenseParticipant::where('utilisateur_id', Auth::id())
            ->where('is_paid', false)
            ->whereHas('depense', function ($query) use ($id) {
                $query->where('colocation_id', $id);
            })
            ->get();

        foreach ($colocationParticipants as $participant) {
            $depense = $participant->depense;
            $user = User::find($depense->payeur_id);
            if (!isset($usersTotals[$user->id])) {
                $usersTotals[$user->id] = [
                    'user' => $user,
                    'montant_du' => 0,
                ];
            }
            $usersTotals[$user->id]['montant_du'] -= $participant->montant_du;
        }
        // dd($usersTotals);
        // die();

        return view('owner.dashboard_owner', compact('colocation', 'usersTotals'));
    }

    public function dashboardUser()
    {
        return view('user.dashboard');
    }

    public function dashboardMember(Colocation $colocation)
    {
        //  if ($colocation->status === 'inactive') {
        //     abort(403);
        // }
        $id = $colocation->id;

        $depenses = Depense::where('colocation_id', $id)->where('payeur_id', Auth::id())->get();
        $usersTotals = [];
        foreach ($depenses as $depense) {
            $participants = DepenseParticipant::where('depense_id', $depense->id)->where('is_paid', false)->get();
            foreach ($participants as $participant) {
                $user = User::find($participant->utilisateur_id);

                if (!isset($usersTotals[$user->id])) {
                    $usersTotals[$user->id] = [
                        'user' => $user,
                        'montant_du' => 0,
                    ];
                }
                $usersTotals[$user->id]['montant_du'] += $participant->montant_du;
            }
        }
        // hado likhalso 3elih
        $colocationParticipants = DepenseParticipant::where('utilisateur_id', Auth::id())
            ->where('is_paid', false)
            ->whereHas('depense', function ($query) use ($id) {
                $query->where('colocation_id', $id);
            })
            ->get();

        foreach ($colocationParticipants as $participant) {
            $depense = $participant->depense;
            $user = User::find($depense->payeur_id);
            if (!isset($usersTotals[$user->id])) {
                $usersTotals[$user->id] = [
                    'user' => $user,
                    'montant_du' => 0,
                ];
            }
            $usersTotals[$user->id]['montant_du'] -= $participant->montant_du;
        }

        $user = Auth::user();

        // MEMBER
        $isMember = $colocation->adhesions()->where('user_id', $user->id)->exists();

        if ($isMember) {
            //Total depenses de colocation
            $totalDepenses = Depense::where('colocation_id', $colocation->id)->sum('montant');

            //Ma part (montant_du)
            $maPart = DepenseParticipant::whereHas('depense', function ($q) use ($colocation) {
                $q->where('colocation_id', $colocation->id);
            })
                ->where('utilisateur_id', $user->id)
                ->sum('montant_du');

            // Total que jai payee
            $jaiPaye = Depense::where('colocation_id', $colocation->id)->where('payeur_id', $user->id)->sum('montant');

            // Balance
            $balance = $jaiPaye - $maPart;

            // Nombre membres
            $membersCount = $colocation->adhesions()->count();

            return view('member.dashboard_member', compact('colocation', 'totalDepenses', 'maPart', 'jaiPaye', 'balance', 'membersCount', 'usersTotals'));
        }

        abort(403);
    }
}

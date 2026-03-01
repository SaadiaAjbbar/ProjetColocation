<?php

namespace App\Http\Controllers;

use App\Models\Adhesion;
use App\Models\Colocation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ColocationController extends Controller
{
    // public function dashboard(Colocation $colocation)
    // {
    //     if ($colocation->status === 'inactive') {
    //         abort(403);
    //     }
    //     $user = Auth::user();

    //     // Check if owner
    //     if ($colocation->owner_id === $user->id) {
    //         return view('admin.colocations.dashboard_owner', compact('colocation'));
    //     }

    //     $isMember = $colocation->adhesions()
    //         ->where('user_id', $user->id)
    //         ->exists();

    //     if ($isMember) {

    //         return view('admin.colocations.dashboard_member', compact('colocation'));
    //     }

    //     abort(403);
    // }

    //annuler colocation
    public function cancel(Colocation $colocation)
    {
        $user = Auth::user();
        $adhesion = Adhesion::where('user_id', $user->id)
            ->where('colocation_id', $colocation->id)
            ->first();
        foreach ($colocation->adhesions as $adhesion) {
            if ($adhesion->user_id !== $user->id) {
                $adhesion->left_at = now();
                $adhesion->save();
            }
        }

        if ($colocation->owner_id !== $user->id) {
            abort(403);
        }

        if ($colocation->status === 'inactive') {
            return redirect()->back();
        }

        $colocation->status = 'inactive';
        $colocation->save();

        User::where('id', $user->id)->decrement('reputation');

        return redirect()->route('dashboardAdmin')->with('success', 'Colocation annulée avec succès');
    }

    public function createColocation()
    {
        return view('colocation.create_colocation');
    }

    public function storeColocation(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $colocation = Colocation::create([
            'name' => $request->name,
            'status' => 'active',
            'owner_id' => Auth::id(),
        ]);

        Adhesion::create([
            'user_id' => Auth::id(),
            'colocation_id' => $colocation->id,
            'role' => 'owner',
        ]);

        return redirect()->route('dashboardUser')->with('success', 'Colocation créée avec succès');
    }

    public function colocations()
    {
        $colocations = Colocation::with('owner', 'adhesions')->get();
        return view('admin.colocations.index', compact('colocations'));
    }

    public function myColocation()
    {
        $user = Auth::user();

        $colocations = Colocation::where('owner_id', $user->id)
            ->orWhereHas('adhesions', function ($query) use ($user) {
                $query->where('user_id', $user->id)->where('left_at', null);
            })
            ->withCount(['adhesions', 'depenses'])
            ->with('adhesions')
            ->get();



        return view('colocation.my_colocations.index', compact('colocations'));
    }

    public function members(Colocation $colocation)
    {
        $user = Auth::user();

        $isOwner = $colocation->owner_id === $user->id;
        $isMember = $colocation->adhesions()
            ->where('user_id', $user->id)
            ->exists();

        if (!$isOwner && !$isMember) {
            abort(403);
        }

        $members = $colocation->adhesions()
            ->with('user')
            ->get();

        return view('colocation.members', compact('colocation', 'members'));
    }


    public function leave(Colocation $colocation)
    {
        $user = Auth::user();

        $balance = $this->calculateUserBalance($user->id, $colocation->id);

        if ($balance < 0) {
            $user->reputation -= 1;
            User::where('id', $user->id)->decrement('reputation');
        }

        // Supprimer relation
        $variable=$colocation->adhesions()->where('user_id',$user->id)->first();
        $variable->left_at=now();
        $variable->save();

        return redirect()->route('my_colocations.index')
            ->with('success', 'Vous avez quitté la colocation.');
    }
    private function calculateUserBalance($userId, $colocationId)
    {
        $totalDu = DB::table('depense_participants')
            ->join('depenses', 'depenses.id', '=', 'depense_participants.depense_id')
            ->where('depenses.colocation_id', $colocationId)
            ->where('depense_participants.utilisateur_id', $userId)
            ->sum('depense_participants.montant_du');

        $totalPaye = DB::table('depenses')
            ->where('colocation_id', $colocationId)
            ->where('payeur_id', $userId)
            ->sum('montant');

        return $totalPaye - $totalDu;
    }

    public function depenses(Colocation $colocation)
    {
        $user = Auth::user();

        $isOwner = $colocation->owner_id === $user->id;
        $isMember = $colocation->adhesions()
            ->where('user_id', $user->id)
            ->exists();

        if (!$isOwner && !$isMember) {
            abort(403);
        }

        $depenses = $colocation->depenses()->with('payeur')->get();

        return view('colocation.depenses', compact('colocation', 'depenses'));
    }

}




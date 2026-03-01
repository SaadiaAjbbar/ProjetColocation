<?php

namespace App\Http\Controllers;

use App\Models\DepenseParticipant;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function valider($colocationId, $userId)
    {
        $depenseParticipants = DepenseParticipant::where('utilisateur_id', $userId)
            ->whereHas('depense', function ($query) use ($colocationId) {
                $query->where('colocation_id', $colocationId);
            })
            ->get();

        foreach($depenseParticipants as $depenseParticipant){
            $depenseParticipant->is_paid = true ;
            $depenseParticipant->save();
        }
        return redirect()->back()->with('success', 'Paiement validé avec succès');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Adhesion;
use App\Models\Category;
use App\Models\Colocation;
use App\Models\Depense;
use App\Models\DepenseParticipant;
use Illuminate\Http\Request;

class DepenseController extends Controller
{
    public function create($id)
    {
        $colocation = Colocation::with('adhesions.user')->findOrFail($id);
        $categories = Category::where('colocation_id', $id)->get();

        return view('colocation.depenses', compact('colocation', 'categories'));
    }
    public function store(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required',
            'montant' => 'required|numeric',
            'date' => 'required|date',
            'payeur_id' => 'required',
            'categorie_id' => 'required',
            'participants' => 'required|array'
        ]);
        // dd($request->payeur_id);
        // die();

        $depense = Depense::create([
            'nom' => $request->nom,
            'montant' => $request->montant,
            'date' => $request->date,
            'payeur_id' => $request->payeur_id,
            'categorie_id' => $request->categorie_id,
            'colocation_id' => $id
        ]);

        $part = $request->montant / count($request->participants);

        foreach ($request->participants as $userId) {
            if ($userId == $request->payeur_id) {
                continue; // skip the payer
            }
            DepenseParticipant::create([
                'depense_id' => $depense->id,
                'utilisateur_id' => $userId,
                'montant_du' => $part
            ]);
        }

        return redirect()->back()->with('success', 'Dépense ajoutée avec succès');
    }
}

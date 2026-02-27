<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Colocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{


    public function create(Colocation $colocation)
    {
        if ($colocation->owner_id !== Auth::id()) {
            abort(403);
        }

        return view('admin.categories.create', compact('colocation'));
    }

    public function store(Request $request, Colocation $colocation)
    {
        if ($colocation->owner_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Category::create([
            'nom' => $request->name,
            'colocation_id' => $colocation->id
        ]);

        return redirect()
            ->route('admin.categories.index', $colocation->id)
            ->with('success', 'Catégorie ajoutée avec succès');
    }

    public function index(Colocation $colocation)
    {
        if ($colocation->owner_id !== Auth::id()) {
            abort(403);
        }
        $categories = Category::where("colocation_id" , $colocation->id)->get();


        return view('admin.categories.index', compact('colocation', 'categories'));
    }
}

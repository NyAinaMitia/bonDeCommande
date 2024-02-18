<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    //
    public function index()
    {
        $produits = Produit::all();
        return view('produits.index', compact('produits'));
    }

    public function create()
    {
        return view('produits.create');
    }

    //gérer la création d'un produit
    public function store(Request $request)
    {
        $request->validate([
            'fournisseur_nom' => 'required|string',
            'designation' => 'required|string',
        ]);
        $fournisseur = Fournisseur::where('nom', $request->input('fournisseur_nom'))->first();
        if (!$fournisseur) {
            return redirect()->back()->with('error_fournisseur', 'Le fournisseur n\'existe pas.');
        }
    
        // Créer le produit avec la clé étrangère
        Produit::create([
            'fournisseur_id' => $fournisseur->id,
            'designation' => $request->input('designation'),
        ]);
        session()->flash('success', 'Produit ajouté avec succès');
        return redirect()->route('produits.index');
    }

    //affiche les détails d'un produit spécifique à l'aide du paramètre produits $produits
    public function show(Produit $produit)
    {
        return view('produits.show', compact('produit'));
    }

    public function edit(Produit $produit)
    {
        return view('produits.edit', compact('produit'));
    }

    //gérer la modification d'un produit
    public function update(Request $request, Produit $produit)
    {
        $request->validate([
            'fournisseur_nom' => 'required|string',
            'designation' => 'required|string',
        ]);
            // Vérifier si le fournisseur existe
        $fournisseur = Fournisseur::where('nom', $request->input('fournisseur_nom'))->first();

        if (!$fournisseur) {
            return redirect()->back()->with('error', 'Le fournisseur n\'existe pas.');
        }

        // Mettre à jour les informations du produit
        $produit->update([
            'fournisseur_id' => $fournisseur->id,
            'designation' => $request->input('designation'),
        ]);
    
        return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec succès');
    }

    public function destroy(Produit $produit)
    {
        $produit->delete();
        return redirect()->route('produits.index')->with('success', '   Produit supprimé avec succès');
    }
}

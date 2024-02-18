<?php

namespace App\Http\Controllers;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    //
    public function index()
    {
        $fournisseurs = Fournisseur::all();
        return view('fournisseurs.index', compact('fournisseurs'));
    }

    public function create()
    {
        return view('fournisseurs.create');
    }

    //gérer la création d'un utilisateur
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'reference_iris' => 'required',
        ]);
        Fournisseur::create($request->all());
        session()->flash('success', 'Fournisseur ajouté avec succès');
        return redirect()->route('fournisseurs.index');
    }

    //affiche les détails d'un utilisateur spécifique à l'aide du paramètre Fournisseurs $fournisseurs
    public function show(Fournisseur $fournisseur)
    {
        return view('fournisseurs.show', compact('fournisseur'));
    }

    public function edit(Fournisseur $fournisseur)
    {
        return view('fournisseurs.edit', compact('fournisseur'));
    }

    //gérer la modification d'un utilisateur
    public function update(Request $request, Fournisseur $fournisseur)
    {
        $request->validate([
            'nom' => 'required',
            'reference_iris' => 'required:fournisseurs,reference_iris,' . $fournisseur->id,
        ]);

        $fournisseur->update($request->all());

        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur mis à jour avec succès');
    }

    public function destroy(Fournisseur $fournisseur)
    {
        $fournisseur->delete();
        return redirect()->route('fournisseurs.index')->with('success', '   Fournisseur supprimé avec succès');
    }
}

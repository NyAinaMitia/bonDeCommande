<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    //gérer la création d'un utilisateur
    public function store(Request $request)
    {
        $request->validate([
            'service' => 'required',
            'agence' => 'required',
            'password' => 'required|min:6',
        ]);
        $hashedPassword = Hash::make($request->password);

        User::create([
            'service' => $request->service,
            'agence' => $request->agence,
            'password' => $hashedPassword,
        ]);
        session()->flash('success', 'Utilisateur créé avec succès');
        return redirect()->route('users.index');
    }

    //affiche les détails d'un utilisateur spécifique à l'aide du paramètre User $user
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    //gérer la modification d'un utilisateur
    public function update(Request $request, User $user)
    {
        $request->validate([
            'service' => 'required',
            'agence' => 'required',
            'password' => 'required|min:6',
        ]);

        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès');
    }
}

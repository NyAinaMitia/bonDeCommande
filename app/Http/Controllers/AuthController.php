<?php
// AuthController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // Assurez-vous que le nom de la vue correspond au chemin correct
    }

    public function login(Request $request)
    {
        $credentials = $request->only('service', 'agence', 'password');
        //dd($credentials, Auth::attempt($credentials));


        if (Auth::attempt($credentials)) {
            // Authentification réussie
            return redirect('/');
        } else {
            // Authentification échouée
            return back()->withErrors(['message' => 'Login failed.']);
        }
    }
}


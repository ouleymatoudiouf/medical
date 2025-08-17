<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Formulaire login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Traitement login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirection selon rôle
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard')->with('success', 'Bienvenue Admin');
            } elseif ($user->hasRole('doctor')) {
                return redirect()->route('medecin.dashboard')->with('success', 'Bienvenue Médecin');
            } else {
                return redirect()->route('dashboard')->with('success', 'Bienvenue Patient');
            }
        }

        return back()->withErrors(['email' => 'Identifiants incorrects'])->onlyInput('email');
    }

    // Formulaire inscription
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Traitement inscription
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Assigner le rôle patient par défaut
        $user->assignRole('patient');

        // Connexion automatique
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Inscription réussie.');
    }

    // Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Déconnexion réussie.');
    }
}

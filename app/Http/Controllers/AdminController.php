<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Page dashboard admin
    public function index()
    {
        // Récupérer uniquement les admins et médecins
        $users = User::role(['admin', 'doctor'])->get();
        return view('admin.dashboard', compact('users'));
    }

    // Formulaire création utilisateur
    public function createUser()
    {
        return view('admin.create-user');
    }

    // Enregistrement d'un nouvel utilisateur
    public function storeUser(Request $request)
    {
        // Validation des champs
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'role' => 'required|string|in:admin,doctor' // ne permettre que admin ou doctor
        ]);

        // Création de l'utilisateur
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        // Assigner le rôle choisi
        $user->assignRole($data['role']);

        // Redirection vers le dashboard admin avec message
        return redirect()->route('admin.dashboard')
            ->with('success', 'Utilisateur créé avec succès !');
    }
}

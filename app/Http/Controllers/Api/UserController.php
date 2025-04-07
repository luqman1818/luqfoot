<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // Afficher la liste des utilisateurs
    public function index()
    {
        $users = User::all();  // Récupère tous les utilisateurs
        return view('users.index', compact('users'));
    }

    // Afficher un utilisateur spécifique
    public function show($id)
    {
        $user = User::findOrFail($id);  // Trouve l'utilisateur par ID
        return view('users.show', compact('user'));
    }

    // Créer un nouvel utilisateur
    public function create()
    {
        return view('users.create');  // Affiche un formulaire pour créer un utilisateur
    }

    // Enregistrer un nouvel utilisateur
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'prenom_use' => 'required|string|max:255',
            'nom_use' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Création de l'utilisateur
        $user = User::create([
            'prenom_use' => $request->prenom_use,
            'nom_use' => $request->nom_use,
            'email' => $request->email,
            'password' => bcrypt($request->password),  // Assurer le chiffrement du mot de passe
        ]);

        return redirect()->route('users.index');  // Redirige vers la liste des utilisateurs
    }

    // Afficher le formulaire d'édition pour un utilisateur
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // Mettre à jour un utilisateur existant
    public function update(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'prenom_use' => 'required|string|max:255',
            'nom_use' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'prenom_use' => $request->prenom_use,
            'nom_use' => $request->nom_use,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        return redirect()->route('users.index');
    }

    // Supprimer un utilisateur
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index');
    }
}

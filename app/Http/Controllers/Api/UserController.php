<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserController extends Controller
{
    // Lister tous les utilisateurs
    public function index()
    {
        return response()->json(User::all());
    }

    // Afficher un utilisateur spécifique
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    // Créer un nouvel utilisateur
    public function store(Request $request)
    {

    
        $validated = $request->validate([
            'prenom_use' => 'required|string|max:255',
            'nom_use' => 'required|string|max:255',
            'adresse_use' => 'required|string|max:255', // Validation pour l'adresse
            'email_use' => 'required|email|unique:users,email_use',
            'date_naissance_use' => 'required|date', // Validation pour la date de naissance
            'mdp_use' => 'required|string|min:6',
            //'roles_id_rol' => 'required|exists:roles,id_rol',
        ]);
        $validated['date_naissance_use'] = Carbon::createFromFormat('d-m-Y', $validated['date_naissance_use'])->format('Y-m-d');

        $validated['mdp_use'] = bcrypt($validated['mdp_use']);

        $user = User::create($validated);

        return response()->json($user, 201);
    }

    // Mettre à jour un utilisateur
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'prenom_use' => 'required|string|max:255',
            'nom_use' => 'required|string|max:255',
            'adresse_use' => 'required|string|max:255', // Validation pour l'adresse
            'email_use' => 'required|email|unique:users,email_use' . $user->id,
            'date_naissance_use' => 'required|date', // Validation pour la date de naissance
            'mdp_use' => 'required|string|min:6',
            //'roles_id_rol' => 'required|exists:roles,id_rol',
        ]);

        if ($request->filled('mdp_use')) {
            $validated['mdp_use'] = bcrypt($validated['mdp_use']);
        } else {
            $validated['mdp_use'] = $user->password;
        }
        // Formater la date de naissance
        if ($request->has('date_naissance_use')) {
            $validated['date_naissance_use'] = Carbon::createFromFormat('d-m-Y', $request->input('date_naissance_use'))->format('Y-m-d');
        }

        // Trouver l'utilisateur par ID
        $user = User::find($id);

       

        $user->update($validated);

        return response()->json($user);
    }

    // Supprimer un utilisateur
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'Utilisateur supprimé']);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
{
    $request->validate([
        'email_use' => 'required|email',
        'mdp_use' => 'required',
    ]);

    $user = User::where('email_use', $request->email_use)->first();

    if (! $user || ! Hash::check($request->mdp_use, $user->mdp_use)) {
        return response()->json([
            'message' => 'Email ou mot de passe incorrect',
        ], 401);
    }

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'message' => 'Login réussi',
        'access_token' => $token,
        'token_type' => 'Bearer',
    ]);
    }

    public function logout(Request $request)
{
    $request->user()->currentAccessToken()->delete();

    return response()->json([
        'message' => 'Déconnexion réussie',
    ]);
}

public function register(Request $request)
{
    $validated = $request->validate([
        'prenom_use' => 'required|string|max:255',
        'nom_use' => 'required|string|max:255',
        'adresse_use' => 'required|string|max:255',
        'email_use' => 'required|email|unique:users,email_use',
        'date_naissance_use' => 'required|date_format:d-m-Y', 
        'mdp_use' => 'required|string|min:6',
    ]);

    $validated['date_naissance_use'] = \Carbon\Carbon::createFromFormat('d-m-Y', $validated['date_naissance_use'])->format('Y-m-d');
    $validated['mdp_use'] = Hash::make($validated['mdp_use']);

    $user = User::create($validated);

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'message' => 'Utilisateur enregistré avec succès',
        'user' => $user,
        'access_token' => $token,
        'token_type' => 'Bearer',
    ], 201);
}

}

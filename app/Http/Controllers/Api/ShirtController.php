<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Shirt;
use App\Http\Controllers\Controller;


class ShirtController extends Controller
{
    public function index()
    {
        $shirts = Shirt::all();  // Récupérer toutes les chemises
        return response()->json($shirts);
    }

    // Afficher une chemise spécifique
    public function show($id)
    {
        $shirt = Shirt::findOrFail($id);  // Trouver une chemise par ID
        return response()->json($shirt);
    }

    // Afficher le formulaire pour créer une chemise (si nécessaire pour une vue)
    public function create()
    {
        return response()->json(['message' => 'Formulaire de création']);
    }

    // Créer une nouvelle chemise
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'nom_shi' => 'required|string|max:255',
            'taille_shi' => 'required|string|max:50',
            'prix_shi' => 'required|numeric|min:0',
        ]);

        // Créer une nouvelle chemise
        $shirt = Shirt::create([
            'nom_shi' => $request->nom_shi,
            'taille_shi' => $request->taille_shi,
            'prix_shi' => $request->prix_shi,
        ]);

        return response()->json($shirt, 201);
    }

    // Modifier une chemise existante
    public function update(Request $request, $id)
    {
        $shirt = Shirt::findOrFail($id);

        // Validation des données
        $request->validate([
            'nom_shi' => 'required|string|max:255',
            'taille_shi' => 'required|string|max:50',
            'prix_shi' => 'required|numeric|min:0',
        ]);

        $shirt->update([
            'nom_shi' => $request->nom_shi,
            'taille_shi' => $request->taille_shi,
            'prix_shi' => $request->prix_shi,
        ]);

        return response()->json($shirt);
    }

    // Supprimer une chemise
    public function destroy($id)
    {
        $shirt = Shirt::findOrFail($id);
        $shirt->delete();

        return response()->json(['message' => 'Maillot supprimée']);
    }
}

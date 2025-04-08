<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    // Lister tous les rôles
    public function index()
    {
        return response()->json(Role::all());
    }

    // Afficher un rôle spécifique
    public function show($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json(['message' => 'Rôle non trouvé'], 404);
        }

        return response()->json($role);
    }

    // Créer un nouveau rôle
    public function store(Request $request)
    {
        $request->validate([
            'nom_rol' => 'required|string|max:255',
        ]);

        $role = Role::create([
            'nom_rol' => $request->nom_rol,
        ]);

        return response()->json($role, 201);
    }

    // Modifier un rôle existant
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json(['message' => 'Rôle non trouvé'], 404);
        }

        $request->validate([
            'nom_rol' => 'required|string|max:255',
        ]);

        $role->update([
            'nom_rol' => $request->nom_rol,
        ]);

        return response()->json($role);
    }

    // Supprimer un rôle
    public function destroy($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json(['message' => 'Rôle non trouvé'], 404);
        }

        $role->delete();

        return response()->json(['message' => 'Rôle supprimé avec succès']);
    }
}

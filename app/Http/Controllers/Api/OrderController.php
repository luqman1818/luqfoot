<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    // Afficher la liste de toutes les commandes
    public function index()
    {
        $orders = Order::all();  // Récupérer toutes les commandes
        return response()->json($orders);
    }

    // Afficher une commande spécifique
    public function show($id)
    {
        $order = Order::findOrFail($id);  // Trouver une commande par ID
        return response()->json($order);
    }

    // Afficher le formulaire pour créer une commande (si nécessaire pour une vue)
    public function create()
    {
        return response()->json(['message' => 'Formulaire de création']);
    }

    // Créer une nouvelle commande
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'date_ord' => 'required|date',
            'users_id_use' => 'required|exists:users,id_use',
        ]);

        // Créer une nouvelle commande
        $order = Order::create([
            'date_ord' => $request->date_ord,
            'users_id_use' => $request->users_id_use,
        ]);

        return response()->json($order, 201);
    }

    // Modifier une commande existante
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Validation des données
        $request->validate([
            'date_ord' => 'required|date',
            'users_id_use' => 'required|exists:users,id_use',
        ]);

        $order->update([
            'date_ord' => $request->date_ord,
            'users_id_use' => $request->users_id_use,
        ]);

        return response()->json($order);
    }

    // Supprimer une commande
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json(['message' => 'Commande supprimée']);
    }
}

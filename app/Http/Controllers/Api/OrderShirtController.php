<?php
namespace App\Http\Controllers\Api;

use App\Models\OrderShirt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderShirtController extends Controller
{
    // Récupérer toutes les commandes de chemises
    public function index()
    {
        $orderShirts = OrderShirt::all();
        return response()->json($orderShirts);
    }

    // Créer une nouvelle commande de chemises
    public function store(Request $request)
    {
        $orderShirt = OrderShirt::create([
            'shirts_id_shi' => $request->shirts_id_shi,
            'orders_id_ord' => $request->orders_id_ord,
            'quantite_ord_shi' => $request->quantite_ord_shi,
        ]);

        return response()->json($orderShirt, 201);
    }

   // Mettre à jour une commande de chemise
public function update(Request $request, $shirtId, $orderId)
{
    // Cherche la commande avec la combinaison shirts_id_shi et orders_id_ord
    $orderShirt = OrderShirt::where('shirts_id_shi', $shirtId)
                            ->where('orders_id_ord', $orderId)
                            ->first();

    // Si la commande n'existe pas, renvoie une erreur
    if (!$orderShirt) {
        return response()->json(['message' => 'Order not found'], 404);
    }

    // Vérifie si la combinaison shirts_id_shi et orders_id_ord existe déjà pour une autre commande
    $existing = OrderShirt::where('shirts_id_shi', $request->shirts_id_shi)
                          ->where('orders_id_ord', $request->orders_id_ord)
                          ->where('id', '!=', $orderShirt->id) // Assure-toi que ce n'est pas le même enregistrement
                          ->first();

    if ($existing) {
        return response()->json(['message' => 'Duplicate entry for this combination of shirt and order'], 400);
    }

    // Met à jour la quantité
    $orderShirt->quantite_ord_shi = $request->quantite_ord_shi;
    $orderShirt->save();

    return response()->json($orderShirt);
}


    // Supprimer une commande de chemise
    public function destroy($id)
    {
        $orderShirt = OrderShirt::findOrFail($id);
        $orderShirt->delete();

        return response()->json(null, 204);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Shirt;
use App\Models\OrderShirt;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Créer des commandes
        $orders = Order::factory()->count(5)->create();

        // Créer des chemises
        $shirts = Shirt::factory()->count(10)->create();

        // Attacher plusieurs chemises à chaque commande avec des quantités aléatoires
        $orders->each(function ($order) use ($shirts) {
            // Sélectionne entre 2 et 5 chemises aléatoires
            $randomShirts = $shirts->random(rand(2, 5));

            foreach ($randomShirts as $shirt) {
                OrderShirt::create([
                    'orders_id_ord' => $order->id_ord,
                    'shirts_id_shi' => $shirt->id_shi,
                    'quantite_ord_shi' => rand(1, 5),
                ]);
            }
        });
    }
}

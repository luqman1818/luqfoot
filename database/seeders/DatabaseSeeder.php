<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Shirt;
use App\Models\OrderShirt;


// Spatie
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        /** ---- SPATIE ROLES & PERMISSIONS ---- **/
        
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Créer une permission
        $createShirt = Permission::firstOrCreate(['name' => 'create shirt']);

        // Attribuer la permission au rôle
        $adminRole->givePermissionTo($createShirt);

        // Créer un utilisateur avec un rôle
        $admin = User::create([
            'prenom_use' => 'Anwar',
            'nom_use' => 'Hersi',
            'email_use' => 'admin@example.com',
            'mdp_use' => bcrypt('secret123'),
            'adresse_use' => 'Rue Laravel 1',
            'date_naissance_use' => '2000-01-01',
        ]);

        $admin->assignRole($adminRole);



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

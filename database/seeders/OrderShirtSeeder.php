<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderShirt;

class OrderShirtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Créer 50 enregistrements dans la table d'association order_shirts
        OrderShirt::factory(50)->create();
    }
}

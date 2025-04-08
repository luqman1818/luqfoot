<?php

namespace Database\Factories;

use App\Models\Shirt;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShirtFactory extends Factory
{
    protected $model = Shirt::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom_shi' => $this->faker->word, // Un mot aléatoire pour le nom de la chemise
            'taille_shi' => $this->faker->randomElement(['S', 'M', 'L', 'XL', 'XXL']), // Taille aléatoire
            'prix_shi' => $this->faker->randomFloat(2, 10, 100), // Prix entre 10 et 100 avec 2 décimales
        ];
    }
}

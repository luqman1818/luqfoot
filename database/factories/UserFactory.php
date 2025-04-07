<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // return [
        //     'nom_use' => fake()->lastName,
        //     'prenom_use' => fake()->firstName,
        //     'adresse_use' => fake()->firstName,
        //     'email' => fake()->unique()->safeEmail(),
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token' => Str::random(10),
        // ];
        return [
            'prenom_use' => $this->faker->firstName(),
            'nom_use' => $this->faker->lastName(),
            'adresse_use' => $this->faker->address(),
            'email_use' => $this->faker->unique()->safeEmail(),
            'mdp_use' => bcrypt('mdp_use'),  // Mot de passe par défaut
            'roles_id_rol' => \App\Models\Role::inRandomOrder()->first()->id_rol,
            'date_naissance_use' => $this->faker->date(),  // Attribuer un rôle aléatoire
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    // public function unverified()
    // {
    //     return $this->state(fn(array $attributes) => [
    //         'email_verified_at' => null,
    //     ]);
    // }
    public function admin()
    {
        return $this->state([
            'roles_id_rol' => 1, // Id du rôle "admin", à modifier selon ton modèle de rôle
        ]);
    }
}

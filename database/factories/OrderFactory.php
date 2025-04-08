<?php

namespace Database\Factories;
use App\Models\Order;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Order::class;

    public function definition()
    {
        return [
            'date_ord' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'users_id_use' => User::inRandomOrder()->value('id_use') ?? User::factory(),
        ];
    }
}

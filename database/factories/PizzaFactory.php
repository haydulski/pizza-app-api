<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pizza>
 */
class PizzaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->sentence(2, true),
            'price' => 130,
            'slug' => 'pizza-' . fake()->numberBetween(0, 500),
            'img' => fake()->imageUrl(),
            'thumbnail' => fake()->imageUrl(),
            'dough' => 'thick'
        ];
    }
}

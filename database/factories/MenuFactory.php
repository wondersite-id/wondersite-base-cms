<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3),
            'sequence_number' => fake()->numberBetween(1,10),
            'type' => 'header',
            'url' => '/',
            'is_open_in_new_tab' => fake()->boolean(),
        ];
    }
}

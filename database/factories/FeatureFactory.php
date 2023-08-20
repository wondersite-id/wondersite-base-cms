<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feature>
 */
class FeatureFactory extends Factory
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
            'slug' => fake()->slug(),
            'description' => fake()->sentences(10),
            'sequence_number' => fake()->randomDigitNotZero(),
            'image' => fake()->imageUrl(),
            'published_at' => fake()->dateTime()
        ];
    }
}

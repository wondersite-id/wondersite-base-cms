<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
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
            'short_description' => fake()->sentences(10),
            'content' => fake()->paragraphs(fake()->numberBetween(15,100)),
            'image' => fake()->imageUrl(),
            'published_at' => fake()->dateTime()
        ];
    }
}

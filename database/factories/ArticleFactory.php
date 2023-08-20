<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3),
            'slug' => fake()->slug(),
            'short_description' => fake()->sentence(10),
            'content' => fake()->paragraph(fake()->numberBetween(15,100)),
            'image' => 'https://wondersite-id.github.io/images/blogs/02.jpg',
            'published_at' => fake()->dateTime()
        ];
    }
}

<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleType;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ArticleType::factory()
            ->count(3)
            ->has(Article::factory()->count(fake()->numberBetween(1,5)), 'articles')
            ->create();

        foreach (Article::all() as $article) {
            $article->saveImageUrl('image', $article->image, 'url');

            $savedArticle = Article::find($article->id);
            $savedArticle->seo->update([
                'title' => $savedArticle->name,
                'description' => $savedArticle->short_description,
                'image' => $savedArticle->getFirstMedia('images')->getUrl(),
            ]);
        }
    }
}

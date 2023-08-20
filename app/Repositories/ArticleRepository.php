<?php

namespace App\Repositories;

use App\Interfaces\ArticleRepositoryInterface;
use App\Models\Article;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function getAll()
    {
        return Article::all();
    }

    public function findById($articleId)
    {
        return Article::findOrFail($articleId);
    }

    public function findByIdNullable($articleId)
    {
        return Article::find($articleId);
    }

    public function delete($articleId)
    {
        Article::destroy($articleId);
    }

    public function create(array $articleDetails)
    {
        return Article::create($articleDetails);
    }

    public function update($articleId, array $newDetails)
    {
        $article = Article::find($articleId);
        foreach ($newDetails as $column => $value) {
            $article->{$column} = $value;
        }
        $article->save();

        return $article;
    }
}
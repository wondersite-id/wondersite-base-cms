<?php

namespace App\Repositories;

use App\Interfaces\ArticleRepositoryInterface;
use App\Models\Article as Model;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function getAll()
    {
        return Model::all();
    }

    public function getPublished()
    {
        return Model::published()->get();
    }

    public function findById($articleId)
    {
        return Model::findOrFail($articleId);
    }

    public function findByIdNullable($articleId)
    {
        return Model::find($articleId);
    }

    public function delete($articleId)
    {
        Model::destroy($articleId);
    }

    public function create(array $articleDetails)
    {
        return Model::create($articleDetails);
    }

    public function update($articleId, array $newDetails)
    {
        $article = Model::find($articleId);
        foreach ($newDetails as $column => $value) {
            $article->{$column} = $value;
        }
        $article->save();

        return $article;
    }
}
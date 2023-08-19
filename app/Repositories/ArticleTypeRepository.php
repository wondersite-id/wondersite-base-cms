<?php

namespace App\Repositories;

use App\Interfaces\ArticleTypeRepositoryInterface;
use App\Models\ArticleType;

class ArticleTypeRepository implements ArticleTypeRepositoryInterface
{
    public function getAll()
    {
        return ArticleType::all();
    }

    public function findById($articleTypeId)
    {
        return ArticleType::findOrFail($articleTypeId);
    }

    public function findByIdNullable($articleTypeId)
    {
        return ArticleType::find($articleTypeId);
    }

    public function delete($articleTypeId)
    {
        ArticleType::destroy($articleTypeId);
    }

    public function create(array $articleTypeDetails)
    {
        return ArticleType::create($articleTypeDetails);
    }

    public function update($articleTypeId, array $newDetails)
    {
        $articleType = ArticleType::find($articleTypeId);
        foreach ($newDetails as $column => $value) {
            $articleType->{$column} = $value;
        }
        $articleType->save();

        return $articleType;
    }
}
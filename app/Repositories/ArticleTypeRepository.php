<?php

namespace App\Repositories;

use App\Interfaces\ArticleTypeRepositoryInterface;
use App\Models\ArticleType as Model;

class ArticleTypeRepository implements ArticleTypeRepositoryInterface
{
    public function getAll()
    {
        return Model::all();
    }

    public function findById($articleTypeId)
    {
        return Model::findOrFail($articleTypeId);
    }

    public function findByIdNullable($articleTypeId)
    {
        return Model::find($articleTypeId);
    }

    public function delete($articleTypeId)
    {
        Model::destroy($articleTypeId);
    }

    public function create(array $articleTypeDetails)
    {
        return Model::create($articleTypeDetails);
    }

    public function update($articleTypeId, array $newDetails)
    {
        $articleType = Model::find($articleTypeId);
        foreach ($newDetails as $column => $value) {
            $articleType->{$column} = $value;
        }
        $articleType->save();

        return $articleType;
    }
}
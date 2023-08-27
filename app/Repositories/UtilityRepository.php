<?php

namespace App\Repositories;

use App\Interfaces\UtilityRepositoryInterface;
use App\Models\Utility as Model;

class UtilityRepository implements UtilityRepositoryInterface
{
    public function getAll()
    {
        return Model::all();
    }

    public function getByType($type)
    {
        return Model::whereType($type)->get();
    }

    public function findById($utilityId)
    {
        return Model::findOrFail($utilityId);
    }

    public function findByIdNullable($utilityId)
    {
        return Model::find($utilityId);
    }

    public function delete($utilityId)
    {
        Model::destroy($utilityId);
    }

    public function create(array $utilityDetails)
    {
        return Model::create($utilityDetails);
    }

    public function update($utilityId, array $newDetails)
    {
        $utility = Model::find($utilityId);
        foreach ($newDetails as $column => $value) {
            $utility->{$column} = $value;
        }
        $utility->save();
    }
}
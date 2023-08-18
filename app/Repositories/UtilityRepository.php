<?php

namespace App\Repositories;

use App\Interfaces\UtilityRepositoryInterface;
use App\Models\Utility;

class UtilityRepository implements UtilityRepositoryInterface
{
    public function getAll()
    {
        return Utility::all();
    }

    public function getByType($type)
    {
        return Utility::whereType($type)->get();
    }

    public function findById($utilityId)
    {
        return Utility::findOrFail($utilityId);
    }

    public function findByIdNullable($utilityId)
    {
        return Utility::find($utilityId);
    }

    public function delete($utilityId)
    {
        Utility::destroy($utilityId);
    }

    public function create(array $utilityDetails)
    {
        return Utility::create($utilityDetails);
    }

    public function update($utilityId, array $newDetails)
    {
        $utility = Utility::find($utilityId);
        foreach ($newDetails as $column => $value) {
            $utility->{$column} = $value;
        }
        $utility->save();
    }
}
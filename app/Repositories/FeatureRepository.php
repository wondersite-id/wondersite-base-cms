<?php

namespace App\Repositories;

use App\Interfaces\FeatureRepositoryInterface;
use App\Models\Feature as Model;

class FeatureRepository implements FeatureRepositoryInterface
{
    public function getAll()
    {
        return Model::all();
    }

    public function getPublished()
    {
        return Model::published()->get();
    }

    public function findById($featureId)
    {
        return Model::findOrFail($featureId);
    }

    public function findByIdNullable($featureId)
    {
        return Model::find($featureId);
    }

    public function delete($featureId)
    {
        Model::destroy($featureId);
    }

    public function create(array $featureDetails)
    {
        return Model::create($featureDetails);
    }

    public function update($featureId, array $newDetails)
    {
        $feature = Model::find($featureId);
        foreach ($newDetails as $column => $value) {
            $feature->{$column} = $value;
        }
        $feature->save();

        return $feature;
    }
}
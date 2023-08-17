<?php

namespace App\Repositories;

use App\Interfaces\FeatureRepositoryInterface;
use App\Models\Feature;

class FeatureRepository implements FeatureRepositoryInterface
{
    public function getAll()
    {
        return Feature::all();
    }

    public function findById($featureId)
    {
        return Feature::findOrFail($featureId);
    }

    public function findByIdNullable($featureId)
    {
        return Feature::find($featureId);
    }

    public function delete($featureId)
    {
        Feature::destroy($featureId);
    }

    public function create(array $featureDetails)
    {
        return Feature::create($featureDetails);
    }

    public function update($featureId, array $newDetails)
    {
        $feature = Feature::find($featureId);
        foreach ($newDetails as $column => $value) {
            $feature->{$column} = $value;
        }
        $feature->save();

        return $feature;
    }
}
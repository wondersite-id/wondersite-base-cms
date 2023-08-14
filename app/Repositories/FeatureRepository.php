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
        $feature = Feature::create($featureDetails);
        $feature->seo->update([
            'title' => $featureDetails['seo_title'],
            'description' => $featureDetails['seo_description'],
            'image' => $featureDetails['seo_image'],
            'author' => $featureDetails['seo_author'],
            'robots' => $featureDetails['seo_robots'],
            'canonical_url' => $featureDetails['seo_canonical_url'],
        ]);
    }

    public function update($featureId, array $newDetails)
    {
        $feature = Feature::find($featureId);
        foreach ($newDetails as $column => $value) {
            $feature->{$column} = $value;
        }
        $feature->save();

        $feature->seo->update([
            'title' => $newDetails['seo_title'],
            'description' => $newDetails['seo_description'],
            'image' => $newDetails['seo_image'],
            'author' => $newDetails['seo_author'],
            'robots' => $newDetails['seo_robots'],
            'canonical_url' => $newDetails['seo_canonical_url'],
        ]);
    }
}
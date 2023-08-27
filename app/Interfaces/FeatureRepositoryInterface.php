<?php

namespace App\Interfaces;

interface FeatureRepositoryInterface
{
    public function getAll();
    public function getPublished();
    public function findById($featureId);
    public function findByIdNullable($featureId);
    public function delete($featureId);
    public function create(array $featureDetails);
    public function update($featureId, array $newDetails);
}
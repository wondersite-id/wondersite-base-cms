<?php

namespace App\Interfaces;

interface UtilityRepositoryInterface
{
    public function getAll();
    public function getByType($type);
    public function findById($utilityId);
    public function findByIdNullable($utilityId);
    public function delete($utilityId);
    public function create(array $utilityDetails);
    public function update($utilityId, array $newDetails);
}
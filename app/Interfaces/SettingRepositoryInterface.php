<?php

namespace App\Interfaces;

interface SettingRepositoryInterface
{
    public function getAll();
    public function getByType($type);
    public function findById($settingId);
    public function findByIdNullable($settingId);
    public function delete($settingId);
    public function create(array $settingDetails);
    public function update($settingId, array $newDetails);
}
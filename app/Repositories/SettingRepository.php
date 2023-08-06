<?php

namespace App\Repositories;

use App\Interfaces\SettingRepositoryInterface;
use App\Models\Setting;

class SettingRepository implements SettingRepositoryInterface
{
    public function getAll()
    {
        return Setting::all();
    }

    public function getByType($type)
    {
        return Setting::whereType($type)->get();
    }

    public function findById($settingId)
    {
        return Setting::findOrFail($settingId);
    }

    public function findByIdNullable($settingId)
    {
        return Setting::find($settingId);
    }

    public function delete($settingId)
    {
        Setting::destroy($settingId);
    }

    public function create(array $settingDetails)
    {
        return Setting::create($settingDetails);
    }

    public function update($settingId, array $newDetails)
    {
        $setting = Setting::find($settingId);
        foreach ($newDetails as $column => $value) {
            $setting->{$column} = $value;
        }
        $setting->save();
    }
}
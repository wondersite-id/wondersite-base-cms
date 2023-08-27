<?php

namespace App\Repositories;

use App\Interfaces\MenuRepositoryInterface;
use App\Models\Menu as Model;

class MenuRepository implements MenuRepositoryInterface
{
    public function getAll()
    {
        return Model::orderBy('sequence_number', 'asc')->get()->sortByDesc('type');
    }

    public function getActiveLinkMenus()
    {
        return Model::where('url', '!=', 'javascript:void(0)')
            ->where('is_open_in_new_tab', false)
            ->get();
    }

    public function findById($menuId)
    {
        return Model::findOrFail($menuId);
    }

    public function findByIdNullable($menuId)
    {
        return Model::find($menuId);
    }

    public function delete($menuId)
    {
        Model::destroy($menuId);
    }

    public function create(array $menuDetails)
    {
        return Model::create($menuDetails);
    }

    public function update($menuId, array $newDetails)
    {
        $menu = Model::find($menuId);
        foreach ($newDetails as $column => $value) {
            $menu->{$column} = $value;
        }
        $menu->save();
    }

    public function getAllParents()
    {
        return Model::root()->orderBy('sequence_number', 'asc')->get()->sortByDesc('type');
    }

    public function getAllChildsByParentId($parentId)
    {
        return Model::whereParentId($parentId)->orderBy('sequence_number', 'asc')->get();
    }
}
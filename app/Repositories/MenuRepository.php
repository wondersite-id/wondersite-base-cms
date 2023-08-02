<?php

namespace App\Repositories;

use App\Interfaces\MenuRepositoryInterface;
use App\Models\Menu;

class MenuRepository implements MenuRepositoryInterface
{
    public function getAll()
    {
        return Menu::orderBy('sequence_number', 'asc')->get()->sortByDesc('type');
    }

    public function findById($menuId)
    {
        return Menu::findOrFail($menuId);
    }

    public function findByIdNullable($menuId)
    {
        return Menu::find($menuId);
    }

    public function delete($menuId)
    {
        Menu::destroy($menuId);
    }

    public function create(array $menuDetails)
    {
        return Menu::create($menuDetails);
    }

    public function update($menuId, array $newDetails)
    {
        $menu = Menu::find($menuId);
        foreach ($newDetails as $column => $value) {
            $menu->{$column} = $value;
        }
        $menu->save();
    }

    public function getAllParents()
    {
        return Menu::isRoot()->orderBy('sequence_number', 'asc')->get()->sortByDesc('type');
    }

    public function getAllChildsByParentId($parentId)
    {
        return Menu::whereParentId($parentId)->orderBy('sequence_number', 'asc')->get();
    }
}
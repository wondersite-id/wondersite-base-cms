<?php

namespace App\Interfaces;

interface MenuRepositoryInterface
{
    public function getAll();
    public function getAllParents();
    public function getAllChildsByParentId($parentId);
    public function getActiveLinkMenus();
    public function findById($menuId);
    public function findByIdNullable($menuId);
    public function delete($menuId);
    public function create(array $menuDetails);
    public function update($menuId, array $newDetails);
}
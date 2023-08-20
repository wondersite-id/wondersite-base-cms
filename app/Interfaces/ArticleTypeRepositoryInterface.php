<?php

namespace App\Interfaces;

interface ArticleTypeRepositoryInterface
{
    public function getAll();
    public function findById($articleTypeId);
    public function findByIdNullable($articleTypeId);
    public function delete($articleTypeId);
    public function create(array $articleTypeDetails);
    public function update($articleTypeId, array $newDetails);
}
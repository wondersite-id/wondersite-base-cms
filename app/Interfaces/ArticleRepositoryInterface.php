<?php

namespace App\Interfaces;

interface ArticleRepositoryInterface
{
    public function getAll();
    public function getPublished();
    public function findById($articleId);
    public function findByIdNullable($articleId);
    public function delete($articleId);
    public function create(array $articleDetails);
    public function update($articleId, array $newDetails);
}
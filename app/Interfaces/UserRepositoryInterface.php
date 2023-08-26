<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getAll();
    public function getAdmins();
    public function getCustomers();
    public function getSpecificCustomer($userId);
    public function findById($userId);
    public function findByIdNullable($userId);
    public function delete($userId);
    public function create(array $userDetails);
    public function update($userId, array $newDetails);
}
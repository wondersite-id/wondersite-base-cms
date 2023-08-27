<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User as Model;

class UserRepository implements UserRepositoryInterface
{
    public function getAll()
    {
        return Model::all();
    }

    public function getAdmins()
    {
        return Model::administrator()->get();
    }

    public function getCustomers()
    {
        return Model::customer()->get();
    }

    public function getSpecificCustomer($userId)
    {
        return Model::whereId($userId)->get();
    }

    public function findById($userId)
    {
        return Model::findOrFail($userId);
    }

    public function findByIdNullable($userId)
    {
        return Model::find($userId);
    }

    public function delete($userId)
    {
        Model::destroy($userId);
    }

    public function create(array $userDetails)
    {
        return Model::create($userDetails);
    }

    public function update($userId, array $newDetails)
    {
        $user = Model::find($userId);
        foreach ($newDetails as $column => $value) {
            $user->{$column} = $value;
        }
        $user->save();
    }
}
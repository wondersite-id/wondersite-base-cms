<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAll()
    {
        return User::all();
    }

    public function getAdmins()
    {
        return User::administrator()->get();
    }

    public function getCustomers()
    {
        return User::customer()->get();
    }

    public function getSpecificCustomer($userId)
    {
        return User::whereId($userId)->get();
    }

    public function findById($userId)
    {
        return User::findOrFail($userId);
    }

    public function findByIdNullable($userId)
    {
        return User::find($userId);
    }

    public function delete($userId)
    {
        User::destroy($userId);
    }

    public function create(array $userDetails)
    {
        return User::create($userDetails);
    }

    public function update($userId, array $newDetails)
    {
        $user = User::find($userId);
        foreach ($newDetails as $column => $value) {
            $user->{$column} = $value;
        }
        $user->save();
    }
}
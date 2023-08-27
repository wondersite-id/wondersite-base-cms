<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Str;

class UserPolicy
{
    private $routeUri;

    public function __construct()
    {
        $this->routeUri = request()->route()->uri;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if (Str::startsWith($this->routeUri, 'cms/customers')) {
            return true;
        }
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $data): bool
    {
        if (Str::startsWith($this->routeUri, 'cms/customers')) {
            return true;
        }
        if ($user->isAdmin()) {
            return true;
        }
        return $user->id == $data->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $data): bool
    {
        if ($user->isAdmin()) {
            return true;
        }
        return $user->id == $data->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $data): bool
    {
        if ($user->isAdmin()) {
            return $user->id != $data->id;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $data): bool
    {
        if ($user->isAdmin()) {
            return true;
        }
        return $user->id == $data->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $data): bool
    {
        return $user->isAdmin();
    }
}

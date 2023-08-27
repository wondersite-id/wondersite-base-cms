<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\Feature;
use App\Models\User;
use RalphJSmit\Laravel\SEO\Models\SEO;

class SEOPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return ($user->can('viewAny', Article::class) || $user->can('viewAny', Feature::class));
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SEO $seo): bool
    {
        return ($user->can('viewAny', Article::class) || $user->can('viewAny', Feature::class));
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SEO $seo): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SEO $seo): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SEO $seo): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SEO $seo): bool
    {
        return false;
    }
}

<?php

namespace App\Providers;

use App\Interfaces\ArticleTypeRepositoryInterface;
use App\Interfaces\ArticleRepositoryInterface;
use App\Interfaces\FeatureRepositoryInterface;
use App\Interfaces\MenuRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\UtilityRepositoryInterface;
use App\Repositories\ArticleTypeRepository;
use App\Repositories\ArticleRepository;
use App\Repositories\FeatureRepository;
use App\Repositories\MenuRepository;
use App\Repositories\UserRepository;
use App\Repositories\UtilityRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
        $this->app->bind(
            FeatureRepositoryInterface::class,
            FeatureRepository::class
        );
        $this->app->bind(
            MenuRepositoryInterface::class,
            MenuRepository::class
        );
        $this->app->bind(
            UtilityRepositoryInterface::class,
            UtilityRepository::class
        );
        $this->app->bind(
            ArticleRepositoryInterface::class,
            ArticleRepository::class
        );
        $this->app->bind(
            ArticleTypeRepositoryInterface::class,
            ArticleTypeRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
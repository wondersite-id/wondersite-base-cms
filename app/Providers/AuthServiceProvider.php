<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\ArticleType;
use App\Models\Feature;
use App\Models\Menu;
use App\Models\User;
use App\Models\Utility;
use App\Policies\ArticlePolicy;
use App\Policies\ArticleTypePolicy;
use App\Policies\FeaturePolicy;
use App\Policies\MenuPolicy;
use App\Policies\SEOPolicy;
use App\Policies\UserPolicy;
use App\Policies\UtilityPolicy;
use RalphJSmit\Laravel\SEO\Models\SEO;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Article::class => ArticlePolicy::class,
        ArticleType::class => ArticleTypePolicy::class,
        Feature::class => FeaturePolicy::class,
        Menu::class => MenuPolicy::class,
        SEO::class => SEOPolicy::class,
        User::class => UserPolicy::class,
        Utility::class => UtilityPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
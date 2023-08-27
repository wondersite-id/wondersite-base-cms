<?php

namespace App\Console\Commands;

use App\Repositories\ArticleRepository;
use App\Repositories\FeatureRepository;
use App\Repositories\MenuRepository;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $menuRepo = app(MenuRepository::class);
        $articleRepo = app(ArticleRepository::class);
        $featureRepo = app(FeatureRepository::class);
        $path = public_path('sitemap.xml');
        $sitemap = Sitemap::create();

        $menus = $menuRepo->getActiveLinkMenus();
        foreach($menus as $menu) {
            $sitemap->add(Url::create($menu->url));
        }
        
        $articles = $articleRepo->getPublished();
        foreach ($articles as $article) {
            $sitemap->add(Url::create("/articles/{$article->slug}"));
        }
        $features = $featureRepo->getPublished();
        foreach ($features as $feature) {
            $sitemap->add(Url::create("/features/{$feature->slug}"));
        }
        $sitemap->writeToFile($path);
    }
}

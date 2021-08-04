<?php

namespace Firebed\Sitemap;

use Illuminate\Support\ServiceProvider;

class SitemapServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerConfig();
        $this->registerViews();
        $this->registerPublished();
    }

    private function registerConfig(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/sitemap.php', 'sitemap'
        );
    }

    private function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'sitemap');
    }

    private function registerPublished(): void
    {
        $this->publishes([
            __DIR__ . '/../config/sitemap.php',
        ], 'sitemap-config');
    }
}
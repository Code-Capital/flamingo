<?php

namespace App\Providers;

use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Debugbar', \Barryvdh\Debugbar\Facades\Debugbar::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        // Disable Debugbar
        if (in_array(app()->environment('local'), getAllowedENVs())) {
            Debugbar::enable();
        } else {
            Debugbar::disable();
        }
    }
}

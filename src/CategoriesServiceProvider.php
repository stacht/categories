<?php

namespace Statch\Categories;

use Illuminate\Support\ServiceProvider;
use Statch\Categories\Contracts\Category as CategoryContract;

class CategoriesServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }

        $this->app->bind(CategoryContract::class, config('statch-categories.models.category'));
    }

    /**
     * Register any package services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/statch-categories.php', 'statch-categories');
    }

    /**
     * Console-specific booting.
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/statch-categories.php' => config_path('statch-categories.php'),
        ], 'config');

        // Publishing the migration file.
        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations'),
        ], 'migrations');
    }
}

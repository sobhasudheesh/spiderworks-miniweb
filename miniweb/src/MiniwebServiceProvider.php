<?php

namespace Spiderworks\MiniWeb;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Yajra\DataTables\DataTablesServiceProvider;
use Intervention\Image\ImageServiceProvider;

use Artisan;

class MiniwebServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(DataTablesServiceProvider::class);
        $this->app->register(ImageServiceProvider::class);
        
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'miniweb');
        $this->publishes([
            __DIR__.'/resources/views' => base_path('resources/views/spiderworks/miniweb'),
        ]);
        $this->publishes([
            __DIR__.'/assets' => base_path('public/miniweb'),
        ]);
        $this->publishes([
            __DIR__ . '/config' => base_path('config')
        ], 'config');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->make('Spiderworks\MiniWeb\Controllers\BaseController');
        $this->app->make('Spiderworks\MiniWeb\Controllers\MenuController');
        $this->app->make('Spiderworks\MiniWeb\Controllers\TypeController');
        $this->app->make('Spiderworks\MiniWeb\Controllers\MediaController');
        $this->app->make('Spiderworks\MiniWeb\Controllers\CategoryController');
        $this->app->make('Spiderworks\MiniWeb\Controllers\PluginController');
    }
}

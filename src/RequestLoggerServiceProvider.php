<?php

namespace Railken\LaraOre;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class RequestLoggerServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/ore.request_logger.php' => config_path('ore.request_logger.php'),
        ], 'config');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Railken\Laravel\Manager\ManagerServiceProvider::class);
        $this->mergeConfigFrom(__DIR__.'/../config/ore.request_logger.php', 'ore.request_logger');
    }
}

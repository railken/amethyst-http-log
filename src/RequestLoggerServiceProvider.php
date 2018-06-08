<?php

namespace Railken\LaraOre;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;

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
        $this->loadRoutes();

        config(['ore.user.permission.managers' => array_merge(Config::get('ore.user.permission.managers'), [
            \Railken\LaraOre\RequestLog\RequestLogManager::class,
        ])]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Railken\Laravel\Manager\ManagerServiceProvider::class);
        $this->app->register(\Railken\LaraOre\UserServiceProvider::class);
        $this->app->register(\Laravel\Scout\ScoutServiceProvider::class);
        $this->app->register(\Yab\MySQLScout\Providers\MySQLScoutServiceProvider::class);

        $this->mergeConfigFrom(__DIR__.'/../config/ore.request_logger.php', 'ore.request_logger');
    }

    /**
     * Load routes.
     *
     * @return void
     */
    public function loadRoutes()
    {
        Route::group([
            'namespace' => 'Railken\LaraOre\Http\Controllers',
            'prefix' => '/api/v1',
        ], function ($router) {
            Route::group([
                'prefix' => '/admin/http-logs',
                'middleware' => Config::get('ore.user.router.middlewares'),
            ], function ($router) {
                $router->get('/', ['uses' => 'HttpLogsController@index']);
                $router->post('/', ['uses' => 'HttpLogsController@create']);
                $router->put('/{id}', ['uses' => 'HttpLogsController@update']);
                $router->delete('/{id}', ['uses' => 'HttpLogsController@remove']);
                $router->get('/{id}', ['uses' => 'HttpLogsController@show']);
            });
        });
    }
}

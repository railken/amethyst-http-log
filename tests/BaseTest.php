<?php

namespace Railken\LaraOre\RequestLogger\Tests;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

abstract class BaseTest extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            \Railken\Laravel\Manager\ManagerServiceProvider::class,
            \Railken\LaraOre\RequestLogger\RequestLoggerServiceProvider::class,
            \Laravel\Scout\ScoutServiceProvider::class,
            \Yab\MySQLScout\Providers\MySQLScoutServiceProvider::class,
        ];
    }

    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        $dotenv = new \Dotenv\Dotenv(__DIR__.'/..', '.env');
        $dotenv->load();

        parent::setUp();

        Route::get('test', function () {
            return "bazinga";
        })->middleware(\Railken\LaraOre\RequestLogger\RequestLoggerMiddleware::class);

        File::cleanDirectory(database_path("migrations/"));

        config("scout.mysql",[
            'mode' => 'NATURAL_LANGUAGE',
            'model_directories' => [app_path()],
            'min_search_length' => 0,
            'min_fulltext_search_length' => 4,
            'min_fulltext_search_fallback' => 'LIKE',
            'query_expansion' => false
        ]);
        config("scout.driver", "mysql");

        $this->artisan('vendor:publish', [
            '--provider' => 'Laravel\Scout\ScoutServiceProvider',
        ]);

        $this->artisan('vendor:publish', [
            '--provider' => 'Railken\LaraOre\RequestLogger\RequestLoggerServiceProvider',
            '--tag' => 'config'
        ]);

        $this->artisan('vendor:publish', [
            '--provider' => 'Railken\LaraOre\RequestLogger\RequestLoggerServiceProvider',
            '--tag' => 'migrations'
        ]);

        $this->artisan('migrate:fresh');
        $this->artisan('migrate');


        $this->artisan('scout:mysql-index', [
            'model' => 'Railken\LaraOre\RequestLogger\RequestLog\RequestLog'
        ]);

    }
}

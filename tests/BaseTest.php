<?php

namespace Railken\Amethyst\Tests;

use Illuminate\Support\Facades\Route;

abstract class BaseTest extends \Orchestra\Testbench\TestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        $dotenv = new \Dotenv\Dotenv(__DIR__.'/..', '.env');
        $dotenv->load();

        parent::setUp();

        Route::any('test', function () {
            return 'bazinga';
        })->middleware(\Railken\Amethyst\Http\Middleware\LogRequest::class);

        $this->artisan('migrate:fresh');
    }

    protected function getPackageProviders($app)
    {
        return [
            \Railken\Amethyst\Providers\HttpLogServiceProvider::class,
        ];
    }
}

<?php

namespace Railken\Amethyst\Tests;

use Illuminate\Support\Facades\Route;

abstract class BaseTest extends \Orchestra\Testbench\TestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp(): void
    {
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

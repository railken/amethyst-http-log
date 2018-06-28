<?php

namespace Railken\LaraOre\RequestLogger\Tests;

use Illuminate\Support\Facades\Route;
use Railken\Bag;

abstract class BaseTest extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            \Railken\LaraOre\RequestLoggerServiceProvider::class,
        ];
    }

    /**
     * Retrieve correct bag of parameters.
     *
     * @return Bag
     */
    public function getParameters()
    {
        $bag = new Bag();
        $bag->set('type', 'inbound');
        $bag->set('method', 'POST');
        $bag->set('url', '/awd');
        $bag->set('request', ['body' => ['id' => 'foo']]);
        $bag->set('response', ['body' => ['id' => 'foo']]);

        return $bag;
    }

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
        })->middleware(\Railken\LaraOre\Http\Middleware\RequestLoggerMiddleware::class);

        $this->artisan('migrate:fresh');
        $this->artisan('vendor:publish', ['--provider' => 'Laravel\Scout\ScoutServiceProvider']);
        $this->artisan('vendor:publish', ['--provider' => 'Railken\LaraOre\RequestLoggerServiceProvider', '--force' => true]);
        $this->artisan('migrate');
    }
}

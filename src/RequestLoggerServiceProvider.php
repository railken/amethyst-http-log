<?php

namespace Railken\LaraOre\RequestLogger;

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

        if (!class_exists('CreateRequestLogsTable')) {
            $this->publishes([
                __DIR__.'/../database/migrations/create_request_logs_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_request_logs_table.php'),
            ], 'migrations');
        }
    }
}
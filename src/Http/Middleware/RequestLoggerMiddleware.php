<?php

namespace Railken\LaraOre\Http\Middleware;

use Closure;
use Railken\LaraOre\RequestLog\RequestLogManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Foundation\Application;

class RequestLoggerMiddleware
{
    protected $app;
    protected $time;

    public function __construct(Application $app)
    {
        $this->time = $this->now();
        $this->app = $app;
    }

    public function now()
    {
        return microtime(true);
    }

    public function handle($request, Closure $next)
    {
        DB::enableQueryLog();
        return $next($request);
    }

    public function terminate($request, $response)
    {
        $lm = new RequestLogManager();
        $lm->log($request, $response, intval(round(($this->now() - $this->time) * 1000)), DB::getQueryLog());
    }
}

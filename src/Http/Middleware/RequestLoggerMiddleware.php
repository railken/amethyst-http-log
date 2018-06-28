<?php

namespace Railken\LaraOre\Http\Middleware;

use Closure;
use Railken\LaraOre\RequestLog\RequestLogManager;

class RequestLoggerMiddleware
{

    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        $lm = new RequestLogManager();
        $lm->log('inbound', 'api', $request, $response, round((microtime(true) - LARAVEL_START) * 1000));
    }
}

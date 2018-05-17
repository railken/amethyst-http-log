<?php

namespace Railken\LaraOre\RequestLogger;

use Railken\LaraOre\RequestLogger\RequestLog\RequestLogManager;

use Closure;

class RequestLoggerMiddleware
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        $lm = new RequestLogManager();
        $lm->log('inbound', 'api', $request, $response);
    }
}

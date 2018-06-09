<?php

namespace Railken\LaraOre;

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
        $lm->log('inbound', 'api', $request, $response);
    }
}

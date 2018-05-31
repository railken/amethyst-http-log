<?php

namespace Railken\LaraOre;

use Railken\LaraOre\RequestLog\RequestLogManager;
use Illuminate\Support\Collection;
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

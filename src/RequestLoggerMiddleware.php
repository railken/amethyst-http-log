<?php

namespace Railken\LaraOre\RequestLogger;

use Railken\LaraOre\RequestLogger\RequestLog\RequestLogManager;

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
    	$config = config('ore.request_logger.middleware');

    	$path = $request->path();

    	if (!$this->isValueInArrayRegex($request->path(), config('ore.request_logger.middleware.path.whitelist'))) {
    		return;
    	}

    	if ($this->isValueInArrayRegex($request->path(), config('ore.request_logger.middleware.path.blacklist'))) {
    		return;
    	}

    	
    	if (!$this->isValueInArrayRegex($request->path(), config('ore.request_logger.middleware.path.whitelist'))) {
    		return;
    	}

    	if ($this->isValueInArrayRegex($request->path(), config('ore.request_logger.middleware.path.blacklist'))) {
    		return;
    	}

        $lm = new RequestLogManager();
        $lm->log('inbound', 'api', $request, $response);
    }

    public function isValueInArrayRegex($value, array $array)
    {

    	$collection = new Collection($array);

    	return $collection->first(function($regex) use ($value) {
    		return preg_match($regex, $value);
    	}) !== null;
    }
}

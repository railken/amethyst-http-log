<?php

namespace Railken\Amethyst\Http\Middleware;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Railken\Amethyst\Managers\HttpLogManager;

class LogRequest
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
        return $next($request);
    }

    public function terminate($request, $response)
    {
        $lm = new HttpLogManager();

        $time = intval(round(($this->now() - $this->time) * 1000));

        $blacklist = Config::get('amethyst.http-log.logger.blacklist');

        $params = (new Collection($request->all()))->filter(function ($value, $key) use ($blacklist) {
            return !preg_match($blacklist, $key);
        });

        $lm->create([
            'method'             => $request->method(),
            'url'                => $request->path(),
            'ip'                 => $request->ip(),
            'status'             => $response->getStatusCode(),
            'time'               => $time,
            'authenticable_type' => Auth::user() ? get_class(Auth::user()) : null,
            'authenticable_id'   => Auth::id(),
            'request'            => ['headers' => $request->headers->all(), 'body' => $params],
            'response'           => ['headers' => $response->headers->all(), 'body' => $response->getContent()],
        ]);
    }
}

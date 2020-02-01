<?php

namespace Amethyst\Http\Middleware;

use Amethyst\Managers\HttpLogManager;
use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class LogRequest
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var int
     */
    protected $time;

    /**
     * @var HttpLogManager
     */
    protected $manager;

    /**
     * Construct a new object.
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->time = $this->now();
        $this->app = $app;
        $this->manager = new HttpLogManager();
    }

    /**
     * @return int
     */
    public function now()
    {
        return microtime(true);
    }

    /**
     * @param $request
     * @param Closure $next
     */
    public function handle($request, Closure $next)
    {
        if (in_array($request->method(), ['GET', 'OPTIONS'], true)) {
            return $next($request);
        }

        $blacklist = Config::get('amethyst.http-log.logger.blacklist');

        $params = (new Collection($request->all()))->filter(function ($value, $key) use ($blacklist) {
            return !preg_match($blacklist, $key);
        });

        $resource = $this->manager->createOrFail([
            'method'             => $request->method(),
            'url'                => $request->path(),
            'ip'                 => $request->ip(),
            'authenticable_type' => Auth::user() ? app('amethyst')->tableize(Auth::user()) : null,
            'authenticable_id'   => Auth::id(),
            'request'            => ['headers' => $request->headers->all(), 'body' => $params],
        ])->getResource();

        $request->request->add(['http-log-request-id' => $resource->id]);

        return $next($request);
    }

    public function terminate($request, $response)
    {
        $id = $request->get('http-log-request-id');

        if (!$id) {
            return;
        }

        $time = intval(round(($this->now() - $this->time) * 1000));

        $this->manager->updateOrFail($this->manager->getRepository()->findOneById($id), [
            'status'   => $response->getStatusCode(),
            'time'     => $time,
            'response' => ['headers' => $response->headers->all(), 'body' => $response->getContent()],
        ]);
    }
}

<?php

namespace Railken\LaraOre\RequestLog;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Railken\Laravel\Manager\Contracts\AgentContract;
use Railken\Laravel\Manager\ModelManager;
use Railken\Laravel\Manager\Tokens;
use Illuminate\Support\Facades\Config;

class RequestLogManager extends ModelManager
{
    /**
     * Class name entity.
     *
     * @var string
     */
    public $entity = RequestLog::class;

    /**
     * List of all attributes.
     *
     * @var array
     */
    protected $attributes = [
        Attributes\Id\IdAttribute::class,
        Attributes\Type\TypeAttribute::class,
        Attributes\Category\CategoryAttribute::class,
        Attributes\Url\UrlAttribute::class,
        Attributes\Method\MethodAttribute::class,
        Attributes\Ip\IpAttribute::class,
        Attributes\Request\RequestAttribute::class,
        Attributes\Response\ResponseAttribute::class,
        Attributes\CreatedAt\CreatedAtAttribute::class,
        Attributes\UpdatedAt\UpdatedAtAttribute::class,
        Attributes\Status\StatusAttribute::class,
        Attributes\Time\TimeAttribute::class,
    ];

    /**
     * List of all exceptions.
     *
     * @var array
     */
    protected $exceptions = [
        Tokens::NOT_AUTHORIZED => Exceptions\RequestLogNotAuthorizedException::class,
    ];

    /**
     * Construct.
     *
     * @param AgentContract $agent
     */
    public function __construct(AgentContract $agent = null)
    {
        $this->entity = Config::get('ore.request-logger.entity');
        $this->attributes = array_merge($this->attributes, array_values(Config::get('ore.request-logger.attributes')));
        
        $classRepository = Config::get('ore.request-logger.repository');
        $this->setRepository(new $classRepository($this));

        $classSerializer = Config::get('ore.request-logger.serializer');
        $this->setSerializer(new $classSerializer($this));

        $classAuthorizer = Config::get('ore.request-logger.authorizer');
        $this->setAuthorizer(new $classAuthorizer($this));

        $classValidator = Config::get('ore.request-logger.validator');
        $this->setValidator(new $classValidator($this));

        parent::__construct($agent);
    }

    public function log($type, $category, Request $request, Response $response, int $time)
    {
        $blacklist = config('ore.request-logger.blacklist');

        $params = (new Collection($request->all()))->filter(function ($value, $key) use ($blacklist) {
            return !preg_match($blacklist, $key);
        });

        $this->create([
            'type'     => $type,
            'category' => $category,
            'method'   => $request->method(),
            'url'      => $request->path(),
            'ip'       => $request->ip(),
            'status'   => $response->status(),
            'time'     => $time,
            'request'  => ['headers' => $request->headers->all(), 'body' => $params],
            'response' => ['headers' => $response->headers->all(), 'body' => $response->original],
        ]);
    }
}

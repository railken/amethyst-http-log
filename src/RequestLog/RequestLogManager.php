<?php

namespace Railken\LaraOre\RequestLog;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Railken\Laravel\Manager\Contracts\AgentContract;
use Railken\Laravel\Manager\ModelManager;
use Railken\Laravel\Manager\Tokens;

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
        $this->setRepository(new RequestLogRepository($this));
        $this->setSerializer(new RequestLogSerializer($this));
        $this->setValidator(new RequestLogValidator($this));
        $this->setAuthorizer(new RequestLogAuthorizer($this));

        parent::__construct($agent);
    }

    public function log($type, $category, Request $request, Response $response)
    {
        $blacklist = config('ore.request_logger.blacklist');

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
            'request'  => ['headers' => $request->headers->all(), 'body' => $params],
            'response' => ['headers' => $response->headers->all(), 'body' => $response->original],
        ]);
    }
}

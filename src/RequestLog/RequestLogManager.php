<?php

namespace Railken\LaraOre\RequestLogger\RequestLog;

use Railken\Laravel\Manager\Contracts\AgentContract;
use Railken\Laravel\Manager\ModelManager;
use Railken\Laravel\Manager\Tokens;

class RequestLogManager extends ModelManager
{
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
}

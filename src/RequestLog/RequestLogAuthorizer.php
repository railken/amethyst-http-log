<?php

namespace Railken\LaraOre\RequestLog;

use Railken\Laravel\Manager\ModelAuthorizer;
use Railken\Laravel\Manager\Tokens;

class RequestLogAuthorizer extends ModelAuthorizer
{
    /**
     * List of all permissions.
     *
     * @var array
     */
    protected $permissions = [
        Tokens::PERMISSION_CREATE => 'request_log.create',
        Tokens::PERMISSION_UPDATE => 'request_log.update',
        Tokens::PERMISSION_SHOW   => 'request_log.show',
        Tokens::PERMISSION_REMOVE => 'request_log.remove',
    ];
}

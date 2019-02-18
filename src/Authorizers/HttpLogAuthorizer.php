<?php

namespace Railken\Amethyst\Authorizers;

use Railken\Lem\Authorizer;
use Railken\Lem\Tokens;

class HttpLogAuthorizer extends Authorizer
{
    /**
     * List of all permissions.
     *
     * @var array
     */
    protected $permissions = [
        Tokens::PERMISSION_CREATE => 'http-log.create',
        Tokens::PERMISSION_UPDATE => 'http-log.update',
        Tokens::PERMISSION_SHOW   => 'http-log.show',
        Tokens::PERMISSION_REMOVE => 'http-log.remove',
    ];
}

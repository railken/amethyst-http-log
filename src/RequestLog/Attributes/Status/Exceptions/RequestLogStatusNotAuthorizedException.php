<?php

namespace Railken\LaraOre\RequestLog\Attributes\Status\Exceptions;

use Railken\LaraOre\RequestLog\Exceptions\RequestLogAttributeException;

class RequestLogStatusNotAuthorizedException extends RequestLogAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'status';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'REQUEST_LOG_STATUS_NOT_AUTHTORIZED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = "You're not authorized to interact with %s, missing %s permission";
}

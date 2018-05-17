<?php

namespace Railken\LaraOre\RequestLogger\RequestLog\Exceptions;

class RequestLogNotAuthorizedException extends RequestLogException
{
    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'REQUEST_LOG_NOT_AUTHORIZED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = "You're not authorized to interact with %s, missing %s permission";
}

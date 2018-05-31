<?php

namespace Railken\LaraOre\RequestLog\Exceptions;

class RequestLogNotFoundException extends RequestLogException
{
    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'REQUEST_LOG_NOT_FOUND';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'Not found';
}

<?php

namespace Railken\LaraOre\RequestLog\Attributes\Time\Exceptions;

use Railken\LaraOre\RequestLog\Exceptions\RequestLogAttributeException;

class RequestLogTimeNotDefinedException extends RequestLogAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'time';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'REQUESTLOG_TIME_NOT_DEFINED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is required';
}

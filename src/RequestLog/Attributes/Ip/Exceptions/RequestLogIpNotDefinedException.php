<?php

namespace Railken\LaraOre\RequestLog\Attributes\Ip\Exceptions;

use Railken\LaraOre\RequestLog\Exceptions\RequestLogAttributeException;

class RequestLogIpNotDefinedException extends RequestLogAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'ip';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'REQUEST_LOG_IP_NOT_DEFINED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is required';
}

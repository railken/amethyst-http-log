<?php

namespace Railken\LaraOre\RequestLog\Attributes\Url\Exceptions;

use Railken\LaraOre\RequestLog\Exceptions\RequestLogAttributeException;

class RequestLogUrlNotUniqueException extends RequestLogAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'url';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'REQUEST_LOG_URL_NOT_UNIQUE';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not unique';
}

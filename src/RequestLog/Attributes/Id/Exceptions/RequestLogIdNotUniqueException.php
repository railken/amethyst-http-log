<?php

namespace Railken\LaraOre\RequestLog\Attributes\Id\Exceptions;

use Railken\LaraOre\RequestLog\Exceptions\RequestLogAttributeException;

class RequestLogIdNotUniqueException extends RequestLogAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'id';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'REQUEST_LOG_ID_NOT_UNIQUE';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not unique';
}

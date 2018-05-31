<?php

namespace Railken\LaraOre\RequestLog\Attributes\Status\Exceptions;

use Railken\LaraOre\RequestLog\Exceptions\RequestLogAttributeException;

class RequestLogStatusNotUniqueException extends RequestLogAttributeException
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
    protected $code = 'REQUEST_LOG_STATUS_NOT_UNIQUE';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not unique';
}

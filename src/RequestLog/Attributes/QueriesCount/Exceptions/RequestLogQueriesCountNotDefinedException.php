<?php

namespace Railken\LaraOre\RequestLog\Attributes\QueriesCount\Exceptions;

use Railken\LaraOre\RequestLog\Exceptions\RequestLogAttributeException;

class RequestLogQueriesCountNotDefinedException extends RequestLogAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'queries_count';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'REQUESTLOG_QUERIES_COUNT_NOT_DEFINED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is required';
}

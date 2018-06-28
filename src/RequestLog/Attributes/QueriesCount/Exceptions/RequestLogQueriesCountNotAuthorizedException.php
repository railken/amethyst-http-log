<?php

namespace Railken\LaraOre\RequestLog\Attributes\QueriesCount\Exceptions;

use Railken\LaraOre\RequestLog\Exceptions\RequestLogAttributeException;

class RequestLogQueriesCountNotAuthorizedException extends RequestLogAttributeException
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
    protected $code = 'REQUESTLOG_QUERIES_COUNT_NOT_AUTHTORIZED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = "You're not authorized to interact with %s, missing %s permission";
}

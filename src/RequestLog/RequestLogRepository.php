<?php

namespace Railken\LaraOre\RequestLogger\RequestLog;

use Railken\Laravel\Manager\ModelRepository;

class RequestLogRepository extends ModelRepository
{
    /**
     * Class name entity.
     *
     * @var string
     */
    public $entity = RequestLog::class;
}

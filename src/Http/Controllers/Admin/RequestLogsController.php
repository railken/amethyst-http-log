<?php

namespace Railken\LaraOre\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Railken\LaraOre\Api\Http\Controllers\RestConfigurableController;
use Railken\LaraOre\Api\Http\Controllers\Traits\RestCreateTrait;
use Railken\LaraOre\Api\Http\Controllers\Traits\RestIndexTrait;
use Railken\LaraOre\Api\Http\Controllers\Traits\RestRemoveTrait;
use Railken\LaraOre\Api\Http\Controllers\Traits\RestShowTrait;
use Railken\LaraOre\Api\Http\Controllers\Traits\RestUpdateTrait;
use Railken\LaraOre\RequestLog\RequestLogManager;

class RequestLogsController extends RestConfigurableController
{
    use RestIndexTrait;
    use RestCreateTrait;
    use RestUpdateTrait;
    use RestShowTrait;
    use RestRemoveTrait;

    /**
     * The config path
     *
     * @var string
     */
    public $config = 'ore.request-logger';

    /**
     * List of params that can be used to perform a search in the index.
     *
     * @var array
     */
    public $queryable = [
        'id',
        'url',
        'type',
        'method',
        'category',
        'request',
        'response',
        'ip',
        'time',
        'created_at',
        'updated_at',
    ];

    /**
     * List of params that can be selected in the index.
     *
     * @var array
     */
    public $fillable = [
        'url',
        'type',
        'method',
        'category',
        'request',
        'response',
        'ip',
        'time',
    ];

    public function __construct(RequestLogManager $manager)
    {
        $this->manager = $manager;
        $this->manager->setAgent($this->getUser());
        parent::__construct();
    }

    /**
     * Create a new instance for query.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function getQuery()
    {
        return $this->manager->repository->getQuery();
    }
}

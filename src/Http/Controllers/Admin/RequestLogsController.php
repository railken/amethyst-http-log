<?php

namespace Railken\LaraOre\Http\Controllers\Admin;

use Railken\LaraOre\Api\Http\Controllers\RestConfigurableController;
use Railken\LaraOre\Api\Http\Controllers\Traits\RestCreateTrait;
use Railken\LaraOre\Api\Http\Controllers\Traits\RestIndexTrait;
use Railken\LaraOre\Api\Http\Controllers\Traits\RestRemoveTrait;
use Railken\LaraOre\Api\Http\Controllers\Traits\RestShowTrait;
use Railken\LaraOre\Api\Http\Controllers\Traits\RestUpdateTrait;

class RequestLogsController extends RestConfigurableController
{
    use RestIndexTrait;
    use RestCreateTrait;
    use RestUpdateTrait;
    use RestShowTrait;
    use RestRemoveTrait;

    /**
     * The config path.
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
        'queries_count',
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
        'queries_count',
    ];
}

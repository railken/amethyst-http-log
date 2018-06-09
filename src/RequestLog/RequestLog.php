<?php

namespace Railken\LaraOre\RequestLog;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Railken\Laravel\Manager\Contracts\EntityContract;

class RequestLog extends Model implements EntityContract
{
    use Searchable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'request', 'response', 'category', 'url', 'method', 'ip', 'type', 'status'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'request'  => 'array',
        'response' => 'array',
    ];

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = \Illuminate\Support\Facades\Config::get('ore.request_logger.table', 'ore_request_logs');
    }
}

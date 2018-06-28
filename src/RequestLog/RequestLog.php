<?php

namespace Railken\LaraOre\RequestLog;

use Illuminate\Database\Eloquent\Model;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Illuminate\Support\Facades\Config;

class RequestLog extends Model implements EntityContract
{

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
    protected $fillable = [
        'request',
        'response',
        'category',
        'url',
        'method',
        'ip',
        'type',
        'status',
        'time'
    ];

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
        $this->table = \Illuminate\Support\Facades\Config::get('ore.request-logger.table');
        $this->fillable = array_merge($this->fillable, array_keys(Config::get('ore.request-logger.attributes')));
    }
}

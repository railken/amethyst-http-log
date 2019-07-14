<?php

namespace Amethyst\Managers;

use Amethyst\Common\ConfigurableManager;
use Railken\Lem\Manager;

/**
 * @method \Amethyst\Models\HttpLog                 newEntity()
 * @method \Amethyst\Schemas\HttpLogSchema          getSchema()
 * @method \Amethyst\Repositories\HttpLogRepository getRepository()
 * @method \Amethyst\Serializers\HttpLogSerializer  getSerializer()
 * @method \Amethyst\Validators\HttpLogValidator    getValidator()
 * @method \Amethyst\Authorizers\HttpLogAuthorizer  getAuthorizer()
 */
class HttpLogManager extends Manager
{
    use ConfigurableManager;

    /**
     * @var string
     */
    protected $config = 'amethyst.http-log.data.http-log';
}

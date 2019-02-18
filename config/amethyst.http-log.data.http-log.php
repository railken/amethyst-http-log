<?php

return [
    'table'      => 'amethyst_http_logs',
    'comment'    => 'HttpLog',
    'model'      => Railken\Amethyst\Models\HttpLog::class,
    'schema'     => Railken\Amethyst\Schemas\HttpLogSchema::class,
    'repository' => Railken\Amethyst\Repositories\HttpLogRepository::class,
    'serializer' => Railken\Amethyst\Serializers\HttpLogSerializer::class,
    'validator'  => Railken\Amethyst\Validators\HttpLogValidator::class,
    'authorizer' => Railken\Amethyst\Authorizers\HttpLogAuthorizer::class,
    'faker'      => Railken\Amethyst\Fakers\HttpLogFaker::class,
    'manager'    => Railken\Amethyst\Managers\HttpLogManager::class,
];

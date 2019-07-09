<?php

return [
    'table'      => 'amethyst_http_logs',
    'comment'    => 'HttpLog',
    'model'      => Amethyst\Models\HttpLog::class,
    'schema'     => Amethyst\Schemas\HttpLogSchema::class,
    'repository' => Amethyst\Repositories\HttpLogRepository::class,
    'serializer' => Amethyst\Serializers\HttpLogSerializer::class,
    'validator'  => Amethyst\Validators\HttpLogValidator::class,
    'authorizer' => Amethyst\Authorizers\HttpLogAuthorizer::class,
    'faker'      => Amethyst\Fakers\HttpLogFaker::class,
    'manager'    => Amethyst\Managers\HttpLogManager::class,
];

<?php

return [
    'enabled'    => true,
    'controller' => Railken\Amethyst\Http\Controllers\Admin\HttpLogsController::class,
    'router'     => [
        'as'     => 'http-log.',
        'prefix' => '/http-logs',
    ],
];

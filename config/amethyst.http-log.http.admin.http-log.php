<?php

return [
    'enabled'    => true,
    'controller' => Amethyst\Http\Controllers\Admin\HttpLogsController::class,
    'router'     => [
        'as'     => 'http-log.',
        'prefix' => '/http-logs',
    ],
];

<?php

return [

    'enabled' => env('AUDITING_ENABLED', true),

    'implementation' => OwenIt\Auditing\Models\Audit::class,

    'user' => [
        'morph_prefix' => 'user',
        'guards'       => [
            'web',
            'api',
        ],
    ],

    'resolver' => [
        'user'       => OwenIt\Auditing\Resolvers\UserResolver::class,
        'ip_address' => OwenIt\Auditing\Resolvers\IpAddressResolver::class,
        'user_agent' => OwenIt\Auditing\Resolvers\UserAgentResolver::class,
        'url'        => OwenIt\Auditing\Resolvers\UrlResolver::class,
    ],

    'events' => [
        'created',
        'updated',
        'deleted',
        'restored',
    ],

    'strict' => true,

    'timestamps' => false,

    'threshold' => 200,

    'driver' => 'database',

    'drivers' => [
        'database' => [
            'table'      => 'audits',
            'connection' => null,
        ],
    ],

    'console' => false,
];

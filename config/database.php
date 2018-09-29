<?php

return [

    'default' => 'master',

    'connections' => [
        'master' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST'),
            'port' => env('DB_PORT'),
            'database' => env('DB_DATABASE'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'strict' => false,
        ],
        'slaves' => [
            'web31' => [
                'driver' => 'mysql',
                'read' => [
                    'host' => env('DB31_HOST'),
                ],
                'write' => [
                    'host' => env('DB_HOST'),
                ],
                'port' => env('DB_PORT'),
                'database' => env('DB_DATABASE'),
                'username' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix' => '',
                'strict' => false,
                'weight' => 3,
            ],
            'web32' => [
                'driver' => 'mysql',
                'read' => [
                    'host' => env('DB32_HOST'),
                ],
                'write' => [
                    'host' => env('DB_HOST'),
                ],
                'port' => env('DB_PORT'),
                'database' => env('DB_DATABASE'),
                'username' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix' => '',
                'strict' => false,
                'weight' => 2,
            ],
            'web33' => [
                'driver' => 'mysql',
                'read' => [
                    'host' => env('DB33_HOST'),
                ],
                'write' => [
                    'host' => env('DB_HOST'),
                ],
                'port' => env('DB_PORT'),
                'database' => env('DB_DATABASE'),
                'username' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix' => '',
                'strict' => false,
                'weight' => 2,
            ],
            'web34' => [
                'driver' => 'mysql',
                'read' => [
                    'host' => env('DB34_HOST'),
                ],
                'write' => [
                    'host' => env('DB_HOST'),
                ],
                'port' => env('DB_PORT'),
                'database' => env('DB_DATABASE'),
                'username' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix' => '',
                'strict' => false,
                'weight' => 1,
            ],
        ],
        'histories' => [
            'driver' => 'mysql',
            'host' => env('DB2_HOST'),
            'port' => env('DB_PORT'),
            'database' => env('DB2_DATABASE'),
            'username' => env('DB2_USERNAME'),
            'password' => env('DB2_PASSWORD'),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'strict' => false,
        ]
    ],
];
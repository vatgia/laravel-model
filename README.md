Vật Giá Laravel (Lumen) Model help connect multiple mysql database (master - slave) easy.


## Functions

- Connect multiple databases with model master - slave
- Randomly connect 1 database slave with weight config

## Sử dụng

Config follow bellow:

    
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
                    'weight' => 100,
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
                    'weight' => 50,
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
                    'weight' => 50,
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
                    'weight' => 50,
                ],
            ],
        ],
    ];
    

Your model need extend from ```VatGia\Model\Model```

Cách thay đổi database

    MyModel::setConnection('master')
    MyModel::setConnection('slavses')
    MyModel::setConnection('slavses.web31')

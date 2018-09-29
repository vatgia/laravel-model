Vật Giá Laravel (Lumen) Model giúp sử dụng nhiều kết nối với database theo dạng master - slaves


## Tính năng

- Connect nhiều database với mô hình master - slaves
- Connect ngẫu nhiên 1 database slaves với trọng số được cấu hình

## Sử dụng

Cấu hình file database như sau:

    
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
    

Các model được tạo cần kế thừa từ class ```VatGia\Model\Model```

Cách thay đổi database

    News::setConnection('master')
    News::setConnection('slavse')
    News::setConnection('slavse.web31')
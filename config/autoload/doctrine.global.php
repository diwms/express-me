<?php

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'params' => [
                    'driverClass' => Doctrine\DBAL\Driver\PDOPgSql\Driver::class,
                    'host'        => '127.0.0.1',
                    'port'        => '5432',
                    'dbname'      => 'blog',
                    'user'        => 'postgres',
                    'password'    => 'postgres',
                    'charset'     => 'UTF8',
                ],
            ],
        ],

        'driver' => [
            'annotations' => [
                'cache' => [
                    'redis' => [
                        'host' => '127.0.0.1',
                    ],
                ],
                'paths' => [
                    'src/App/src/Entity',
                ],
            ],
        ],

        'configuration' => [
            'proxy_dir'       => 'data/cache/DoctrineORM/Proxy',
            'proxy_namespace' => 'DoctrineORM/Proxy',
        ],
    ],
];

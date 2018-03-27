<?php

return [
    'doctrine' => [
        'use_redis_as_cache' => true,
        'connection'         => [
            'orm_default' => [
                'driverClass' => Doctrine\DBAL\Driver\PDOPgSql\Driver::class,
                'params'      => [
                    'driver'   => 'pdo_pgsql',
                    'host'     => php_sapi_name() == 'cli' ? 'localhost' : 'docker.for.mac.localhost',
                    'port'     => '5432',
                    'dbname'   => 'blog',
                    'user'     => 'postgres',
                    'password' => 'postgres',
                    'charset'  => 'UTF8',
                ],
            ],
        ],

        'driver' => [
            'annotations' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\DoctrineAnnotations',
                'cache' => 'array',
                'paths' => [
                    'src/App/src/Entity',
                ],
            ],
        ],

        'configuration' => [
            'auto_generate_proxy_classes' => false,
            'proxy_dir'                   => 'data/cache/DoctrineORM/Proxy',
            'proxy_namespace'             => 'DoctrineORM/Proxy',
            'underscore_naming_strategy'  => true,
        ],

        'cache' => [
            'redis' => [
                'host' => php_sapi_name() == 'cli'? 'localhost' : 'docker.for.mac.localhost',
            ],
        ],
    ],
];

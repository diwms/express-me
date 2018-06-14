<?php

return [
    'dependencies' => [
        'factories' => [
            Doctrine\ORM\EntityManager::class  => App\Factory\Doctrine\AppEntityManager::class,
            Doctrine\Common\Cache\Cache::class => App\Factory\Doctrine\AppRedisCache::class,
        ],
    ],
];

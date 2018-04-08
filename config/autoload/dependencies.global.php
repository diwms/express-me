<?php

declare(strict_types=1);

return [
    'dependencies' => [
        'factories' => [
            Doctrine\ORM\EntityManager::class  => Integration\Doctrine\Factory\DoctrineFactory::class,
            Doctrine\Common\Cache\Cache::class => Integration\Doctrine\Factory\DoctrineRedisCacheFactory::class,
        ],
    ],
];

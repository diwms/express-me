<?php

declare(strict_types=1);

return [
    'dependencies' => [
        'aliases'    => [],
        'invokables' => [],
        'factories'  => [
            Doctrine\ORM\EntityManager::class => App\Factory\DoctrineFactory::class,
        ],
    ],
];

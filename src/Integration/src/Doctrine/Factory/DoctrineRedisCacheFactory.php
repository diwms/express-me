<?php

declare(strict_types=1);

namespace Integration\Doctrine\Factory;

use Doctrine\Common\Cache\RedisCache;
use Interop\Container\ContainerInterface;
use Redis;

class DoctrineRedisCacheFactory
{
    public function __invoke(ContainerInterface $container): RedisCache
    {
        $config = $container->get('config')['doctrine']['driver']['annotations'];

        $redis = new Redis;
        $redis->connect($config['cache']['redis']['host']);

        $cache = new RedisCache;
        $cache->setRedis($redis);

        return $cache;
    }
}

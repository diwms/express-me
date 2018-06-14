<?php

namespace App\Factory\Doctrine;

use Doctrine\Common\Cache\RedisCache;
use Interop\Container\ContainerInterface;

class AppRedisCache
{
    public function __invoke(ContainerInterface $container): RedisCache
    {
        $config = $container->get('config')['doctrine']['driver']['annotations'];

        $redis = new \Redis;
        $redis->connect($config['cache']['redis']['host']);

        $cache = new RedisCache;
        $cache->setRedis($redis);

        return $cache;
    }
}

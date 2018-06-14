<?php

namespace IntegrationTest\Doctrine\Factory;

use App\Factory\Doctrine\AppRedisCache;
use Doctrine\Common\Cache\RedisCache;
use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;

class AppRedisCacheTest extends TestCase
{
    private $configuration;

    protected function setUp()
    {
        $this->configuration = array_undot(['doctrine.driver.annotations.cache.redis.host' => '127.0.0.1']);
    }

    public function testFactoryInvocation(): void
    {
        $container = new ServiceManager;
        $container->setService('config', $this->configuration);

        $factory = new AppRedisCache();

        $this->assertInstanceOf(AppRedisCache::class, $factory);
        $this->assertInstanceOf(RedisCache::class, $factory($container));
    }
}

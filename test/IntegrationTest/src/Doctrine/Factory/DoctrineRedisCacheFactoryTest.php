<?php

declare(strict_types=1);

namespace IntegrationTest\Doctrine\Factory;

use Doctrine\Common\Cache\RedisCache;
use Integration\Doctrine\Factory\DoctrineRedisCacheFactory;
use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;

class DoctrineRedisCacheFactoryTest extends TestCase
{
    /** @var array */
    private $configuration;

    public function setUp(): void
    {
        $this->configuration = array_undot(['doctrine.driver.annotations.cache.redis.host' => 'localhost']);
    }

    public function testFactoryInvocation(): void
    {
        $container = new ServiceManager;
        $container->setService('config', $this->configuration);

        $factory = new DoctrineRedisCacheFactory;

        $this->assertInstanceOf(DoctrineRedisCacheFactory::class, $factory);
        $this->assertInstanceOf(RedisCache::class, $factory($container));
    }
}

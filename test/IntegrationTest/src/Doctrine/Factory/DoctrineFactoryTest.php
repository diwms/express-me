<?php

declare(strict_types=1);

namespace IntegrationTest\Doctrine\Factory;

use Doctrine\Common\Cache\Cache;
use Doctrine\DBAL\Driver\PDOPgSql\Driver;
use Doctrine\ORM\EntityManager;
use Integration\Doctrine\Factory\DoctrineFactory;
use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;

class DoctrineFactoryTest extends TestCase
{
    private $configuration;

    public function setUp(): void
    {
        $this->configuration = array_undot(
            [
                'doctrine.connection.orm_default.params.driverClass' => Driver::class,
                'doctrine.driver.annotations.paths'                  => 'src/App/src/Entity',
                'doctrine.configuration.proxy_dir'                   => 'data/cache/DoctrineORM/Proxy',
                'doctrine.configuration.proxy_namespace'             => 'DoctrineORM/Proxy',
            ]
        );
    }

    public function testFactoryInvocation(): void
    {
        $container = new ServiceManager;
        $container->setService('config', $this->configuration);
        $container->setService(Cache::class, $this->createMock(Cache::class));

        $factory = new DoctrineFactory;

        $this->assertInstanceOf(DoctrineFactory::class, $factory);
        $this->assertInstanceOf(EntityManager::class, $factory($container));
    }
}

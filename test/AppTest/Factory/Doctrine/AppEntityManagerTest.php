<?php

namespace AppTest\Doctrine\Factory;

use App\Factory\Doctrine\AppEntityManager;
use Doctrine\Common\Cache\Cache;
use Doctrine\DBAL\Driver\PDOPgSql\Driver;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;

class AppEntityManagerTest extends TestCase
{
    private $configuration;

    protected function setUp()
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

        $factory = new AppEntityManager();

        $this->assertInstanceOf(AppEntityManager::class, $factory);
        $this->assertInstanceOf(EntityManager::class, $factory($container));
    }
}

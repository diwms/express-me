<?php

namespace App\Factory\Doctrine;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\Cache;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Psr\Container\ContainerInterface;

class AppEntityManager
{
    public function __invoke(ContainerInterface $container): EntityManager
    {
        $config = $container->get('config')['doctrine'];
        $configuration = $config['configuration'];
        $autoGenerateProxyClasses = $configuration['auto_generate_proxy_classes'] ?? false;

        $doctrine = new Configuration();
        $doctrine->setProxyDir($configuration['proxy_dir']);
        $doctrine->setProxyNamespace($configuration['proxy_namespace']);
        $doctrine->setAutoGenerateProxyClasses($autoGenerateProxyClasses);
        $doctrine->setNamingStrategy(new UnderscoreNamingStrategy());

        $driver = new AnnotationDriver(new AnnotationReader(), $config['driver']['annotations']['paths']);
        $doctrine->setMetadataDriverImpl($driver);

        $cache = $container->get(Cache::class);
        $doctrine->setQueryCacheImpl($cache);
        $doctrine->setResultCacheImpl($cache);
        $doctrine->setMetadataCacheImpl($cache);

        return EntityManager::create($config['connection']['orm_default']['params'], $doctrine);
    }
}

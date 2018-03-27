<?php

namespace App\Factory;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Doctrine\Common\Cache\RedisCache;
use Psr\Container\ContainerInterface;

class DoctrineFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return EntityManager
     * @throws \Doctrine\Common\Annotations\AnnotationException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): EntityManager
    {
        $config = $container->get('config');
        $config = $config['doctrine'];

        $autoGenerateProxyClasses = $config['configuration']['auto_generate_proxy_classes'] ?? false;
        $underscoreNamingStrategy = $config['configuration']['underscore_naming_strategy'] ?? false;

        // Doctrine ORM
        $doctrine = new Configuration();
        $doctrine->setProxyDir($config['configuration']['proxy_dir']);
        $doctrine->setProxyNamespace($config['configuration']['proxy_namespace']);
        $doctrine->setAutoGenerateProxyClasses($autoGenerateProxyClasses);

        // Naming Strategy
        if ($underscoreNamingStrategy) {
            $doctrine->setNamingStrategy(new UnderscoreNamingStrategy());
        }

        // ORM mapping by Annotation
        //AnnotationRegistry::registerAutoloadNamespace($config['driver']['annotations']['class']);
        AnnotationRegistry::registerFile(__DIR__ . '/../../../../vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php');
        $driver = new AnnotationDriver(
            new AnnotationReader(),
            $config['driver']['annotations']['paths']
        );

        $doctrine->setMetadataDriverImpl($driver);

        // Cache
        if ($config['use_redis_as_cache']) {
            $redis = new \Redis();
            $redis->connect($config['cache']['redis']['host']);

            $cache = new RedisCache();
            $cache->setRedis($redis);
            $doctrine->setQueryCacheImpl($cache);
            $doctrine->setResultCacheImpl($cache);
            $doctrine->setMetadataCacheImpl($cache);
        }

        // EntityManager
        return EntityManager::create($config['connection']['orm_default']['params'], $doctrine);
    }
}

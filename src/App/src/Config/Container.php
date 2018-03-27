<?php

declare(strict_types=1);

namespace App\Config;

use Psr\Container\ContainerInterface;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceManager;

class Container
{
    /** @var ContainerInterface */
    private $container;

    /**
     * Container constructor.
     */
    public function __construct()
    {
        $aggregator = new Aggregator();
        $container = new ServiceManager();

        (new Config($aggregator->getMergedConfig()['config']))->configureServiceManager($container);

        $container->setService('config', $aggregator->getMergedConfig());

        $this->container = $container;
    }

    /**
     * @return ContainerInterface
     */
    public function get(): ContainerInterface
    {
        return $this->container;
    }
}

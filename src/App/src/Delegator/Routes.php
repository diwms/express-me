<?php

declare(strict_types=1);

namespace App\Delegator;

use App\Action\HomePageAction;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;

/**
 * Class Routes.
 * Perform application routes setup.
 */
class Routes
{
    public function __invoke(ContainerInterface $container, $serviceName, callable $callback)
    {
        /** @var $app Application */
        $app = $callback();

        $app->get('/', HomePageAction::class);

        return $app;
    }
}

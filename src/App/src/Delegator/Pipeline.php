<?php

declare(strict_types=1);

namespace App\Delegator;

use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Stratigility\Middleware\ErrorHandler;

class Pipeline
{
    /**
     * @param ContainerInterface $container
     * @param string             $serviceName
     * @param callable           $callback
     *
     * @return Application
     */
    public function __invoke(ContainerInterface $container, $serviceName, callable $callback)
    {
        /** @var $app Application */
        $app = $callback();

        $app->pipe(ErrorHandler::class);
        $app->pipeRoutingMiddleware();
        $app->pipeDispatchMiddleware();

        return $app;
    }
}

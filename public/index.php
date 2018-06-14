<?php

if (PHP_SAPI === 'cli-server' && __FILE__ !== $_SERVER['SCRIPT_FILENAME']) {
    return false;
}

require_once __DIR__.'/../vendor/autoload.php';

(function () {
    /** @var \Psr\Container\ContainerInterface $container */
    $container = require_once __DIR__.'/../config/container.php';

    /** @var \Zend\Expressive\Application $app */
    $app = $container->get(\Zend\Expressive\Application::class);
    $factory = $container->get(\Zend\Expressive\MiddlewareFactory::class);

    (require_once __DIR__.'/../config/pipeline.php')($app, $factory, $container);
    (require_once __DIR__.'/../config/routes.php')($app, $factory, $container);

    $app->run();
})();

<?php

declare(strict_types=1);

if (PHP_SAPI === 'cli-server' && $_SERVER['SCRIPT_FILENAME'] !== __FILE__) {
    return false;
}

require_once __DIR__ . '/../vendor/autoload.php';

(function () {
    /** @var \Psr\Container\ContainerInterface $container */
    $container = require_once __DIR__ . '/../config/container.php';

    //var_dump($container);exit;
    /** @var \Zend\Expressive\Application $app */
    $app     = $container->get(\Zend\Expressive\Application::class);
    $factory = $container->get(\Zend\Expressive\MiddlewareFactory::class);

    (require_once __DIR__ . '/../config/pipeline.php')($app, $factory, $container);
    (require_once __DIR__ . '/../config/routes.php')($app, $factory, $container);

    $app->run();
})();
<?php

declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

(function () {
    $container = (new \App\Config\Container())->get();
    $app = $container->get(\Zend\Expressive\Application::class);
    $app->run();
})();

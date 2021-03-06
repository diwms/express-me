<?php

use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\MiddlewareFactory;

return function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    $app->get('/', \App\Http\Handler\HomePageHandler::class, 'home');
    $app->get('/post/{slug:[0-9a-zA-Z\-]+}', App\Http\Handler\PostPageHandler::class, 'post.view');
};

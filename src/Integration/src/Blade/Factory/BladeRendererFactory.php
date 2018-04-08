<?php

declare(strict_types=1);

namespace Integration\Blade\Factory;

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\ViewServiceProvider;
use Integration\Blade\BladeRenderer;
use Psr\Container\ContainerInterface;

class BladeRendererFactory
{
    /**
     * @param ContainerInterface $sm
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @return BladeRenderer
     */
    public function __invoke(ContainerInterface $sm): BladeRenderer
    {
        $templates = $sm->get('config')['templates'];
        $container = new Container();

        $container->bind('files', function () {
            return new Filesystem();
        }, true);

        $container->bind('events', function () {
            return new Dispatcher();
        }, true);

        $container->bindIf('config', function () use ($templates) {
            return [
                'view.paths'    => $templates['paths'],
                'view.compiled' => $templates['cache'],
            ];
        }, true);

        /** @var \Illuminate\Contracts\Foundation\Application $container */
        (new ViewServiceProvider($container))->register();

        return new BladeRenderer($container['view']);
    }
}

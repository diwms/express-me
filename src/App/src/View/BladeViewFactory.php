<?php

declare(strict_types=1);

namespace App\View;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Events\Dispatcher as EventDispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Factory as ViewFactory;
use Illuminate\View\FileViewFinder;
use Illuminate\View\ViewFinderInterface;
use Psr\Container\ContainerInterface;

class BladeViewFactory
{
    const SERVICE_NAME = '\App\View\BladeView';

    public function __invoke(ContainerInterface $container)
    {
        return $this->createViewFactory($container);
    }

    public function createViewFactory($container)
    {
        $viewResolver = new EngineResolver();

        $config = $container->has('config') ? $container->get('config') : [];

        $cachePath = $config['templates']['cache'];

        $viewResolver->register('blade', function () use ($cachePath) {
            return new CompilerEngine(
                new BladeCompiler(
                    new Filesystem(),
                    $cachePath
                )
            );
        });

        $viewResolver->register('php', function () {
            return new PhpEngine();
        });

        $finder = $this->getViewFinder($container);
        $dispatcher = $this->getEventDispatcher($container);

        return new ViewFactory($viewResolver, $finder, $dispatcher);
    }

    protected function getViewFinder($container)
    {
        if ($container->has(ViewFinderInterface::class)) {
            return $container->get(ViewFinderInterface::class);
        }

        return new FileViewFinder(new Filesystem(), []);
    }

    protected function getEventDispatcher($container)
    {
        if ($container->has(Dispatcher::class)) {
            return $container->get(Dispatcher::class);
        }

        return new EventDispatcher();
    }
}
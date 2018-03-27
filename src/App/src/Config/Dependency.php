<?php

declare(strict_types=1);

namespace App\Config;

use App\Delegator\Pipeline;
use App\Delegator\Routes;
use App\View\BladeRendererFactory;
use Zend\Expressive\Application;
use Zend\Expressive\Container\ApplicationFactory;
use Zend\Expressive\Container\ErrorHandlerFactory;
use Zend\Expressive\Container\NotFoundDelegateFactory;
use Zend\Expressive\Delegate\NotFoundDelegate;
use Zend\Expressive\Router\FastRouteRouter;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Stratigility\Middleware\ErrorHandler;

class Dependency
{
    /** @var array */
    public static $config = [
        'config' => [
            'delegators' => [
                Application::class => [Pipeline::class, Routes::class],
            ],
            'invokables' => [
                RouterInterface::class => FastRouteRouter::class,
            ],
            'factories'  => [
                Application::class      => ApplicationFactory::class,
                NotFoundDelegate::class => NotFoundDelegateFactory::class,
                ErrorHandler::class     => ErrorHandlerFactory::class,

                TemplateRendererInterface::class => BladeRendererFactory::class,
            ],
        ],
    ];
}

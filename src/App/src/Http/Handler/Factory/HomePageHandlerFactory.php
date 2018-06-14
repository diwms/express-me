<?php

namespace App\Http\Handler\Factory;

use App\Http\Handler\HomePageHandler;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class HomePageHandlerFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return RequestHandlerInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        /**
         * @var EntityManager             $entityManager
         * @var TemplateRendererInterface $template
         */

        $entityManager = $container->get(EntityManager::class);
        $template      = $container->get(TemplateRendererInterface::class);

        return new HomePageHandler($entityManager, $template);
    }
}

<?php

declare(strict_types=1);

namespace App\Action;

use Interop\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;

class HomePageAction implements MiddlewareInterface
{
    private $router;

    private $template;

    public function __construct(Router\RouterInterface $router, Template\TemplateRendererInterface $template = null)
    {
        $this->router = $router;
        $this->template = $template;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $data['routerName'] = 'FastRoute';

        return new HtmlResponse($this->template->render('app::home', $data));
    }
}

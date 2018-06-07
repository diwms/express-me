<?php

declare(strict_types=1);

namespace App\Http\Handler;

use App\Entity\PostEntity;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrinePaginatorAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use Zend\Paginator\Paginator;

class HomePageHandler implements RequestHandlerInterface
{
    /** @var TemplateRendererInterface */
    private $template;

    /** @var EntityManager */
    private $entityManager;

    public function __construct(EntityManager $entityManager, TemplateRendererInterface $template)
    {
        $this->entityManager = $entityManager;
        $this->template      = $template;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $page = $request->getQueryParams()['page'] ?? 1;
        $postsRepository = $this->entityManager->getRepository(PostEntity::class);
        $posts           = $postsRepository->findAll();

        $doctrinePaginator = new DoctrinePaginator($posts, false);
        $adapter           = new DoctrinePaginatorAdapter($doctrinePaginator);

        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);
        $paginator->setCurrentPageNumber($page);

        return new HtmlResponse($this->template->render('app::home-page', [
            'posts' => $paginator,
        ]));
    }
}

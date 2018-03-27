<?php

declare(strict_types=1);

namespace App\Http\Handler;

use App\Entity\PostEntity;
use Doctrine\ORM\EntityManager;
use League\CommonMark\CommonMarkConverter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class PostPageHandler implements RequestHandlerInterface
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
        $slug           = $request->getAttribute('slug');
        $postRepository = $this->entityManager->getRepository(PostEntity::class);
        /** @var PostEntity $post */
        $post = $postRepository->findOneBySlug($slug);

        $converter = new CommonMarkConverter();
        $post->setContent($converter->convertToHtml($post->getContent()));

        return new HtmlResponse($this->template->render('app::post-page', [
            'post' => $post,
            'tags' => $post->tagsToString()
        ]));
    }
}

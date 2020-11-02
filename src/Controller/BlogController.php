<?php

declare(strict_types=1);

namespace App\Controller;

use App\Builder\PostBuilder;
use App\Entity\Post;
use App\Formatter\PaginatorFormatter;
use App\Formatter\PostFormatter;
use App\Repository\PostRepository;
use App\Service\BlogService;
use App\Validation\EditPostRequest;
use App\Validation\PageRequest;
use App\Validation\ViewPostRequest;
use Psr\Http\Message\ResponseInterface as Response;
use Yiisoft\DataResponse\DataResponseFactoryInterface;

final class BlogController
{
    private DataResponseFactoryInterface $responseFactory;
    private PostRepository $postRepository;
    private PostFormatter $postFormatter;
    private PostBuilder $postBuilder;
    private BlogService $blogService;

    public function __construct(
        PostRepository $postRepository,
        DataResponseFactoryInterface $responseFactory,
        PostFormatter $postFormatter,
        PostBuilder $postBuilder,
        BlogService $blogService
    ) {
        $this->postRepository = $postRepository;
        $this->responseFactory = $responseFactory;
        $this->postFormatter = $postFormatter;
        $this->postBuilder = $postBuilder;
        $this->blogService = $blogService;
    }

    public function index(PageRequest $request, PaginatorFormatter $paginatorFormatter): Response
    {
        $paginator = $this->blogService->getPosts($request->getPage());
        $posts = [];
        foreach ($paginator->read() as $post) {
            $posts[] = $this->postFormatter->format($post);
        }

        return $this->responseFactory->createResponse(
            [
                'paginator' => $paginatorFormatter->format($paginator),
                'posts' => $posts
            ]
        );
    }

    public function view(ViewPostRequest $request): Response
    {
        return $this->responseFactory->createResponse(
            [
                'post' => $this->postFormatter->format(
                    $this->blogService->getPost($request->getId())
                )
            ]
        );
    }

    public function create(EditPostRequest $postRequest): Response
    {
        $post = $this->postBuilder->build(new Post(), $postRequest);
        $post->setUser($postRequest->getUser());

        $this->postRepository->save($post);

        return $this->responseFactory->createResponse();
    }

    public function update(EditPostRequest $postRequest): Response
    {
        $post = $this->postBuilder->build(
            $this->blogService->getPost($postRequest->getId()),
            $postRequest
        );

        $this->postRepository->save($post);

        return $this->responseFactory->createResponse();
    }
}

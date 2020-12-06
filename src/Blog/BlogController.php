<?php

declare(strict_types=1);

namespace App\Blog;

use App\Formatter\PaginatorFormatter;
use App\User\UserRequest;
use Psr\Http\Message\ResponseInterface as Response;
use Yiisoft\DataResponse\DataResponseFactoryInterface;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="blog",
 *     description="Blog"
 * )
 */
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

    /**
     * @OA\Get(
     *     tags={"blog"},
     *     path="/blog/",
     *     summary="Returns paginated blog posts",
     *     description="",
     *     @OA\Parameter(ref="#/components/parameters/PageRequest"),
     *     @OA\Response(
     *          response="200",
     *          description="Success",
     *          @OA\JsonContent(
     *              allOf={
     *                  @OA\Schema(ref="#/components/schemas/Response"),
     *                  @OA\Schema(
     *                      @OA\Property(
     *                          property="data",
     *                          type="object",
     *                          @OA\Property(
     *                              property="posts",
     *                              type="array",
     *                              @OA\Items(ref="#/components/schemas/Post")
     *                          ),
     *                          @OA\Property(
     *                              property="paginator",
     *                              type="object",
     *                              ref="#/components/schemas/Paginator"
     *                          ),
     *                      ),
     *                  ),
     *              },
     *          )
     *    ),
     * )
     */
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
                'posts' => $posts,
            ]
        );
    }

    /**
     * @OA\Get(
     *     tags={"blog"},
     *     path="/blog/{id}",
     *     summary="Returns a post with a given ID",
     *     description="",
     *     @OA\Response(response="200", description="Success")
     * )
     */
    public function view(ViewPostRequest $request): Response
    {
        return $this->responseFactory->createResponse(
            [
                'post' => $this->postFormatter->format(
                    $this->blogService->getPost($request->getId())
                ),
            ]
        );
    }

    /**
     * @OA\Post(
     *     tags={"blog"},
     *     path="/blog",
     *     summary="Creates a blog post",
     *     description="",
     *     @OA\Response(response="200", description="Success")
     * )
     */
    public function create(EditPostRequest $postRequest, UserRequest $userRequest): Response
    {
        $post = $this->postBuilder->build(new Post(), $postRequest);
        $post->setUser($userRequest->getUser());

        $this->postRepository->save($post);

        return $this->responseFactory->createResponse();
    }

    /**
     * @OA\Put(
     *     tags={"blog"},
     *     path="/blog/{id}",
     *     summary="Updates a blog post with a given ID",
     *     description="",
     *     @OA\Response(response="200", description="Success")
     * )
     */
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

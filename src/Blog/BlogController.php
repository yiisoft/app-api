<?php

declare(strict_types=1);

namespace App\Blog;

use App\Formatter\PaginatorFormatter;
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
    private PostFormatter $postFormatter;
    private BlogService $blogService;

    public function __construct(
        DataResponseFactoryInterface $responseFactory,
        PostFormatter $postFormatter,
        BlogService $blogService
    ) {
        $this->responseFactory = $responseFactory;
        $this->postFormatter = $postFormatter;
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
     *     @OA\Parameter(
     *          @OA\Schema(type="int", example="2"),
     *          in="path",
     *          name="id",
     *          parameter="id"
     *     ),
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
     *                              property="post",
     *                              type="object",
     *                              ref="#/components/schemas/Post"
     *                          ),
     *                      ),
     *                  ),
     *              },
     *          )
     *    ),
     *    @OA\Response(
     *          response="404",
     *          description="Not found",
     *          @OA\JsonContent(
     *              allOf={
     *                  @OA\Schema(ref="#/components/schemas/BadResponse"),
     *                  @OA\Schema(
     *                      @OA\Property(property="error_message", example="Entity not found"),
     *                      @OA\Property(property="error_code", nullable=true, example=404)
     *                  ),
     *              },
     *          )
     *    ),
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
}

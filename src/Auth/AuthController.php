<?php

declare(strict_types=1);

namespace App\Auth;

use App\User\UserService;
use Psr\Http\Message\ResponseInterface;
use Yiisoft\DataResponse\DataResponseFactoryInterface as ResponseFactory;

/**
 * @OA\Tag(
 *     name="auth",
 *     description="Authentication"
 * )
 */
final class AuthController
{
    private ResponseFactory $responseFactory;
    private UserService $userService;

    public function __construct(
        ResponseFactory $responseFactory,
        UserService $userService
    ) {
        $this->responseFactory = $responseFactory;
        $this->userService = $userService;
    }

    /**
     * @OA\Post(
     *     tags={"auth"},
     *     path="/auth/",
     *     summary="Authenticate by params",
     *     description="",
     *     @OA\Response(
     *          response="200",
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/SuccessLoginResponse")
     *    ),
     *    @OA\Response(
     *          response="400",
     *          description="Bad request",
     *          @OA\JsonContent(ref="#/components/schemas/BadResponse")
     *     ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/AuthRequest"),
     *          ),
     *     ),
     * )
     */
    public function login(AuthRequest $request): ResponseInterface
    {
        return $this->responseFactory->createResponse(
            [
                'token' => $this->userService->login(
                    $request->getLogin(),
                    $request->getPassword()
                )->getToken(),
            ]
        );
    }

    /**
     * @OA\Post(
     *     tags={"auth"},
     *     path="/logout/",
     *     summary="Logout",
     *     description="",
     *     @OA\Response(
     *          response="200",
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/Response")
     *    ),
     *    @OA\Response(
     *          response="400",
     *          description="Bad request",
     *          @OA\JsonContent(ref="#/components/schemas/BadResponse")
     *     ),
     * )
     */
    public function logout(): ResponseInterface
    {
        $this->userService->logout();
        return $this->responseFactory->createResponse();
    }
}

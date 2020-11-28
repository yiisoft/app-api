<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\UserService;
use App\Validation\AuthRequest;
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
     *     path="/auth",
     *     summary="Authenticate by token",
     *     description="",
     *     @OA\Response(response="200", description="Success")
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
     *     path="/logout",
     *     summary="Logout",
     *     description="",
     *     @OA\Response(response="200", description="Success")
     * )
     */
    public function logout(): ResponseInterface
    {
        $this->userService->logout();
        return $this->responseFactory->createResponse();
    }
}

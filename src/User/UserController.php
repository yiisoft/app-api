<?php

declare(strict_types=1);

namespace App\User;

use App\Exception\NotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\DataResponse\DataResponseFactoryInterface;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="user",
 *     description="Users"
 * )
 */
final class UserController
{
    private DataResponseFactoryInterface $responseFactory;
    private UserRepository $userRepository;
    private UserFormatter $userFormatter;

    public function __construct(
        DataResponseFactoryInterface $responseFactory,
        UserRepository $userRepository,
        UserFormatter $userFormatter
    ) {
        $this->responseFactory = $responseFactory;
        $this->userRepository = $userRepository;
        $this->userFormatter = $userFormatter;
    }

    /**
     * @OA\Get(
     *     tags={"user"},
     *     path="/users",
     *     summary="Returns paginated users",
     *     description="",
     *     @OA\Response(response="200", description="Success")
     * )
     */
    public function index(): ResponseInterface
    {
        $dataReader = $this->userRepository->findAllOrderByLogin();
        $result = [];
        foreach ($dataReader->read() as $user) {
            $result[] = $this->userFormatter->format($user);
        }

        return $this->responseFactory->createResponse(
            [
                'users' => $result,
            ]
        );
    }

    /**
     * @OA\Get(
     *     tags={"user"},
     *     path="/users/{id}",
     *     summary="Returns a user with a given ID",
     *     description="",
     *     @OA\Response(response="200", description="Success")
     * )
     */
    public function view(ServerRequestInterface $request): ResponseInterface
    {
        /**
         * @var User $user
         */
        $user = $this->userRepository->findByPK($request->getAttribute('id'));
        if ($user === null) {
            throw new NotFoundException();
        }

        return $this->responseFactory->createResponse(
            [
                'user' => $this->userFormatter->format($user),
            ]
        );
    }
}

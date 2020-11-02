<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Exception\NotFoundException;
use App\Formatter\UserFormatter;
use App\Repository\UserRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\DataResponse\DataResponseFactoryInterface;

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

    public function index(): ResponseInterface
    {
        $dataReader = $this->userRepository->findAllOrderByLogin();
        $result = [];
        foreach ($dataReader->read() as $user) {
            $result[] = $this->userFormatter->format($user);
        }

        return $this->responseFactory->createResponse(
            [
                'users' => $result
            ]
        );
    }

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
                'user' => $this->userFormatter->format($user)
            ]
        );
    }
}

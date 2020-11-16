<?php

declare(strict_types=1);

use App\Auth\AuthRequestErrorHandler;
use Yiisoft\Auth\AuthenticationMethodInterface;
use Yiisoft\Auth\IdentityRepositoryInterface;
use App\Repository\UserRepository;
use Yiisoft\Auth\Method\HttpHeader;
use Yiisoft\Auth\Middleware\Authentication;
use Yiisoft\Factory\Definitions\Reference;

return [
    IdentityRepositoryInterface::class => UserRepository::class,
    AuthenticationMethodInterface::class => HttpHeader::class,
    Authentication::class => [
        'class' => Authentication::class,
        '__construct()' => [
            'authenticationFailureHandler' => Reference::to(AuthRequestErrorHandler::class)
        ],
    ],
];


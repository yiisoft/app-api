<?php

use App\Factory\MiddlewareDispatcherFactory;
use App\Formatter\ApiResponseFormatter;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UploadedFileFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Yiisoft\Auth\IdentityRepositoryInterface;
use Yiisoft\DataResponse\DataResponseFactory;
use Yiisoft\DataResponse\DataResponseFactoryInterface;
use Yiisoft\DataResponse\DataResponseFormatterInterface;
use Yiisoft\Validator\ValidatorFactoryInterface;
use Yiisoft\Yii\Web\ErrorHandler\JsonRenderer;
use Yiisoft\Yii\Web\ErrorHandler\ThrowableRendererInterface;
use Yiisoft\Yii\Web\MiddlewareDispatcher;
use App\Repository\UserRepository;
use Yiisoft\Validator\ValidatorFactory;

return [
    RequestFactoryInterface::class => Psr17Factory::class,
    ServerRequestFactoryInterface::class => Psr17Factory::class,
    ResponseFactoryInterface::class => Psr17Factory::class,
    StreamFactoryInterface::class => Psr17Factory::class,
    UriFactoryInterface::class => Psr17Factory::class,
    UploadedFileFactoryInterface::class => Psr17Factory::class,
    DataResponseFactoryInterface::class => DataResponseFactory::class,
    MiddlewareDispatcher::class => new MiddlewareDispatcherFactory(),
    IdentityRepositoryInterface::class => UserRepository::class,
    ThrowableRendererInterface::class => JsonRenderer::class,
    ValidatorFactoryInterface::class => ValidatorFactory::class,
    DataResponseFormatterInterface::class => ApiResponseFormatter::class,
];

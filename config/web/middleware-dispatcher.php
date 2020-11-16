<?php

declare(strict_types=1);

use App\NotFoundHandler;
use Psr\Container\ContainerInterface;
use Yiisoft\Router\Middleware\Router;
use Yiisoft\ErrorHandler\ErrorCatcher;
use Yiisoft\Yii\Web\Middleware\SubFolder;
use Yiisoft\Yii\Web\MiddlewareDispatcher;

return [
    MiddlewareDispatcher::class => static fn (ContainerInterface $container) =>
        (new MiddlewareDispatcher($container, $container->get(NotFoundHandler::class)))
            ->addMiddleware($container->get(Router::class))
            ->addMiddleware($container->get(SubFolder::class))
            ->addMiddleware(($container->get(ErrorCatcher::class))->forceContentType('application/json')),
];

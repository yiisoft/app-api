<?php

declare(strict_types=1);

namespace App\Factory;

use Psr\Container\ContainerInterface;
use Yiisoft\Router\Middleware\Router;
use Yiisoft\Yii\Web\ErrorHandler\ErrorCatcher;
use Yiisoft\Yii\Web\Middleware\SubFolder;
use Yiisoft\Yii\Web\MiddlewareDispatcher;
use App\NotFoundHandler;

final class MiddlewareDispatcherFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $router = $container->get(Router::class);
        $errorCatcher = $container->get(ErrorCatcher::class);
        $subFolder = $container->get(SubFolder::class);
        $notFoundHandler = $container->get(NotFoundHandler::class);

        return (new MiddlewareDispatcher($container, $notFoundHandler))
            ->addMiddleware($router)
            ->addMiddleware($subFolder)
            ->addMiddleware($errorCatcher->forceContentType('application/json'));
    }
}

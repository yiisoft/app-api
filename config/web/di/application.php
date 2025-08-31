<?php

declare(strict_types=1);

use App\Http\NotFoundHandler;
use Yiisoft\Definitions\DynamicReference;
use Yiisoft\Definitions\Reference;
use Yiisoft\ErrorHandler\Middleware\ErrorCatcher;
use Yiisoft\Injector\Injector;
use Yiisoft\Middleware\Dispatcher\MiddlewareDispatcher;
use Yiisoft\RequestProvider\RequestCatcherMiddleware;
use Yiisoft\Router\Middleware\Router;
use Yiisoft\Yii\Middleware\Subfolder;

/** @var array $params */

return [
    Yiisoft\Yii\Http\Application::class => [
        '__construct()' => [
            'dispatcher' => DynamicReference::to(static function (Injector $injector) use ($params) {
                return $injector->make(MiddlewareDispatcher::class)
                    ->withMiddlewares([
                        RequestCatcherMiddleware::class,
                        ErrorCatcher::class,
                        Subfolder::class,
                        Router::class,
                    ]);
            }),
            'fallbackHandler' => Reference::to(NotFoundHandler::class),
        ],
    ],
];

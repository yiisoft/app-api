<?php

declare(strict_types=1);

use App\NotFoundHandler;
use Yiisoft\ErrorHandler\ErrorCatcher;
use Yiisoft\Injector\Injector;
use Yiisoft\Middleware\Dispatcher\MiddlewareDispatcher;
use Yiisoft\Router\Middleware\Router;
use Yiisoft\Yii\Web\Middleware\SubFolder;
use Yiisoft\Factory\Definitions\Reference;

return [
    Yiisoft\Yii\Web\Application::class => [
        '__construct()' => [
            'dispatcher' => static function (Injector $injector) {
                return ($injector->make(MiddlewareDispatcher::class))
                    ->withMiddlewares(
                        [
                            Router::class,
                            SubFolder::class,
                            ErrorCatcher::class,
                        ]
                    );
            },
            'fallbackHandler' => Reference::to(NotFoundHandler::class),
        ],
    ],
];

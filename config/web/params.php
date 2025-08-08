<?php

declare(strict_types=1);

use Yiisoft\ErrorHandler\Middleware\ErrorCatcher;
use Yiisoft\RequestProvider\RequestCatcherMiddleware;
use Yiisoft\Router\Middleware\Router;
use Yiisoft\Yii\Middleware\Subfolder;

return [
    'yiisoft/input-http' => [
        'requestInputParametersResolver' => [
            'throwInputValidationException' => true,
        ],
    ],

    'middlewares' => [
        RequestCatcherMiddleware::class,
        ErrorCatcher::class,
        Subfolder::class,
        Router::class,
    ],
];

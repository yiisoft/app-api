<?php

declare(strict_types=1);

use Yiisoft\ErrorHandler\Middleware\ErrorCatcher;
use Yiisoft\Router\Middleware\Router;
use Yiisoft\Yii\Middleware\Locale;
use Yiisoft\Yii\Middleware\Subfolder;

return [
    'yiisoft/input-http' => [
        'requestInputParametersResolver' => [
            'throwInputValidationException' => true,
        ],
    ],

    'middlewares' => [
        ErrorCatcher::class,
        Subfolder::class,
        Locale::class,
        Router::class,
    ],

    'locale' => [
        'locales' => ['en' => 'en-US', 'ru' => 'ru-RU'],
        'ignoredRequests' => [
            '/debug**',
        ],
    ],
];

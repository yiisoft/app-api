<?php

declare(strict_types=1);

use Yiisoft\ErrorHandler\Middleware\ErrorCatcher;
use Yiisoft\Router\Middleware\Router;
use Yiisoft\Yii\Middleware\Locale;
use Yiisoft\Yii\Middleware\SubFolder;

return [
    'middlewares' => [
        ErrorCatcher::class,
        SubFolder::class,
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

<?php

declare(strict_types=1);

use App\Provider\CacheProvider;
use App\Provider\LoggerProvider;
use App\Provider\RepositoryProvider;
use Yiisoft\Arrays\Modifier\ReverseBlockMerge;
use App\Provider\AuthProvider;
use Yiisoft\Yii\Event\EventDispatcherProvider;
use Yiisoft\Composer\Config\Builder;

return [
    CacheProvider::class => CacheProvider::class,
    LoggerProvider::class => LoggerProvider::class,
    RepositoryProvider::class => RepositoryProvider::class,
    ReverseBlockMerge::class => new ReverseBlockMerge(),
    AuthProvider::class => AuthProvider::class,
    'yiisoft/event-dispatcher/eventdispatcher' => [
        '__class' => EventDispatcherProvider::class,
        '__construct()' => [Builder::require('events')],
    ],
];

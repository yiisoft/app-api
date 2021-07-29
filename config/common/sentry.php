<?php
declare(strict_types=1);

return [
    \Http\Client\HttpClient::class => \GuzzleHttp\Client::class,
    \Http\Client\HttpAsyncClient::class => [
        'class' => \Http\Adapter\Guzzle7\Client::class,
        '__construct()' => [
            \Yiisoft\Factory\Definition\Reference::to(\GuzzleHttp\Client::class),
        ],
    ],
];

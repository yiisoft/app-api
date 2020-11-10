<?php

declare(strict_types=1);

use App\Factory\AppRouterFactory;
use Psr\Container\ContainerInterface;
use Yiisoft\Router\FastRoute\UrlGenerator;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Router\UrlMatcherInterface;
use Yiisoft\Router\RouteCollectionInterface;
use Yiisoft\Router\RouteCollection;

/**
 * @var array $params
 */

return [
    ContainerInterface::class => static function (ContainerInterface $container) {
        return $container;
    },
    UrlMatcherInterface::class => new AppRouterFactory(),
    UrlGeneratorInterface::class => UrlGenerator::class,
    RouteCollectionInterface::class => RouteCollection::class
];

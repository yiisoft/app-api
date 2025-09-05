<?php

declare(strict_types=1);

use Yiisoft\Config\Config;
use Yiisoft\Router\RouteCollection;
use Yiisoft\Router\RouteCollectionInterface;
use Yiisoft\Router\RouteCollectorInterface;

/** @var Config $config */

return [
    RouteCollectionInterface::class =>
        static fn(RouteCollectorInterface $collector) => new RouteCollection(
            $collector->addRoute(...$config->get('routes')),
        ),
];

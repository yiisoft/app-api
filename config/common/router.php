<?php

declare(strict_types=1);

use App\Middleware\ExceptionMiddleware;
use Yiisoft\Composer\Config\Builder;
use Yiisoft\DataResponse\Middleware\FormatDataResponse;
use Yiisoft\Injector\Injector;
use Yiisoft\Request\Body\RequestBodyParser;
use Yiisoft\Router\Group;
use Yiisoft\Router\RouteCollection;
use Yiisoft\Router\RouteCollectorInterface;
use Yiisoft\Router\RouteCollectionInterface;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Router\UrlMatcherInterface;
use Yiisoft\Router\FastRoute\UrlGenerator;
use Yiisoft\Router\FastRoute\UrlMatcher;

return [
    UrlMatcherInterface::class => static function (Injector $injector) {
        $arguments = [];
        if (true) { // TODO: make it configurable via params
            $arguments['cache'] = null;
        }
        return $injector->make(UrlMatcher::class, $arguments);
    },

    UrlGeneratorInterface::class => UrlGenerator::class,

    RouteCollectorInterface::class => Group::create(),

    RouteCollectionInterface::class => static function (RouteCollectorInterface $collector) {
        $collector->addGroup(
            Group::create(null, require Builder::path('routes'))
                ->addMiddleware(ExceptionMiddleware::class)
                ->addMiddleware(FormatDataResponse::class)
                ->addMiddleware(RequestBodyParser::class)
        );

        return new RouteCollection($collector);
    }
];

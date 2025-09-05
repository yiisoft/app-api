<?php

declare(strict_types=1);

use App\Http\ApiResponseFormatter;
use App\Http\ExceptionMiddleware;
use Yiisoft\Config\Config;
use Yiisoft\DataResponse\Formatter\HtmlDataResponseFormatter;
use Yiisoft\DataResponse\Formatter\JsonDataResponseFormatter;
use Yiisoft\DataResponse\Middleware\FormatDataResponse;
use Yiisoft\Request\Body\RequestBodyParser;
use Yiisoft\Router\Group;
use Yiisoft\Router\RouteCollection;
use Yiisoft\Router\RouteCollectionInterface;
use Yiisoft\Router\RouteCollectorInterface;

/** @var Config $config */

return [
    RouteCollectionInterface::class => static function (RouteCollectorInterface $collector) use ($config) {
        $apiRoutesGroup = Group::create()
            ->middleware(
                RequestBodyParser::class,
                static fn() => new FormatDataResponse(
                    new ApiResponseFormatter(
                        new JsonDataResponseFormatter(),
                    ),
                ),
                ExceptionMiddleware::class,
            )
            ->routes(... require dirname(__DIR__) . '/routes-api.php');

        $htmlRoutesGroup = Group::create()
            ->middleware(
                static fn() => new FormatDataResponse(
                    new HtmlDataResponseFormatter(),
                ),
            )
            ->routes(... require dirname(__DIR__) . '/routes-html.php');

        $otherRoutes = $config->get('routes');

        $collector->addRoute($apiRoutesGroup, $htmlRoutesGroup, ...$otherRoutes);

        return new RouteCollection($collector);
    },
];

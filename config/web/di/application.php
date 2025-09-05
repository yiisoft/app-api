<?php

declare(strict_types=1);

use App\Http\ApiResponseFormatter;
use App\Http\ExceptionMiddleware;
use App\Http\NotFoundHandler;
use Yiisoft\DataResponse\Formatter\JsonDataResponseFormatter;
use Yiisoft\DataResponse\Middleware\FormatDataResponse;
use Yiisoft\Definitions\DynamicReference;
use Yiisoft\Definitions\Reference;
use Yiisoft\ErrorHandler\Middleware\ErrorCatcher;
use Yiisoft\Input\Http\HydratorAttributeParametersResolver;
use Yiisoft\Input\Http\RequestInputParametersResolver;
use Yiisoft\Middleware\Dispatcher\CompositeParametersResolver;
use Yiisoft\Middleware\Dispatcher\MiddlewareDispatcher;
use Yiisoft\Middleware\Dispatcher\ParametersResolverInterface;
use Yiisoft\Request\Body\RequestBodyParser;
use Yiisoft\Router\Middleware\Router;
use Yiisoft\Yii\Http\Application;


/** @var array $params */

return [
    Application::class => [
        '__construct()' => [
            'dispatcher' => DynamicReference::to([
                'class' => MiddlewareDispatcher::class,
                'withMiddlewares()' => [
                    [
                        static fn() => new FormatDataResponse(
                            new ApiResponseFormatter(
                                new JsonDataResponseFormatter(),
                            ),
                        ),
                        RequestBodyParser::class,
                        ExceptionMiddleware::class,
                        ErrorCatcher::class,
                        Router::class,
                    ],
                ],
            ]),
            'fallbackHandler' => Reference::to(NotFoundHandler::class),
        ],
    ],

    ParametersResolverInterface::class => [
        'class' => CompositeParametersResolver::class,
        '__construct()' => [
            Reference::to(HydratorAttributeParametersResolver::class),
            Reference::to(RequestInputParametersResolver::class),
        ],
    ],
];

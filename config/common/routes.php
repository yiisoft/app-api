<?php

declare(strict_types=1);

use App\InfoController;
use Yiisoft\DataResponse\Middleware\FormatDataResponseAsHtml;
use Yiisoft\DataResponse\Middleware\FormatDataResponseAsJson;
use Yiisoft\Router\Group;
use Yiisoft\Router\Route;
use Yiisoft\Swagger\Action\SwaggerJson;
use Yiisoft\Swagger\Action\SwaggerUi;
use Yiisoft\Yii\Middleware\CorsAllowAll;

return [
    Route::get('/')
        ->action([InfoController::class, 'index'])
        ->name('api/info'),

    // Swagger routes
    Group::create('/docs')
        ->routes(
            Route::get('')
                ->middleware(FormatDataResponseAsHtml::class)
                ->action(fn (SwaggerUi $swaggerUi) => $swaggerUi->withJsonUrl('/docs/openapi.json')),
            Route::get('/openapi.json')
                ->middleware(FormatDataResponseAsJson::class)
                ->middleware(CorsAllowAll::class)
                ->action([SwaggerJson::class, 'handle']),
        ),
];

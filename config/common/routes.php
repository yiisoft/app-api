<?php

declare(strict_types=1);

use App\Controller\IndexController;
use Yiisoft\DataResponse\Middleware\FormatDataResponseAsHtml;
use Yiisoft\DataResponse\Middleware\FormatDataResponseAsJson;
use Yiisoft\HttpMiddleware\CorsAllowAllMiddleware;
use Yiisoft\Router\Group;
use Yiisoft\Router\Route;
use Yiisoft\Swagger\Action\SwaggerJson;
use Yiisoft\Swagger\Action\SwaggerUi;

/**
 * @var array $params
 */

return [
    Route::get('/')
        ->action([IndexController::class, 'index'])
        ->name('app/index'),

    Group::create('/docs')
        ->routes(
            Route::get('')
                ->middleware(FormatDataResponseAsHtml::class)
                ->action(fn(SwaggerUi $swaggerUi) => $swaggerUi->withJsonUrl('/docs/openapi.json')),
            Route::get('/openapi.json')
                ->middleware(FormatDataResponseAsJson::class)
                ->middleware(CorsAllowAllMiddleware::class)
                ->action(fn(SwaggerJson $swaggerJson) => $swaggerJson->withAnnotationPaths($params['yiisoft/yii-swagger']['annotation-paths'])),
        ),
];

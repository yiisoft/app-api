<?php

declare(strict_types=1);

use App\Auth\AuthController;
use App\Blog\BlogController;
use App\InfoController;
use Yiisoft\Auth\Middleware\Authentication;
use Yiisoft\DataResponse\Middleware\FormatDataResponseAsHtml;
use Yiisoft\DataResponse\Middleware\FormatDataResponseAsJson;
use Yiisoft\Router\Group;
use Yiisoft\Router\Route;
use Yiisoft\Swagger\Middleware\SwaggerJson;
use Yiisoft\Swagger\Middleware\SwaggerUi;

return [
    Route::get('/')
        ->action([InfoController::class, 'index'])
        ->name('api/info'),

    Route::get('/blog/')
        ->action([BlogController::class, 'index'])
        ->name('blog/index'),

    Route::get('/blog/{id:\d+}')
        ->action([BlogController::class, 'view'])
        ->name('blog/view'),

    Route::post('/auth/')
        ->action([AuthController::class, 'login'])
        ->name('auth'),

    Route::post('/logout/')
        ->middleware(Authentication::class)
        ->action([AuthController::class, 'logout'])
        ->name('logout'),

    // Swagger routes
    Group::create('/docs')
        ->routes(
            Route::get('')
                ->middleware(FormatDataResponseAsHtml::class)
                ->action(fn (SwaggerUi $swaggerUi) => $swaggerUi->withJsonUrl('/docs/openapi.json')),
            Route::get('/openapi.json')
                ->middleware(FormatDataResponseAsJson::class)
                ->action(
                    static function (SwaggerJson $swaggerJson) {
                        return $swaggerJson
                            // Uncomment cache for production environment
                            // ->withCache(3600)
                            ->withAnnotationPaths(
                                [
                                    '@src', // Path to API controllers
                                ]
                            );
                    }
                ),
        ),
];

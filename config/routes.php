<?php

declare(strict_types=1);

use App\Auth\AuthController;
use App\Blog\BlogController;
use App\InfoController;
use App\User\UserController;
use Yiisoft\Auth\Middleware\Authentication;
use Yiisoft\DataResponse\Middleware\FormatDataResponseAsHtml;
use Yiisoft\DataResponse\Middleware\FormatDataResponseAsJson;
use Yiisoft\Router\Group;
use Yiisoft\Router\Route;
use Yiisoft\Swagger\Middleware\SwaggerJson;
use Yiisoft\Swagger\Middleware\SwaggerUi;
use App\Factory\RestGroupFactory;

return [
    Route::get('/', [InfoController::class, 'index'])
        ->name('api/info'),

    Route::get('/blog/', [BlogController::class, 'index'])
        ->name('blog/index'),

    Route::get('/blog/{id:\d+}', [BlogController::class, 'view'])
        ->name('blog/view'),

    Route::post('/blog/', [BlogController::class, 'create'])
        ->name('blog/create')
        ->addMiddleware(Authentication::class),

    Route::put('/blog/{id:\d+}', [BlogController::class, 'update'])
        ->name('blog/update')
        ->addMiddleware(Authentication::class),

    RestGroupFactory::create('/users/', UserController::class)
        ->addMiddleware(Authentication::class),

    Route::post('/auth/', [AuthController::class, 'login'])
        ->name('auth'),

    Route::post('/logout/', [AuthController::class, 'logout'])
        ->name('logout')
        ->addMiddleware(Authentication::class),

    // Swagger routes
    Group::create(
        '/docs',
        [
            Route::get('')
                ->addMiddleware(fn (SwaggerUi $swaggerUi) => $swaggerUi->withJsonUrl('/docs/openapi.json'))
                ->addMiddleware(FormatDataResponseAsHtml::class),
            Route::get('/openapi.json')
                ->addMiddleware(
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
                )
                ->addMiddleware(FormatDataResponseAsJson::class),
        ]
    ),
];

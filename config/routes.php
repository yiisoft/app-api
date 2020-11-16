<?php

declare(strict_types=1);

use App\Controller\BlogController;
use App\Controller\AuthController;
use App\Controller\SiteController;
use App\Controller\UserController;
use Yiisoft\Auth\Middleware\Authentication;
use Yiisoft\DataResponse\Middleware\FormatDataResponseAsJson;
use Yiisoft\Router\Group;
use Yiisoft\Router\Route;
use Yiisoft\Swagger\Middleware\SwaggerJson;
use Yiisoft\Swagger\Middleware\SwaggerUi;

return [
    Route::get('/', [SiteController::class, 'index'])
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

    Route::get('/users/', [UserController::class, 'index'])
        ->name('users/index')
        ->addMiddleware(Authentication::class),

    Route::get('/users/{id:\d+}', [UserController::class, 'view'])
        ->name('users/view')
        ->addMiddleware(Authentication::class),

    Route::post('/auth/', [AuthController::class, 'login'])
        ->name('auth'),

    Route::post('/logout/', [AuthController::class, 'logout'])
        ->name('logout'),

    // Swagger routes
    Group::create('/swagger', [
        Route::get('')
            ->addMiddleware(fn (SwaggerUi $swaggerUi) => $swaggerUi->withJsonUrl('/swagger/json-url'))
            ->name('swagger/index'),
        Route::get('/json-url')
            ->addMiddleware(static function (SwaggerJson $swaggerJson) {
                return $swaggerJson
                    // Uncomment cache for production environment
                    // ->withCache(60)
                    ->withAnnotationPaths([
                        '@src/Controller' // Path to API controllers
                    ]);
            })
            ->addMiddleware(FormatDataResponseAsJson::class),
    ]),
];

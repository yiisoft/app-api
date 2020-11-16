<?php

declare(strict_types=1);

use App\Controller\BlogController;
use App\Controller\AuthController;
use App\Controller\SiteController;
use App\Controller\UserController;
use Yiisoft\Auth\Middleware\Authentication;
use Yiisoft\Router\Route;

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
];

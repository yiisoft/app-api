<?php

declare(strict_types=1);

namespace App\Factory;

use App\Controller\AuthController;
use App\Controller\BlogController;
use App\Controller\SiteController;
use App\Controller\UserController;
use App\Middleware\ExceptionMiddleware;
use Psr\Container\ContainerInterface;
use Yiisoft\Auth\Middleware\Authentication;
use Yiisoft\DataResponse\Middleware\FormatDataResponse;
use Yiisoft\Request\Body\RequestBodyParser;
use Yiisoft\Router\FastRoute\UrlMatcher;
use Yiisoft\Router\Group;
use Yiisoft\Router\Route;
use Yiisoft\Router\RouteCollection;
use Yiisoft\Router\RouteCollectorInterface;

class AppRouterFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $collector = $container->get(RouteCollectorInterface::class);
        $collector->addGroup(
            Group::create(null, $this->getRoutes())
                ->addMiddleware(ExceptionMiddleware::class)
                ->addMiddleware(FormatDataResponse::class)
                ->addMiddleware(RequestBodyParser::class)
        );

        return new UrlMatcher(new RouteCollection($collector));
    }

    private function getRoutes(): array
    {
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
    }
}

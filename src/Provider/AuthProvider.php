<?php

declare(strict_types=1);

namespace App\Provider;

use App\Auth\AuthRequestErrorHandler;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Yiisoft\Auth\AuthenticationMethodInterface;
use Yiisoft\Auth\Method\HttpHeader;
use Yiisoft\Auth\Middleware\Authentication;
use Yiisoft\Di\Container;
use Yiisoft\Di\Support\ServiceProvider;

final class AuthProvider extends ServiceProvider
{
    /**
     * @psalm-suppress InaccessibleMethod
     */
    public function register(Container $container): void
    {
        $container->set(AuthenticationMethodInterface::class, HttpHeader::class);
        $container->set(
            Authentication::class,
            static function (ContainerInterface $container) {
                return new Authentication(
                    $container->get(AuthenticationMethodInterface::class),
                    $container->get(ResponseFactoryInterface::class),
                    $container->get(AuthRequestErrorHandler::class)
                );
            }
        );
    }
}

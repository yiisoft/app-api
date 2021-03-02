<?php

declare(strict_types=1);

use Yiisoft\Middleware\Dispatcher\MiddlewareStack;
use Yiisoft\Middleware\Dispatcher\MiddlewareStackInterface;

return [
    MiddlewareStackInterface::class => MiddlewareStack::class,
];

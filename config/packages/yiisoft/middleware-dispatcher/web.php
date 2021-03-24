<?php

declare(strict_types=1);

use Yiisoft\Middleware\Dispatcher\MiddlewarePipelineInterface;
use Yiisoft\Middleware\Dispatcher\MiddlewareStack;

return [
    MiddlewarePipelineInterface::class => MiddlewareStack::class,
];

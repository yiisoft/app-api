<?php

declare(strict_types=1);


use Yiisoft\ErrorHandler\JsonRenderer;
use Yiisoft\ErrorHandler\ThrowableRendererInterface;

return [
    ThrowableRendererInterface::class => JsonRenderer::class,
];

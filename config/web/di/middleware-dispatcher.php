<?php

declare(strict_types=1);

use Yiisoft\Middleware\Dispatcher\ParametersResolverInterface;
use Yiisoft\RequestModel\HandlerParametersResolver;

/**
 * @var array $params
 */

return [
    ParametersResolverInterface::class => HandlerParametersResolver::class,
];

<?php

declare(strict_types=1);

use App\Formatter\ApiResponseFormatter;
use Yiisoft\DataResponse\DataResponseFactory;
use Yiisoft\DataResponse\DataResponseFactoryInterface;
use Yiisoft\DataResponse\DataResponseFormatterInterface;

/* @var $params array */

return [
    DataResponseFormatterInterface::class => ApiResponseFormatter::class,
    DataResponseFactoryInterface::class => DataResponseFactory::class,
];

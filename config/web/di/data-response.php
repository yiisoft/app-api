<?php

declare(strict_types=1);

use App\Http\ApiResponseFormatter;
use Yiisoft\DataResponse\DataResponseFormatterInterface;

/* @var $params array */

return [
    DataResponseFormatterInterface::class => ApiResponseFormatter::class,
];

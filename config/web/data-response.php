<?php

declare(strict_types=1);

use App\Formatter\ApiResponseFormatter;
use Yiisoft\DataResponse\DataResponseFormatterInterface;

return [
    DataResponseFormatterInterface::class => ApiResponseFormatter::class,
];

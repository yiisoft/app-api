<?php

declare(strict_types=1);

namespace App\Validation;

use Yiisoft\RequestModel\RequestModel;

final class PageRequest extends RequestModel
{
    private const DEFAULT_PAGE_PARAM = 1;

    public function getPage(): int
    {
        if ($this->hasValue('query.page')) {
            return (int)$this->getValue('query.page');
        }

        return self::DEFAULT_PAGE_PARAM;
    }
}

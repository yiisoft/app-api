<?php

declare(strict_types=1);

namespace App\Blog;

use Yiisoft\RequestModel\RequestModel;

final class ViewPostRequest extends RequestModel
{
    public function getId(): int
    {
        return (int)$this->getValue('attributes.id');
    }
}

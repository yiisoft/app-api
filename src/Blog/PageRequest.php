<?php

declare(strict_types=1);

namespace App\Blog;

use Yiisoft\RequestModel\RequestModel;
use OpenApi\Annotations as OA;

/**
 * @OA\Parameter(
 *      @OA\Schema(
 *          type="int",
 *          example="2"
 *      ),
 *      in="query",
 *      name="page",
 *      parameter="PageRequest"
 * )
 */
final class PageRequest extends RequestModel
{
    private const DEFAULT_PAGE_PARAM = 1;

    public function getPage(): int
    {
        if ($this->hasAttribute('query.page')) {
            return (int)$this->getAttributeValue('query.page');
        }

        return self::DEFAULT_PAGE_PARAM;
    }
}

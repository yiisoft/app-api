<?php

declare(strict_types=1);

namespace App\Http;

use Yiisoft\Data\Paginator\OffsetPaginator;

final class PaginatorFormatter
{
    public function format(OffsetPaginator $paginator): array
    {
        return [
            'pageSize' => $paginator->getPageSize(),
            'currentPage' => $paginator->getCurrentPage(),
            'totalPages' => $paginator->getTotalPages(),
        ];
    }
}

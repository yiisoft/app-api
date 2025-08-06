<?php

declare(strict_types=1);

namespace App\Http;

use OpenApi\Attributes as OA;
use Yiisoft\Data\Paginator\OffsetPaginator;

#[OA\Schema(
    schema: "Paginator",
    properties: [
        new OA\Property(property: "pageSize", format: "int", example: "10"),
        new OA\Property(property: "currentPage", format: "int", example: "1"),
        new OA\Property(property: "totalPages", format: "int", example: "3"),
    ],
)]
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

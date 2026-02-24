<?php

declare(strict_types=1);

namespace App\Api\Shared\Presenter;

use Yiisoft\Data\Paginator\OffsetPaginator;

/**
 * @implements PresenterInterface<OffsetPaginator>
 */
final readonly class OffsetPaginatorPresenter implements PresenterInterface
{
    private CollectionPresenter $collectionPresenter;

    public function __construct(
        PresenterInterface $itemPresenter = new AsIsPresenter(),
    ) {
        $this->collectionPresenter = new CollectionPresenter($itemPresenter);
    }

    public function present(mixed $value): array
    {
        return [
            'items' => $this->collectionPresenter->present($value->read()),
            'pageSize' => $value->getPageSize(),
            'currentPage' => $value->getCurrentPage(),
            'totalPages' => $value->getTotalPages(),
        ];
    }
}

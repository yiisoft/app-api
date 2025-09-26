<?php

declare(strict_types=1);

namespace App\Api\Shared\Presenter;

use Yiisoft\Data\Paginator\OffsetPaginator;
use Yiisoft\DataResponse\DataResponse;

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

    public function present(mixed $value, DataResponse $response): DataResponse
    {
        $collectionResponse = $this->collectionPresenter->present($value->read(), $response);
        return $collectionResponse->withData([
            'items' => $collectionResponse->getData(),
            'pageSize' => $value->getPageSize(),
            'currentPage' => $value->getCurrentPage(),
            'totalPages' => $value->getTotalPages(),
        ]);
    }
}

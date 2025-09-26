<?php

declare(strict_types=1);

namespace App\Api\Shared\Presenter;

use Yiisoft\DataResponse\DataResponse;

/**
 * @implements PresenterInterface<iterable>
 */
final readonly class CollectionPresenter implements PresenterInterface
{
    public function __construct(
        private PresenterInterface $itemPresenter = new AsIsPresenter(),
    ) {}

    public function present(mixed $value, DataResponse $response): DataResponse
    {
        $result = [];
        foreach ($value as $item) {
            $response = $this->itemPresenter->present($item, $response);
            $result[] = $response->getData();
        }
        return $response->withData($result);
    }
}

<?php

declare(strict_types=1);

namespace App\Api\Shared\Presenter;

/**
 * @implements PresenterInterface<iterable>
 */
final readonly class CollectionPresenter implements PresenterInterface
{
    public function __construct(
        private PresenterInterface $itemPresenter = new AsIsPresenter(),
    ) {}

    public function present(mixed $value): array
    {
        $result = [];
        foreach ($value as $item) {
            $result[] = $this->itemPresenter->present($item);
        }
        return $result;
    }
}

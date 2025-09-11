<?php

declare(strict_types=1);

namespace App\Http\Presenter;

/**
 * @implements PresenterInterface<iterable>
 */
final readonly class CollectionPresenter implements PresenterInterface
{
    public function __construct(
        private PresenterInterface $itemPresenter = new AsIsPresenter(),
    ) {}

    public function present(mixed $value): mixed
    {
        $result = [];
        foreach ($value as $item) {
            $result[] = $this->itemPresenter->present($item);
        }
        return $result;
    }
}

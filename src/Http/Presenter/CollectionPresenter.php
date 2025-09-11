<?php

declare(strict_types=1);

namespace App\Http\Presenter;

use Psr\Http\Message\ResponseInterface;

/**
 * @implements PresenterInterface<iterable>
 */
final readonly class CollectionPresenter implements PresenterInterface
{
    public function __construct(
        private PresenterInterface $itemPresenter = new AsIsPresenter(),
    ) {}

    public function present(mixed $value, ResponseInterface $response): mixed
    {
        $result = [];
        foreach ($value as $item) {
            $result[] = $this->itemPresenter->present($item, $response);
        }
        return $result;
    }
}

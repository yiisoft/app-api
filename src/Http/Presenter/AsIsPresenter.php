<?php

declare(strict_types=1);

namespace App\Http\Presenter;

/**
 * @implements PresenterInterface<mixed>
 */
final readonly class AsIsPresenter implements PresenterInterface
{
    public function present(mixed $value): mixed
    {
        return $value;
    }
}

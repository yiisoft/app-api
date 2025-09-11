<?php

declare(strict_types=1);

namespace App\Http\Presenter;

use Psr\Http\Message\ResponseInterface;

/**
 * @implements PresenterInterface<mixed>
 */
final readonly class AsIsPresenter implements PresenterInterface
{
    public function present(mixed $value, ResponseInterface $response): mixed
    {
        return $value;
    }
}

<?php

declare(strict_types=1);

namespace App\Api\Shared\Presenter;

use Yiisoft\DataResponse\DataResponse;

/**
 * @implements PresenterInterface<mixed>
 */
final readonly class AsIsPresenter implements PresenterInterface
{
    public function present(mixed $value, DataResponse $response): DataResponse
    {
        return $response->withData($value);
    }
}

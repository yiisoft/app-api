<?php

declare(strict_types=1);

namespace App\Api\Shared\Presenter;

use Yiisoft\DataResponse\DataResponse;
use Yiisoft\Validator\Result;

/**
 * @implements PresenterInterface<Result>
 */
final readonly class ValidationResultPresenter implements PresenterInterface
{
    public function present(mixed $value, DataResponse $response): DataResponse
    {
        return $response->withData(
            $value->getErrorMessagesIndexedByPath(),
        );
    }
}

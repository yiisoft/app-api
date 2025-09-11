<?php

declare(strict_types=1);

namespace App\Http\Presenter;

use Psr\Http\Message\ResponseInterface;
use Yiisoft\Validator\Result;

/**
 * @implements PresenterInterface<Result>
 */
final readonly class ValidationResultPresenter implements PresenterInterface
{
    public function present(mixed $value, ResponseInterface $response): array
    {
        return $value->getErrorMessagesIndexedByPath();
    }
}

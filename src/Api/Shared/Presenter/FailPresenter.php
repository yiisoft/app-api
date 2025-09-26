<?php

declare(strict_types=1);

namespace App\Api\Shared\Presenter;

use Yiisoft\DataResponse\DataResponse;
use Yiisoft\Http\Status;

/**
 * @implements PresenterInterface<mixed>
 */
final readonly class FailPresenter implements PresenterInterface
{
    public function __construct(
        private string $message = 'Unknown error.',
        private int|null $code = null,
        private int $httpCode = Status::BAD_REQUEST,
        private PresenterInterface $presenter = new AsIsPresenter(),
    ) {}

    public function present(mixed $value, DataResponse $response): DataResponse
    {
        $response = $this->presenter->present($value, $response);
        $result = [
            'status' => 'failed',
            'error_message' => $this->message,
        ];
        if ($this->code !== null) {
            $result['error_code'] = $this->code;
        }
        if ($value !== null) {
            $result['error_data'] = $response->getData();
        }
        return $response->withData($result)->withStatus($this->httpCode);
    }
}

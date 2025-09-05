<?php

declare(strict_types=1);

namespace App\Http;

use LogicException;
use Psr\Http\Message\ResponseInterface;
use Yiisoft\DataResponse\DataResponse;
use Yiisoft\DataResponse\DataResponseFormatterInterface;
use Yiisoft\DataResponse\Formatter\JsonDataResponseFormatter;
use Yiisoft\Http\Status;

use function sprintf;

final readonly class ApiResponseFormatter implements DataResponseFormatterInterface
{
    public function __construct(
        private JsonDataResponseFormatter $jsonDataResponseFormatter,
    ) {}

    public function format(DataResponse $dataResponse): ResponseInterface
    {
        $data = $dataResponse->getStatusCode() === Status::OK
            ? $this->createSuccessData($dataResponse)
            : $this->createFailedData($dataResponse);

        return $this->jsonDataResponseFormatter->format(
            $dataResponse->withData($data),
        );
    }

    private function createSuccessData(DataResponse $response): array
    {
        $data = $response->getData();
        if ($data !== null && !is_array($data)) {
            throw new LogicException(
                sprintf(
                    'The response data must be either null or an array. Got %s.',
                    get_debug_type($data),
                ),
            );
        }

        return [
            'status' => 'success',
            'data' => $data,
        ];
    }

    private function createFailedData(DataResponse $response): array
    {
        $data = $response->getData();
        return [
            'status' => 'failed',
            'error_message' => is_string($data) && $data !== '' ? $data : 'Unknown error',
            'error_code' => $response->getStatusCode(),
        ];
    }
}

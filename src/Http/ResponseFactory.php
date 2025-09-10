<?php

declare(strict_types=1);

namespace App\Http;

use Psr\Http\Message\ResponseInterface;
use Yiisoft\DataResponse\DataResponseFactoryInterface;
use Yiisoft\DataResponse\Formatter\JsonDataResponseFormatter;
use Yiisoft\Http\Status;
use Yiisoft\Validator\Result;

final readonly class ResponseFactory
{
    public function __construct(
        private DataResponseFactoryInterface $dataResponseFactory,
        private JsonDataResponseFormatter $jsonDataResponseFormatter,
    ) {
    }

    public function success(array|null $data = null): ResponseInterface
    {
        return $this->jsonDataResponseFormatter->format(
            $this->dataResponseFactory->createResponse([
                'status' => 'success',
                'data' => $data,
            ])
        );
    }

    public function fail(
        string $message,
        array|null $data = null,
        int|null $code = null,
        int $httpCode = Status::BAD_REQUEST,
    ): ResponseInterface {
        $result = [
            'status' => 'failed',
            'error_message' => $message,
        ];
        if ($code !== null) {
            $result['error_code'] = $code;
        }
        if ($data !== null) {
            $result['error_data'] = $data;
        }
        return $this->jsonDataResponseFormatter->format(
            $this->dataResponseFactory->createResponse($result, $httpCode)
        );
    }

    public function notFound(): ResponseInterface
    {
        return $this->fail('Not found.', httpCode: Status::NOT_FOUND);
    }

    public function failValidation(Result $result): ResponseInterface
    {
        return $this->fail('Validation failed.', $result->getErrorMessagesIndexedByPath());
    }
}

<?php

declare(strict_types=1);

namespace App\Http;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Yiisoft\DataResponse\DataResponseFactoryInterface;
use Yiisoft\Http\Status;
use Yiisoft\Validator\Result;

final readonly class ApiResponseFactory
{
    public function __construct(
        private DataResponseFactoryInterface $dataResponseFactory,
        private ResponseFactoryInterface $responseFactory,
    ) {}

    public function success(array|null $data = null): ResponseInterface
    {
        return $this->dataResponseFactory->createResponse(['status' => 'success', 'data' => $data]);
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
        return $this->dataResponseFactory->createResponse($result, $httpCode);
    }

    public function notFound(string $message = 'Not found.'): ResponseInterface
    {
        return $this->fail($message, httpCode: Status::NOT_FOUND);
    }

    public function failValidation(Result $result): ResponseInterface
    {
        return $this->fail(
            'Validation failed.',
            $result->getErrorMessagesIndexedByPath(),
            httpCode: Status::UNPROCESSABLE_ENTITY,
        );
    }
}

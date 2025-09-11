<?php

declare(strict_types=1);

namespace App\Http;

use App\Http\Presenter\AsIsPresenter;
use App\Http\Presenter\PresenterInterface;
use App\Http\Presenter\ValidationResultPresenter;
use Psr\Http\Message\ResponseInterface;
use Yiisoft\DataResponse\DataResponseFactoryInterface;
use Yiisoft\Http\Status;
use Yiisoft\Validator\Result;

final readonly class ApiResponseFactory
{
    public function __construct(
        private DataResponseFactoryInterface $dataResponseFactory,
    ) {}

    public function success(
        array|object|null $data = null,
        PresenterInterface $presenter = new AsIsPresenter(),
    ): ResponseInterface
    {
        $response = $this->dataResponseFactory->createResponse();
        return $response
            ->withData([
                'status' => 'success',
                'data' => $presenter->present($data, $response),
            ])
            ->withStatus(Status::OK);
    }

    public function fail(
        string $message,
        array|object|null $data = null,
        int|null $code = null,
        int $httpCode = Status::BAD_REQUEST,
        PresenterInterface $presenter = new AsIsPresenter(),
    ): ResponseInterface {
        $response = $this->dataResponseFactory->createResponse();
        $result = [
            'status' => 'failed',
            'error_message' => $message,
        ];
        if ($code !== null) {
            $result['error_code'] = $code;
        }
        if ($data !== null) {
            $result['error_data'] = $presenter->present($data, $response);
        }
        return $response->withData($result)->withStatus($httpCode);
    }

    public function notFound(string $message = 'Not found.'): ResponseInterface
    {
        return $this->fail($message, httpCode: Status::NOT_FOUND);
    }

    public function failValidation(Result $result): ResponseInterface
    {
        return $this->fail(
            'Validation failed.',
            $result,
            httpCode: Status::UNPROCESSABLE_ENTITY,
            presenter: new ValidationResultPresenter(),
        );
    }
}

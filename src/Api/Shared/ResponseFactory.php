<?php

declare(strict_types=1);

namespace App\Api\Shared;

use App\Api\Shared\Presenter\AsIsPresenter;
use App\Api\Shared\Presenter\FailPresenter;
use App\Api\Shared\Presenter\PresenterInterface;
use App\Api\Shared\Presenter\SuccessPresenter;
use App\Api\Shared\Presenter\ValidationResultPresenter;
use Psr\Http\Message\ResponseInterface;
use Yiisoft\DataResponse\DataResponseFactoryInterface;
use Yiisoft\Http\Status;
use Yiisoft\Validator\Result;

final readonly class ResponseFactory
{
    public function __construct(
        private DataResponseFactoryInterface $dataResponseFactory,
    ) {}

    public function success(
        array|object|null $data = null,
        PresenterInterface $presenter = new AsIsPresenter(),
    ): ResponseInterface {
        return (new SuccessPresenter($presenter))
            ->present($data, $this->dataResponseFactory->createResponse());
    }

    public function fail(
        string $message,
        array|object|null $data = null,
        int|null $code = null,
        int $httpCode = Status::BAD_REQUEST,
        PresenterInterface $presenter = new AsIsPresenter(),
    ): ResponseInterface {
        return (new FailPresenter($message, $code, $httpCode, $presenter))
            ->present($data, $this->dataResponseFactory->createResponse());
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

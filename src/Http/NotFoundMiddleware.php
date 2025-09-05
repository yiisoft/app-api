<?php

declare(strict_types=1);

namespace App\Http;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Yiisoft\DataResponse\DataResponseFactoryInterface;
use Yiisoft\Http\Status;

final readonly class NotFoundMiddleware implements MiddlewareInterface
{
    public function __construct(
        private DataResponseFactoryInterface $dataResponseFactory,
    ) {}

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        return $this->dataResponseFactory->createResponse(
            'Not found.',
            Status::NOT_FOUND,
        );
    }
}

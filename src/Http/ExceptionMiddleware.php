<?php

declare(strict_types=1);

namespace App\Http;

use App\Exception\ApplicationException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Yiisoft\Input\Http\InputValidationException;

final readonly class ExceptionMiddleware implements MiddlewareInterface
{
    public function __construct(
        private ApiResponseFactory $apiResponseFactory,
    ) {}

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (ApplicationException $e) {
            return $this->apiResponseFactory->fail($e->getMessage(), code: $e->getCode());
        } catch (InputValidationException $e) {
            return $this->apiResponseFactory->failValidation($e->getResult());
        }
    }
}

<?php

declare(strict_types=1);

namespace App\Http;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Throwable;
use Yiisoft\ErrorHandler\Exception\UserException;
use Yiisoft\Input\Http\InputValidationException;

use function is_int;

final readonly class ExceptionMiddleware implements MiddlewareInterface
{
    public function __construct(
        private ApiResponseFactory $apiResponseFactory,
    ) {}

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (InputValidationException $exception) {
            return $this->apiResponseFactory->failValidation($exception->getResult());
        } catch (Throwable $exception) {
            if (UserException::isUserException($exception)) {
                $code = $exception->getCode();
                return $this->apiResponseFactory->fail(
                    $exception->getMessage(),
                    code: is_int($code) ? $code : null,
                );
            }
            throw $exception;
        }
    }
}

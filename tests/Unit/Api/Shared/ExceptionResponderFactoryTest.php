<?php

declare(strict_types=1);

namespace App\Tests\Unit\Api\Shared;

use App\Api\Shared\ExceptionResponderFactory;
use App\Api\Shared\ResponseFactory;
use Codeception\Test\Unit;
use HttpSoft\Message\ResponseFactory as PsrResponseFactory;
use HttpSoft\Message\ServerRequest;
use HttpSoft\Message\StreamFactory;
use LogicException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Yiisoft\DataResponse\DataResponse;
use Yiisoft\DataResponse\DataResponseFactory;
use Yiisoft\Di\Container;
use Yiisoft\ErrorHandler\Exception\UserException;
use Yiisoft\ErrorHandler\Middleware\ExceptionResponder;
use Yiisoft\Injector\Injector;
use Yiisoft\Input\Http\InputValidationException;
use Yiisoft\Validator\Result;

final class ExceptionResponderFactoryTest extends Unit
{
    public function testInputValidationException(): void
    {
        $request = new ServerRequest();
        $handler = new class implements RequestHandlerInterface {
            public function handle(ServerRequestInterface $request): ResponseInterface
            {
                throw new InputValidationException(
                    (new Result())->addError('error1', valuePath: ['name']),
                );
            }
        };

        $response = $this->createExceptionResponder()->process($request, $handler);

        $this->assertInstanceOf(DataResponse::class, $response);
        $this->assertSame(
            [
                'status' => 'failed',
                'error_message' => 'Validation failed.',
                'error_data' => [
                    'name' => ['error1'],
                ],
            ],
            $response->getData(),
        );
    }

    public function testUserException(): void
    {
        $request = new ServerRequest();
        $handler = new class implements RequestHandlerInterface {
            public function handle(ServerRequestInterface $request): ResponseInterface
            {
                throw new UserException('Hello, Exception!');
            }
        };

        $response = $this->createExceptionResponder()->process($request, $handler);

        $this->assertInstanceOf(DataResponse::class, $response);
        $this->assertSame(
            [
                'status' => 'failed',
                'error_message' => 'Hello, Exception!',
                'error_code' => 0,
            ],
            $response->getData(),
        );
    }

    public function testOtherThrowable(): void
    {
        $request = new ServerRequest();
        $handler = new class implements RequestHandlerInterface {
            public function handle(ServerRequestInterface $request): ResponseInterface
            {
                throw new LogicException('Hello, Exception!');
            }
        };

        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('Hello, Exception!');
        $this->createExceptionResponder()->process($request, $handler);
    }

    private function createExceptionResponder(): ExceptionResponder
    {
        return (new ExceptionResponderFactory(
            new PsrResponseFactory(),
            new ResponseFactory(
                new DataResponseFactory(
                    new PsrResponseFactory(),
                    new StreamFactory(),
                ),
            ),
            new Injector(new Container()),
        ))->create();
    }
}

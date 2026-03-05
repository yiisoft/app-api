<?php

declare(strict_types=1);

namespace App\Tests\Unit\Api\Shared;

use App\Api\Shared\ResponseFactory;
use Codeception\Test\Unit;
use HttpSoft\Message\ResponseFactory as PsrResponseFactory;
use Yiisoft\DataResponse\DataStream\DataStream;
use Yiisoft\DataResponse\ResponseFactory\DataResponseFactory;
use Yiisoft\Validator\Result;

final class ResponseFactoryTest extends Unit
{
    public function testSuccess(): void
    {
        $response = $this
            ->createResponseFactory()
            ->success(['name' => 'test']);

        $body = $response->getBody();

        $this->assertInstanceOf(DataStream::class, $body);
        $this->assertSame(
            [
                'status' => 'success',
                'data' => ['name' => 'test'],
            ],
            $body->getData(),
        );
    }

    public function testFail(): void
    {
        $response = $this
            ->createResponseFactory()
            ->fail('error text');

        $body = $response->getBody();

        $this->assertInstanceOf(DataStream::class, $body);
        $this->assertSame(
            [
                'status' => 'failed',
                'error_message' => 'error text',
            ],
            $body->getData(),
        );
    }

    public function testNotFound(): void
    {
        $response = $this
            ->createResponseFactory()
            ->notFound();

        $body = $response->getBody();

        $this->assertInstanceOf(DataStream::class, $body);
        $this->assertSame(
            [
                'status' => 'failed',
                'error_message' => 'Not found.',
            ],
            $body->getData(),
        );
    }

    public function testFailValidation(): void
    {
        $result = (new Result())
            ->addError('error1', valuePath: ['name'])
            ->addError('error2', valuePath: ['name'])
            ->addError('error3', valuePath: ['age']);
        $response = $this
            ->createResponseFactory()
            ->failValidation($result);

        $body = $response->getBody();

        $this->assertInstanceOf(DataStream::class, $body);
        $this->assertSame(
            [
                'status' => 'failed',
                'error_message' => 'Validation failed.',
                'error_data' => [
                    'name' => ['error1', 'error2'],
                    'age' => ['error3'],
                ],
            ],
            $body->getData(),
        );
    }

    private function createResponseFactory(): ResponseFactory
    {
        return new ResponseFactory(
            new DataResponseFactory(
                new PsrResponseFactory(),
            ),
        );
    }
}

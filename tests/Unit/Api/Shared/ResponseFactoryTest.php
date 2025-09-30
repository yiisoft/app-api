<?php

declare(strict_types=1);

namespace App\Tests\Unit\Api\Shared;

use App\Api\Shared\ResponseFactory;
use Codeception\Test\Unit;
use HttpSoft\Message\ResponseFactory as PsrResponseFactory;
use HttpSoft\Message\StreamFactory;
use Yiisoft\DataResponse\DataResponse;
use Yiisoft\DataResponse\DataResponseFactory;
use Yiisoft\Validator\Result;

final class ResponseFactoryTest extends Unit
{
    public function testSuccess(): void
    {
        $response = $this
            ->createResponseFactory()
            ->success(['name' => 'test']);

        $this->assertInstanceOf(DataResponse::class, $response);
        $this->assertSame(
            [
                'status' => 'success',
                'data' => ['name' => 'test'],
            ],
            $response->getData(),
        );
    }

    public function testFail(): void
    {
        $response = $this
            ->createResponseFactory()
            ->fail('error text');

        $this->assertInstanceOf(DataResponse::class, $response);
        $this->assertSame(
            [
                'status' => 'failed',
                'error_message' => 'error text',
            ],
            $response->getData(),
        );
    }

    public function testNotFound(): void
    {
        $response = $this
            ->createResponseFactory()
            ->notFound();

        $this->assertInstanceOf(DataResponse::class, $response);
        $this->assertSame(
            [
                'status' => 'failed',
                'error_message' => 'Not found.',
            ],
            $response->getData(),
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

        $this->assertInstanceOf(DataResponse::class, $response);
        $this->assertSame(
            [
                'status' => 'failed',
                'error_message' => 'Validation failed.',
                'error_data' => [
                    'name' => ['error1', 'error2'],
                    'age' => ['error3'],
                ],
            ],
            $response->getData(),
        );
    }

    private function createResponseFactory(): ResponseFactory
    {
        return new ResponseFactory(
            new DataResponseFactory(
                new PsrResponseFactory(),
                new StreamFactory(),
            ),
        );
    }
}

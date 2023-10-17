<?php

declare(strict_types=1);

namespace App\Tests\Unit\Http;

use App\Http\ApiResponseDataFactory;
use HttpSoft\Message\ResponseFactory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\StreamFactoryInterface;
use RuntimeException;
use Yiisoft\DataResponse\DataResponse;

final class ApiResponseDataFactoryTest extends TestCase
{
    public function testResponse(): void
    {
        $factory = new ApiResponseDataFactory();

        $response = $factory->createResponse();

        $this->assertEquals([
            'status' => '',
            'error_message' => '',
            'error_code' => null,
            'data' => null,
        ], $response->toArray());
    }

    public function testSuccessResponse(): void
    {
        $factory = new ApiResponseDataFactory();

        $response = $factory->createSuccessResponse();

        $this->assertEquals([
            'status' => 'success',
            'error_message' => '',
            'error_code' => null,
            'data' => null,
        ], $response->toArray());
    }

    public function testErrorResponse(): void
    {
        $factory = new ApiResponseDataFactory();

        $response = $factory->createErrorResponse();

        $this->assertEquals([
            'status' => 'failed',
            'error_message' => '',
            'error_code' => null,
            'data' => null,
        ], $response->toArray());
    }

    public function testGenericResponse(): void
    {
        $factory = new ApiResponseDataFactory();

        $response = new DataResponse(
            'error message',
            555,
            'Testing phase',
            new ResponseFactory(),
            $this->createStub(StreamFactoryInterface::class),
        );
        $response = $factory->createFromResponse($response);

        $this->assertEquals([
            'status' => 'failed',
            'error_message' => 'error message',
            'error_code' => 555,
            'data' => null,
        ], $response->toArray());
    }

    public function testGenericSuccessResponse(): void
    {
        $factory = new ApiResponseDataFactory();

        $response = new DataResponse(
            ['message' => 'success message'],
            200,
            'Testing phase',
            new ResponseFactory(),
            $this->createStub(StreamFactoryInterface::class),
        );
        $response = $factory->createFromResponse($response);

        $this->assertEquals([
            'status' => 'success',
            'error_message' => '',
            'error_code' => null,
            'data' => ['message' => 'success message'],
        ], $response->toArray());
    }

    public function testUnableToUseNotArrayDataInGenericResponse(): void
    {
        $factory = new ApiResponseDataFactory();

        $response = new DataResponse(
            'success message',
            200,
            'Testing phase',
            new ResponseFactory(),
            $this->createStub(StreamFactoryInterface::class),
        );

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('The response data must be either null or an array');

        $factory->createFromResponse($response);
    }
}

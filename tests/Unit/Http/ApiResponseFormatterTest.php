<?php

declare(strict_types=1);

namespace App\Tests\Unit\Http;

use App\Http\ApiResponseFormatter;
use Codeception\Attribute\DataProvider;
use HttpSoft\Message\ResponseFactory;
use HttpSoft\Message\StreamFactory;
use LogicException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Yiisoft\DataResponse\DataResponse;
use Yiisoft\DataResponse\DataResponseFactory;
use Yiisoft\DataResponse\Formatter\JsonDataResponseFormatter;
use Yiisoft\Http\Status;

final class ApiResponseFormatterTest extends TestCase
{
    public function testSuccess(): void
    {
        $formatter = $this->createFormatter();
        $response = $this->createDataResponse(['key' => 'value']);

        $result = $this->getBodyContent($formatter->format($response));

        $this->assertSame('{"status":"success","data":{"key":"value"}}', $result);
    }


    public static function dataFailed(): iterable
    {
        yield ['An error occurred', 'An error occurred'];
        yield ['0', '0'];
        yield ['Unknown error', ''];
        yield ['Unknown error', null];
    }

    #[DataProvider('dataFailed')]
    public function testFailed(string $expectedError, ?string $error): void
    {
        $formatter = $this->createFormatter();
        $response = $this->createDataResponse($error, Status::INTERNAL_SERVER_ERROR);

        $result = $this->getBodyContent($formatter->format($response));

        $this->assertSame(
            '{"status":"failed","error_message":"' . $expectedError . '","error_code":500}',
            $result,
        );
    }

    public function testSuccessWithInvalidValue(): void
    {
        $formatter = $this->createFormatter();
        $response = $this->createDataResponse('test');

        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('The response data must be either null or an array. Got string.');
        $formatter->format($response);
    }

    private function createDataResponse(mixed $data, int $code = Status::OK): DataResponse
    {
        return (new DataResponseFactory(new ResponseFactory(), new StreamFactory()))->createResponse($data, $code);
    }

    private function createFormatter(): ApiResponseFormatter
    {
        return new ApiResponseFormatter(
            new JsonDataResponseFormatter(),
        );
    }

    private function getBodyContent(ResponseInterface $response): string
    {
        $body = $response->getBody();
        $body->rewind();
        return $body->getContents();
    }
}

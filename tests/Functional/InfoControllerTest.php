<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\VersionProvider;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Yiisoft\DataResponse\DataResponse;
use Yiisoft\DataResponse\DataResponseFactoryInterface;
use Yiisoft\Yii\Testing\FunctionalTester;

final class InfoControllerTest extends TestCase
{
    private ?FunctionalTester $tester;

    protected function setUp(): void
    {
        $this->tester = new FunctionalTester();
    }

    public function testGetIndex()
    {
        $method = 'GET';
        $url = '/';

        $this->tester->bootstrapApplication('web', dirname(__DIR__, 2));
        $response = $this->tester->doRequest($method, $url);

        $this->assertEquals(
            [
                'status' => 'success',
                'error_message' => '',
                'error_code' => null,
                'data' => ['version' => '3.0', 'author' => 'yiisoft'],
            ],
            $response->getContentAsJson()
        );
    }
}

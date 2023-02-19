<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use PHPUnit\Framework\TestCase;
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

        $this->tester->bootstrapApplication(dirname(__DIR__, 2));
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

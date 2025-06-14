<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\Support\FunctionalTester;
use Codeception\Test\Unit;
use HttpSoft\Message\ServerRequest;

use function PHPUnit\Framework\assertJson;
use function PHPUnit\Framework\assertSame;

final class InfoControllerTest extends Unit
{
    protected FunctionalTester $tester;

    public function testGetIndex()
    {
        $response = $this->tester->sendRequest(
            new ServerRequest(uri: '/'),
        );

        $output = $response->getBody()->getContents();
        assertJson($output);

        assertSame(
            [
                'status' => 'success',
                'error_message' => '',
                'error_code' => null,
                'data' => ['version' => '3.0', 'author' => 'yiisoft'],
            ],
            json_decode($output, true),
        );
    }
}

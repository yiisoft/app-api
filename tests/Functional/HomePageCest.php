<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\Support\FunctionalTester;
use HttpSoft\Message\ServerRequest;

use function PHPUnit\Framework\assertJson;
use function PHPUnit\Framework\assertSame;

final readonly class HomePageCest
{
    public function base(FunctionalTester $tester): void
    {
        $response = $tester->sendRequest(
            new ServerRequest(uri: '/'),
        );

        $output = $response->getBody()->getContents();
        assertJson($output);

        assertSame(
            [
                'status' => 'success',
                'data' => ['name' => 'My Project', 'version' => '1.0'],
            ],
            json_decode($output, true),
        );
    }
}

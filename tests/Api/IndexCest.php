<?php

declare(strict_types=1);

namespace App\Tests\Api;

use App\Tests\Support\ApiTester;
use Codeception\Util\HttpCode;

final readonly class IndexCest
{
    public function getHome(ApiTester $I): void
    {
        $I->sendGET('/');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(
            [
                'status' => 'success',
                'data' => [
                    'name' => 'My Project',
                    'version' => '1.0',
                ],
            ],
        );
    }
}

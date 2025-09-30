<?php

declare(strict_types=1);

namespace App\Tests\Api;

use App\Tests\Support\ApiTester;
use Codeception\Util\HttpCode;

final readonly class NotFoundCest
{
    public function testNotFoundPage(ApiTester $I): void
    {
        $I->sendGET('/not_found_page');
        $I->seeResponseCodeIs(HttpCode::NOT_FOUND);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(
            [
                'status' => 'failed',
                'error_message' => 'Not found.',
            ],
        );
    }
}

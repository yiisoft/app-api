<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use App\Tests\Support\AcceptanceTester;
use Codeception\Util\HttpCode;

final class SiteCest
{
    public function getHome(AcceptanceTester $I): void
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

    public function testNotFoundPage(AcceptanceTester $I): void
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

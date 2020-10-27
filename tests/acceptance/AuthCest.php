<?php

namespace App\Tests\Acceptance;

use App\Tests\AcceptanceTester;
use Codeception\Util\HttpCode;
use Yiisoft\Json\Json;

final class AuthCest
{
    public function auth(AcceptanceTester $I): void
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST(
            '/auth/',
            [
                'login' => 'Opal1144',
                'password' => 'Opal1144'
            ]
        );
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(
            [
                'status' => 'success',
                'error_message' => '',
                'error_code' => null,
            ]
        );

        $response = Json::decode($I->grabResponse());
        $I->seeInDatabase(
            'user',
            [
                'id' => 1,
                'token' => $response['data']['token']
            ]
        );
    }
}

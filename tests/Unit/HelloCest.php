<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Tests\Support\ApplicationDataProvider;
use App\Tests\Support\UnitTester;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\CommandLoader\ContainerCommandLoader;
use Symfony\Component\Console\Tester\CommandTester;
use Yiisoft\Yii\Console\ExitCode;

final class HelloCest
{
    public function testExecute(UnitTester $I): void
    {
        $app = new Application();
        $params = ApplicationDataProvider::getConsoleConfig()->get('params-console');

        $loader = new ContainerCommandLoader(
            ApplicationDataProvider::getConsoleContainer(),
            $params['yiisoft/yii-console']['commands']
        );

        $app->setCommandLoader($loader);

        $command = $app->find('hello');

        $commandCreate = new CommandTester($command);

        $commandCreate->setInputs(['yes']);

        $I->assertSame(ExitCode::OK, $commandCreate->execute([]));

        $output = $commandCreate->getDisplay(true);

        $I->assertStringContainsString('Hello!', $output);
    }
}

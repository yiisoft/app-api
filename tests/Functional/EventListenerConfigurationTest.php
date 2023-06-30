<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\Support\ApplicationDataProvider;
use PHPUnit\Framework\TestCase;
use Yiisoft\Yii\Event\ListenerConfigurationChecker;

class EventListenerConfigurationTest extends TestCase
{
    public function testConsoleListenerConfiguration(): void
    {
        $config = ApplicationDataProvider::getConsoleConfig();
        $container = ApplicationDataProvider::getConsoleContainer();

        $checker = $container->get(ListenerConfigurationChecker::class);
        $checker->check($config->get('events-console'));

        self::assertInstanceOf(ListenerConfigurationChecker::class, $checker);
    }
}

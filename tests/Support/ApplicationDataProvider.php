<?php

declare(strict_types=1);

namespace App\Tests\Support;

use Psr\Container\ContainerInterface;
use Yiisoft\Config\Config;
use Yiisoft\Yii\Runner\Console\ConsoleApplicationRunner;
use Yiisoft\Yii\Runner\Http\HttpApplicationRunner;

final class ApplicationDataProvider
{
    private static ?ConsoleApplicationRunner $consoleRunner = null;
    private static ?HttpApplicationRunner $webRunner = null;

    public static function getConsoleConfig(): Config
    {
        return self::getConsoleRunner()->getConfig();
    }

    public static function getConsoleContainer(): ContainerInterface
    {
        return self::getConsoleRunner()->getContainer();
    }

    public static function getWebConfig(): Config
    {
        return self::getConsoleRunner()->getConfig();
    }

    public static function getWebContainer(): ContainerInterface
    {
        return self::getConsoleRunner()->getContainer();
    }

    private static function getConsoleRunner(): ConsoleApplicationRunner
    {
        if (self::$consoleRunner === null) {
            self::$consoleRunner = new ConsoleApplicationRunner(
                rootPath: dirname(__DIR__, 2),
                environment: $_ENV['YII_ENV']
            );
        }
        return self::$consoleRunner;
    }

    private static function getWebRunner(): HttpApplicationRunner
    {
        if (self::$webRunner === null) {
            self::$webRunner = new HttpApplicationRunner(
                rootPath: dirname(__DIR__, 2),
                environment: $_ENV['YII_ENV']
            );
        }
        return self::$webRunner;
    }
}

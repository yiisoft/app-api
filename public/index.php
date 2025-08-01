<?php

declare(strict_types=1);

use Yiisoft\ErrorHandler\ErrorHandler;
use Yiisoft\ErrorHandler\Renderer\JsonRenderer;
use Yiisoft\Log\Logger;
use Yiisoft\Log\Target\File\FileTarget;
use Yiisoft\Yii\Runner\Http\HttpApplicationRunner;

/**
 * @psalm-var string $_SERVER['REQUEST_URI']
 */

// PHP built-in server routing.
if (PHP_SAPI === 'cli-server') {
    // Serve static files as is.
    /** @var string */
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (is_file(__DIR__ . $path)) {
        return false;
    }

    // Explicitly set for URLs with dot.
    $_SERVER['SCRIPT_NAME'] = '/index.php';
}

if (getenv('YII_C3')) {
    $c3 = dirname(__DIR__) . '/c3.php';
    if (file_exists($c3)) {
        require_once $c3;
    }
}

require_once dirname(__DIR__) . '/autoload.php';

// Run HTTP application runner
$runner = new HttpApplicationRunner(
    rootPath: dirname(__DIR__),
    debug: $_ENV['YII_DEBUG'],
    checkEvents: $_ENV['YII_DEBUG'],
    environment: $_ENV['YII_ENV'],
    temporaryErrorHandler: new ErrorHandler(
        new Logger([new FileTarget(dirname(__DIR__) . '/runtime/logs/app.log')]),
        new JsonRenderer(),
    ),
);
$runner->run();

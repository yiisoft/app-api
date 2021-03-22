<?php

use Psr\Container\ContainerInterface;
use Yiisoft\Config\Config;
use Yiisoft\Di\Container;
use Yiisoft\Http\Method;
use Yiisoft\Yii\Web\Application;
use Yiisoft\Yii\Web\SapiEmitter;
use Yiisoft\Yii\Web\ServerRequestFactory;

define('YII_ENV', 'testing');

// PHP built-in server routing.
if (PHP_SAPI === 'cli-server') {
    // Serve static files as is.
    if (is_file(__DIR__ . $_SERVER["REQUEST_URI"])) {
        return false;
    }

    // Explicitly set for URLs with dot.
    $_SERVER['SCRIPT_NAME'] = '/index-test.php';
}

$c3 = dirname(__DIR__) . '/c3.php';

if (is_file($c3)) {
    require_once $c3;
}

require_once dirname(__DIR__) . '/vendor/autoload.php';

$runner = new ApplicationRunner();
// Development mode:
$runner->debug();
// Run application:
$runner->run();

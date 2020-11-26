<?php

use Psr\Container\ContainerInterface;
use Yiisoft\Composer\Config\Builder;
use Yiisoft\Di\Container;
use Yiisoft\Http\Method;
use Yiisoft\Yii\Web\Application;
use Yiisoft\Yii\Web\SapiEmitter;
use Yiisoft\Yii\Web\ServerRequestFactory;

// PHP built-in server should serve static files as is
if ((PHP_SAPI === 'cli-server') && is_file(__DIR__ . $_SERVER["REQUEST_URI"])) {
    return false;
}

require_once dirname(__DIR__) . '/vendor/autoload.php';

Builder::rebuild();

$startTime = microtime(true);
$container = new Container(
    require Builder::path('tests/web'),
    require Builder::path('tests/providers'),
);

$container = $container->get(ContainerInterface::class);
$application = $container->get(Application::class);

$request = $container->get(ServerRequestFactory::class)->createFromGlobals();
$request = $request->withAttribute('applicationStartTime', $startTime);

try {
    $application->start();
    $response = $application->handle($request);
    $emitter = new SapiEmitter();
    $emitter->emit($response, $request->getMethod() === Method::HEAD);
} finally {
    $application->afterEmit($response ?? null);
    $application->shutdown();
}

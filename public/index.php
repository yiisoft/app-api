<?php

use Doctrine\Common\Annotations\AnnotationReader;
use Psr\Container\ContainerInterface;
use Yiisoft\Composer\Config\Builder;
use Yiisoft\Di\Container;
use Yiisoft\Http\Method;
use Yiisoft\Yii\Web\Application;
use Yiisoft\Yii\Web\SapiEmitter;
use Yiisoft\Yii\Web\ServerRequestFactory;

// PHP built-in server routing.
if (PHP_SAPI === 'cli-server') {
    // Serve static files as is.
    if (is_file(__DIR__ . $_SERVER["REQUEST_URI"])) {
        return false;
    }

    // Explicitly set for URLs with dot.
    $_SERVER['SCRIPT_NAME'] = '/index.php';
}

require_once dirname(__DIR__) . '/vendor/autoload.php';

Builder::rebuild();

$startTime = microtime(true);
$container = new Container(
    require Builder::path('web'),
    require Builder::path('providers')
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

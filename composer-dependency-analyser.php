<?php

declare(strict_types=1);

use ShipMonk\ComposerDependencyAnalyser\Config\Configuration;
use ShipMonk\ComposerDependencyAnalyser\Config\ErrorType;

$root = __DIR__;
return (new Configuration())
    ->disableComposerAutoloadPathScan()
    ->setFileExtensions(['php'])
    ->addPathToScan($root . '/src', isDev: false)
    ->addPathToScan($root . '/config', isDev: false)
    ->addPathToScan($root . '/public/index.php', isDev: false)
    ->addPathToScan($root . '/yii', isDev: false)
    ->addPathToScan($root . '/tests', isDev: true)
    ->ignoreErrorsOnPackages(
        ['yiisoft/di', 'yiisoft/data'],
        [ErrorType::PROD_DEPENDENCY_ONLY_IN_DEV],
    )
    ->ignoreErrorsOnPackages(
        ['psr/container', 'yiisoft/config', 'yiisoft/aliases', 'yiisoft/request-provider', 'yiisoft/router-fastroute'],
        [ErrorType::UNUSED_DEPENDENCY],
    );

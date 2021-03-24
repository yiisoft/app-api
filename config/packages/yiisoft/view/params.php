<?php

declare(strict_types=1);

use Yiisoft\Assets\AssetManager;
use Yiisoft\Factory\Definitions\Reference;

return [
    'yiisoft/view' => [
        'basePath' => '@views',
        'defaultParameters' => [
            'assetManager' => Reference::to(AssetManager::class),
        ],
        'theme' => [
            'pathMap' => [],
            'basePath' => '',
            'baseUrl' => '',
        ],
    ],
];

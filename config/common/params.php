<?php

declare(strict_types=1);

use Yiisoft\Assets\AssetManager;
use Yiisoft\Definitions\Reference;

return [
    'supportEmail' => 'support@example.com',

    'yiisoft/aliases' => [
        'aliases' => [
            '@root' => dirname(__DIR__, 2),
            '@assets' => '@public/assets',
            '@assetsUrl' => '@baseUrl/assets',
            '@baseUrl' => '/',
            '@data' => '@root/data',
            '@messages' => '@resources/messages',
            '@public' => '@root/public',
            '@resources' => '@root/resources',
            '@runtime' => '@root/runtime',
            '@src' => '@root/src',
            '@tests' => '@root/tests',
            '@views' => '@root/views',
            '@vendor' => '@root/vendor',
        ],
    ],

    'yiisoft/router-fastroute' => [
        'enableCache' => false,
    ],

    'yiisoft/view' => [
        'basePath' => '@views',
        'parameters' => [
            'assetManager' => Reference::to(AssetManager::class),
        ],
    ],

    'yiisoft/yii-swagger' => [
        'annotation-paths' => [
            '@src',
        ],
    ],
];

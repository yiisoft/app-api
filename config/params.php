<?php

declare(strict_types=1);

use Cycle\Schema\Generator;
use Spiral\Database\Driver\SQLite\SQLiteDriver;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Factory\Definitions\Reference;
use Yiisoft\Yii\Cycle\Schema\Provider\FromConveyorSchemaProvider;
use Yiisoft\Yii\Cycle\Schema\Provider\SimpleCacheSchemaProvider;

return [
    'yiisoft/yii-debug' => [
        'enabled' => false,
    ],
    'supportEmail' => 'support@example.com',
    'yiisoft/aliases' => [
        'aliases' => [
            '@root' => dirname(__DIR__),
            '@resources' => '@root/resources',
            '@src' => '@root/src',
            '@data' => '@root/data',
            '@tests' => '@root/tests',
            '@views' => '@root/views',
            '@assets' => '@public/assets',
            '@assetsUrl' => '@baseUrl/assets',
        ],
    ],
    'yiisoft/view' => [
        'basePath' => '@views',
        'defaultParameters' => [
            'assetManager' => Reference::to(AssetManager::class),
        ],
    ],
    'yiisoft/yii-cycle' => [
        'dbal' => [
            'default' => 'default',
            'aliases' => [],
            'databases' => [
                'default' => ['connection' => 'sqlite'],
            ],
            'connections' => [
                'sqlite' => [
                    'driver' => SQLiteDriver::class,
                    'connection' => 'sqlite:@data/db/database.db',
                    'username' => '',
                    'password' => '',
                ],
            ],
        ],
        'schema-providers' => [
            // Uncomment next line to enable schema cache
            // SimpleCacheSchemaProvider::class => ['key' => 'cycle-orm-cache-key'],
            FromConveyorSchemaProvider::class => [
                'generators' => [
                    Generator\SyncTables::class,
                ],
            ],
        ],
        'annotated-entity-paths' => [
            '@src',
        ],
    ],
    'yiisoft/router' => [
        'enableCache' => false,
    ],
];

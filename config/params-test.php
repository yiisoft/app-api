<?php

use Cycle\Schema\Generator;
use Yiisoft\Yii\Cycle\Schema\Provider\FromConveyorSchemaProvider;
use Yiisoft\Yii\Cycle\Schema\Provider\SimpleCacheSchemaProvider;
use Spiral\Database\Driver\SQLite\SQLiteDriver;

return [
    'yiisoft/yii-cycle' => [
        'dbal' => [
            'default' => 'default',
            'aliases' => [],
            'databases' => [
                'default' => ['connection' => 'sqlite']
            ],
            'connections' => [
                'sqlite' => [
                    'driver' => SQLiteDriver::class,
                    'connection' => 'sqlite:@tests/_data/database.db',
                    'username' => '',
                    'password' => '',
                ],
            ],
        ],
        'schema-providers' => [
            SimpleCacheSchemaProvider::class => [
                'key' => 'cycle-orm-cache-key'
            ],
            FromConveyorSchemaProvider::class => [
                'generators' => [
                    Generator\SyncTables::class,
                ]
            ],
        ],
        'annotated-entity-paths' => [
            '@src/Entity',
        ],
    ],
];

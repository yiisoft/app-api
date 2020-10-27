<?php

use Spiral\Database\Driver\SQLite\SQLiteDriver;

return [
    'yiisoft/yii-cycle' => [
        'dbal' => [
            'connections' => [
                'sqlite' => [
                    'driver' => SQLiteDriver::class,
                    'connection' => 'sqlite:@tests/_data/database.db',
                    'username' => '',
                    'password' => '',
                ],
            ],
        ],
    ],
];

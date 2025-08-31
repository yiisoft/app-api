<?php

declare(strict_types=1);

return [
    'supportEmail' => 'support@example.com',

    'yiisoft/aliases' => [
        'aliases' => require __DIR__ . '/aliases.php',
    ],

    'yiisoft/router-fastroute' => [
        'enableCache' => false,
    ],

    'yiisoft/view' => [
        'basePath' => '@views',
        'parameters' => [],
    ],
];

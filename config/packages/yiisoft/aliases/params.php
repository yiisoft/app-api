<?php

declare(strict_types=1);

return [
    'yiisoft/aliases' => [
        'aliases' => [
            '@root' => dirname(__DIR__, 4),
            '@resources' => '@root/resources',
            '@src' => '@root/src',
            '@data' => '@root/data',
            '@tests' => '@root/tests',
            '@views' => '@root/views',
            '@assets' => '@public/assets',
            '@assetsUrl' => '@baseUrl/assets',
        ],
    ],
];

<?php

declare(strict_types=1);

return [
    'supportEmail' => 'support@example.com',

    'yiisoft/aliases' => [
        'aliases' => [
            '@root' => dirname(__DIR__),
            '@assets' => '@public/assets',
            '@assetsUrl' => '@baseUrl/assets',
            '@baseUrl' => '/',
            '@data' => '@root/data',
            '@public' => '@root/public',
            '@resources' => '@root/resources',
            '@runtime' => '@root/runtime',
            '@src' => '@root/src',
            '@tests' => '@root/tests',
            '@views' => '@root/views',
            '@vendor' => '@root/vendor',
        ],
    ],
];

<?php

declare(strict_types=1);

return [
    'config-plugin' => [
        'params' => [
            'common/params.php',
        ],
        'params-web' => [
            '$params',
            'web/params.php',
        ],
        'params-console' => [
            '$params',
            'console/params.php',
        ],
        'di' => [
            '$common',
            'common/di/*.php',
        ],
        'di-web' => [
            '$di',
            '$web',
            'web/di/*.php',
        ],
        'di-console' => [
            '$di',
            '$console',
        ],
        'delegates-console' => [],
        'di-delegates' => ['$delegates'],
        'di-delegates-console' => ['$di-delegates', '$delegates-console'],
        'di-delegates-web' => '$di-delegates',
        'di-providers' => '$providers',
        'di-providers-console' => '$di-providers',
        'di-providers-web' => '$di-providers',
        'events' => [],
        'events-console' => '$events',
        'events-web' => '$events',
        'bootstrap' => [],
        'bootstrap-console' => '$bootstrap',
        'bootstrap-web' => '$bootstrap',
        'routes' => 'common/routes.php',
    ],
    'config-plugin-environments' => [
        'dev' => [
            'params' => [
                'environments/dev/params.php',
            ],
        ],
        'prod' => [
            'params' => [
                'environments/prod/params.php',
            ],
        ],
        'test' => [
            'params' => [
                'environments/test/params.php',
            ],
        ],
    ],
    'config-plugin-options' => [
        'source-directory' => 'config',
    ],
];

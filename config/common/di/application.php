<?php

declare(strict_types=1);

use App\ApplicationParams;

/** @var array $params */

return [
    ApplicationParams::class => [
        '__construct()' => [
            'name' => $params['application']['name'],
            'version' => $params['application']['version'],
        ],
    ],
];

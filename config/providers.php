<?php

declare(strict_types=1);

use App\Provider\RepositoryProvider;
use Yiisoft\Composer\Config\Merger\Modifier\ReverseBlockMerge;

return [
    RepositoryProvider::class => RepositoryProvider::class,
    ReverseBlockMerge::class => new ReverseBlockMerge(),
];

<?php

declare(strict_types=1);

use App\Controller\IndexAction;
use Yiisoft\Router\Route;

/**
 * @var array $params
 */

return [
    Route::get('/')
        ->action(IndexAction::class)
        ->name('app/index'),
];

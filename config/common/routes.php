<?php

declare(strict_types=1);

use App\Controller\IndexController;
use Yiisoft\Router\Route;

/**
 * @var array $params
 */

return [
    Route::get('/')
        ->action([IndexController::class, 'index'])
        ->name('app/index'),
];

<?php

declare(strict_types=1);

use App\EndPoint\Api;
use Yiisoft\Router\Route;

/**
 * @var array $params
 */

return [
    Route::get('/')->action(Api\Index\Action::class)->name('app/index'),
];

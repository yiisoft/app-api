<?php

declare(strict_types=1);

namespace App\Http\Presenter;

/**
 * @template T
 */
interface PresenterInterface
{
    /**
     * @param T $value
     */
    public function present(mixed $value): mixed;
}

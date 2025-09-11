<?php

declare(strict_types=1);

namespace App\Http\Presenter;

use Psr\Http\Message\ResponseInterface;

/**
 * @template T
 */
interface PresenterInterface
{
    /**
     * @param T $value
     */
    public function present(mixed $value, ResponseInterface $response): mixed;
}

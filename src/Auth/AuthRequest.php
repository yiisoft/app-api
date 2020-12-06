<?php

declare(strict_types=1);

namespace App\Auth;

use Yiisoft\RequestModel\RequestModel;
use Yiisoft\RequestModel\ValidatableModelInterface;
use Yiisoft\Validator\Rule\Required;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      schema="AuthRequest",
 *      @OA\Property(example="Opal1144", property="login", format="string"),
 *      @OA\Property(example="Opal1144", property="password", format="string"),
 * )
 */
final class AuthRequest extends RequestModel implements ValidatableModelInterface
{
    public function getLogin(): string
    {
        return (string)$this->getValue('body.login');
    }

    public function getPassword(): string
    {
        return (string)$this->getValue('body.password');
    }

    public function getRules(): array
    {
        return [
            'body.login' => [
                new Required(),
            ],
            'body.password' => [
                new Required(),
            ],
        ];
    }
}

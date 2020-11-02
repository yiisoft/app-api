<?php

declare(strict_types=1);

namespace App\Validation;

use Yiisoft\RequestModel\RequestModel;
use Yiisoft\RequestModel\ValidatableModelInterface;
use Yiisoft\Validator\Rule\Required;

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
            ]
        ];
    }
}

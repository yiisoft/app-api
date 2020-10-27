<?php

declare(strict_types=1);

namespace App\Validation;

use App\Entity\User;
use App\Enum\PostStatus;
use Yiisoft\Auth\Middleware\Authentication;
use Yiisoft\RequestModel\RequestModel;
use Yiisoft\RequestModel\ValidatableModelInterface;
use Yiisoft\Validator\Result;
use Yiisoft\Validator\Rule\HasLength;
use Yiisoft\Validator\Rule\Required;

final class EditPostRequest extends RequestModel implements ValidatableModelInterface
{
    public function getId(): int
    {
        return (int)$this->getValue('attributes.id');
    }

    public function getTitle(): string
    {
        return (string)$this->getValue('body.title');
    }

    public function getText(): string
    {
        return (string)$this->getValue('body.text');
    }

    public function getStatus(): PostStatus
    {
        return new PostStatus($this->getValue('body.status'));
    }

    public function getUser(): User
    {
        /**
         * @var User $identity
         */
        $identity = $this->getValue('attributes.' . Authentication::class);

        return $identity;
    }

    public function getRules(): array
    {
        return [
            'body.title' => [
                new Required(),
                (new HasLength())
                    ->min(5)
                    ->max(255)
            ],
            'body.text' => [
                new Required(),
                (new HasLength())
                    ->min(5)
                    ->max(1000)
            ],
            'body.status' => [
                new Required(),
                static function ($value): Result {
                    $result = new Result();
                    if (!PostStatus::isValid($value)) {
                        $result->addError('Incorrect status');
                    }
                    return $result;
                }
            ]
        ];
    }
}

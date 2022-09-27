<?php

declare(strict_types=1);

namespace App\User;

use App\Exception\BadRequestException;
use Yiisoft\Auth\IdentityInterface;
use Yiisoft\Auth\IdentityRepositoryInterface;
use Yiisoft\User\CurrentUser;

final class UserService
{
    public function __construct(private CurrentUser $currentUser, private IdentityRepositoryInterface $identityRepository)
    {
    }

    /**
     * @throws BadRequestException
     */
    public function login(string $login, string $password): IdentityInterface
    {
        $identity = $this->identityRepository->findByLogin($login);
        if ($identity === null) {
            throw new BadRequestException('No such user.');
        }

        if (!$identity->validatePassword($password)) {
            throw new BadRequestException('Invalid password.');
        }

        if (!$this->currentUser->login($identity)) {
            throw new BadRequestException();
        }

        $identity->resetToken();
        $this->identityRepository->save($identity);
        return $identity;
    }

    public function logout(User $user): void
    {
        $user->resetToken();
        $this->identityRepository->save($user);
    }
}

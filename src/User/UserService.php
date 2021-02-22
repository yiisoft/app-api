<?php

declare(strict_types=1);

namespace App\User;

use App\Exception\BadRequestException;
use Yiisoft\Auth\IdentityInterface;
use Yiisoft\Auth\IdentityRepositoryInterface;
use Yiisoft\User\CurrentIdentity\CurrentIdentity;

final class UserService
{
    private IdentityRepositoryInterface $identityRepository;
    private CurrentIdentity $currentIdentity;

    public function __construct(CurrentIdentity $currentIdentity, IdentityRepositoryInterface $identityRepository)
    {
        $this->currentIdentity = $currentIdentity;
        $this->identityRepository = $identityRepository;
    }

    /**
     * @param string $login
     * @param string $password
     *
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

        if (!$this->currentIdentity->login($identity)) {
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

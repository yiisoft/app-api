<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\BadRequestException;
use Yiisoft\Auth\IdentityInterface;
use Yiisoft\Auth\IdentityRepositoryInterface;
use Yiisoft\Yii\Web\User\User;
use Throwable;

final class UserService
{
    private IdentityRepositoryInterface $identityRepository;
    private User $user;

    public function __construct(User $user, IdentityRepositoryInterface $identityRepository)
    {
        $this->user = $user;
        $this->identityRepository = $identityRepository;
    }

    /**
     * @param string $login
     * @param string $password
     * @return IdentityInterface
     * @throws BadRequestException
     */
    public function login(string $login, string $password): IdentityInterface
    {
        $identity = $this->identityRepository->findByLogin($login);
        if ($identity === null) {
            throw new BadRequestException('No such user');
        }

        if (!$identity->validatePassword($password)) {
            throw new BadRequestException('Invalid password');
        }

        if (!$this->user->login($identity)) {
            throw new BadRequestException();
        }

        $identity->resetToken();
        $this->identityRepository->save($identity);
        return $identity;
    }

    /**
     * @throws BadRequestException
     * @throws Throwable
     */
    public function logout(): void
    {
        if ($this->user->logout()) {
            throw new BadRequestException();
        }
    }
}

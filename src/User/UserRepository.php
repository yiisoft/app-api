<?php

declare(strict_types=1);

namespace App\User;

use Cycle\ORM\ORMInterface;
use Cycle\ORM\Select;
use Cycle\ORM\Transaction;
use Yiisoft\Auth\IdentityInterface;
use Yiisoft\Auth\IdentityRepositoryInterface;
use Yiisoft\Data\Reader\Sort;
use Yiisoft\Yii\Cycle\DataReader\SelectDataReader;

final class UserRepository extends Select\Repository implements IdentityRepositoryInterface
{
    private ORMInterface $orm;

    public function __construct(Select $select, ORMInterface $orm)
    {
        $this->orm = $orm;
        parent::__construct($select);
    }

    public function findAllOrderByLogin(): SelectDataReader
    {
        return (new SelectDataReader($this->select()))
            ->withSort(
                (new Sort([]))->withOrderString('login')
            );
    }

    public function findIdentity(string $id): ?IdentityInterface
    {
        return $this->findIdentityBy('id', $id);
    }

    public function findIdentityByToken(string $token, string $type = null): ?IdentityInterface
    {
        return $this->findIdentityBy('token', $token);
    }

    public function findByLogin(string $login): ?IdentityInterface
    {
        return $this->findIdentityBy('login', $login);
    }

    public function save(IdentityInterface $user): void
    {
        $transaction = new Transaction($this->orm);
        $transaction->persist($user);
        $transaction->run();
    }

    private function findIdentityBy(string $field, string $value): ?IdentityInterface
    {
        /**
         * @var $identity IdentityInterface|null
         */
        return $this->findOne([$field => $value]);
    }
}

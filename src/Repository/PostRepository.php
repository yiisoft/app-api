<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Post;
use Cycle\ORM\ORMInterface;
use Cycle\ORM\Select;
use Cycle\ORM\Transaction;
use Yiisoft\Yii\Cycle\DataReader\SelectDataReader;

final class PostRepository extends Select\Repository
{
    private ORMInterface $orm;

    public function __construct(Select $select, ORMInterface $orm)
    {
        $this->orm = $orm;
        parent::__construct($select);
    }

    public function findAll(array $scope = [], array $orderBy = []): SelectDataReader
    {
        return (new SelectDataReader(
            $this->select()->where($scope)->orderBy($orderBy)
        ));
    }

    public function save(Post $user): void
    {
        $transaction = new Transaction($this->orm);
        $transaction->persist($user);
        $transaction->run();
    }
}

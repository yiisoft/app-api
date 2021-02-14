<?php

declare(strict_types=1);

namespace App\Blog;

use Cycle\ORM\Select;
use Yiisoft\Yii\Cycle\Data\Reader\EntityReader;

final class PostRepository extends Select\Repository
{
    public function findAll(array $scope = [], array $orderBy = []): EntityReader
    {
        return new EntityReader(
            $this->select()->where($scope)->orderBy($orderBy)
        );
    }
}

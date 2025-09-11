<?php

declare(strict_types=1);

namespace App\Tests\Unit\HttpPresenter;

use App\Http\Presenter\OffsetPaginatorPresenter;
use App\Http\Presenter\PresenterInterface;
use Codeception\Test\Unit;
use Yiisoft\Data\Paginator\OffsetPaginator;
use Yiisoft\Data\Reader\Iterable\IterableDataReader;

final class OffsetPaginatorPresenterTest extends Unit
{
    public function testBase(): void
    {
        $paginator = (new OffsetPaginator(
            new IterableDataReader([
                ['id' => 1, 'name' => 'Item 1'],
                ['id' => 2, 'name' => 'Item 2'],
                ['id' => 3, 'name' => 'Item 3'],
                ['id' => 4, 'name' => 'Item 4'],
                ['id' => 5, 'name' => 'Item 5'],
            ]),
        ))
            ->withPageSize(2)
            ->withCurrentPage(2);
        $presenter = new OffsetPaginatorPresenter();

        $result = $presenter->present($paginator);

        $this->assertSame(
            [
                'items' => [
                    ['id' => 3, 'name' => 'Item 3'],
                    ['id' => 4, 'name' => 'Item 4'],
                ],
                'pageSize' => 2,
                'currentPage' => 2,
                'totalPages' => 3,
            ],
            $result,
        );
    }

    public function testItemPresenter(): void
    {
        $paginator = new OffsetPaginator(
            new IterableDataReader([
                ['id' => 1, 'name' => 'Item 1'],
                ['id' => 2, 'name' => 'Item 2'],
            ]),
        );
        $presenter = new OffsetPaginatorPresenter(
            new class implements PresenterInterface {
                public function present(mixed $value): mixed
                {
                    return $value['name'];
                }
            },
        );

        $result = $presenter->present($paginator);

        $this->assertSame(
            [
                'items' => ['Item 1', 'Item 2'],
                'pageSize' => 10,
                'currentPage' => 1,
                'totalPages' => 1,
            ],
            $result,
        );
    }
}

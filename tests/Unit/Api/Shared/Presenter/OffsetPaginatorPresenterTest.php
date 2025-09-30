<?php

declare(strict_types=1);

namespace App\Tests\Unit\Api\Shared\Presenter;

use App\Api\Shared\Presenter\OffsetPaginatorPresenter;
use App\Api\Shared\Presenter\PresenterInterface;
use Codeception\Test\Unit;
use HttpSoft\Message\ResponseFactory;
use HttpSoft\Message\StreamFactory;
use Yiisoft\Data\Paginator\OffsetPaginator;
use Yiisoft\Data\Reader\Iterable\IterableDataReader;
use Yiisoft\DataResponse\DataResponse;
use Yiisoft\Http\Status;

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

        $result = $presenter->present($paginator, $this->createDataResponse());

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
            $result->getData(),
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
                public function present(mixed $value, DataResponse $response): DataResponse
                {
                    return $response->withData($value['name']);
                }
            },
        );

        $result = $presenter->present($paginator, $this->createDataResponse());

        $this->assertSame(
            [
                'items' => ['Item 1', 'Item 2'],
                'pageSize' => 10,
                'currentPage' => 1,
                'totalPages' => 1,
            ],
            $result->getData(),
        );
    }

    private function createDataResponse(): DataResponse
    {
        return new DataResponse(
            '',
            Status::OK,
            '',
            new ResponseFactory(),
            new StreamFactory(),
        );
    }
}

<?php

declare(strict_types=1);

namespace App\Controller;

use App\ApplicationParams;
use Psr\Http\Message\ResponseInterface;
use Yiisoft\DataResponse\DataResponseFactoryInterface;

final class IndexAction
{
    public function __invoke(
        DataResponseFactoryInterface $responseFactory,
        ApplicationParams $applicationParams,
    ): ResponseInterface {
        return $responseFactory->createResponse([
            'name' => $applicationParams->name,
            'version' => $applicationParams->version,
        ]);
    }
}

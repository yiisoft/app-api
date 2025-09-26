<?php

declare(strict_types=1);

namespace App\Api;

use App\Api\Shared\ResponseFactory;
use App\Shared\ApplicationParams;
use Psr\Http\Message\ResponseInterface;

final class IndexAction
{
    public function __invoke(
        ResponseFactory $responseFactory,
        ApplicationParams $applicationParams,
    ): ResponseInterface {
        return $responseFactory->success([
            'name' => $applicationParams->name,
            'version' => $applicationParams->version,
        ]);
    }
}

<?php

declare(strict_types=1);

namespace App\Controller;

use App\ApplicationParams;
use App\Http\ResponseFactory;
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

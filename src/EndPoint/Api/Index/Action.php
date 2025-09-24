<?php

declare(strict_types=1);

namespace App\EndPoint\Api\Index;

use App\EndPoint\Api\Shared\ResponseFactory;
use App\Shared\ApplicationParams;
use Psr\Http\Message\ResponseInterface;

final class Action
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

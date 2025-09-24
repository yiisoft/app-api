<?php

declare(strict_types=1);

namespace App\EndPoint\Api\Index;

use App\EndPoint\Api\Shared\ApiResponseFactory;
use App\Shared\ApplicationParams;
use Psr\Http\Message\ResponseInterface;

final class Action
{
    public function __invoke(
        ApiResponseFactory $apiResponseFactory,
        ApplicationParams $applicationParams,
    ): ResponseInterface {
        return $apiResponseFactory->success([
            'name' => $applicationParams->name,
            'version' => $applicationParams->version,
        ]);
    }
}

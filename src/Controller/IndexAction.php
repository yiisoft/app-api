<?php

declare(strict_types=1);

namespace App\Controller;

use App\ApplicationParams;
use App\Http\ApiResponseFactory;
use Psr\Http\Message\ResponseInterface;

final class IndexAction
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

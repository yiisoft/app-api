<?php

declare(strict_types=1);

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use Yiisoft\DataResponse\DataResponseFactoryInterface;

/**
 * @OA\Info(title="My first API", version="1.0")
 */
class SiteController
{
    /**
     * @OA\Get(
     *     path="/",
     *     @OA\Response(response="200", description="API Info")
     * )
     */
    public function index(DataResponseFactoryInterface $responseFactory): ResponseInterface
    {
        return $responseFactory->createResponse(['version' => '3.0', 'author' => 'yiisoft']);
    }
}

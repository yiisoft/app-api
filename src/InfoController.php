<?php

declare(strict_types=1);

namespace App;

use Psr\Http\Message\ResponseInterface;
use Yiisoft\DataResponse\DataResponseFactoryInterface;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(title="Yii API application", version="1.0")
 */
class InfoController
{
    /**
     * @OA\Get(
     *     path="/",
     *     summary="Returns info about the API",
     *     description="",
     *     @OA\Response(response="200", description="Success")
     * )
     */
    public function index(DataResponseFactoryInterface $responseFactory): ResponseInterface
    {
        return $responseFactory->createResponse(['version' => '3.0', 'author' => 'yiisoft']);
    }
}

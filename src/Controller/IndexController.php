<?php

declare(strict_types=1);

namespace App\Controller;

use OpenApi\Attributes as OA;
use Psr\Http\Message\ResponseInterface;
use Yiisoft\DataResponse\DataResponseFactoryInterface;

#[OA\Info(title:'Yii API application', version:'1.0')]
class IndexController
{
    #[OA\Get(
        path: '/',
        description: '',
        summary: 'Returns info about the API',
        responses: [
            new OA\Response(
                response:'200',
                description:'Success',
                content: new OA\JsonContent(
                    allOf: [
                        new OA\Schema(ref: '#/components/schemas/Response'),
                        new OA\Schema(properties: [
                            new OA\Property(property: 'data', properties: [
                                new OA\Property(property: 'version', type: 'string', example: '3.0'),
                                new OA\Property(property: 'author', type: 'string', example: 'yiisoft'),
                            ], type: 'object'),
                        ]),
                    ]
                ),
            ),
        ]
    )]
    public function index(DataResponseFactoryInterface $responseFactory): ResponseInterface
    {
        return $responseFactory->createResponse(['version' => '3.0', 'author' => 'yiisoft']);
    }
}

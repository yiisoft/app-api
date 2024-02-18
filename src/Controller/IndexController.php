<?php

declare(strict_types=1);

namespace App\Controller;

use OpenApi\Attributes\Get;
use OpenApi\Attributes\Info;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Response;
use OpenApi\Attributes\Schema;
use Psr\Http\Message\ResponseInterface;
use Yiisoft\DataResponse\DataResponseFactoryInterface;

#[Info(title:"Yii API application", version:"1.0")]
class IndexController
{

    #[Get(
        path: "/",
        description: "",
        summary: "Returns info about the API",
        responses: [
            new Response(
                response:"200",
                description:"Success",
                content: new JsonContent(
                    allOf: [
                        new Schema(ref: "#/components/schemas/Response"),
                        new Schema(properties: [
                            new Property(property: "data", properties: [
                                new Property(property: "version", type: "string", example: "3.0"),
                                new Property(property: "author", type: "string", example: "yiisoft"),
                            ], type: "object"),
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

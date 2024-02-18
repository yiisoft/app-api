<?php

declare(strict_types=1);

namespace App\Http;

use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;


#[Schema(
    schema: "Response"
)]
#[Schema(
    schema: "BadResponse",
    allOf: [
        new Schema(ref: "#/components/schemas/Response"),
        new Schema(properties: [
            new Property(property: "status", example: "failed"),
            new Property(property: "error_message", example: "Error description message"),
            new Property(property: "error_code", example: "400", nullable: true),
            new Property(property: "data", example: null),
        ])
    ]
)]
final class ApiResponseData
{
    #[Property(
        property: "status",
        format: "string",
        enum: ['success', 'failed'],
        example: "success"
    )]
    private string $status = '';

    #[Property(
        property: "error_message",
        format: "string",
        example: ""
    )]
    private string $errorMessage = '';

    #[Property(
        property: "error_code",
        format: "integer",
        example: null,
        nullable: true
    )]
    private ?int $errorCode = null;

    #[Property(
        property: "data",
        type: "object",
        nullable: true
    )]
    private ?array $data = null;

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    public function setErrorMessage(string $errorMessage): self
    {
        $this->errorMessage = $errorMessage;
        return $this;
    }

    public function getErrorCode(): ?int
    {
        return $this->errorCode;
    }

    public function setErrorCode(int $errorCode): self
    {
        $this->errorCode = $errorCode;
        return $this;
    }

    public function getData(): ?array
    {
        return $this->data;
    }

    public function setData(?array $data): self
    {
        $this->data = $data;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'status' => $this->getStatus(),
            'error_message' => $this->getErrorMessage(),
            'error_code' => $this->getErrorCode(),
            'data' => $this->getData(),
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Dto;

final class ApiResponseData
{
    private string $status = '';

    private string $errorMessage = '';

    private ?int $errorCode = null;

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
            'data' => $this->getData()
        ];
    }
}

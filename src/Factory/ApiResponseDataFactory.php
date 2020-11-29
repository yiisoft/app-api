<?php

declare(strict_types=1);

namespace App\Factory;

use App\Dto\ApiResponseData;
use Yiisoft\DataResponse\DataResponse;
use Yiisoft\Http\Status;

/**
 * @OA\Schema(
 *      schema="Response",
 *      @OA\Property(
 *          property="status",
 *          format="string",
 *          example="success",
 *          enum={"success", "failed"}
 *      ),
 *      @OA\Property(property="error_message", format="string", example=""),
 *      @OA\Property(property="error_code", format="integer", nullable=true, example=null),
 *      @OA\Property(
 *          property="data",
 *          type="object",
 *          nullable=true,
 *      ),
 * )
 * @OA\Schema(
 *      schema="BadResponse",
 *      allOf={
 *          @OA\Schema(ref="#/components/schemas/Response"),
 *          @OA\Schema(
 *              @OA\Property(
 *                  property="status",
 *                  example="failed",
 *              ),
 *              @OA\Property(property="error_message", example="Error description message"),
 *              @OA\Property(property="error_code", nullable=true, example=400),
 *              @OA\Property(
 *                  property="data",
 *                  example=null
 *              ),
 *          )
 *      }
 * )
 */
final class ApiResponseDataFactory
{
    public function createFromResponse(DataResponse $response): ApiResponseData
    {
        if ($response->getStatusCode() !== Status::OK) {
            return $this->createErrorResponse()
                ->setErrorCode($response->getStatusCode())
                ->setErrorMessage($this->getErrorMessage($response));
        }

        return $this->createSuccessResponse()
            ->setData($response->getData());
    }

    public function createSuccessResponse(): ApiResponseData
    {
        return $this->createResponse()->setStatus('success');
    }

    public function createErrorResponse(): ApiResponseData
    {
        return $this->createResponse()->setStatus('failed');
    }

    public function createResponse(): ApiResponseData
    {
        return new ApiResponseData();
    }

    private function getErrorMessage(DataResponse $response): string
    {
        $data = $response->getData();
        if (is_string($data) && !empty($data)) {
            return $data;
        }

        return 'Unknown error';
    }
}

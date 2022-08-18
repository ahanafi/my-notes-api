<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseHandler {

    /**
     * @param $results
     * @param $message
     * @return JsonResponse
     */
    public function handleResponse($results, $message = null): JsonResponse
    {
        $response = [
            'success' => true,
            'data' => $results->resource ?? $results,
            'message' => $message
        ];

        return response()->json($response);
    }

    /**
     * @param $error
     * @param array $errorMessage
     * @param int $errorCode
     * @return JsonResponse
     */
    public function handleError($error, array $errorMessage = [], int $errorCode = 404): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error
        ];

        if (!empty($errorMessage)) {
            $response['data'] = $errorMessage;
        }

        return response()->json($response, $errorCode);
    }

}

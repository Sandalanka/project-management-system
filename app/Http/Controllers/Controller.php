<?php

namespace App\Http\Controllers;

use App\Constant\Messages;
use App\Constant\Status;
use Exception;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

abstract class Controller
{
    /**
     *
     * Summary: Return a success JSON response.
     *
     * @param array|Collection|Arrayable|null $data
     * @param string|null $message
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function successResponse(array|Collection|Arrayable $data = null,
                                       string                     $message = null,
                                       int                        $statusCode = Status::STATUS_CODE_OK): JsonResponse
    {
        $response = [
            'status' => Status::STATUS_SUCCESS,
            'timestamp' => now()->toDateTimeString()
        ];

        if ($message !== null) {
            $response['message'] = $message;
        }

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $statusCode, [
                'Access-Control-Allow-Origin' => '*',
                'Content-Type' => 'application/json'
            ]
        );
    }

    /**
     *
     * Summary: Return an error JSON response.
     *
     * @param Exception|null $exception
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function errorResponse(Exception $exception = null,
                                     string    $message = Messages::GENERAL_RESPONSE_ERROR_MESSAGE,
                                     int       $statusCode = Status::STATUS_CODE_INTERNAL_SERVER_ERROR): JsonResponse
    {
    
         $response = [
            'status' => Status::STATUS_FAILED,
            'message' => $message,
            'timestamp' => now()->toDateTimeString()
        ];

        if ($exception !== null) {
            $response['errors'] = $exception->getMessage();
        }

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $statusCode, [
            'Access-Control-Allow-Origin' => '*',
            'Content-Type' => 'application/json'
        ]);
    }
}

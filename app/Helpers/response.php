<?php

use Illuminate\Http\JsonResponse;
use JetBrains\PhpStorm\ArrayShape;

if (!function_exists('successResponse')) {
    function successResponse($data , $message = 'progress successfully done'): JsonResponse
    {
        return response()->json([
            'status' => true,
            'data' => $data,
            'message' => $message
        ]);
    }
}

if (!function_exists('errorResponse')) {
    function errorResponse($message = 'Call Support', $exception = null , string $type = null , string $errorMessage = '' , $status = 200): JsonResponse
    {
        $result = [
            'status' => false,
            'message' => $message,
        ];
        if ($type != null)
            $result['error'] = [
                'type' => $type,
                'error' => $errorMessage
            ];
        else if ($exception != null)
            $result['error'] = [
                'type' => get_class($exception),
                'error' => $exception instanceof Exception ? $exception->getMessage() : "",
            ];

        return response()->json($result , $status);
    }
}


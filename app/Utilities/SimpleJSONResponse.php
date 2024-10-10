<?php
namespace App\Utilities;
use Illuminate\Http\JsonResponse;

class SimpleJSONResponse
{
    public static function successResponse($data, $message, $statusCode): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message,
        ], $statusCode);
    }
    public static function errorResponse($message, $statusCode): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $statusCode);
    }
}
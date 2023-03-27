<?php

namespace App\Traits;

trait ApiResponse
{
    function successResponse(array $data = [])
    {
        return response()->json([
            'success' => 1,
            'data' => $data
        ]);
    }

    function errorResponse(string $message)
    {
        return response()->json([
            'success' => 0,
            'error' => $message
        ]);
    }
}

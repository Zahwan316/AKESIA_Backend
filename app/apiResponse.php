<?php

namespace App;

trait apiResponse
{
    //
    public function apiResponse($message, $data = null, $status_code = 200, $error = false)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
            'status_code' => $status_code,
            'error' => $error
        ], $status_code);
    }
}

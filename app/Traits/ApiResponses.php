<?php

namespace App\Traits;

trait ApiResponses
{
    protected function responseSuccess($message, $data = [], $status = 200)
    {
        return response([
            'success' => true,
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    protected function responseFailed($message, $status = 422)
    {
        return response([
            'success' => false,
            'message' => $message,
        ], $status);
    }
}
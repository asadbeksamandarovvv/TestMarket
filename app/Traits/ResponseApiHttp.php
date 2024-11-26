<?php

namespace App\Traits;

trait ResponseApiHttp
{
    public function successResponse($data = [], $message = 'Success', $code = 200)
    {
        return response([
                            'success' => true,
                            'data'    => $data,
                            'message' => $message,
                            'code'    => $code,
                        ], $code);
    }

    public function errorResponse($message, $code = 422)
    {
        return response([
                            'success' => false,
                            'message' => $message,
                            'code'    => $code,
                        ], $code);
    }
}

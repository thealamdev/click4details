<?php

namespace App\Traits;

trait HttpResponses
{
    /**
     * @return array|object.
     * handle all https responses.
     */

    protected function success($data, $message = null, $code = 200)
    {
        return response()->json([
            'status' => 'Request was successful',
            'message' => $message,
            'payload' => $data,
        ], $code);
    }

    /**
     * @return array|object.
     * handle all https responses.
     */

    protected function error($data, $message = null, $code)
    {
        return response()->json([
            'status' => 'Error has occurred...',
            'message' => $message,
            'payload' => $data
        ], $code);
    }
}

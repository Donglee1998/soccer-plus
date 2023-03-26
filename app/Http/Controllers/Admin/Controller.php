<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param array|object $data
     * @param int $status
     * @return JsonResponse
     */
    public function jsonData($data = [], int $status = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'status' => true,
            'data'   => $data,
        ], $status);
    }

    /**
     * @param $error
     * @param int $status
     * @return JsonResponse
     */
    public function jsonError($error, int $status = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        $message = $error;
        $file    = '';
        $line    = '';
        if (is_object($error)) {
            $message = $error->getMessage();
            $file = env('APP_ENV') === 'production' ? '' : $error->getFile();
            $line = env('APP_ENV') === 'production' ? '' : $error->getLine();
        }

        return response()->json([
            'success' => false,
            'message' => $message,
            'file'    => $file,
            'line'    => $line,
        ], $status);
    }
}

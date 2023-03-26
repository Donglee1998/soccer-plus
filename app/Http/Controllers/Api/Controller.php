<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /*
     * @param int $responseCode
     * @param null $data
     * @return JsonResponse
     */
    public function response($data = null, $responseCode = JsonResponse::HTTP_OK): JsonResponse
    {
        return response()->json($data, $responseCode);
    }

    /*
     * @param int $responseCode
     * @param null $data
     * @return JsonResponse
     */
    public function responseFailure($e = null, $responseCode = JsonResponse::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        return response()->json($e->getMessage(), $responseCode);
    }

    /*
     * @param int $responseCode
     * @param null $data
     * @return JsonResponse
     */
    public function responseNotFound($e = null, $responseCode = JsonResponse::HTTP_NOT_FOUND): JsonResponse
    {
        if(empty($e)){
            $e = __('validation.errors.404');
        }
        return response()->json($e, $responseCode);
    }

    public function validateRequest($data,$rules){
        $validation = Validator::make($data, $rules);
        if($validation->fails()){
            return false;
        }
        return true;
    }
}

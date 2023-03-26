<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
trait ApiValidateTrait
{

    public function failedValidation(Validator $validator)
    {

        $errors = (new ValidationException($validator))->errors();
        foreach ($errors as $key => $value) {
            $errors[$key] = reset($value);
        }

        throw new HttpResponseException(response()->json($errors, JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}

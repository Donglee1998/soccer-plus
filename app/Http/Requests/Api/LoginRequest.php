<?php

namespace App\Http\Requests\Api;

use App\Traits\ApiValidateTrait;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    use ApiValidateTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required',
            'uuid'     => 'required',
        ];
    }

    /**
     * Change attributes name
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'username' => 'ID',
            'password' => 'パスワード',
            'uuid'     => 'uuid',
        ];
    }
}

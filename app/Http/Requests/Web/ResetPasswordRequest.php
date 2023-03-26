<?php

namespace App\Http\Requests\Web;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class ResetPasswordRequest extends FormRequest
{
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
            'data.password' => 'required|min:6|confirmed',
        ];
    }


    public function messages()
    {
        return [
            'data.password.confirmed' => 'パスワードとパスワード確認が一致しません。',
        ];
    }

    public function attributes()
    {
        return [
            'data.password'              => 'パスワード',
            'data.password_confirmation' => 'パスワード（確認）',
        ];
    }
}

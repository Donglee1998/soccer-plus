<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'username' => 'required|max:255',
            'password' => 'required',
        ];
    }


    public function messages()
    {
        return [
            '*' => 'アカウントが存在しないか、契約の有効期限が切れています'
        ];
    }

    public function attributes()
    {
        return [
            'username' => 'メールアドレス',
        ];
    }
}

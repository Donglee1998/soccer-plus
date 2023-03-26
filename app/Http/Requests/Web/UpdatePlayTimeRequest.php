<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlayTimeRequest extends FormRequest
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
            'play_time' => 'bail|required|numeric',
        ];
    }

    public function attributes()
    {
        return [
            'play_time' => '再生時間',
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}

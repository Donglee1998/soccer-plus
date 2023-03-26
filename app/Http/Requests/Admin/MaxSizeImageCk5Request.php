<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MaxSizeImageCk5Request extends FormRequest
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
        $data       = request()->file('upload');
        $name       = $data !== null ? $data->getClientOriginalName() : null;
        $extension  = pathinfo($name, PATHINFO_EXTENSION);
        $array_extensions_image = ['png', 'jpg', 'bmp'];
        $rules      = [];
        if (!empty($data) && in_array(strtolower($extension), $array_extensions_image)) {
            $rules['upload'] = 'bail|required|max:5120';
        }

        return $rules;
    }
}

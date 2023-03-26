<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class FolderRequest extends FormRequest
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
            'name'  => 'bail|required|max:255|custom_unique:Folder,name,'. request()->name
        ];
    }

    public function attributes()
    {
        return [
            'name'  => 'フォルダ名',
        ];
    }
}

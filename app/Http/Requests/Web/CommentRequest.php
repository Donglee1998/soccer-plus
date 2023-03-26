<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
		$rules            = [];
		$rules['title']   = 'bail|nullable|max:255';
		$rules['content'] = 'bail|nullable|max:1000';
		$rules['name']    = 'bail|nullable|max:255';

        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
			'title'   => '回戦',
			'content' => '戦評',
			'name'    => '文責',
        ];
    }

    public function messages()
    {
        return [
			'*.max' => ':attributeは:max文字以内に入力してください。',
        ];
    }
}

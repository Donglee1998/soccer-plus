<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TeamRequest extends FormRequest
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
        $rules = [
            'data.name'         => ['mb_required', 'max_mb:255'],
            'data.color_home'   => ['required', 'team_color'],
            'data.color_guest'  => ['required', 'team_color'],
        ];
        return $rules;
    }

    /**
     * Change attributes name
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'data.name'          => 'チーム名',
            'data.color_home'    => 'チームカラー',
            'data.color_guest'   => 'チームカラー',
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}

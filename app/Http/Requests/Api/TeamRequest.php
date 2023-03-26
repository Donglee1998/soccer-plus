<?php

namespace App\Http\Requests\Api;

use App\Traits\ApiValidateTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TeamRequest extends FormRequest
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
        $rules = [];
        $rules['teams.*.id']           = ['required'];
        $rules['teams.*.name']         = ['mb_required', 'max_mb:255'];
        $rules['teams.*.abbreviation'] = ['max_mb:255'];
        $rules['teams.*.gender']       = ['nullable', 'member_gender'];
        $rules['teams.*.hometown']     = ['max_mb:255'];
        $rules['teams.*.coach']        = ['max_mb:255'];
        $rules['teams.*.supervisor']   = ['max_mb:255'];
        $rules['teams.*.manager']      = ['max_mb:255'];
        $rules['teams.*.trainer']      = ['max_mb:255'];
        $rules['teams.*.color_home']   = ['required', 'team_color'];
        $rules['teams.*.color_guest']  = ['required', 'team_color'];
        $rules['teams.*.explanation']  = ['nullable', 'max_mb:1000'];
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
            'teams.*.name'          => 'チーム名',
            'teams.*.abbreviation'  => '略称',
            'teams.*.gender'        => 'チーム性別',
            'teams.*.color_home'    => 'チームカラー',
            'teams.*.color_guest'   => 'チームカラー',
            'teams.*.hometown'      => 'ホームタウン',
            'teams.*.supervisor'    => '監督',
            'teams.*.coach'         => 'コーチ',
            'teams.*.manager'       => 'マネージャー',
            'teams.*.trainer'       => 'トレーナー',
            'teams.*.explanation'   => '説明',
            'teams.*.ids'           => '注文',
            'teams.*.ids.*'         => '注文',
        ];
    }

    public function messages()
    {
        return [
        ];
    }

}

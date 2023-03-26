<?php

namespace App\Http\Requests\Api;

use App\Traits\ApiValidateTrait;
use Illuminate\Foundation\Http\FormRequest;

class TacticRequest extends FormRequest
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
        $rules['tactic'] = [
            'id'         => ['required'],
            'title'      => ['required', 'max_mb:255'],
            'explain'    => ['required', 'max_mb:255'],
            'type'       => ['required', 'in:' . implode(',', config('constants.tactic_type.key'))],
            'status'     => ['required', 'in:' . implode(',', config('constants.tactic_status.key'))],
            'pitch'      => ['required', 'in:' . implode(',', config('constants.tactic_pitch.key'))],
            'background' => ['required', 'numeric'],
            'created_by' => ['nullable'],
        ];
        
        $rules['sheets.*.id']           = ['required'];
        $rules['sheets.*.tactic_id']    = ['required'];
        $rules['sheets.*.sketch_image'] = ['required', 'mimes:jpeg,png,jpg,gif', 'max:5120'];
        $rules['sheets.*.layer']        = ['required', 'json'];
        $rules['sheets.*.comment']      = ['nullable'];
        $rules['sheets.*.order']        = ['nullable', 'numeric'];
        $rules['sheets.*.coord_ball_x'] = ['nullable'];
        $rules['sheets.*.coord_ball_y'] = ['nullable'];
        $rules['sheets.*.coord_goal_x'] = ['nullable'];
        $rules['sheets.*.coord_goal_y'] = ['nullable'];
        
        $rules['member_sheet.*.member_id'] = ['required'];
        $rules['member_sheet.*.sheet_id']  = ['required'];
        $rules['member_sheet.*.coord_x']   = ['required'];
        $rules['member_sheet.*.coord_y']   = ['required'];
        return $rules;
    }


    public function attributes()
    {
        return [
            'tactic.title'    => '作戦名',
            'tactic.explain'  => '説明',
            'tactic.type'     => '作戦の種類',
            'tactic.status'   => '状況',
            'tactic.pitch'    => 'コート',
        ];
    }
}

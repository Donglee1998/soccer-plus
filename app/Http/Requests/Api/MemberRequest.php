<?php
 
namespace App\Http\Requests\Api;

use App\Traits\ApiValidateTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MemberRequest extends FormRequest
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
        $rules['team_id']                   = ['required'];
        $rules['members.*.id']              = ['required'];
        $rules['members.*.first_name']      = ['nullable', 'max_mb:255'];
        $rules['members.*.last_name']       = ['nullable', 'max_mb:255'];
        $rules['members.*.birthday']        = ['nullable', 'date_format:Y-m-d'];
        $rules['members.*.number_official'] = ['nullable', "regex:/^[0-9]{0,3}+$/"];
        $rules['members.*.number_practice'] = ['nullable', "regex:/^[0-9]{0,3}+$/"];
        $rules['members.*.position']        = ['nullable', 'member_position'];
        $rules['members.*.dominant_foot']   = ['nullable', 'dominant_foot'];
        $rules['members.*.height']          = ['nullable', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/', 'min:0'];
        $rules['members.*.weight']          = ['nullable', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/', 'min:0', 'max:999.99'];
        $rules['members.*.school']          = ['nullable', 'max_mb:255'];
        $rules['members.*.email']           = ['nullable', 'email'];
        $rules['members.*.former_team']     = ['nullable', 'max_mb:255'];
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
            'members.*.team_id'         => 'チーム',
            'members.*.first_name'      => '名前:',
            'members.*.last_name'       => '名前:',
            'members.*.birthday'        => '生年月日',
            'members.*.number_official' => '背番号(公式)',
            'members.*.number_practice' => '背番号(練習)',
            'members.*.position'        => 'ポジション',
            'members.*.dominant_foot'   => '利き足',
            'members.*.height'          => '身長',
            'members.*.weight'          => '体重',
            'members.*.school'          => '出身校',
            'members.*.email'           => 'メールアドレス',
            'members.*.former_team'     => '前所属チーム',
         ];
    }
 
    public function messages()
    {
        return [
            'members.*.height.max'              => ':attributeを正しく入力してください',
            'members.*.weight.max'              => ':attributeを正しく入力してください',
            'members.*.max_mb'                  => ':max文字以内で入力してください。',
            'members.*.number_official.min'     => '正の数を入力してください。',
            'members.*.number_practice.min'     => '正の数を入力してください。',
            'members.*.height.min'              => '正の数を入力してください。',
            'members.*.weight.min'              => '正の数を入力してください。',
            'members.*.number_official.numeric' => ':attributeは数字で入力してください。',
            'members.*.number_practice.numeric' => ':attributeは数字で入力してください。',
            'members.*.height.numeric'          => ':attributeは数字で入力してください。',
            'members.*.weight.numeric'          => ':attributeは数字で入力してください。',
        ];
    }
}
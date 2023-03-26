<?php
 
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MemberRequest extends FormRequest
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
        $rules = [];
        $rules['data.first_name']      = ['nullable', 'max_mb:255'];
        $rules['data.last_name']       = ['nullable', 'max_mb:255'];
        $rules['data.birthday']        = ['nullable', 'date_format:Y-m-d'];
        $rules['data.number_official'] = ['mb_required', 'regex:/^[0-9]{0,3}+$/',
        Rule::unique('members', 'number_official')->where('team_id', request()->team_id)->ignore(request()->member_id)->whereNull('deleted_at')];
        $rules['data.number_practice'] = ['mb_required', 'regex:/^[0-9]{0,3}+$/',
        Rule::unique('members', 'number_practice')->where('team_id', request()->team_id)->ignore(request()->member_id)->whereNull('deleted_at')];
        $rules['data.position']        = ['nullable', 'member_position'];
        $rules['data.sub_position']    = ['nullable', 'member_position'];
        $rules['data.dominant_foot']   = ['nullable', 'dominant_foot'];
        $rules['data.height']          = ['nullable', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/', 'min:0'];
        $rules['data.weight']          = ['nullable', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/', 'min:0', 'max:999.99'];
        $rules['data.school']          = ['nullable', 'max_mb:255'];
        $rules['data.email']           = ['nullable', 'email'];
        $rules['data.former_team']     = ['nullable', 'max_mb:255'];
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
            'data.team_id'         => 'チーム',
            'data.first_name'      => '名前:',
            'data.last_name'       => '名前:',
            'data.birthday'        => '生年月日',
            'data.number_official' => '背番号(公式)',
            'data.number_practice' => '背番号(練習)',
            'data.position'        => 'ポジション',
            'data.sub_position'    => 'サブポジション',
            'data.dominant_foot'   => '利き足',
            'data.height'          => '身長',
            'data.weight'          => '体重',
            'data.school'          => '出身校',
            'data.email'           => 'メールアドレス',
            'data.former_team'     => '前所属チーム',
         ];
    }
 
    public function messages()
    {
        return [
            'data.height.max'              => ':attributeを正しく入力してください',
            'data.height.regex'            => ':attributeを正しく入力してください',
            'data.weight.max'              => ':attributeを正しく入力してください',
            'data.weight.regex'            => ':attributeを正しく入力してください',
            'data.max_mb'                  => ':max文字以内で入力してください。',
            'data.number_official.min'     => '正の数を入力してください。',
            'data.number_practice.min'     => '正の数を入力してください。',
            'data.height.min'              => '正の数を入力してください。',
            'data.weight.min'              => '正の数を入力してください。',
            'data.number_official.regex'   => ':attributeを入力してください',
            'data.number_practice.regex'   => ':attributeを入力してください',
            'data.height.numeric'          => ':attributeは数字で入力してください。',
            'data.weight.numeric'          => ':attributeは数字で入力してください。',
            'data.number_official.unique'  => 'すでに登録されています。',
            'data.number_practice.unique'  => 'すでに登録されています。',
        ];
    }
}
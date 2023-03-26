<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
        $rules                    = [];
        $rules['data.name']       = 'bail|required|max:255';
        $rules['data.email']      = 'bail|required|email|max:255';
        $rules['data.team']       = 'bail|nullable|max:255';
        $rules['data.purpose']    = 'bail|nullable|integer|in:' . implode(',', config('constants.contact.purpose.key'));
        $rules['data.app_type']   = 'bail|nullable|integer|in:' . implode(',', config('constants.contact.app_type.key'));
        $rules['data.status']     = 'bail|required|integer|in:' . implode(',', config('constants.contact.status.key'));
        $rules['data.created_at'] = 'bail|nullable|date';
        $rules['data.content']    = 'bail|required|max:1000';
        $rules['data.admin_memo'] = 'bail|nullable|max:1000';
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
            'data.name'       => 'お名前',
            'data.email'      => 'メールアドレス',
            'data.team'       => '所属チーム',
            'data.status'     => '対応状況',
            'data.purpose'    => 'お問い合わせ目的',
            'data.app_type'   => 'ご利用アプリ',
            'data.created_at' => 'お問い合わせ日時',
            'data.content'    => 'お問い合わせ内容',
            'data.admin_memo' => '対応メモ',
        ];
    }
}

<?php

namespace App\Http\Requests\Web;

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
        $rules                  = [];
        $rules['name']          = 'bail|required|max:255';
        $rules['email']         = 'bail|required|email|max:255';
        $rules['confirm_email'] = 'bail|required|email|max:255|same:email';
        $rules['team']          = 'bail|max:255|nullable';
        $rules['purpose']       = 'bail|nullable|integer|in:' . implode(',', config('constants.contact.purpose.key'));
        $rules['app_type']      = 'bail|nullable|integer|in:' . implode(',', config('constants.contact.app_type.key'));
        $rules['content']       = 'bail|required|max:1000';

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
            'name'          => 'お名前',
            'email'         => 'メールアドレス',
            'confirm_email' => 'メールアドレス（確認）',
            'team'          => '所属チーム',
            'purpose'       => 'ご利用アプリ',
            'app_type'      => 'ご利用アプリ',
            'content'       => 'お問い合わせ内容',
        ];
    }

    public function messages()
    {
        return [
            'email.email'           => '正しいメールアドレスを入力してください。',
            'confirm_email.email'   => '正しいメールアドレスを入力してください。',
            'confirm_email.same'    => 'メールアドレスとメールアドレス（確認）が異なっています。',
            '*.required'            => '未入力です。',
            '*.max'                 => ':attributeは:max文字以内に入力してください。',
        ];
    }
}

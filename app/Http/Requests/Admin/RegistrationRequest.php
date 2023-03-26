<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\Registration;

class RegistrationRequest extends FormRequest
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
        $old_data = Registration::find(request()->id);
        $rules = [
            'data.name'               => 'bail|required|max:255',
            'data.name_furigana'      => 'bail|required|max:255',
            'data.registration_email' => 'bail|required|email|max:255',
            'data.corp_name'          => 'bail|required|max:255',
            'data.corp_name_furigana' => 'bail|required|max:255',
            'data.zip'                => 'bail|required|max:255|zip_valid',
            'data.address'            => 'bail|required|max:255',
            'data.tel'                => 'bail|required|max:255|phone_valid',

            'data.pic_name'          => 'bail|required|max:255',
            'data.pic_name_furigana' => 'bail|required|max:255',
            'data.pic_email'         => 'bail|required|email|max:255',
            'data.pic_mobile'        => 'bail|required|max:255|phone_valid',
            'data.pic_birthday'      => 'bail|required|date_format:Y-m-d',
            'data.pic_gender'        => 'bail|required|',
            'data.pic_tel'           => 'bail|required|max:255|phone_valid',
            'data.pic_address'       => 'bail|required|max:255',
            'data.contract_option'   => 'bail|nullable|contract_option',
            'data.payment_method1'   => 'bail|required',
            'data.payment_method2'   => 'bail|required',

            'data.contact2_name'          => 'bail|nullable|max:255',
            'data.contact2_name_furigana' => 'bail|nullable|max:255',
            'data.contact2_email'         => 'bail|nullable|email|max:255',
            'data.contact2_tel'           => 'bail|nullable|max:255|phone_valid',

            'data.delivery_name'    => 'bail|required|max:255',
            'data.delivery_zip'     => 'bail|required|max:255|zip_valid',
            'data.delivery_address' => 'bail|required|max:255',
            'data.contract_status'  => 'bail|required|max:255',

            'data.email'            => ['bail', 'required', 'email', 'max:255',
                                            'different:data.viewer.email',
                                            Rule::unique('registrations', 'email')->ignore(request()->id)->whereNull('deleted_at')
                                        ],
            'data.username'         => ['bail', 'required', 'max:255',
                                           Rule::unique('registrations', 'username')->ignore(request()->id)->whereNull('deleted_at')
                                        ],
        ];

        // contract_premium
        $has_contract = false;
        foreach ([
            'data.contract_premium1' => array_values(config('constants.contract_premium1.key')),
            'data.contract_premium2' => array_values(config('constants.contract_premium2.key')),
            'data.contract_premium3' => array_values(config('constants.contract_premium3.key')),
        ] as $contract_premium_part => $valid_values) {
            $contract_premium_part_val = request()->$contract_premium_part;
            if (!empty($contract_premium_part_val) || in_array($contract_premium_part_val, $valid_values)) {
                $has_contract = true;
                break;
            }
        }

        if (!$has_contract) {
            $rules['data.contract_premium'] = 'bail|required';
        }

        if ($old_data->password) {
            $rules['data.password'] = 'bail|nullable|min:6|max:255';
        }else{
            $rules['data.password'] = 'bail|required|min:6|max:255';
        }

        if ($old_data->password_confirm) {
            $rules['data.password_confirm'] = 'bail|nullable|min:6|max:255';
        }else{
            $rules['data.password_confirm'] = 'bail|required|min:6|max:255';
        }

        // contract_premium
        $has_contract = false;
        foreach ([
            'data.contract_premium1' => array_values(config('constants.contract_premium1.key')),
            'data.contract_premium2' => array_values(config('constants.contract_premium2.key')),
            'data.contract_premium3' => array_values(config('constants.contract_premium3.key')),
        ] as $contract_premium_part => $valid_values) {
            $contract_premium_part_val = request()->input($contract_premium_part);
            if (!empty($contract_premium_part_val) || in_array($contract_premium_part_val, $valid_values)) {
                $has_contract = true;
                break;
            }
        }

        if (!$has_contract) {
            $rules['data.contract_premium'] = 'bail|required';
        }

        return $rules;
    }

    public function messages()
    {
        $sentaku_fields = [
            'pic_birthday', 'pic_gender', 'contract_premium', 'contract_option',
            'payment_method1', 'payment_method2',
        ];

        $messages = [];
        foreach ($sentaku_fields as $field) {
            $messages["data.$field.required"] = '未選択です。';
        }

        foreach (['zip', 'pic_zip', 'delivery_zip'] as $field) {
            $messages["data.$field.present"] = ':attributeは無効です。';
        }

        return $messages + [
            '*.required'        => '未入力です。',
            '*.zip_valid'       => ':attributeは無効です。',
            '*.phone_valid'     => ':attributeは無効です。',
            '*.invalid'         => ':attributeは無効です。',
            '*.contract_option' => '「Play by play video」と「Play by play videoライト」のいずれかを選択してください。',
        ];
    }

    public function attributes()
    {
        return [
            'data.name'                   => 'チーム代表者氏名',
            'data.name_furigana'          => 'チーム代表者氏(フリガナ)',
            'data.registration_email'     => 'チーム情報でメールアドレス',
            'data.corp_name'              => '団体名',
            'data.corp_name_furigana'     => '団体名(フリガナ)',
            'data.zip'                    => 'チーム情報で郵便番号',
            'data.address'                => 'ご住所',
            'data.tel'                    => 'お電話番号',

            'data.pic_name'               => '担当者名',
            'data.pic_name_furigana'      => '担当者名(フリガナ)',
            'data.pic_email'              => '担当者情報でメールアドレス',
            'data.pic_tel'                => 'お電話番号',
            'data.pic_birthday'           => '生年月日',
            'data.pic_gender'             => '性別',
            'data.pic_zip'                => '担当者情報で郵便番号',
            'data.pic_address'            => '担当者情報で住所',
            'data.pic_mobile'             => '連絡先(携帯電話)',
            'data.contract_premium'       => 'プレミアム契約',
            'data.contract_option'        => 'オプション契約',
            'data.payment_method1'        => '支払い方法 1',
            'data.payment_method2'        => '支払い方法 2',

            'data.contact2_name'          => '担当者姓',
            'data.contact2_name_furigana' => '担当者名(フリガナ)',
            'data.contact2_email'         => '第二連絡先でメールアドレス',
            'data.contact2_tel'           => '連絡先(携帯電話)',

            'data.delivery_name'          => '担当者名',
            'data.delivery_zip'           => '送付先で郵便番号',
            'data.delivery_address'       => '送付先で住所',

            'data.email'                   => '管理者でメールアドレス',
            'data.username'                => 'ID',
            'data.password'                => 'パスワード',
            'data.password_confirm'        => 'パスワード',

            'data.contract_status'         => '契約状況',
        ];
    }
}

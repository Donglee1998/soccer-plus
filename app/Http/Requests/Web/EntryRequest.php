<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class EntryRequest extends FormRequest
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
            'name'                   => 'bail|required|max:255',
            'name_furigana'          => 'bail|required|max:255',
            'registration_email'     => 'bail|required|max:255|email',
            'corp_name'              => 'bail|required|max:255',
            'corp_name_furigana'     => 'bail|required|max:255',
            'address'                => 'bail|required|max:255',
            'tel'                    => 'bail|required|max:255|phone_valid',
            'pic_name'               => 'bail|required|max:255',
            'pic_name_furigana'      => 'bail|required|max:255',
            'pic_email'              => 'bail|required|max:255|email',
            'pic_mobile'             => 'bail|required|max:255',
            'pic_gender'             => 'bail|required',
            'pic_address'            => 'bail|required|max:255',
            'pic_tel'                => 'bail|required|max:255|phone_valid',
            'contract_option'        => 'bail|nullable|contract_option',
            'payment_method1'        => 'bail|required',
            'payment_method2'        => 'bail|required',
            'contact2_name'          => 'bail|max:255',
            'contact2_name_furigana' => 'bail|max:255',
            'contact2_email'         => 'bail|nullable|max:255|email',
            'contact2_tel'           => 'bail|nullable|max:255',
            'delivery_name'          => 'bail|required|max:255',
            'delivery_address'       => 'bail|required|max:255',
        ];

        // contract_premium
        $has_contract = false;
        foreach ([
            'contract_premium1' => array_values(config('constants.contract_premium1.key')),
            'contract_premium2' => array_values(config('constants.contract_premium2.key')),
            'contract_premium3' => array_values(config('constants.contract_premium3.key')),
        ] as $contract_premium_part => $valid_values) {
            $contract_premium_part_val = request()->$contract_premium_part;
            if (!empty($contract_premium_part_val) || in_array($contract_premium_part_val, $valid_values)) {
                $has_contract = true;
                break;
            }
        }

        if (!$has_contract) {
            $rules['contract_premium'] = 'bail|required';
        }

        // pic_birthday
        $pic_birthday_year  = request()->pic_birthday_year;
        $pic_birthday_month = request()->pic_birthday_month;
        $pic_birthday_day   = request()->pic_birthday_day;
        if (empty($pic_birthday_year) && empty($pic_birthday_month) && empty($pic_birthday_day)) {
            $rules['pic_birthday'] = 'bail|present|required';
        } else if (empty($pic_birthday_year) || empty($pic_birthday_month) || empty($pic_birthday_day)) {
            $rules['pic_birthday'] = 'bail|present|invalid';
        } else {
            $format   = 'Y-m-d';
            $date_str = "$pic_birthday_year-$pic_birthday_month-$pic_birthday_day";
            $d        = \DateTime::createFromFormat($format, $date_str);
            if (empty($d) || $d->format($format) !== $date_str) {
                $rules['pic_birthday'] = 'bail|present|invalid';
            }
        }

        // zip, pic_zip, delivery_zip
        foreach (['zip', 'pic_zip', 'delivery_zip'] as $field) {
            $field_1_name  = "{$field}_1";
            $field_2_name  = "{$field}_2";
            $field_1_value = request()->$field_1_name;
            $field_2_value = request()->$field_2_name;
            if (empty($field_1_value) && empty($field_2_value)) {
                $rules[$field] = 'bail|required';
            } else if (empty($field_1_value) || empty($field_2_value)) {
                $rules[$field] = 'bail|present|invalid';
            } else {
                if (preg_match('#[^0-9]#', $field_1_value) || strlen($field_1_value) !== 3
                    || preg_match('#[^0-9]#', $field_2_value) || strlen($field_2_value) !== 4) {
                    $rules[$field] = 'bail|present|invalid';
                }
            }
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'name'                   => 'チーム代表者氏名',
            'name_furigana'          => 'チーム代表者氏名(フリガナ)',
            'registration_email'     => 'メールアドレス',
            'corp_name'              => '団体名',
            'corp_name_furigana'     => '団体名(フリガナ)',
            'zip'                    => '郵便番号',
            'address'                => 'ご住所',
            'tel'                    => 'お電話番号',
            'pic_name'               => '担当者名',
            'pic_name_furigana'      => '担当者名(フリガナ)',
            'pic_email'              => 'メールアドレス',
            'pic_mobile'             => '連絡先(携帯電話)',
            'pic_birthday'           => '生年月日',
            'pic_gender'             => '性別',
            'pic_zip'                => '郵便番号',
            'pic_address'            => '住所',
            'pic_tel'                => 'お電話番号',
            'contract_premium'       => 'プレミアム契約',
            'contract_option'        => 'オプション契約',
            'payment_method1'        => '支払い方法 1',
            'payment_method2'        => '支払い方法 2',
            'contact2_name'          => '担当者名',
            'contact2_name_furigana' => '郵便番号(フリガナ)',
            'contact2_email'         => 'メールアドレス',
            'contact2_tel'           => '連絡先(携帯電話)',
            'delivery_name'          => '担当者名',
            'delivery_zip'           => '郵便番号',
            'delivery_address'       => '住所',
        ];
    }

    public function messages()
    {
        $sentaku_fields = [
            'pic_birthday', 'pic_gender', 'contract_premium', 'contract_option',
            'payment_method1', 'payment_method2',
        ];

        $messages = [];
        foreach ($sentaku_fields as $field) {
            $messages["$field.required"] = '未選択です。';
        }

        foreach (['zip', 'pic_zip', 'delivery_zip'] as $field) {
            $messages["$field.present"] = ':attributeは無効です。';
        }

        return $messages + [
            '*.required'        => '未入力です。',
            '*.zip_valid'       => ':attributeは無効です。',
            '*.phone_valid'     => ':attributeは無効です。',
            '*.invalid'         => ':attributeは無効です。',
            '*.contract_option' => '「Play by play video」と「Play by play videoライト」のいずれかを選択してください。',
        ];
    }
}

<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
        $data  = request()->get('data');
        if ($data['category'] == config('constants.news_category.key.news')) {
            $rules = [
                'data.public_date'    => 'bail|required|date_format:Y-m-d',
                'data.sub_category'   => 'bail|required|integer|in:' . implode(',', config('constants.news_sub_category.key')),
                'data.title'          => 'bail|mb_required|max:255',
                'data.is_public'      => 'bail|required|integer|in:' . implode(',', config('constants.setting_public.key')),
                'data.start_date'     => 'bail|nullable|date_format:Y-m-d H:i|before_or_equal:data.end_date',
                'data.end_date'       => 'bail|nullable|date_format:Y-m-d H:i',
                'data.update_comment' => 'bail|max:1000'
            ];
        }else{
            $rules = [
                'data.title'          => 'bail|mb_required|max:255',
                'data.is_public'      => 'bail|required|integer|in:' . implode(',', config('constants.setting_public.key')),
                'data.update_comment' => 'bail|max:1000',
                'data.overview'       => 'bail|max:1000',
            ];
        }

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
            'data.public_date'    => '公開日時',
            'data.sub_category'   => 'カテゴリ',
            'data.title'          => 'タイトル',
            'data.is_public'      => '公衆',
            'data.start_date'     => '公開日時 ',
            'data.end_date'       => '公開終了日時',
            'data.update_comment' => '更新コメント',
            'data.overview'       => '概要',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'data.is_public.required'         => '公開設定を選択してください。',
            'data.start_date.before_or_equal' => '公開終了日時は公開日時より前になっています。'
        ];
    }
}

<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class PeriodAggregationStatRequest extends FormRequest
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
        $rule = [
            'date_from' => 'bail|required|date_format:Y/m/d',
            'date_to'   => 'bail|required|date_format:Y/m/d|after_or_equal:date_from',
            'team'      => 'bail|required',
            'type'      => 'bail|required',
        ];

        // if (request()->date_from) {
        //     $rule['date_from'] = ['date_format:Y/m/d'];
        // }

        // if (request()->date_to) {
        //     $rule['date_to'] = ['date_format:Y/m/d'];
        // }

        // if (request()->date_from && request()->date_to) {
        //     $rule['date_to'] = ['after_or_equal:date_from'];
        // }

        return $rule;
    }

    public function attributes()
    {
        return [
            'date_from' => '期間(開始日)',
            'date_to'   => '期間(終了日)',
            'team'      => 'チーム名',
            'type'      => '試合の種類',
        ];
    }

    public function messages()
    {
        return [
            'date_to.after_or_equal' => '期間(終了日)は期間(開始日)より前になっています。',
            'date_from.required'     => '期間(開始日)を入力してください。',
            'date_to.required'       => '期間(終了日)を入力してください。',
            'date_from.date_format'  => '期間(開始日)は「yyyy年mm月dd日」のフォーマットで入力してください。',
            'date_to.date_format'    => '期間(終了日)は「yyyy年mm月dd日」のフォーマットで入力してください。',
        ];
    }
}

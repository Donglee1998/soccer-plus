<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class StatVideoRequest extends FormRequest
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
        return [
            'video_id'         => 'bail|required|exists:videos,id',
            'time_start_play'  => 'bail|required|date_format:H:i:s',
            'time_stop_play'   => 'bail|required|date_format:H:i:s|after:time_start_play',
            'replace_next_flg' => 'bail|integer|in:0,1',
            'comment'          => 'bail|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'video_id'         => '動画タイトル',
            'time_start_play'  => '再生時',
            'time_stop_play'   => 'プレイ終了時',
            'replace_next_flg' => '動画',
            'comment'          => '動画',
        ];
    }

    public function messages()
    {
        return [
            'time_stop_play.after' => 'プレイ終了時は再生時より前になっています。',
            '*.date_format'        => '正しい時間を入力してください。',
        ];
    }
}

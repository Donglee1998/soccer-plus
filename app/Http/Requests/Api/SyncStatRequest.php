<?php

namespace App\Http\Requests\Api;

use App\Traits\ApiValidateTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SyncStatRequest extends FormRequest
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
        // sync team
        $rules['teams.*.id']           = ['required'];
        $rules['teams.*.name']         = ['mb_required', 'max_mb:255'];
        $rules['teams.*.abbreviation'] = ['max_mb:255'];
        $rules['teams.*.gender']       = ['nullable', 'member_gender'];
        $rules['teams.*.hometown']     = ['max_mb:255'];
        $rules['teams.*.coach']        = ['max_mb:255'];
        $rules['teams.*.supervisor']   = ['max_mb:255'];
        $rules['teams.*.manager']      = ['max_mb:255'];
        $rules['teams.*.trainer']      = ['max_mb:255'];
        $rules['teams.*.color_home']   = ['required', 'team_color'];
        $rules['teams.*.color_guest']  = ['required', 'team_color'];
        $rules['teams.*.explanation']  = ['nullable', 'max_mb:1000'];

        // sync member
        $rules['members.*.id']              = ['required'];
        $rules['members.*.first_name']      = ['nullable', 'max_mb:255'];
        $rules['members.*.last_name']       = ['nullable', 'max_mb:255'];
        $rules['members.*.birthday']        = ['nullable', 'date_format:Y-m-d'];
        $rules['members.*.number_official'] = ['nullable', 'regex:/^[0-9]{0,3}+$/'];
        $rules['members.*.number_practice'] = ['nullable', 'regex:/^[0-9]{0,3}+$/'];
        $rules['members.*.position']        = ['nullable', 'member_position'];
        $rules['members.*.dominant_foot']   = ['nullable', 'dominant_foot'];
        $rules['members.*.height']          = ['nullable', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/', 'min:0'];
        $rules['members.*.weight']          = ['nullable', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/', 'min:0', 'max:999.99'];
        $rules['members.*.school']          = ['nullable', 'max_mb:255'];
        $rules['members.*.email']           = ['nullable', 'email'];
        $rules['members.*.former_team']     = ['nullable', 'max_mb:255'];
        $rules['members.*.sub_position']    = ['nullable'];

        // sync lineup
        $rules['lineups.*.id']         = ['required'];
        $rules['lineups.*.team_id']    = ['required'];
        $rules['lineups.*.title']      = ['required', 'mb_required', 'max_mb:255'];
        $rules['lineups.*.starting']   = ['nullable','json'];
        $rules['lineups.*.substitute'] = ['nullable','json'];
        $rules['lineups.*.not_member'] = ['nullable','json'];
        $rules['lineups.*.people_starting'] = ['nullable','numeric'];

        // sync match
        $rules['matches.id']                 = ['required'];
        $rules['matches.team_id1']           = ['required'];
        $rules['matches.team_color1']        = ['nullable', 'team_color'];
        $rules['matches.team_id2']           = ['required'];
        $rules['matches.team_color2']        = ['nullable', 'team_color'];
        $rules['matches.conference_name']    = ['nullable', 'max_mb:255'];
        $rules['matches.type']               = ['nullable', 'match_type'];
        $rules['matches.team_owner']         = ['nullable', 'in:' . implode(',', config('constants.team_own.key'))];
        $rules['matches.start_date']         = ['nullable', 'date_format:Y-m-d'];
        $rules['matches.start_time']         = ['nullable', 'date_format:H:i'];
        $rules['matches.place']              = ['max_mb:255'];
        $rules['matches.referee']            = ['max_mb:255'];
        $rules['matches.linesman']           = ['max_mb:255'];
        $rules['matches.fourth_referee']     = ['max_mb:255'];
        $rules['matches.weather']            = ['nullable', 'in:' . implode(',', config('constants.weather.key'))];
        $rules['matches.pitch_type']         = ['nullable', 'in:' . implode(',', config('constants.pitch_type.key'))];
        $rules['matches.situation']          = ['nullable', 'in:' . implode(',', config('constants.situation.key'))];
        $rules['matches.number_people']      = ['nullable', 'numeric'];
        $rules['matches.round1_time']        = ['nullable', 'numeric', 'min:0', 'max:150'];
        $rules['matches.round2_time']        = ['nullable', 'numeric', 'min:0', 'max:150'];
        $rules['matches.round3_time']        = ['nullable', 'numeric', 'min:0', 'max:150'];
        $rules['matches.round4_time']        = ['nullable', 'numeric', 'min:0', 'max:150'];
        $rules['matches.additional_time1']   = ['nullable', 'numeric'];
        $rules['matches.additional_time2']   = ['nullable', 'numeric'];
        $rules['matches.additional_time3']   = ['nullable', 'numeric'];
        $rules['matches.additional_time4']   = ['nullable', 'numeric'];
        $rules['matches.rest_time']          = ['nullable', 'numeric'];
        $rules['matches.extra_time']         = ['nullable', 'numeric', 'min:0', 'max:150'];
        $rules['matches.penalty']            = ['nullable', 'match_penalty'];
        $rules['matches.comment']            = ['max_mb:1000'];
        $rules['matches.status']             = ['nullable', 'in:' . implode(',', config('constants.match_status.key'))];
        $rules['matches.team1_ball_control'] = ['nullable'];
        $rules['matches.team2_ball_control'] = ['nullable'];

        // sync stat
        $rules['stats.*.id']        = ['nullable'];
        $rules['stats.*.match_id']  = ['required'];
        $rules['stats.*.member_id'] = ['nullable'];
        $rules['stats.*.action_id'] = ['required', 'numeric'];
        $rules['stats.*.result']    = ['nullable', 'numeric', 'in:' . implode(',', config('constants.action_result.key'))];

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
            'teams.*.id'                   => 'ID',
            'teams.*.name'                 => 'チーム名',
            'teams.*.abbreviation'         => '略称',
            'teams.*.gender'               => 'チーム性別',
            'teams.*.color_home'           => 'チームカラー',
            'teams.*.color_guest'          => 'チームカラー',
            'teams.*.hometown'             => 'ホームタウン',
            'teams.*.supervisor'           => '監督',
            'teams.*.coach'                => 'コーチ',
            'teams.*.manager'              => 'マネージャー',
            'teams.*.trainer'              => 'トレーナー',
            'teams.*.explanation'          => '説明',

            'members.*.id'                 => 'ID',
            'members.*.team_id'            => 'チーム',
            'members.*.first_name'         => '名前:',
            'members.*.last_name'          => '名前:',
            'members.*.birthday'           => '生年月日',
            'members.*.number_official'    => '背番号(公式)',
            'members.*.number_practice'    => '背番号(練習)',
            'members.*.position'           => 'ポジション',
            'members.*.dominant_foot'      => '利き足',
            'members.*.height'             => '身長',
            'members.*.weight'             => '体重',
            'members.*.school'             => '出身校',
            'members.*.email'              => 'メールアドレス',
            'members.*.former_team'        => '前所属チーム',

            'lineups.*.id'                 => 'ID',
            'lineups.*.team_id'            => 'チーム',
            'lineups.*.title'              => 'タイトル',

            'matches.id'                 => 'ID',
            'matches.team_id1'           => 'チーム1',
            'matches.team_color1'        => 'チームカラー1',
            'matches.team_id2'           => 'チーム2',
            'matches.team_color2'        => 'チームカラー2',
            'matches.conference_name'    => '大会名',
            'matches.type'               => '試合種類',
            'matches.start_date'         => '日',
            'matches.start_time'         => '時',
            'matches.place'              => '場所',
            'matches.referee'            => '主審',
            'matches.linesman'           => '副審',
            'matches.fourth_referee'     => '第4の審判員',
            'matches.weather'            => '気候',
            'matches.pitch_type'         => 'ピッチ',
            'matches.situation'          => '状態',
            'matches.number_people'      => '人数',
            'matches.round1_time'        => '試合時間1',
            'matches.round2_time'        => '試合時間2',
            'matches.round3_time'        => '試合時間2',
            'matches.round4_time'        => '試合時間4',
            'matches.rest_time'          => '休憩',
            'matches.extra_time'         => '延長戦',
            'matches.penalty'            => 'PK戦',
            'matches.comment'            => 'メモ',
            'matches.status'             => '状態',
            'matches.team_owner'         => 'ホーム/アウェイ',
        ];
    }

    public function messages()
    {
        return [
        ];
    }

}

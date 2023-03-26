<?php

namespace App\Http\Resources\Match;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Team;

class MatchHistoryResource extends JsonResource
{
    protected $teams;
    protected $column_opts;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $columns = [
            'team_id1'           => 'チーム1',
            'team_color1'        => 'チームカラー1',
            'team_id2'           => 'チーム2',
            'team_color2'        => 'チームカラー2',
            'conference_name'    => '大会名',
            'type'               => '試合種類',
            'start_date'         => '日',
            'start_time'         => '時',
            'place'              => '場所',
            'referee'            => '主審',
            'linesman'           => '副審',
            'fourth_referee'     => '第4の審判員',
            'weather'            => '気候',
            'pitch_type'         => 'ピッチ',
            'situation'          => '状態',
            'number_people'      => '人数',
            'round1_time'        => '1st',
            'round2_time'        => '2nd',
            'round3_time'        => '3rd',
            'round4_time'        => '4th',
            'rest_time'          => '休憩',
            'extra_time'         => '延長戦',
            'penalty'            => 'PK戦',
            'comment'            => 'メモ',
            'status'             => '状態',
            'team_owner'         => 'ホーム/アウェイ',
        ];

        $this->column_opts = [
            'team_color1' => config('constants.team_color'),
            'team_color2' => config('constants.team_color'),
            'type'        => config('constants.match_type.label'),
            'team_owner'  => config('constants.team_own.label'),
            'weather'     => config('constants.weather.label'),
            'pitch_type'  => config('constants.pitch_type.label'),
            'situation'   => config('constants.situation.label'),
            'penalty'     => config('constants.penalty.label'),
            'extra_time'  => config('constants.match_extra_time')
        ];

        $this->teams = Team::where('created_by', auth('api')->user()->id)->pluck('name', 'id');

        $histories = [];
        foreach ($this->resource as $key => $history) {
            $data_updated = [
                'updated_at' => format_date($history->updated_at, 'Y-m-d H:i'),
                'version'    => $history->version,
            ];
            $contents = json_decode($history->content);
            unset($contents->user_id);
            foreach ($contents as $column => $value) {
                $value_transform = $this->transformValue($column, $value);
                $data_updated['content'][] = [
                    'column'     => isset($columns[$column]) ? $columns[$column] : $column,
                    'old_value'  => $value_transform[0],
                    'new_value'  => $value_transform[1]
                ];
            }
            $histories[] = $data_updated;
        }

        return [
            'data'    => [
                'data' => $histories
            ],
            'success' => true
        ];
    }

    public function transformValue($column, $value){
        if (@$this->column_opts[$column]) {
            if ($column == 'extra_time') {
                return [
                    $this->column_opts['extra_time'][$value[0]] ?? $value[0].'分',
                    $this->column_opts['extra_time'][$value[1]] ?? $value[1].'分'
                ];
            }
            return [@$this->column_opts[$column][$value[0]], @$this->column_opts[$column][$value[1]]];
        }
        if (in_array($column, ['team_id1', 'team_id2'])) {
            return [
                @$this->teams[$value[0]],
                @$this->teams[$value[1]]
            ];
        }
        if (in_array($column, ['number_people'])) {
            return [$value[0] . '人', $value[1] . '人'];
        }
        if (in_array($column, ['round1_time', 'round2_time', 'round3_time', 'round4_time'])) {
            return [$value[0] . '分', $value[1] . '分'];
        }
        return [@$value[0], @$value[1]];

    }
}

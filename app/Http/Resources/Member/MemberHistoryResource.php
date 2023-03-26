<?php

namespace App\Http\Resources\Member;

use Illuminate\Http\Resources\Json\JsonResource;

class MemberHistoryResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $columns = [
            'team_id'         => 'チーム',
            'first_name'      => '姓',
            'last_name'       => '名',
            'gender'          => '性別',
            'birthday'        => '生年月日',
            'number_official' => '背番号(公式)',
            'number_practice' => '背番号(練習)',
            'position'        => 'ポジション',
            'dominant_foot'   => '利き足',
            'height'          => '身長',
            'weight'          => '体重',
            'school'          => '出身校',
            'email'           => 'メールアドレス',
            'former_team'     => '前所属チーム',
        ];
        $histories = [];
        foreach ($this->resource as $key => $history) {
            $data_updated = [
                'updated_at' => format_date($history->updated_at, 'Y-m-d H:i'),
                'version'    => $history->version,
            ];
            $contents = json_decode($history->content);
            unset($contents->user_id);
            foreach ($contents as $column => $values) {
                $data_updated['content'][] = [
                    'column'     => isset($columns[$column]) ? $columns[$column] : $column,
                    'old_value'  => @$values[0],
                    'new_value'  => @$values[1]
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
}

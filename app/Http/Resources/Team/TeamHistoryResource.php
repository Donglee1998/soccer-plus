<?php

namespace App\Http\Resources\Team;

use Illuminate\Http\Resources\Json\JsonResource;

class TeamHistoryResource extends JsonResource
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
            'name'         => 'チーム名',
            'abbreviation' => '略称',
            'gender'       => 'チーム性別',
            'color_home'   => 'チームカラー(ホーム)',
            'color_guest'  => 'チームカラー(アウェイ)',
            'hometown'     => 'ホームタウン',
            'supervisor'   => '監督',
            'coach'        => 'コーチ',
            'manager'      => 'マネージャー',
            'trainer'      => 'トレーナー',
            'explanation'  => '説明',
            'order'        => '注文',
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

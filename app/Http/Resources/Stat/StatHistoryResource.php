<?php

namespace App\Http\Resources\Stat;

use Illuminate\Http\Resources\Json\JsonResource;

class StatHistoryResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $histories = [];
        foreach ($this->resource as $key => $history) {
            $data_updated = [
                'updated_at'        => format_date($history->updated_at, 'Y-m-d H:i') ?? '',
                'version'           => $history->version ?? '',
                'created_at_round'  => $history->stat->created_at_round ?? null,
                'action_created'    => date("i:s", intval($history->stat->action_created / 1000)) ?? null,
            ];

            $contents = json_decode($history->content) ?? '';
            $count_coord = 0; // Return one coord record 
            foreach ($contents as $column => $values) {
                if (in_array($column, ['coord_x', 'coord_y'])) {
                    if($count_coord == 0) {
                        $data_updated['content'][] = [
                            'column'    => 'coord',
                            'old_value' => '',
                            'new_value' => '位置変更'
                        ];
                        $count_coord++;
                    }
                    continue;
                };

                if (in_array($column, ['member_id'])) {
                    $data_updated['content'][] = [
                        'column'    => $column,
                        'old_value' => $history->shirtNumber($values[0]) ?? '',
                        'new_value' => $history->shirtNumber($values[1])  ?? '',
                    ];
                    continue;
                };

                $data_updated['content'][] = [
                    'column'     => $column,
                    'old_value'  => ($column == 'action_created' && !empty($values[0])) ? date("i:s", intval($values[0] / 1000)) : @$values[0],
                    'new_value'  => ($column == 'action_created' && !empty($values[1])) ? date("i:s", intval($values[1] / 1000)) : @$values[1]
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

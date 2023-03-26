<?php

namespace App\Http\Resources\Match;

use Illuminate\Http\Resources\Json\JsonResource;

class MatchListResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $colors = [
            '1' => 'color_home',
            '2' => 'color_guest'
        ];
        $this->resource->getCollection()->transform(function ($value) use ($colors){
            $team1 = collect($value['team1'])->only(['id', 'name', 'is_home']);
            $team1['color'] = @$value['team1'][$colors[$value['team_color1']]];
            $team1['score'] = $value['team1_score'];

            $team2 = collect($value['team2'])->only(['id', 'name', 'is_home']);
            $team2['color'] = @$value['team2'][$colors[$value['team_color2']]];
            $team2['score'] = $value['team2_score'];
            return [
                'id'         => $value['id'],
                'start_date' => format_date($value['start_date'], 'Y-m-d'),
                'start_time' => format_date($value['start_time'], 'H:i'),
                'team1'      => $team1,
                'type'       => $value['type'],
                'status'     => $value['status'],
                'team2'      => $team2,
                'updated_at' => format_date($value['updated_at'], 'Y-m-d H:i:s'),
                'is_lineup'  => ($value['lineup_id1'] && $value['lineup_id2']) ? true : false,
            ];
        });
        return [
            'data'    => $this->resource,
            'success' => true
        ];
    }

}

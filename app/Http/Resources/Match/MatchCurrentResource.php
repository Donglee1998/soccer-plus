<?php

namespace App\Http\Resources\Match;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\LineUp\CurrentLineUpResource;

class MatchCurrentResource extends JsonResource
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
        if ($this->team1) {
            $color = @$colors[$this->team_color1];
            $this->team1->color = $this->team1->$color;
            $this->team1->members = new CurrentLineUpResource($this->lineup1);
            $this->team1->lineup_id = $this->lineup_id1;
            unset($this->team1->color_home);
            unset($this->team1->color_guest);
        }
        if($this->team2) {
            $color = @$colors[$this->team_color2];
            $this->team2->color = $this->team2->$color;
            $this->team2->members = new CurrentLineUpResource($this->lineup2);
            $this->team2->lineup_id = $this->lineup_id2;
            unset($this->team2->color_home);
            unset($this->team2->color_guest);
        }
        return [
            'data' => [
                'data' =>  [
                    'id'            => $this->id,
                    'type'          => $this->type,
                    'team_owner'    => $this->team_owner,
                    'start_date'    => $this->start_date,
                    'start_time'    => $this->start_time,
                    'round1_time'   => $this->round1_time,
                    'round2_time'   => $this->round2_time,
                    'round3_time'   => $this->round3_time,
                    'round4_time'   => $this->round4_time,
                    'rest_time'     => $this->rest_time,
                    'extra_time'    => $this->extra_time,
                    'team1'         => $this->team1,
                    'team2'         => $this->team2,
                    'status'        => $this->status,
                    'number_people' => $this->number_people,
                    'penalty'       => $this->penalty ?? '',
                ]
            ],
            'success' => true
        ];
    }
}

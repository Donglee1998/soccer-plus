<?php

namespace App\Http\Resources\Match;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Stat\InputStatResource;
use App\Http\Resources\LineUp\CurrentLineUpResource;

class MatchInputStatResource extends JsonResource
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
                'id'          => $this->id,
                'status'      => $this->status,
                'team1_score' => $this->team1_score,
                'team2_score' => $this->team2_score,
                'type'        => $this->type,
                'input_stats' => InputStatResource::collection($this->stats),
                'team1'       => $this->team1,
                'team2'       => $this->team2,
                'team_owner'  => $this->team_owner,
                'start_date'  => $this->start_date,
                'start_time'  => $this->start_time,
            ],
            'success' => true
        ];
    }
}

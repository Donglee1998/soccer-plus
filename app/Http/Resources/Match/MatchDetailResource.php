<?php

namespace App\Http\Resources\Match;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\LineUp\CurrentLineUpResource;

class MatchDetailResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $this->resource->start_time = format_date($this->resource->start_time, 'H:i');
        $this->resource->is_lineup = false;
        if ($this->resource->lineup_id1 && $this->resource->lineup_id2) {
            $this->resource->is_lineup = true;
        }
        return $this->resource;
    }
}

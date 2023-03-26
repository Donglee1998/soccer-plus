<?php

namespace App\Http\Resources\LineUp;

use Illuminate\Http\Resources\Json\JsonResource;

class LineUpListResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $lineups = $this->resource;
        $lineups->transform(function ($lineup){
            $lineup['starting'] = json_encode($lineup['starting'] ? $lineup['starting']: []);
            $lineup['substitute'] = json_encode($lineup['substitute'] ? $lineup['substitute']: []);
            $lineup['not_member'] = json_encode($lineup['not_member'] ? $lineup['not_member'] : []);
            $lineup['pattern'] = json_encode($lineup['pattern'] ? $lineup['pattern'] :[]);
            return $lineup;
        });

        return $lineups;
    }
}

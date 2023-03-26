<?php

namespace App\Http\Resources\Stat;

use Illuminate\Http\Resources\Json\JsonResource;

class StatListResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data'    => $this->resource,
            'success' => true
        ];
    }
}

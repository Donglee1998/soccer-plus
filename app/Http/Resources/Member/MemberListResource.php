<?php

namespace App\Http\Resources\Member;

use Illuminate\Http\Resources\Json\JsonResource;

class MemberListResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $members = $this->resource->toArray();
        $results = [];
        foreach ($members as $member){
            unset($member['position_name']);
            $results[] = $member;
        }

        return $results;
    }
}

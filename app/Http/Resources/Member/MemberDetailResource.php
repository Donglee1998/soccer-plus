<?php

namespace App\Http\Resources\Member;

use Illuminate\Http\Resources\Json\JsonResource;

class MemberDetailResource extends JsonResource
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
            'id'              =>  $this->id,
            'team_id'         =>  $this->team_id,
            'team_name'       =>  @$this->team->name,
            'first_name'      =>  $this->first_name,
            'last_name'       =>  $this->last_name,
            'gender'          =>  $this->gender,
            'birthday'        =>  $this->birthday,
            'number_official' =>  $this->number_official,
            'number_practice' =>  $this->number_practice,
            'position'        =>  $this->position,
            'position_name'   =>  $this->position_name,
            'dominant_foot'   =>  $this->dominant_foot,
            'height'          =>  $this->height,
            'weight'          =>  $this->weight,
            'school'          =>  $this->school,
            'email'           =>  $this->email,
            'former_team'     =>  $this->former_team
        ];
    }
}

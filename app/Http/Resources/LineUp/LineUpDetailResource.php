<?php

namespace App\Http\Resources\LineUp;

use Illuminate\Http\Resources\Json\JsonResource;

class LineUpDetailResource extends JsonResource
{
    protected $__members;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $this->__members   = $this->team->members->pluck('full_name', 'id');
        $this->__positions = $this->team->members->pluck('position', 'id');
        $this->team        = $this->team->unsetRelation('members');
        return [
            'id'         => $this->id,
            'team_id'    => $this->team_id,
            'title'      => $this->title,
            'starting'   => $this->_getNameMemberById($this->starting),
            'substitute' => $this->_getNameMemberById($this->substitute),
            'not_member' => $this->_getNameMemberById($this->not_member),
            'team'       => $this->team,
        ];
    }

    private function _getNameMemberById($data)
    {
        $members = $this->__members;
        $positions = $this->__positions;
        return collect($data)->map(function ($value) use ($members, $positions) {
            $value['name'] = !empty($members[$value['member_id']]) ? $members[$value['member_id']] : '';
            $value['position_name'] = !empty($positions[$value['member_id']]) ? config('constants.member_position.label.' . $positions[$value['member_id']]) : '';
            return $value;
        });
    }
}

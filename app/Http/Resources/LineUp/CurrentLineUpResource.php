<?php

namespace App\Http\Resources\LineUp;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrentLineUpResource extends JsonResource
{
    protected $__members;
    protected $__positions;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->resource) {
            $this->__members   = $this->team->members->pluck('full_name', 'id');
            $this->__positions = $this->team->members->pluck('position', 'id');
            return $this->_getNameMemberById($this->starting, 'starting')->merge($this->_getNameMemberById($this->substitute, 'substitute'));
        }else{
            return null;
        }

    }

    private function _getNameMemberById($data, $type)
    {
        $members = $this->__members;
        $positions = $this->__positions;
        return collect($data)->map(function ($value) use ($members, $positions, $type) {
            return [
                'id'              => $value['member_id'],
                'number_practice' => $value['number_practice'],
                'number_official' => $value['number_official'],
                'name'            => @$members[$value['member_id']],
                'position'        => @$positions[$value['member_id']],
                'position_name'   => !empty($positions[$value['member_id']]) ? config('constants.member_position.label.' . $positions[$value['member_id']]) : '',
                'type'            => $type
            ];
        });
    }
}

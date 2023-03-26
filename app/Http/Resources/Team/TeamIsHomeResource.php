<?php

namespace App\Http\Resources\Team;

use Illuminate\Http\Resources\Json\JsonResource;

class TeamIsHomeResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $team = $this->resource;
        $members = [];
        if ($team) {
            $user = auth('api')->user();
            $member_column = array_flip(\Schema::getColumnListing('members'));
            $members = $team->members()
            ->select(array_keys($member_column))
            ->where('deleted_at', NULL)
            ->where('created_by', $user->id)
            ->get();
        }
        return [
            'data'    => [
                'team'    => $team,
                'members' => $members
            ],
            'success' => true
        ];
    }
}

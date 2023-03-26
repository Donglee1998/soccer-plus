<?php

namespace App\Http\Resources\Tactic;

use Illuminate\Http\Resources\Json\JsonResource;

class TacticListResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $this->resource->transform(function ($value){
            return [
                'id'          => $value['id'],
                'title'       => $value['title'],
                'explain'     => $value['explain'],
                'type'        => $value['type'],
                'status'      => $value['status'],
                'pitch'       => $value['pitch'],
                'background'  => $value['background'],
                'type_label'  => $value['type_label'],
                'pitch_label' => $value['pitch_label'],
                'created_at'  => $value['created_at'],
                'updated_at'  => $value['updated_at'],
                'sheet'       => @$value->firstSheet->thumbnail,
            ];
        });
        return [
            'data'    => $this->resource,
            'success' => true
        ];
    }
}

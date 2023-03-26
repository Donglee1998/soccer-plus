<?php

namespace App\Http\Resources\Tactic;

use Illuminate\Http\Resources\Json\JsonResource;

class TacticSyncResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
    	$members = $this['members'];
    	$this['sheets'] = collect($this['sheets'])->map(function ($sheet) use($members){
        	$sheet['members'] = \Arr::where($members, function ($member, $key) use($sheet) {
			    return ($member['sheet_id'] == $sheet['id']);
			});
            return $sheet;
        });
        return [
            'data'    => [
            	'id'          => $this['tactic']['id'],
                'title'       => $this['tactic']['title'],
                'explain'     => $this['tactic']['explain'],
                'type'        => $this['tactic']['type'],
                'status'      => $this['tactic']['status'],
                'pitch'       => $this['tactic']['pitch'],
                'background'  => $this['tactic']['background'],
                'created_at'  => $this['tactic']['created_at'],
                'updated_at'  => $this['tactic']['updated_at'],
                'created_by'  => $this['tactic']['created_by'],
                'sheets'      => $this['sheets'],
             ],
            'success' => true
        ];
    }
}

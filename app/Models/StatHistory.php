<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UnixTimestampSerializable;
use App\Traits\TraitModel;
use App\Models\Member;

class StatHistory extends Model
{
    use HasFactory, SoftDeletes, UnixTimestampSerializable, TraitModel;

    protected $table = 'stat_histories';

    protected $guarded = [];

    protected $fillable = [
        'id',
        'stat_id',
        'content'
    ];

    public function stat()
    {
        return $this->belongsTo(Stat::class);
    }

    public function shirtNumber($member_id)
    {
        $type_match = $this->stat->match->type ?? null;
        
        $member = Member::where('id', $member_id)->first();
        if (!empty($member)) {
            if(in_array($type_match, [intval(config('constants.match_type.key.official')), intval(config('constants.match_type.key.research'))])) {
                return $member->number_official;
            }else if($type_match === intval(config('constants.match_type.key.practice'))) {
                return $member->number_practice;
            }
        }

        return null;
    }
}

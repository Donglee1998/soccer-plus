<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\TraitModel;
use App\Traits\UnixTimestampSerializable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory;
    use TraitModel;
    use SoftDeletes;
    use UnixTimestampSerializable;

    protected $table = 'members';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];
    protected $fillable = ['id', 'team_id', 'first_name', 'last_name', 'birthday', 'number_official', 'number_practice', 'position', 'sub_position', 'dominant_foot', 'height', 'weight', 'school', 'email', 'created_by', 'former_team', 'member_id'];

    protected $appends = [
        'position_name',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function memberHistory()
    {
        return $this->hasMany(MemberHistory::class, 'member_id', 'id');
    }

    public function getPositionNameAttribute()
    {
        if(@$this->attributes['position']) {
            return config('constants.member_position.label.' . $this->attributes['position']);
        }
    }

    public function getFullNameAttribute ()
    {
        return ($this->first_name || $this->last_name) ? "$this->first_name  $this->last_name" : '?';
    }

    public function memberSheet()
    {
        return $this->hasMany(MemberSheet::class, 'member_id', 'id');
    }
}

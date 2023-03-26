<?php

namespace App\Models;

use App\Traits\TraitModel;
use App\Traits\UnixTimestampSerializable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use HasFactory;
    use TraitModel;
    use SoftDeletes;
    use UnixTimestampSerializable;
    protected $table   = 'teams';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $dates   = ['deleted_at', 'created_at', 'updated_at'];
    protected $guarded = [];
    protected $fillable = [
        'id',
        'name',
        'abbreviation',
        'gender',
        'hometown',
        'supervisor',
        'coach',
        'manager',
        'trainer',
        'color_home',
        'color_guest',
        'explanation',
        'created_by',
        'is_home',
        'order_number',
        'team_code',
        'team_id',
    ];

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function matches_team1()
    {
        return $this->hasMany(Tournament::class, 'team_id1');
    }

    public function matches_team2()
    {
        return $this->hasMany(Tournament::class, 'team_id2');
    }

    public function lineups()
    {
        return $this->hasMany(Lineup::class);
    }

    public function team_history()
    {
        return $this->hasMany(TeamHistory::class, 'team_id', 'id');
    }

    public function registration(){
        return $this->belongsTo(Registration::class, 'created_by', 'id');
    }
}

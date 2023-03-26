<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UnixTimestampSerializable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lineup extends Model
{
    use SoftDeletes;
    use UnixTimestampSerializable;
    use HasFactory;

    protected $table = 'lineups';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];
    protected $fillable = ['team_id', 'title', 'created_by', 'starting', 'substitute', 'not_member', 'pattern', 'pattern_name', 'people_starting', 'tmp_lineup'];
    protected $casts = [
        'starting'   => 'json',
        'substitute' => 'json',
        'not_member' => 'json',
        'pattern'    => 'json',
    ];
    public function team(){
        return $this->belongsTo(Team::class);
    }

    public function matches_lineup1()
    {
        return $this->hasMany(Tournament::class, 'lineup_id1');
    }

    public function matches_lineup2()
    {
        return $this->hasMany(Tournament::class, 'lineup_id2');
    }
}

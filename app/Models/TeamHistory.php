<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamHistory extends Model
{
    use HasFactory;

    protected $table = 'team_histories';

    protected $guarded = [];

    public function team(){
        return $this->belongsTo(Team::class);
    }
}

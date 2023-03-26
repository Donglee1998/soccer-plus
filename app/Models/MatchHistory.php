<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchHistory extends Model
{
    use HasFactory;

    protected $table = 'match_histories';
    protected $guarded = [];

    public function macth(){
        return $this->belongsTo(Tournament::class);
    }

}

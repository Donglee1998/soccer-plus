<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberHistory extends Model
{
    use HasFactory;

    protected $table = 'member_histories';
    protected $guarded = [];

    public function member(){
        return $this->belongsTo(Member::class);
    }
}

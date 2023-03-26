<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberSheet extends Model
{
    use HasFactory;

    protected $table = 'member_sheets';
    protected $guarded = [];

    public function member(){
        return $this->belongsTo(Member::class);
    }

    public function sheet(){
        return $this->belongsTo(Sheet::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table    = 'comments';
    protected $dates    = ['updated_at', 'created_at'];
    protected $fillable = ['title', 'content', 'name', 'created_by', 'match_id'];

}

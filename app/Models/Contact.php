<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table    = 'contacts';
    protected $dates    = ['deleted_at', 'created_at', 'deleted_at'];
    protected $fillable = ['name', 'email', 'team', 'status', 'app_type', 'content', 'admin_memo', 'purpose', 'type'];
}

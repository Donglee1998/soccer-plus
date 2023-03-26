<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Folder extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table    = 'folders';
    protected $dates    = ['deleted_at', 'created_at', 'updated_at'];
    protected $fillable = ['name', 'created_by'];

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}

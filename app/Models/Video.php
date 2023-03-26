<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table    = 'videos';
    protected $dates    = ['deleted_at', 'created_at', 'updated_at'];
    protected $fillable = ['title', 'created_by', 'path', 'thumbnail', 'folder_id', 'size', 'duration'];

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }

    public function getPathUrlAttribute()
    {
        if (empty($this->thumbnail)) {
            return '';
        }

        return removeLastForwardSlash(config('filesystems.disks.s3.url')) . '/' . removeFirstForwardSlash($this->thumbnail);
    }

    public function getUrlAttribute()
    {
        if (empty($this->thumbnail)) {
            return '';
        }

        return removeLastForwardSlash(config('filesystems.disks.s3.url')) . '/' . removeFirstForwardSlash($this->path);
    }

    public function getUrlVideoAttribute()
    {
        if (empty($this->path)) {
            return '';
        }

        return removeLastForwardSlash(config('filesystems.disks.s3.url')) . '/' . removeFirstForwardSlash($this->path);
    }
}

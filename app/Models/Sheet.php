<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UnixTimestampSerializable;
use Illuminate\Database\Eloquent\SoftDeletes;
class Sheet extends Model
{
    use UnixTimestampSerializable;
    use HasFactory;
    use SoftDeletes;

    protected $table = 'sheets';
    protected $guarded = [];

    public function tactic(){
        return $this->belongsTo(Tactic::class);
    }

    public function sketchUrl()
    {
        if (empty($this->sketch)) {
            return '';
        }

        return removeLastForwardSlash(config('filesystems.disks.s3.url')) . '/' . removeFirstForwardSlash($this->sketch);
    }
}

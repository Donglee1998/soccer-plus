<?php

namespace App\Models;
use App\Traits\UnixTimestampSerializable;
use Illuminate\Database\Eloquent\Model;

class Backup extends Model
{
    use UnixTimestampSerializable;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'backups';

    /**
     * The attribute that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'user_id',
        'comment',
        'size',
    ];
}

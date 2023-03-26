<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SessionInput extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'session_inputs';

    /**
     * The attribute that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'session_id',
        'page',
        'data',
        'submitted_at',
    ];
}

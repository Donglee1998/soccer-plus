<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordAccountReset extends Model
{
    public const EXPIRE_TOKEN = 60;
    public $timestamps        = false;

    /**
     * The database table used this model.
     * @var string
     */
    protected $table = 'password_account_resets';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['email', 'token', 'created_at'];
}

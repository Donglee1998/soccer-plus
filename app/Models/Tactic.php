<?php

namespace App\Models;

use App\Traits\TraitModel;
use App\Traits\UnixTimestampSerializable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tactic extends Model
{
    use SoftDeletes;
    use UnixTimestampSerializable;
    use HasFactory;
    use TraitModel;

    protected $table   = 'tactics';
    protected $guarded = [
        'updated_at',
        'deleted_at',
    ];
    protected $appends = [
        'type_label',
        'pitch_label',
    ];
    protected $fillable = [
        'id',
        'tactic_id',
        'title',
        'explain',
        'type',
        'status',
        'pitch',
        'background',
        'created_by',
        'created_at',
        'updated_at',
        'synced_at',
        'uuid',
    ];

    public function getTypeLabelAttribute()
    {
        return config('constants.tactic_type.label.' . $this->attributes['type']);
    }

    public function getPitchLabelAttribute()
    {
        return config('constants.pitch.label.' . $this->attributes['pitch']);
    }

    public function sheets()
    {
        return $this->hasMany(Sheet::class, 'tactic_id', 'id');
    }

    public function firstSheet() {
       return $this->hasOne(Sheet::class, 'tactic_id', 'id')->latest();
    }
}

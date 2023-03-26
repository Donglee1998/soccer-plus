<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;

class Registration extends Authenticatable implements JWTSubject
{
    use SoftDeletes, Notifiable;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'registrations';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'name_furigana',
        'registration_email',
        'corp_name',
        'corp_name_furigana',
        'zip',
        'address',
        'address',
        'tel',
        'pic_name',
        'pic_name_furigana',
        'pic_email',
        'pic_mobile',
        'pic_birthday',
        'pic_gender',
        'pic_zip',
        'pic_address',
        'pic_tel',
        'contract_premium1',
        'contract_premium2',
        'contract_premium3',
        'contract_option',
        'payment_method1',
        'payment_method2',
        'contact2_name',
        'contact2_name_furigana',
        'contact2_email',
        'contact2_tel',
        'delivery_name',
        'delivery_zip',
        'delivery_address',
        'contract_status',
        'type',
        'email',
        'username',
        'password',
        'password_confirm',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'password_confirm'
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [
            'uuid'    => $this->uuid,
            'team_id' => $this->team_id,
        ];
    }

    public function team()
    {
        return $this->hasMany(Team::class, 'created_by');
    }

    public function teamIsHome()
    {
        return $this->team->where('is_home' , intval(Config('constants.is_home')))->first();
    }

    public function getSpaceUploadInfo($unit = null)
    {
        $unit = $unit ? $unit : config('constants.pbpv.space_upload.default_unit');
        $data = (object) [
            'has_contract' => false,
            'space_mb' => 0,
            'space' => 0,
            'unit' => $unit,
            'used_mb' => 0,
            'used' => 0,
            'used_unit' => $unit,
            'used_percent' => 0,
            'file_kb' => config('constants.pbpv.space_upload.file_mb') * 1024,
        ];

        $options = json_decode($this->contract_option, true);
        if (in_array(config('constants.contract_option.key.play_by_play_video'), $options)) {
            $data->has_contract = true;
            $data->space = $data->space_mb = config('constants.pbpv.space_upload.standard_mb');
        } else if (in_array(config('constants.contract_option.key.play_by_play_video_lite'), $options)) {
            $data->has_contract = true;
            $data->space = $data->space_mb = config('constants.pbpv.space_upload.lite_mb');
        }

        $used_kb = Video::where('created_by', $this->id)->sum('size');
        $data->used_mb = $used_kb ? round($used_kb / 1024, 1) : 0;

        if ($unit == 'GB') {
            $data->space = round($data->space_mb / 1024, 1);
            $data->used = $data->used_mb ? round($data->used_mb / 1024, 1) : 0;
        } else if ($unit == 'KB') {
            $data->space = $data->space_mb * 1024;
            $data->used = $used_kb;
        }

        $data->used_percent = $data->used_mb ? ($data->used_mb / $data->space_mb) * 100 : 0;
        return $data;
    }

    public function getHasSyncContractAttribute()
    {
        $options = json_decode($this->contract_option, true);
        return in_array(config('constants.contract_option.key.expert_server_model'), $options);
    }
}

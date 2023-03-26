<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\TraitModel;
use App\Traits\UnixTimestampSerializable;

class Stat extends Model
{
    use UnixTimestampSerializable;
    use HasFactory;
    use TraitModel;

    protected $table = 'stats';
    public $timestamps = false;
    protected $fillable = [
        'match_id',
        'member_id',
        'member_anonymous_id',
        'sub_member_id',
        'order',
        'action_id',
        'sub_action_id',
        'coord_x',
        'coord_y',
        'result',
        'created_at',
        'created_at_round',
        // attributes of error
        'fouls_id',
        'fouls_judgment_type_id',
        'fouls_reason_received_card_id',
        'fouls_free_kick_id',
        // attributes of kick
        'ball_goal_coord_x',
        'ball_goal_coord_y',
        'ball_goal_number',
        'action_kick_situation_id',
        'action_kick_gk_id',
        'action_kick_block_id',
        // attributes of contribution
        'action_contribution_data',
        'action_contribution_score',
        // attributes of pa area
        'is_pa_home_area',
        'is_pa_guest_area',
        // attributes of wings area
        'is_wings_home_area',
        'is_wings_guest_area',
        // attributes of pitch area
        'is_pitch_home_area',
        'is_pitch_guest_area',
        // attributes flag is edit.
        'ball_goal_type',
        'is_edit',
        'ball_goal_action_goalkeeper_id',
        'ball_goal_pk_round',
        'account_level',
        'home_gk_member_id',
        'guest_gk_member_id',
        'action_kick_member_id',
        'timer_at',
        'timer_additional_at',
        'sub_coord_x',
        'sub_coord_y',
        'shoot_area_key',
        'pattern',
        'ball_goal_number_coord_x',
        'ball_goal_number_coord_y',
        'is_change_court'

    ];

    public function match(){
        return $this->belongsTo(Tournament::class, 'match_id', 'id');
    }

    public function member(){
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

    public function statsVideos()
    {
        return $this->hasOne(StatsVideos::class, 'stat_id', 'id');
    }

    public function stat_history()
    {
        return $this->hasMany(StatHistory::class, 'stat_id', 'id');
    }

    public function sub_member(){
        return $this->belongsTo(Member::class, 'sub_member_id', 'id');
    }
}

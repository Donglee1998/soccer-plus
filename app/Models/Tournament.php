<?php

namespace App\Models;

use App\Traits\TraitModel;
use App\Traits\UnixTimestampSerializable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tournament extends Model
{
    use HasFactory;
    use SoftDeletes;
    use TraitModel;
    use UnixTimestampSerializable;

    protected $table   = 'matches';
    protected $dates   = ['start_date','deleted_at', 'created_at', 'updated_at'];
    protected $guarded = [];
    protected $fillable = ['team_id1', 'team_color1', 'team_id2', 'team_color2', 'conference_name', 'type', 'team_owner', 'start_date', 'start_time', 'place', 'referee', 'linesman', 'fourth_referee', 'weather', 'pitch_type', 'situation', 'number_people', 'round1_time', 'round2_time', 'round3_time', 'round4_time', 'rest_time', 'extra_time', 'penalty', 'comment', 'team1_score', 'team2_score', 'created_by', 'additional_time1', 'additional_time2', 'additional_time3', 'additional_time4', 'status', 'lineup_id1', 'lineup_id2', 'match_id', 'uuid', 'team1_ball_control', 'team2_ball_control', 'additional_extra_time1', 'additional_extra_time2', 'team1_score_pk', 'team2_score_pk', 'current_timer', 'current_round', 'tmp_lineup_id1', 'tmp_lineup_id2'];

    public function team1()
    {
        return $this->belongsTo(Team::class, 'team_id1')->withTrashed();;
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team_id2')->withTrashed();;
    }

    public function lineup1()
    {
        return $this->belongsTo(Lineup::class, 'lineup_id1');
    }

    public function lineup2()
    {
        return $this->belongsTo(Lineup::class, 'lineup_id2');
    }

    public function match_history()
    {
        return $this->hasMany(MatchHistory::class, 'match_id', 'id');
    }

    public function stats()
    {
        return $this->hasMany(Stat::class, 'match_id', 'id');
    }

    public function statScore()
    {
        $rounds = $this->stats()->select('created_at_round')->groupBy('created_at_round')->get()->pluck('created_at_round')->toArray();
        $stats  = $this->stats()->whereIn('action_id', config('constants.pbpv.goal_actions'))->where('result', 1)->with('member')->get();
        if (count($rounds)) {
            $round_remap = [];
            foreach ($rounds as $round) {
                $round_remap[$round] = ['team1' => 0, 'team2' => 0];
            }
            $rounds = $round_remap;
            foreach ($stats as $stat) {
                if ($stat->member) {
                    if ($this->team_id1 == $stat->member->team_id) {
                        $rounds[$stat->created_at_round]['team1'] += 1;
                    } elseif ($this->team_id2 == $stat->member->team_id) {
                        $rounds[$stat->created_at_round]['team2'] += 1;
                    }
                } else {
                    $team_home_id = $this->team_owner == 1 ? $this->team_id1 : $this->team_id2;
                    if (is_anonymous_stat_belong_to_team($this->team_id1, $team_home_id, $stat->member_anonymous_id)) {
                        $rounds[$stat->created_at_round]['team1'] += 1;
                    } elseif (is_anonymous_stat_belong_to_team($this->team_id2, $team_home_id, $stat->member_anonymous_id)) {
                        $rounds[$stat->created_at_round]['team2'] += 1;
                    }
                }
            }

            if (isset($rounds['_PK'])) {
                $rounds['_PK']['team1'] = $this->team1_score_pk ? $this->team1_score_pk : 0;
                $rounds['_PK']['team2'] = $this->team2_score_pk ? $this->team2_score_pk : 0;
            }
            return $rounds;
        }
        return [];
    }

    public function statGoal()
    {
        $stats = $this->stats()->whereIn('action_id', config('constants.pbpv.goal_actions'))->where('result', 1)->with('member')->orderBy('created_at_round')->get();
        $goals = [
            'team1' => [],
            'team2' => [],
        ];
        foreach ($stats as $stat) {
            if ($stat->member) {
                if ($this->team_id1 == $stat->member->team_id) {
                    $goals['team1'][] = [
                        'name'     => ($stat->member?->full_name == ' ' ? '?' : $stat->member?->full_name),
                        'round'    => str_replace('_', '', $stat->created_at_round),
                        'time'     => implode(':', parse_duration($stat->timer_at > 0 ? $stat->timer_at / 1000 : 0, false)),
                        'sub_name' => ($stat->sub_member?->full_name == ' ' ? '?' : $stat->sub_member?->full_name),
                    ];
                } elseif ($this->team_id2 == $stat->member->team_id) {
                    $goals['team2'][] = [
                        'name'     => $stat->member?->full_name,
                        'round'    => str_replace('_', '', $stat->created_at_round),
                        'time'     => implode(':', parse_duration($stat->timer_at > 0 ? $stat->timer_at / 1000 : 0, false)),
                        'sub_name' => ($stat->sub_member?->full_name == ' ' ? '?' : $stat->sub_member?->full_name),
                    ];
                }
            } else {
                $team_home_id = $this->team_owner == 1 ? $this->team_id1 : $this->team_id2;
                if (is_anonymous_stat_belong_to_team($this->team_id1, $team_home_id, $stat->member_anonymous_id)) {
                    $goals['team1'][] = [
                        'name'  => '仮選手(?)',
                        'round' => str_replace('_', '', $stat->created_at_round),
                        'time'  => implode(':', parse_duration($stat->timer_at > 0 ? $stat->timer_at / 1000 : 0, false)),
                    ];
                } elseif (is_anonymous_stat_belong_to_team($this->team_id2, $team_home_id, $stat->member_anonymous_id)) {
                    $goals['team2'][] = [
                        'name'  => '仮選手(?)',
                        'round' => str_replace('_', '', $stat->created_at_round),
                        'time'  => implode(':', parse_duration($stat->timer_at > 0 ? $stat->timer_at / 1000 : 0, false)),
                    ];
                }
            }
        }
        return $goals;
    }

    public function statHistory()
    {
        return $this->hasManyThrough(
            StatHistory::class,
            Stat::class,
            'match_id',
            'stat_id',
            'id',
            'id'
        );
    }
}

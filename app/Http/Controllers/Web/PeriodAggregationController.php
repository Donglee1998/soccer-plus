<?php

namespace App\Http\Controllers\Web;

use App\Helpers\TransformDataStat;
use App\Http\Requests\Web\PeriodAggregationStatRequest;
use App\Repositories\MatchRepository;
use App\Repositories\MemberRepository;
use App\Repositories\StatRepository;
use App\Repositories\TeamRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriodAggregationController extends BaseController
{
    protected $__matchRepo;
    protected $__teamRepo;
    protected $__statRepo;
    protected $__memberRepo;

    public function __construct(MatchRepository $matchRepository, TeamRepository $teamRepo, StatRepository $statRepo, MemberRepository $memberRepo)
    {
        $this->__matchRepo  = $matchRepository;
        $this->__teamRepo   = $teamRepo;
        $this->__statRepo   = $statRepo;
        $this->__memberRepo = $memberRepo;
    }

    public function index()
    {
        $type    = config('constants.period_aggregation.match_type.label');
        $auth_id = Auth::guard('web')->user()->id;
        $team    = $this->__teamRepo->getListExceptIsHome($auth_id);
        return view('web.period_aggregations.index', compact('type', 'team'));
    }

    public function statCheck(PeriodAggregationStatRequest $request)
    {
        $team_home = $this->__teamRepo->getTeamIsHome(Auth::guard('web')->user()->id);
        $match     = $this->__matchRepo->getMatchStat($request->all(), $team_home->id)->get();
        $count     = count($match);
        return response()->json(['result' => true, 'count' => $count], 200);
    }

    /**
     * Display page period_stat
     *
     * @return \Illuminate\Http\Response
     */
    public function stat(Request $request)
    {
        $team = $this->__teamRepo->find($request->team);
        return view('web.period_aggregations.stat', compact('team'));
    }

    /**
     * Get data for ajax link /period_aggregation/period_stat/team
     *
     * @return \Illuminate\Http\Response
     */
    public function team(Request $request)
    {
        $team_home           = $this->__teamRepo->getTeamIsHome(Auth::guard('web')->user()->id);
        $match               = $this->__matchRepo->getMatchStat($request->all(), $team_home->id);
        $match_id            = $match->pluck('id')->toArray();
        $match               = $match->get();
        $member_anonymous_id = -1;
        if (empty($match)) {
            return response()->json(['result' => true, 'message' => 'Null']);
        }
        $stats                     = $this->__statRepo->getStatsTeams($match_id, $request->round);
        $member_id                 = $this->__memberRepo->getMemberStats($team_home->id)->pluck('id')->toArray();
        $sum                       = [];
        $avg                       = [];
        $sum_goal                  = 0;
        $sum_kick                  = 0;
        $sum_kick_goal             = 0;
        $sum_assist                = 0;
        $sum_last_pass             = 0;
        $sum_cross                 = 0;
        $sum_pass_dribble          = 0;
        $sum_fouled                = 0;
        $sum_tackle                = 0;
        $sum_clear                 = 0;
        $sum_block                 = 0;
        $sum_foul                  = 0;
        $sum_second_ball           = 0;
        $sum_is_pa                 = 0;
        $sum_penalty_golf          = 0;
        $sum_corner_kick           = 0;
        $sum_free_kick             = 0;
        $sum_pk                    = 0;
        $sum_tackle_overhead_home  = 0;
        $sum_tackle_overhead_guest = 0;
        $sum_save                  = 0;

        $sum_ratio_goal                  = 0;
        $sum_ratio_kick_goal             = 0;
        $sum_ratio_tackle_overhead_home  = 0;
        $sum_ratio_tackle_overhead_guest = 0;
        $sum_ratio_pass_dribble          = 0;
        $sum_ratio_cross                 = 0;
        $sum_ratio_tackle                = 0;
        $sum_ratio_clear                 = 0;
        $sum_ratio_second_ball           = 0;
        $sum_ratio_save                  = 0;
        $sum_ratio_catch_cross           = 0;
        $sum_ratio_goal_play             = 0;
        $sum_ratio_throw                 = 0;
        $sum_ratio_lose                  = 0;
        $count                           = 0;
        if ($request->team_type == 1) {
            foreach ($match as $key => $value) {
                $time  = null;
                $check = false;
                if ($request->round) {
                    if ($request->round == 1) {
                        $time  = $value->round1_time;
                        $check = true;
                    } else if ($request->round == 2) {
                        $time  = $value->round2_time;
                        $check = true;
                    } else if ($request->round == 3) {
                        $time  = $value->round3_time;
                        $check = true;
                    } else if ($request->round == 4) {
                        $time  = $value->round4_time;
                        $check = true;
                    } else if ($request->round == 5 || $request->round == 6) {
                        $time  = $value->extra_time;
                        $check = true;
                    }
                }
                if ($check && is_null($time)) {
                    $match[$key]->goal                  = '--';
                    $match[$key]->kick                  = '--';
                    $match[$key]->kick_goal             = '--';
                    $match[$key]->assist                = '--';
                    $match[$key]->last_pass             = '--';
                    $match[$key]->cross                 = '--';
                    $match[$key]->pass_dribble          = '--';
                    $match[$key]->fouled                = '--';
                    $match[$key]->tackle                = '--';
                    $match[$key]->clear                 = '--';
                    $match[$key]->block                 = '--';
                    $match[$key]->foul                  = '--';
                    $match[$key]->second_ball           = '--';
                    $match[$key]->is_pa                 = '--';
                    $match[$key]->penalty_golf          = '--';
                    $match[$key]->corner_kick           = '--';
                    $match[$key]->free_kick             = '--';
                    $match[$key]->pk                    = '--';
                    $match[$key]->tackle_overhead_home  = '--';
                    $match[$key]->tackle_overhead_guest = '--';
                    $match[$key]->save                  = '--';
                } else {
                    $count += 1;
                    $box_score_team = TransformDataStat::boxScoreTeamNumber($stats, $member_id, $team_home, $value, $time, $request->sub_time, $member_anonymous_id);
                    $match[$key]->goal                  = $box_score_team['goal'];
                    $match[$key]->kick                  = $box_score_team['kick'];
                    $match[$key]->kick_goal             = $box_score_team['kick_goal'];
                    $match[$key]->assist                = $box_score_team['assist'];
                    $match[$key]->last_pass             = $box_score_team['last_pass'];
                    $match[$key]->cross                 = $box_score_team['cross'];
                    $match[$key]->pass_dribble          = $box_score_team['pass_dribble'];
                    $match[$key]->fouled                = $box_score_team['fouled'];
                    $match[$key]->tackle                = $box_score_team['cut_ball'];
                    $match[$key]->clear                 = $box_score_team['clear'];
                    $match[$key]->block                 = $box_score_team['block'];
                    $match[$key]->foul                  = $box_score_team['foul'];
                    $match[$key]->second_ball           = $box_score_team['second_ball'];
                    $match[$key]->is_pa                 = $box_score_team['is_pa'];
                    $match[$key]->penalty_golf          = $box_score_team['penalty_golf'];
                    $match[$key]->corner_kick           = $box_score_team['corner_kick'];
                    $match[$key]->free_kick             = $box_score_team['free_kick'];
                    $match[$key]->pk                    = $box_score_team['pk'];
                    $match[$key]->tackle_overhead_home  = $box_score_team['tackle_overhead_home'];
                    $match[$key]->tackle_overhead_guest = $box_score_team['tackle_overhead_guest'];
                    $match[$key]->save                  = $box_score_team['save'];

                    $sum_goal                  = $sum_goal + $box_score_team['goal'];
                    $sum_kick                  = $sum_kick + $box_score_team['kick'];
                    $sum_kick_goal             = $sum_kick_goal + $box_score_team['kick_goal'];
                    $sum_assist                = $sum_assist + $box_score_team['assist'];
                    $sum_last_pass             = $sum_last_pass + $box_score_team['last_pass'];
                    $sum_cross                 = $sum_cross + $box_score_team['cross'];
                    $sum_pass_dribble          = $sum_pass_dribble + $box_score_team['pass_dribble'];
                    $sum_fouled                = $sum_fouled + $box_score_team['fouled'];
                    $sum_tackle                = $sum_tackle + $box_score_team['cut_ball'];
                    $sum_clear                 = $sum_clear + $box_score_team['clear'];
                    $sum_block                 = $sum_block + $box_score_team['block'];
                    $sum_foul                  = $sum_foul + $box_score_team['foul'];
                    $sum_second_ball           = $sum_second_ball + $box_score_team['second_ball'];
                    $sum_is_pa                 = $sum_is_pa + $box_score_team['is_pa'];
                    $sum_penalty_golf          = $sum_penalty_golf + $box_score_team['penalty_golf'];
                    $sum_corner_kick           = $sum_corner_kick + $box_score_team['corner_kick'];
                    $sum_free_kick             = $sum_free_kick + $box_score_team['free_kick'];
                    $sum_pk                    = $sum_pk + $box_score_team['pk'];
                    $sum_tackle_overhead_home  = $sum_tackle_overhead_home + $box_score_team['tackle_overhead_home'];
                    $sum_tackle_overhead_guest = $sum_tackle_overhead_guest + $box_score_team['tackle_overhead_guest'];
                    $sum_save                  = $sum_save + $box_score_team['save'];
                }
            }
            $sum['goal']                  = $sum_goal;
            $sum['kick']                  = $sum_kick;
            $sum['kick_goal']             = $sum_kick_goal;
            $sum['assist']                = $sum_assist;
            $sum['last_pass']             = $sum_last_pass;
            $sum['cross']                 = $sum_cross;
            $sum['pass_dribble']          = $sum_pass_dribble;
            $sum['fouled']                = $sum_fouled;
            $sum['tackle']                = $sum_tackle;
            $sum['clear']                 = $sum_clear;
            $sum['block']                 = $sum_block;
            $sum['foul']                  = $sum_foul;
            $sum['second_ball']           = $sum_second_ball;
            $sum['is_pa']                 = $sum_is_pa;
            $sum['penalty_golf']          = $sum_penalty_golf;
            $sum['corner_kick']           = $sum_corner_kick;
            $sum['free_kick']             = $sum_free_kick;
            $sum['pk']                    = $sum_pk;
            $sum['tackle_overhead_home']  = $sum_tackle_overhead_home;
            $sum['tackle_overhead_guest'] = $sum_tackle_overhead_guest;
            $sum['save']                  = $sum_save;

            $avg['goal']                  = $this->avg($sum_goal, $count);
            $avg['kick']                  = $this->avg($sum_kick, $count);
            $avg['kick_goal']             = $this->avg($sum_kick_goal, $count);
            $avg['assist']                = $this->avg($sum_assist, $count);
            $avg['last_pass']             = $this->avg($sum_last_pass, $count);
            $avg['cross']                 = $this->avg($sum_cross, $count);
            $avg['pass_dribble']          = $this->avg($sum_pass_dribble, $count);
            $avg['fouled']                = $this->avg($sum_fouled, $count);
            $avg['tackle']                = $this->avg($sum_tackle, $count);
            $avg['clear']                 = $this->avg($sum_clear, $count);
            $avg['block']                 = $this->avg($sum_block, $count);
            $avg['foul']                  = $this->avg($sum_foul, $count);
            $avg['second_ball']           = $this->avg($sum_second_ball, $count);
            $avg['is_pa']                 = $this->avg($sum_is_pa, $count);
            $avg['penalty_golf']          = $this->avg($sum_penalty_golf, $count);
            $avg['corner_kick']           = $this->avg($sum_corner_kick, $count);
            $avg['free_kick']             = $this->avg($sum_free_kick, $count);
            $avg['pk']                    = $this->avg($sum_pk, $count);
            $avg['tackle_overhead_home']  = $this->avg($sum_tackle_overhead_home, $count);
            $avg['tackle_overhead_guest'] = $this->avg($sum_tackle_overhead_guest, $count);
            $avg['save']                  = $this->avg($sum_save, $count);
        } else {
            foreach ($match as $key => $value) {
                $time  = null;
                $check = false;
                if ($request->round) {
                    if ($request->round == 1) {
                        $time  = $value->round1_time;
                        $check = true;
                    } else if ($request->round == 2) {
                        $time  = $value->round2_time;
                        $check = true;
                    } else if ($request->round == 3) {
                        $time  = $value->round3_time;
                        $check = true;
                    } else if ($request->round == 4) {
                        $time  = $value->round4_time;
                        $check = true;
                    } else if ($request->round == 5 || $request->round == 6) {
                        $time  = $value->extra_time;
                        $check = true;
                    }
                }
                if ($check && is_null($time)) {
                    $match[$key]->ratio_goal                  = '--';
                    $match[$key]->ratio_kick_goal             = '--';
                    $match[$key]->ratio_tackle_overhead_home  = '--';
                    $match[$key]->ratio_tackle_overhead_guest = '--';
                    $match[$key]->ratio_pass_dribble          = '--';
                    $match[$key]->ratio_cross                 = '--';
                    $match[$key]->ratio_tackle                = '--';
                    $match[$key]->ratio_clear                 = '--';
                    $match[$key]->ratio_second_ball           = '--';
                    $match[$key]->ratio_save                  = '--';
                    $match[$key]->ratio_catch_cross           = '--';
                    $match[$key]->ratio_goal_play             = '--';
                    $match[$key]->ratio_throw                 = '--';
                    $match[$key]->ratio_lose                  = '--';
                } else {
                    $count += 1;
                    $box_score_team                           = TransformDataStat::boxScoreTeamProbability($stats, $member_id, $team_home, $value, $time, $request->sub_time, $member_anonymous_id);
                    $match[$key]->ratio_goal                  = $box_score_team['ratio_goal'];
                    $match[$key]->ratio_kick_goal             = $box_score_team['ratio_kick_goal'];
                    $match[$key]->ratio_tackle_overhead_home  = $box_score_team['ratio_tackle_overhead_home'];
                    $match[$key]->ratio_tackle_overhead_guest = $box_score_team['ratio_tackle_overhead_guest'];
                    $match[$key]->ratio_pass_dribble          = $box_score_team['ratio_pass_dribble'];
                    $match[$key]->ratio_cross                 = $box_score_team['ratio_cross'];
                    $match[$key]->ratio_tackle                = $box_score_team['ratio_tackle'];
                    $match[$key]->ratio_clear                 = $box_score_team['ratio_clear'];
                    $match[$key]->ratio_second_ball           = $box_score_team['ratio_second_ball'];
                    $match[$key]->ratio_save                  = $box_score_team['ratio_save'];
                    $match[$key]->ratio_catch_cross           = $box_score_team['ratio_catch_cross'];
                    $match[$key]->ratio_goal_play             = $box_score_team['ratio_goal_play'];
                    $match[$key]->ratio_throw                 = $box_score_team['ratio_throw'];
                    $match[$key]->ratio_lose                  = $box_score_team['ratio_lose'];

                    $sum_ratio_goal                  = $sum_ratio_goal + $box_score_team['ratio_goal'];
                    $sum_ratio_kick_goal             = $sum_ratio_kick_goal + $box_score_team['ratio_kick_goal'];
                    $sum_ratio_tackle_overhead_home  = $sum_ratio_tackle_overhead_home + $box_score_team['ratio_tackle_overhead_home'];
                    $sum_ratio_tackle_overhead_guest = $sum_ratio_tackle_overhead_guest + $box_score_team['ratio_tackle_overhead_guest'];
                    $sum_ratio_pass_dribble          = $sum_ratio_pass_dribble + $box_score_team['ratio_pass_dribble'];
                    $sum_ratio_cross                 = $sum_ratio_cross + $box_score_team['ratio_cross'];
                    $sum_ratio_tackle                = $sum_ratio_tackle + $box_score_team['ratio_tackle'];
                    $sum_ratio_clear                 = $sum_ratio_clear + $box_score_team['ratio_clear'];
                    $sum_ratio_second_ball           = $sum_ratio_second_ball + $box_score_team['ratio_second_ball'];
                    $sum_ratio_save                  = $sum_ratio_save + $box_score_team['ratio_save'];
                    $sum_ratio_catch_cross           = $sum_ratio_catch_cross + $box_score_team['ratio_catch_cross'];
                    $sum_ratio_goal_play             = $sum_ratio_goal_play + $box_score_team['ratio_goal_play'];
                    $sum_ratio_throw                 = $sum_ratio_throw + $box_score_team['ratio_throw'];
                    $sum_ratio_lose                  = $sum_ratio_lose + $box_score_team['ratio_lose'];
                }
            }

            $avg['ratio_goal']                  = $this->avg($sum_ratio_goal, $count);
            $avg['ratio_kick_goal']             = $this->avg($sum_ratio_kick_goal, $count);
            $avg['ratio_tackle_overhead_home']  = $this->avg($sum_ratio_tackle_overhead_home, $count);
            $avg['ratio_tackle_overhead_guest'] = $this->avg($sum_ratio_tackle_overhead_guest, $count);
            $avg['ratio_pass_dribble']          = $this->avg($sum_ratio_pass_dribble, $count);
            $avg['ratio_cross']                 = $this->avg($sum_ratio_cross, $count);
            $avg['ratio_tackle']                = $this->avg($sum_ratio_tackle, $count);
            $avg['ratio_clear']                 = $this->avg($sum_ratio_clear, $count);
            $avg['ratio_second_ball']           = $this->avg($sum_ratio_second_ball, $count);
            $avg['ratio_save']                  = $this->avg($sum_ratio_save, $count);
            $avg['ratio_catch_cross']           = $this->avg($sum_ratio_catch_cross, $count);
            $avg['ratio_goal_play']             = $this->avg($sum_ratio_goal_play, $count);
            $avg['ratio_throw']                 = $this->avg($sum_ratio_throw, $count);
            $avg['ratio_lose']                  = $this->avg($sum_ratio_lose, $count);
        }
        return response()->json(['result' => true, 'data' => $match, 'sum' => (object) $sum, 'avg' => (object) $avg], 200);
    }

    public function getResult($counterValue, $counterTotal)
    {
        if ($counterTotal === 0) {
            return 0;
        }

        return round(($counterValue / $counterTotal) * 100, 1);
    }

    public function avg($value, $count)
    {
        if ($value === 0) {
            return 0;
        }

        return round($value / $count, 1);
    }

    /**
     * Get data for ajax link /period_aggregation/period_stat/personal
     *
     * @return \Illuminate\Http\Response
     */
    public function personal(Request $request)
    {
        $team_home = $this->__teamRepo->getTeamIsHome(Auth::guard('web')->user()->id);
        $match     = $this->__matchRepo->getMatchStat($request->all(), $team_home->id);
        $match_id  = $match->pluck('id')->toArray();
        $match     = $match->get();
        if (empty($match)) {
            return response()->json(['result' => true, 'message' => 'Null']);
        }
        $stats                     = $this->__statRepo->getStatsTeams($match_id, $request->round);
        $member                    = $this->__memberRepo->getMemberStats($team_home->id)->get();
        $member_id                 = $member->pluck('id')->toArray();
        $member_anonymous_home     = -1;
        $member_anonymous_guest    = -2;
        $sum                       = [];
        $avg                       = [];
        $sum_goal                  = 0;
        $sum_kick                  = 0;
        $sum_kick_goal             = 0;
        $sum_assist                = 0;
        $sum_last_pass             = 0;
        $sum_cross                 = 0;
        $sum_pass_dribble          = 0;
        $sum_fouled                = 0;
        $sum_tackle                = 0;
        $sum_steal                 = 0;
        $sum_intercept             = 0;
        $sum_shoot_block           = 0;
        $sum_cross_block           = 0;
        $sum_foul                  = 0;
        $sum_clear                 = 0;
        $sum_second_ball           = 0;
        $sum_corner_kick           = 0;
        $sum_free_kick             = 0;
        $sum_pk                    = 0;
        $sum_tackle_overhead_home  = 0;
        $sum_tackle_overhead_guest = 0;
        $sum_guest_kick            = 0;
        $sum_guest_kick_goal       = 0;
        $sum_guest_lose            = 0;
        $sum_save_kick             = 0;
        $sum_save_penalty          = 0;
        $sum_punching              = 0;
        $sum_pass                  = 0;
        $sum_guest_pass            = 0;
        $sum_contribute            = 0;

        $sum_ratio_goal                  = 0;
        $sum_ratio_kick_goal             = 0;
        $sum_ratio_tackle_overhead_home  = 0;
        $sum_ratio_tackle_overhead_guest = 0;
        $sum_ratio_pass_dribble          = 0;
        $sum_ratio_cross                 = 0;
        $sum_ratio_tackle                = 0;
        $sum_ratio_clear                 = 0;
        $sum_ratio_second_ball           = 0;
        $sum_ratio_save                  = 0;
        $sum_ratio_catch_cross           = 0;
        $sum_ratio_lose                  = 0;
        if ($request->personal_type == 1) {
            foreach ($member as $key => $value) {
                $tmp_goal                  = 0;
                $tmp_kick                  = 0;
                $tmp_kick_goal             = 0;
                $tmp_assist                = 0;
                $tmp_last_pass             = 0;
                $tmp_cross                 = 0;
                $tmp_pass_dribble          = 0;
                $tmp_fouled                = 0;
                $tmp_tackle                = 0;
                $tmp_steal                 = 0;
                $tmp_intercept             = 0;
                $tmp_shoot_block           = 0;
                $tmp_cross_block           = 0;
                $tmp_foul                  = 0;
                $tmp_clear                 = 0;
                $tmp_second_ball           = 0;
                $tmp_corner_kick           = 0;
                $tmp_free_kick             = 0;
                $tmp_pk                    = 0;
                $tmp_tackle_overhead_home  = 0;
                $tmp_tackle_overhead_guest = 0;
                $tmp_guest_kick            = 0;
                $tmp_guest_kick_goal       = 0;
                $tmp_guest_lose            = 0;
                $tmp_save_kick             = 0;
                $tmp_save_penalty          = 0;
                $tmp_punching              = 0;
                $tmp_pass                  = 0;
                $tmp_guest_pass            = 0;
                $tmp_contribute            = 0;
                foreach ($match as $key1 => $value1) {
                    $time = null;
                    if ($request->round) {
                        if ($request->round == 1) {
                            $time = $value1->round1_time;
                        } else if ($request->round == 2) {
                            $time = $value1->round2_time;
                        } else if ($request->round == 3) {
                            $time = $value1->round3_time;
                        } else if ($request->round == 4) {
                            $time = $value1->round4_time;
                        } else if ($request->round == 5 || $request->round == 6) {
                            $time = $value1->extra_time;
                        }
                    }
                    $box_score_personal        = TransformDataStat::boxScorePersonalNumber($stats, $member_id, $value, $value1, $time, $request->sub_time);
                    $tmp_goal                  = $tmp_goal + $box_score_personal['goal'];
                    $tmp_kick                  = $tmp_kick + $box_score_personal['kick'];
                    $tmp_kick_goal             = $tmp_kick_goal + $box_score_personal['kick_goal'];
                    $tmp_assist                = $tmp_assist + $box_score_personal['assist'];
                    $tmp_last_pass             = $tmp_last_pass + $box_score_personal['last_pass'];
                    $tmp_cross                 = $tmp_cross + $box_score_personal['cross'];
                    $tmp_pass_dribble          = $tmp_pass_dribble + $box_score_personal['pass_dribble'];
                    $tmp_fouled                = $tmp_fouled + $box_score_personal['fouled'];
                    $tmp_tackle                = $tmp_tackle + $box_score_personal['tackle'];
                    $tmp_steal                 = $tmp_steal + $box_score_personal['steal'];
                    $tmp_intercept             = $tmp_intercept + $box_score_personal['intercept'];
                    $tmp_shoot_block           = $tmp_shoot_block + $box_score_personal['shoot_block'];
                    $tmp_cross_block           = $tmp_cross_block + $box_score_personal['cross_block'];
                    $tmp_foul                  = $tmp_foul + $box_score_personal['foul'];
                    $tmp_clear                 = $tmp_clear + $box_score_personal['clear'];
                    $tmp_second_ball           = $tmp_second_ball + $box_score_personal['second_ball'];
                    $tmp_corner_kick           = $tmp_corner_kick + $box_score_personal['corner_kick'];
                    $tmp_free_kick             = $tmp_free_kick + $box_score_personal['free_kick'];
                    $tmp_pk                    = $tmp_pk + $box_score_personal['pk'];
                    $tmp_tackle_overhead_home  = $tmp_tackle_overhead_home + $box_score_personal['tackle_overhead_home'];
                    $tmp_tackle_overhead_guest = $tmp_tackle_overhead_guest + $box_score_personal['tackle_overhead_guest'];
                    $tmp_guest_kick            = $tmp_guest_kick + $box_score_personal['guest_kick'];
                    $tmp_guest_kick_goal       = $tmp_guest_kick_goal + $box_score_personal['guest_kick_goal'];
                    $tmp_guest_lose            = $tmp_guest_lose + $box_score_personal['guest_lose'];
                    $tmp_save_kick             = $tmp_save_kick + $box_score_personal['save_kick'];
                    $tmp_save_penalty          = $tmp_save_penalty + $box_score_personal['save_penalty'];
                    $tmp_punching              = $tmp_punching + $box_score_personal['punching'];
                    $tmp_pass                  = $tmp_pass + $box_score_personal['pass'];
                    $tmp_guest_pass            = $tmp_guest_pass + $box_score_personal['guest_pass'];
                    $tmp_contribute            = $tmp_contribute + $box_score_personal['contribute'];
                }
                $member[$key]->goal                  = $tmp_goal;
                $member[$key]->kick                  = $tmp_kick;
                $member[$key]->kick_goal             = $tmp_kick_goal;
                $member[$key]->assist                = $tmp_assist;
                $member[$key]->last_pass             = $tmp_last_pass;
                $member[$key]->cross                 = $tmp_cross;
                $member[$key]->pass_dribble          = $tmp_pass_dribble;
                $member[$key]->fouled                = $tmp_fouled;
                $member[$key]->tackle                = $tmp_tackle;
                $member[$key]->steal                 = $tmp_steal;
                $member[$key]->intercept             = $tmp_intercept;
                $member[$key]->shoot_block           = $tmp_shoot_block;
                $member[$key]->cross_block           = $tmp_cross_block;
                $member[$key]->foul                  = $tmp_foul;
                $member[$key]->clear                 = $tmp_clear;
                $member[$key]->second_ball           = $tmp_second_ball;
                $member[$key]->corner_kick           = $tmp_corner_kick;
                $member[$key]->free_kick             = $tmp_free_kick;
                $member[$key]->pk                    = $tmp_pk;
                $member[$key]->tackle_overhead_home  = $tmp_tackle_overhead_home;
                $member[$key]->tackle_overhead_guest = $tmp_tackle_overhead_guest;
                $member[$key]->guest_kick            = $tmp_guest_kick;
                $member[$key]->guest_kick_goal       = $tmp_guest_kick_goal;
                $member[$key]->guest_lose            = $tmp_guest_lose;
                $member[$key]->save_kick             = $tmp_save_kick;
                $member[$key]->save_penalty          = $tmp_save_penalty;
                $member[$key]->punching              = $tmp_punching;
                $member[$key]->pass                  = $tmp_pass;
                $member[$key]->guest_pass            = $tmp_guest_pass;
                $member[$key]->contribute            = $tmp_contribute;

                $sum_goal                  = $sum_goal + $tmp_goal;
                $sum_kick                  = $sum_kick + $tmp_kick;
                $sum_kick_goal             = $sum_kick_goal + $tmp_kick_goal;
                $sum_assist                = $sum_assist + $tmp_assist;
                $sum_last_pass             = $sum_last_pass + $tmp_last_pass;
                $sum_cross                 = $sum_cross + $tmp_cross;
                $sum_pass_dribble          = $sum_pass_dribble + $tmp_pass_dribble;
                $sum_fouled                = $sum_fouled + $tmp_fouled;
                $sum_tackle                = $sum_tackle + $tmp_tackle;
                $sum_steal                 = $sum_steal + $tmp_steal;
                $sum_intercept             = $sum_intercept + $tmp_intercept;
                $sum_shoot_block           = $sum_shoot_block + $tmp_shoot_block;
                $sum_cross_block           = $sum_cross_block + $tmp_cross_block;
                $sum_foul                  = $sum_foul + $tmp_foul;
                $sum_clear                 = $sum_clear + $tmp_clear;
                $sum_second_ball           = $sum_second_ball + $tmp_second_ball;
                $sum_corner_kick           = $sum_corner_kick + $tmp_corner_kick;
                $sum_free_kick             = $sum_free_kick + $tmp_free_kick;
                $sum_pk                    = $sum_pk + $tmp_pk;
                $sum_tackle_overhead_home  = $sum_tackle_overhead_home + $tmp_tackle_overhead_home;
                $sum_tackle_overhead_guest = $sum_tackle_overhead_guest + $tmp_tackle_overhead_guest;
                $sum_guest_kick            = $sum_guest_kick + $tmp_guest_kick;
                $sum_guest_kick_goal       = $sum_guest_kick_goal + $tmp_guest_kick_goal;
                $sum_guest_lose            = $sum_guest_lose + $tmp_guest_lose;
                $sum_save_kick             = $sum_save_kick + $tmp_save_kick;
                $sum_save_penalty          = $sum_save_penalty + $tmp_save_penalty;
                $sum_punching              = $sum_punching + $tmp_punching;
                $sum_pass                  = $sum_pass + $tmp_pass;
                $sum_guest_pass            = $sum_guest_pass + $tmp_guest_pass;
                $sum_contribute            = $sum_contribute + $tmp_contribute;
            }
            // member temporary
            $goal                  = 0;
            $kick                  = 0;
            $kick_goal             = 0;
            $assist                = 0;
            $last_pass             = 0;
            $cross                 = 0;
            $pass_dribble          = 0;
            $fouled                = 0;
            $tackle                = 0;
            $steal                 = 0;
            $intercept             = 0;
            $shoot_block           = 0;
            $cross_block           = 0;
            $foul                  = 0;
            $clear                 = 0;
            $second_ball           = 0;
            $corner_kick           = 0;
            $free_kick             = 0;
            $pk                    = 0;
            $tackle_overhead_home  = 0;
            $tackle_overhead_guest = 0;
            $guest_kick            = 0;
            $guest_kick_goal       = 0;
            $guest_lose            = 0;
            $save_kick             = 0;
            $save_penalty          = 0;
            $punching              = 0;
            $pass                  = 0;
            $guest_pass            = 0;
            $contribute            = 0;
            $check_temporary       = false;

            foreach ($match as $key => $value) {
                $time = null;
                if ($request->round) {
                    if ($request->round == 1) {
                        $time = $value->round1_time;
                    } else if ($request->round == 2) {
                        $time = $value->round2_time;
                    } else if ($request->round == 3) {
                        $time = $value->round3_time;
                    } else if ($request->round == 4) {
                        $time = $value->round4_time;
                    } else if ($request->round == 5 || $request->round == 6) {
                        $time = $value->extra_time;
                    }
                }
                $ms_in_round1 = $time * 60000 / 3;
                $ms_in_round2 = $time * 60000 / 3 * 2;
                foreach ($stats as $key1 => $value1) {
                    if ($value1->match_id == $value->id) {
                        if ($request->sub_time == 1) {
                            if ($value1->timer_at <= $ms_in_round1) {
                                if ($value1->member_anonymous_id == $member_anonymous_home || $value1->member_anonymous_id == $member_anonymous_guest) {
                                    $check_temporary = true;
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->result == 1 && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $goal += 1;
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $kick += 1;
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $member_anonymous_home && in_array($value1->ball_goal_number, config('constants.goal_numbers'))) {
                                    $kick_goal += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.assist.id') && $value1->result == 1 && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $assist += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.assist.id') && $value1->result != 1 && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $last_pass += 1;
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $cross += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.pass.id') && $value1->member_anonymous_id == $member_anonymous_home && $value1->result == 1) {
                                    $pass_dribble += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.fouled.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $fouled += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.tackle.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $tackle += 1;
                                }
                                $contribution_data = json_decode($value1->action_contribution_data, true);
                                if ($value1->action_id == config('constants.action_map.tackle.id') && $value1->member_anonymous_id == $member_anonymous_home && isset($contribution_data['seize'])) {
                                    $steal += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.intercept.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $intercept += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.block.id') && $value1->member_anonymous_id == $member_anonymous_home && isset($contribution_data['shoot_block'])) {
                                    $shoot_block += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.block.id') && $value1->member_anonymous_id == $member_anonymous_home && isset($contribution_data['cross_block'])) {
                                    $cross_block += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.foul.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $foul += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.clear.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $clear += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.second_ball.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $second_ball += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.corner_kick.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $corner_kick += 1;
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.direct_free_kick.id'), config('constants.action_map.indirect_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $free_kick += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.pk_free_kick.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $pk += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.tackle_overhead.id') && $value1->member_anonymous_id == $member_anonymous_home && $value1->result == 1 && ($value1->is_pitch_home_area && !$value1->is_pitch_guest_area)) {
                                    $tackle_overhead_home += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.tackle_overhead.id') && $value1->member_anonymous_id == $member_anonymous_home && $value1->result == 1 && (!$value1->is_pitch_home_area && $value1->is_pitch_guest_area)) {
                                    $tackle_overhead_guest += 1;
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_anonymous_id == $member_anonymous_guest) {
                                    if ($value1->guest_gk_member_id == $value->id) {
                                        $guest_kick += 1;
                                    } elseif ($value1->home_gk_member_id == $value->id) {
                                        $guest_kick += 1;
                                    }
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_anonymous_id == $member_anonymous_guest && in_array($value1->ball_goal_number, config('constants.goal_numbers'))) {
                                    if ($value1->guest_gk_member_id == $value->id) {
                                        $guest_kick_goal += 1;
                                    } elseif ($value1->home_gk_member_id == $value->id) {
                                        $guest_kick_goal += 1;
                                    }
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_anonymous_id == $member_anonymous_guest && $value1->result == 1) {
                                    if ($value1->guest_gk_member_id == $value->id) {
                                        $guest_lose += 1;
                                    } elseif ($value1->home_gk_member_id == $value->id) {
                                        $guest_lose += 1;
                                    }
                                }
                                $contribution_score = json_decode($value1->action_contribution_score, true);
                                if ((in_array($value1->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && $value1->member_anonymous_id == $member_anonymous_home) || ($value1->member_anonymous_id == -2 && in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value1->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value1->result != 1)) {
                                    if (isset($contribution_data['shoot'])) {
                                        $save_kick += 1;
                                    } elseif (isset($contribution_score['stop_pk'])) {
                                        $save_kick += 1;
                                    } elseif ($value1->guest_gk_member_id == $value->id) {
                                        $save_kick += 1;
                                    } elseif ($value1->home_gk_member_id == $value->id) {
                                        $save_kick += 1;
                                    }
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && $value1->member_anonymous_id == $member_anonymous_home) {
                                    if ((isset($contribution_data['shoot']) || isset($contribution_score['stop_pk'])) && $value1->guest_gk_member_id == $value->id && $value1->is_pa_guest_area) {
                                        $save_penalty += 1;
                                    } else if ((isset($contribution_data['shoot']) || isset($contribution_score['stop_pk'])) && $value1->home_gk_member_id == $value->id && $value1->is_pa_home_area) {
                                        $save_penalty += 1;
                                    }
                                }
                                if (($value1->member_anonymous_id == -2 && in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value1->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value1->result != 1)) {
                                    if ($value1->guest_gk_member_id == $value->id && $value1->is_pa_guest_area) {
                                        $save_penalty += 1;
                                    } elseif ($value1->home_gk_member_id == $value->id && $value1->is_pa_home_area) {
                                        $save_penalty += 1;
                                    }
                                }
                                if ($value1->action_id == config('constants.action_map.punching.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $punching += 1;
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.punt_kick.id'), config('constants.action_map.throw_ball.id')]) && $value1->member_anonymous_id == $member_anonymous_home && isset($contribution_data['successful_own_pass'])) {
                                    $pass += 1;
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.punt_kick.id'), config('constants.action_map.throw_ball.id')]) && $value1->member_anonymous_id == $member_anonymous_home && isset($contribution_data['successful_enemy_pass'])) {
                                    $guest_pass += 1;
                                }
                                if ($value1->member_anonymous_id == $member_anonymous_home) {
                                    if ($value1->action_contribution_score) {
                                        $contribution_score = json_decode($value1->action_contribution_score, true);
                                        foreach ($contribution_score as $key2 => $value2) {
                                            $contribute += $value2;
                                        }
                                    }
                                }
                            }
                        } else if ($request->sub_time == 2) {
                            if ($value1->timer_at > $ms_in_round1 && $value1->timer_at <= $ms_in_round2) {
                                if ($value1->member_anonymous_id == $member_anonymous_home || $value1->member_anonymous_id == $member_anonymous_guest) {
                                    $check_temporary = true;
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->result == 1 && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $goal += 1;
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $kick += 1;
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $member_anonymous_home && in_array($value1->ball_goal_number, config('constants.goal_numbers'))) {
                                    $kick_goal += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.assist.id') && $value1->result == 1 && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $assist += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.assist.id') && $value1->result != 1 && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $last_pass += 1;
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $cross += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.pass.id') && $value1->member_anonymous_id == $member_anonymous_home && $value1->result == 1) {
                                    $pass_dribble += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.fouled.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $fouled += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.tackle.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $tackle += 1;
                                }
                                $contribution_data = json_decode($value1->action_contribution_data, true);
                                if ($value1->action_id == config('constants.action_map.tackle.id') && $value1->member_anonymous_id == $member_anonymous_home && isset($contribution_data['seize'])) {
                                    $steal += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.intercept.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $intercept += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.block.id') && $value1->member_anonymous_id == $member_anonymous_home && isset($contribution_data['shoot_block'])) {
                                    $shoot_block += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.block.id') && $value1->member_anonymous_id == $member_anonymous_home && isset($contribution_data['cross_block'])) {
                                    $cross_block += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.foul.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $foul += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.clear.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $clear += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.second_ball.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $second_ball += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.corner_kick.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $corner_kick += 1;
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.direct_free_kick.id'), config('constants.action_map.indirect_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $free_kick += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.pk_free_kick.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $pk += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.tackle_overhead.id') && $value1->member_anonymous_id == $member_anonymous_home && $value1->result == 1 && ($value1->is_pitch_home_area && !$value1->is_pitch_guest_area)) {
                                    $tackle_overhead_home += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.tackle_overhead.id') && $value1->member_anonymous_id == $member_anonymous_home && $value1->result == 1 && (!$value1->is_pitch_home_area && $value1->is_pitch_guest_area)) {
                                    $tackle_overhead_guest += 1;
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_anonymous_id == $member_anonymous_guest) {
                                    if ($value1->guest_gk_member_id == $value->id) {
                                        $guest_kick += 1;
                                    } elseif ($value1->home_gk_member_id == $value->id) {
                                        $guest_kick += 1;
                                    }
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_anonymous_id == $member_anonymous_guest && in_array($value1->ball_goal_number, config('constants.goal_numbers'))) {
                                    if ($value1->guest_gk_member_id == $value->id) {
                                        $guest_kick_goal += 1;
                                    } elseif ($value1->home_gk_member_id == $value->id) {
                                        $guest_kick_goal += 1;
                                    }
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_anonymous_id == $member_anonymous_guest && $value1->result == 1) {
                                    if ($value1->guest_gk_member_id == $value->id) {
                                        $guest_lose += 1;
                                    } elseif ($value1->home_gk_member_id == $value->id) {
                                        $guest_lose += 1;
                                    }
                                }
                                $contribution_score = json_decode($value1->action_contribution_score, true);
                                if ((in_array($value1->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && $value1->member_anonymous_id == $member_anonymous_home) || ($value1->member_anonymous_id == -2 && in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value1->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value1->result != 1)) {
                                    if (isset($contribution_data['shoot'])) {
                                        $save_kick += 1;
                                    } elseif (isset($contribution_score['stop_pk'])) {
                                        $save_kick += 1;
                                    } elseif ($value1->guest_gk_member_id == $value->id) {
                                        $save_kick += 1;
                                    } elseif ($value1->home_gk_member_id == $value->id) {
                                        $save_kick += 1;
                                    }
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && $value1->member_anonymous_id == $member_anonymous_home) {
                                    if ((isset($contribution_data['shoot']) || isset($contribution_score['stop_pk'])) && $value1->guest_gk_member_id == $value->id && $value1->is_pa_guest_area) {
                                        $save_penalty += 1;
                                    } else if ((isset($contribution_data['shoot']) || isset($contribution_score['stop_pk'])) && $value1->home_gk_member_id == $value->id && $value1->is_pa_home_area) {
                                        $save_penalty += 1;
                                    }
                                }
                                if (($value1->member_anonymous_id == -2 && in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value1->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value1->result != 1)) {
                                    if ($value1->guest_gk_member_id == $value->id && $value1->is_pa_guest_area) {
                                        $save_penalty += 1;
                                    } elseif ($value1->home_gk_member_id == $value->id && $value1->is_pa_home_area) {
                                        $save_penalty += 1;
                                    }
                                }
                                if ($value1->action_id == config('constants.action_map.punching.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $punching += 1;
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.punt_kick.id'), config('constants.action_map.throw_ball.id')]) && $value1->member_anonymous_id == $member_anonymous_home && isset($contribution_data['successful_own_pass'])) {
                                    $pass += 1;
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.punt_kick.id'), config('constants.action_map.throw_ball.id')]) && $value1->member_anonymous_id == $member_anonymous_home && isset($contribution_data['successful_enemy_pass'])) {
                                    $guest_pass += 1;
                                }
                                if ($value1->member_anonymous_id == $member_anonymous_home) {
                                    if ($value1->action_contribution_score) {
                                        $contribution_score = json_decode($value1->action_contribution_score, true);
                                        foreach ($contribution_score as $key2 => $value2) {
                                            $contribute += $value2;
                                        }
                                    }
                                }
                            }
                        } else if ($request->sub_time == 3) {
                            if ($value1->timer_at > $ms_in_round2) {
                                if ($value1->member_anonymous_id == $member_anonymous_home || $value1->member_anonymous_id == $member_anonymous_guest) {
                                    $check_temporary = true;
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->result == 1 && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $goal += 1;
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $kick += 1;
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $member_anonymous_home && in_array($value1->ball_goal_number, config('constants.goal_numbers'))) {
                                    $kick_goal += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.assist.id') && $value1->result == 1 && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $assist += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.assist.id') && $value1->result != 1 && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $last_pass += 1;
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $cross += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.pass.id') && $value1->member_anonymous_id == $member_anonymous_home && $value1->result == 1) {
                                    $pass_dribble += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.fouled.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $fouled += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.tackle.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $tackle += 1;
                                }
                                $contribution_data = json_decode($value1->action_contribution_data, true);
                                if ($value1->action_id == config('constants.action_map.tackle.id') && $value1->member_anonymous_id == $member_anonymous_home && isset($contribution_data['seize'])) {
                                    $steal += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.intercept.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $intercept += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.block.id') && $value1->member_anonymous_id == $member_anonymous_home && isset($contribution_data['shoot_block'])) {
                                    $shoot_block += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.block.id') && $value1->member_anonymous_id == $member_anonymous_home && isset($contribution_data['cross_block'])) {
                                    $cross_block += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.foul.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $foul += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.clear.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $clear += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.second_ball.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $second_ball += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.corner_kick.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $corner_kick += 1;
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.direct_free_kick.id'), config('constants.action_map.indirect_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $free_kick += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.pk_free_kick.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $pk += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.tackle_overhead.id') && $value1->member_anonymous_id == $member_anonymous_home && $value1->result == 1 && ($value1->is_pitch_home_area && !$value1->is_pitch_guest_area)) {
                                    $tackle_overhead_home += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.tackle_overhead.id') && $value1->member_anonymous_id == $member_anonymous_home && $value1->result == 1 && (!$value1->is_pitch_home_area && $value1->is_pitch_guest_area)) {
                                    $tackle_overhead_guest += 1;
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_anonymous_id == $member_anonymous_guest) {
                                    if ($value1->guest_gk_member_id == $value->id) {
                                        $guest_kick += 1;
                                    } elseif ($value1->home_gk_member_id == $value->id) {
                                        $guest_kick += 1;
                                    }
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_anonymous_id == $member_anonymous_guest && in_array($value1->ball_goal_number, config('constants.goal_numbers'))) {
                                    if ($value1->guest_gk_member_id == $value->id) {
                                        $guest_kick_goal += 1;
                                    } elseif ($value1->home_gk_member_id == $value->id) {
                                        $guest_kick_goal += 1;
                                    }
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_anonymous_id == $member_anonymous_guest && $value1->result == 1) {
                                    if ($value1->guest_gk_member_id == $value->id) {
                                        $guest_lose += 1;
                                    } elseif ($value1->home_gk_member_id == $value->id) {
                                        $guest_lose += 1;
                                    }
                                }
                                $contribution_score = json_decode($value1->action_contribution_score, true);
                                if ((in_array($value1->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && $value1->member_anonymous_id == $member_anonymous_home) || ($value1->member_anonymous_id == -2 && in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value1->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value1->result != 1)) {
                                    if (isset($contribution_data['shoot'])) {
                                        $save_kick += 1;
                                    } elseif (isset($contribution_score['stop_pk'])) {
                                        $save_kick += 1;
                                    } elseif ($value1->guest_gk_member_id == $value->id) {
                                        $save_kick += 1;
                                    } elseif ($value1->home_gk_member_id == $value->id) {
                                        $save_kick += 1;
                                    }
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && $value1->member_anonymous_id == $member_anonymous_home) {
                                    if ((isset($contribution_data['shoot']) || isset($contribution_score['stop_pk'])) && $value1->guest_gk_member_id == $value->id && $value1->is_pa_guest_area) {
                                        $save_penalty += 1;
                                    } else if ((isset($contribution_data['shoot']) || isset($contribution_score['stop_pk'])) && $value1->home_gk_member_id == $value->id && $value1->is_pa_home_area) {
                                        $save_penalty += 1;
                                    }
                                }
                                if (($value1->member_anonymous_id == -2 && in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value1->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value1->result != 1)) {
                                    if ($value1->guest_gk_member_id == $value->id && $value1->is_pa_guest_area) {
                                        $save_penalty += 1;
                                    } elseif ($value1->home_gk_member_id == $value->id && $value1->is_pa_home_area) {
                                        $save_penalty += 1;
                                    }
                                }
                                if ($value1->action_id == config('constants.action_map.punching.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $punching += 1;
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.punt_kick.id'), config('constants.action_map.throw_ball.id')]) && $value1->member_anonymous_id == $member_anonymous_home && isset($contribution_data['successful_own_pass'])) {
                                    $pass += 1;
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.punt_kick.id'), config('constants.action_map.throw_ball.id')]) && $value1->member_anonymous_id == $member_anonymous_home && isset($contribution_data['successful_enemy_pass'])) {
                                    $guest_pass += 1;
                                }
                                if ($value1->member_anonymous_id == $member_anonymous_home) {
                                    if ($value1->action_contribution_score) {
                                        $contribution_score = json_decode($value1->action_contribution_score, true);
                                        foreach ($contribution_score as $key2 => $value2) {
                                            $contribute += $value2;
                                        }
                                    }
                                }
                            }
                        } else {
                            if ($value1->member_anonymous_id == $member_anonymous_home || $value1->member_anonymous_id == $member_anonymous_guest) {
                                $check_temporary = true;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->result == 1 && $value1->member_anonymous_id == $member_anonymous_home) {
                                $goal += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $member_anonymous_home) {
                                $kick += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $member_anonymous_home && in_array($value1->ball_goal_number, config('constants.goal_numbers'))) {
                                $kick_goal += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.assist.id') && $value1->result == 1 && $value1->member_anonymous_id == $member_anonymous_home) {
                                $assist += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.assist.id') && $value1->result != 1 && $value1->member_anonymous_id == $member_anonymous_home) {
                                $last_pass += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && $value1->member_anonymous_id == $member_anonymous_home) {
                                $cross += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.pass.id') && $value1->member_anonymous_id == $member_anonymous_home && $value1->result == 1) {
                                $pass_dribble += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.fouled.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                $fouled += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.tackle.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                $tackle += 1;
                            }
                            $contribution_data = json_decode($value1->action_contribution_data, true);
                            if ($value1->action_id == config('constants.action_map.tackle.id') && $value1->member_anonymous_id == $member_anonymous_home && isset($contribution_data['seize'])) {
                                $steal += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.intercept.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                $intercept += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.block.id') && $value1->member_anonymous_id == $member_anonymous_home && isset($contribution_data['shoot_block'])) {
                                $shoot_block += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.block.id') && $value1->member_anonymous_id == $member_anonymous_home && isset($contribution_data['cross_block'])) {
                                $cross_block += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.foul.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                $foul += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.clear.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                $clear += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.second_ball.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                $second_ball += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.corner_kick.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                $corner_kick += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.direct_free_kick.id'), config('constants.action_map.indirect_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_anonymous_id == $member_anonymous_home) {
                                $free_kick += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.pk_free_kick.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                $pk += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.tackle_overhead.id') && $value1->member_anonymous_id == $member_anonymous_home && $value1->result == 1 && ($value1->is_pitch_home_area && !$value1->is_pitch_guest_area)) {
                                $tackle_overhead_home += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.tackle_overhead.id') && $value1->member_anonymous_id == $member_anonymous_home && $value1->result == 1 && (!$value1->is_pitch_home_area && $value1->is_pitch_guest_area)) {
                                $tackle_overhead_guest += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_anonymous_id == $member_anonymous_guest) {
                                if ($value1->guest_gk_member_id == $value->id) {
                                    $guest_kick += 1;
                                } elseif ($value1->home_gk_member_id == $value->id) {
                                    $guest_kick += 1;
                                }
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_anonymous_id == $member_anonymous_guest && in_array($value1->ball_goal_number, config('constants.goal_numbers'))) {
                                if ($value1->guest_gk_member_id == $value->id) {
                                    $guest_kick_goal += 1;
                                } elseif ($value1->home_gk_member_id == $value->id) {
                                    $guest_kick_goal += 1;
                                }
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_anonymous_id == $member_anonymous_guest && $value1->result == 1) {
                                if ($value1->guest_gk_member_id == $value->id) {
                                    $guest_lose += 1;
                                } elseif ($value1->home_gk_member_id == $value->id) {
                                    $guest_lose += 1;
                                }
                            }
                            $contribution_score = json_decode($value1->action_contribution_score, true);
                            if ((in_array($value1->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && $value1->member_anonymous_id == $member_anonymous_home) || ($value1->member_anonymous_id == -2 && in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value1->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value1->result != 1)) {
                                if (isset($contribution_data['shoot'])) {
                                    $save_kick += 1;
                                } elseif (isset($contribution_score['stop_pk'])) {
                                    $save_kick += 1;
                                } elseif ($value1->guest_gk_member_id == $value->id) {
                                    $save_kick += 1;
                                } elseif ($value1->home_gk_member_id == $value->id) {
                                    $save_kick += 1;
                                }
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && $value1->member_anonymous_id == $member_anonymous_home) {
                                if ((isset($contribution_data['shoot']) || isset($contribution_score['stop_pk'])) && $value1->guest_gk_member_id == $value->id && $value1->is_pa_guest_area) {
                                    $save_penalty += 1;
                                } else if ((isset($contribution_data['shoot']) || isset($contribution_score['stop_pk'])) && $value1->home_gk_member_id == $value->id && $value1->is_pa_home_area) {
                                    $save_penalty += 1;
                                }
                            }
                            if (($value1->member_anonymous_id == -2 && in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value1->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value1->result != 1)) {
                                if ($value1->guest_gk_member_id == $value->id && $value1->is_pa_guest_area) {
                                    $save_penalty += 1;
                                } elseif ($value1->home_gk_member_id == $value->id && $value1->is_pa_home_area) {
                                    $save_penalty += 1;
                                }
                            }
                            if ($value1->action_id == config('constants.action_map.punching.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                $punching += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.punt_kick.id'), config('constants.action_map.throw_ball.id')]) && $value1->member_anonymous_id == $member_anonymous_home && isset($contribution_data['successful_own_pass'])) {
                                $pass += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.punt_kick.id'), config('constants.action_map.throw_ball.id')]) && $value1->member_anonymous_id == $member_anonymous_home && isset($contribution_data['successful_enemy_pass'])) {
                                $guest_pass += 1;
                            }
                            if ($value1->member_anonymous_id == $member_anonymous_home) {
                                if ($value1->action_contribution_score) {
                                    $contribution_score = json_decode($value1->action_contribution_score, true);
                                    foreach ($contribution_score as $key2 => $value2) {
                                        $contribute += $value2;
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if ($check_temporary === true) {
                $member_temporary                          = [];
                $member_temporary['first_name']            = '仮選手';
                $member_temporary['last_name']             = '';
                $member_temporary['position_name']         = '?';
                $member_temporary['number_official']       = '?';
                $member_temporary['goal']                  = $goal;
                $member_temporary['kick']                  = $kick;
                $member_temporary['kick_goal']             = $kick_goal;
                $member_temporary['assist']                = $assist;
                $member_temporary['last_pass']             = $last_pass;
                $member_temporary['cross']                 = $cross;
                $member_temporary['pass_dribble']          = $pass_dribble;
                $member_temporary['fouled']                = $fouled;
                $member_temporary['tackle']                = $tackle;
                $member_temporary['steal']                 = $steal;
                $member_temporary['intercept']             = $intercept;
                $member_temporary['shoot_block']           = $shoot_block;
                $member_temporary['cross_block']           = $cross_block;
                $member_temporary['foul']                  = $foul;
                $member_temporary['clear']                 = $clear;
                $member_temporary['second_ball']           = $second_ball;
                $member_temporary['corner_kick']           = $corner_kick;
                $member_temporary['free_kick']             = $free_kick;
                $member_temporary['pk']                    = $pk;
                $member_temporary['tackle_overhead_home']  = $tackle_overhead_home;
                $member_temporary['tackle_overhead_guest'] = $tackle_overhead_guest;
                $member_temporary['guest_kick']            = $guest_kick;
                $member_temporary['guest_kick_goal']       = $guest_kick_goal;
                $member_temporary['guest_lose']            = $guest_lose;
                $member_temporary['save_kick']             = $save_kick;
                $member_temporary['save_penalty']          = $save_penalty;
                $member_temporary['punching']              = $punching;
                $member_temporary['pass']                  = $pass;
                $member_temporary['guest_pass']            = $guest_pass;
                $member_temporary['contribute']            = $contribute;
                $member->push((object) $member_temporary);
                // end member temporary
            }

            // sum and avg
            $sum['goal']                  = $sum_goal + $goal;
            $sum['kick']                  = $sum_kick + $kick;
            $sum['kick_goal']             = $sum_kick_goal + $kick_goal;
            $sum['assist']                = $sum_assist + $assist;
            $sum['last_pass']             = $sum_last_pass + $last_pass;
            $sum['cross']                 = $sum_cross + $cross;
            $sum['pass_dribble']          = $sum_pass_dribble + $pass_dribble;
            $sum['fouled']                = $sum_fouled + $fouled;
            $sum['tackle']                = $sum_tackle + $tackle;
            $sum['steal']                 = $sum_steal + $steal;
            $sum['intercept']             = $sum_intercept + $intercept;
            $sum['shoot_block']           = $sum_shoot_block + $shoot_block;
            $sum['cross_block']           = $sum_cross_block + $cross_block;
            $sum['foul']                  = $sum_foul + $foul;
            $sum['clear']                 = $sum_clear + $clear;
            $sum['second_ball']           = $sum_second_ball + $second_ball;
            $sum['corner_kick']           = $sum_corner_kick + $corner_kick;
            $sum['free_kick']             = $sum_free_kick + $free_kick;
            $sum['pk']                    = $sum_pk + $pk;
            $sum['tackle_overhead_home']  = $sum_tackle_overhead_home + $tackle_overhead_home;
            $sum['tackle_overhead_guest'] = $sum_tackle_overhead_guest + $tackle_overhead_guest;
            $sum['guest_kick']            = $sum_guest_kick + $guest_kick;
            $sum['guest_kick_goal']       = $sum_guest_kick_goal + $guest_kick_goal;
            $sum['guest_lose']            = $sum_guest_lose + $guest_lose;
            $sum['save_kick']             = $sum_save_kick + $save_kick;
            $sum['save_penalty']          = $sum_save_penalty + $save_penalty;
            $sum['punching']              = $sum_punching + $punching;
            $sum['pass']                  = $sum_pass + $pass;
            $sum['guest_pass']            = $sum_guest_pass + $guest_pass;
            $sum['contribute']            = $sum_contribute + $contribute;

            $avg['goal']                  = $this->avg($sum['goal'], count($member));
            $avg['kick']                  = $this->avg($sum['kick'], count($member));
            $avg['kick_goal']             = $this->avg($sum['kick_goal'], count($member));
            $avg['assist']                = $this->avg($sum['assist'], count($member));
            $avg['last_pass']             = $this->avg($sum['last_pass'], count($member));
            $avg['cross']                 = $this->avg($sum['cross'], count($member));
            $avg['pass_dribble']          = $this->avg($sum['pass_dribble'], count($member));
            $avg['fouled']                = $this->avg($sum['fouled'], count($member));
            $avg['tackle']                = $this->avg($sum['tackle'], count($member));
            $avg['steal']                 = $this->avg($sum['steal'], count($member));
            $avg['intercept']             = $this->avg($sum['intercept'], count($member));
            $avg['shoot_block']           = $this->avg($sum['shoot_block'], count($member));
            $avg['cross_block']           = $this->avg($sum['cross_block'], count($member));
            $avg['foul']                  = $this->avg($sum['foul'], count($member));
            $avg['clear']                 = $this->avg($sum['clear'], count($member));
            $avg['second_ball']           = $this->avg($sum['second_ball'], count($member));
            $avg['corner_kick']           = $this->avg($sum['corner_kick'], count($member));
            $avg['free_kick']             = $this->avg($sum['free_kick'], count($member));
            $avg['pk']                    = $this->avg($sum['pk'], count($member));
            $avg['tackle_overhead_home']  = $this->avg($sum['tackle_overhead_home'], count($member));
            $avg['tackle_overhead_guest'] = $this->avg($sum['tackle_overhead_guest'], count($member));
            $avg['guest_kick']            = $this->avg($sum['guest_kick'], count($member));
            $avg['guest_kick_goal']       = $this->avg($sum['guest_kick_goal'], count($member));
            $avg['guest_lose']            = $this->avg($sum['guest_lose'], count($member));
            $avg['save_kick']             = $this->avg($sum['save_kick'], count($member));
            $avg['save_penalty']          = $this->avg($sum['save_penalty'], count($member));
            $avg['punching']              = $this->avg($sum['punching'], count($member));
            $avg['pass']                  = $this->avg($sum['pass'], count($member));
            $avg['guest_pass']            = $this->avg($sum['guest_pass'], count($member));
            $avg['contribute']            = $this->avg($sum['contribute'], count($member));
        } else {
            foreach ($member as $key => $value) {
                $tmp_goal                  = 0;
                $tmp_kick_goal             = 0;
                $tmp_tackle_overhead_home  = 0;
                $tmp_tackle_overhead_guest = 0;
                $tmp_pass_dribble          = 0;
                $tmp_cross                 = 0;
                $tmp_tackle                = 0;
                $tmp_clear                 = 0;
                $tmp_second_ball           = 0;
                $tmp_save                  = 0;
                $tmp_catch_cross           = 0;
                $tmp_lose                  = 0;
                foreach ($match as $key1 => $value1) {
                    $time = null;
                    if ($request->round) {
                        if ($request->round == 1) {
                            $time = $value1->round1_time;
                        } else if ($request->round == 2) {
                            $time = $value1->round2_time;
                        } else if ($request->round == 3) {
                            $time = $value1->round3_time;
                        } else if ($request->round == 4) {
                            $time = $value1->round4_time;
                        } else if ($request->round == 5 || $request->round == 6) {
                            $time = $value1->extra_time;
                        }
                    }
                    $box_score_personal        = TransformDataStat::boxScorePersonalProbability($stats, $member_id, $value, $value1, $time, $request->sub_time);
                    $tmp_goal                  = $tmp_goal + $box_score_personal['ratio_goal'];
                    $tmp_kick_goal             = $tmp_kick_goal + $box_score_personal['ratio_kick_goal'];
                    $tmp_tackle_overhead_home  = $tmp_tackle_overhead_home + $box_score_personal['ratio_tackle_overhead_home'];
                    $tmp_tackle_overhead_guest = $tmp_tackle_overhead_guest + $box_score_personal['ratio_tackle_overhead_guest'];
                    $tmp_pass_dribble          = $tmp_pass_dribble + $box_score_personal['ratio_pass_dribble'];
                    $tmp_cross                 = $tmp_cross + $box_score_personal['ratio_cross'];
                    $tmp_tackle                = $tmp_tackle + $box_score_personal['ratio_tackle'];
                    $tmp_clear                 = $tmp_clear + $box_score_personal['ratio_clear'];
                    $tmp_second_ball           = $tmp_second_ball + $box_score_personal['ratio_second_ball'];
                    $tmp_save                  = $tmp_save + $box_score_personal['ratio_save'];
                    $tmp_catch_cross           = $tmp_catch_cross + $box_score_personal['ratio_catch_cross'];
                    $tmp_lose                  = $tmp_lose + $box_score_personal['ratio_lose'];
                }
                $member[$key]->ratio_goal                  = $tmp_goal;
                $member[$key]->ratio_kick_goal             = $tmp_kick_goal;
                $member[$key]->ratio_tackle_overhead_home  = $tmp_tackle_overhead_home;
                $member[$key]->ratio_tackle_overhead_guest = $tmp_tackle_overhead_guest;
                $member[$key]->ratio_pass_dribble          = $tmp_pass_dribble;
                $member[$key]->ratio_cross                 = $tmp_cross;
                $member[$key]->ratio_tackle                = $tmp_tackle;
                $member[$key]->ratio_clear                 = $tmp_clear;
                $member[$key]->ratio_second_ball           = $tmp_second_ball;
                $member[$key]->ratio_save                  = $tmp_save;
                $member[$key]->ratio_catch_cross           = $tmp_catch_cross;
                $member[$key]->ratio_lose                  = $tmp_lose;

                $sum_ratio_goal                  = $sum_ratio_goal + $tmp_goal;
                $sum_ratio_kick_goal             = $sum_ratio_kick_goal + $tmp_kick_goal;
                $sum_ratio_tackle_overhead_home  = $sum_ratio_tackle_overhead_home + $tmp_tackle_overhead_home;
                $sum_ratio_tackle_overhead_guest = $sum_ratio_tackle_overhead_guest + $tmp_tackle_overhead_guest;
                $sum_ratio_pass_dribble          = $sum_ratio_pass_dribble + $tmp_pass_dribble;
                $sum_ratio_cross                 = $sum_ratio_cross + $tmp_cross;
                $sum_ratio_tackle                = $sum_ratio_tackle + $tmp_tackle;
                $sum_ratio_clear                 = $sum_ratio_clear + $tmp_clear;
                $sum_ratio_second_ball           = $sum_ratio_second_ball + $tmp_second_ball;
                $sum_ratio_save                  = $sum_ratio_save + $tmp_save;
                $sum_ratio_catch_cross           = $sum_ratio_catch_cross + $tmp_catch_cross;
                $sum_ratio_lose                  = $sum_ratio_lose + $tmp_lose;
            }
            // member temporary
            $goal                        = 0;
            $kick                        = 0;
            $kick_goal                   = 0;
            $tackle_overhead_home        = 0;
            $total_tackle_overhead_home  = 0;
            $tackle_overhead_guest       = 0;
            $total_tackle_overhead_guest = 0;
            $pass_dribble                = 0;
            $total_pass_dribble          = 0;
            $cross                       = 0;
            $total_cross                 = 0;
            $tackle                      = 0;
            $total_tackle                = 0;
            $clear                       = 0;
            $total_clear                 = 0;
            $second_ball                 = 0;
            $total_second_ball           = 0;
            $save                        = 0;
            $total_save                  = 0;
            $catch_cross                 = 0;
            $total_catch_cross           = 0;
            $lose                        = 0;
            $total_lose                  = 0;
            $check_temporary             = false;

            foreach ($match as $key => $value) {
                $time = null;
                if ($request->round) {
                    if ($request->round == 1) {
                        $time = $value->round1_time;
                    } else if ($request->round == 2) {
                        $time = $value->round2_time;
                    } else if ($request->round == 3) {
                        $time = $value->round3_time;
                    } else if ($request->round == 4) {
                        $time = $value->round4_time;
                    } else if ($request->round == 5 || $request->round == 6) {
                        $time = $value->extra_time;
                    }
                }
                $ms_in_round1 = $time * 60000 / 3;
                $ms_in_round2 = $time * 60000 / 3 * 2;
                foreach ($stats as $key1 => $value1) {
                    if ($value1->match_id == $value->id) {
                        if ($request->sub_time == 1) {
                            if ($value1->timer_at <= $ms_in_round1) {
                                if ($value1->member_anonymous_id == $member_anonymous_home || $value1->member_anonymous_id == $member_anonymous_guest) {
                                    $check_temporary = true;
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $kick += 1;
                                    if ($value1->result == 1) {
                                        $goal += 1;
                                    }
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $member_anonymous_home && in_array($value1->ball_goal_number, config('constants.goal_numbers'))) {
                                    $kick_goal += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.tackle_overhead.id') && ($value1->member_anonymous_id == $member_anonymous_home || $value1->member_anonymous_id == $member_anonymous_guest)) {
                                    if ($value1->is_pitch_home_area) {
                                        $total_tackle_overhead_home += 1;
                                        if ($value1->member_anonymous_id == $member_anonymous_home) {
                                            $tackle_overhead_home += 1;
                                        }
                                    }
                                    if ($value1->is_pitch_guest_area) {
                                        $total_tackle_overhead_guest += 1;
                                        if ($value1->member_anonymous_id == $member_anonymous_home) {
                                            $tackle_overhead_guest += 1;
                                        }
                                    }
                                }
                                if ($value1->action_id == config('constants.action_map.pass.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $total_pass_dribble += 1;
                                    if ($value1->result == 1) {
                                        $pass_dribble += 1;
                                    }
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $total_cross += 1;
                                    if ($value1->result == 1) {
                                        $cross += 1;
                                    }
                                }
                                $contribution_data = json_decode($value1->action_contribution_data, true);
                                if ($value1->action_id == config('constants.action_map.tackle.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $total_tackle += 1;
                                    if (isset($contribution_data['seize'])) {
                                        $tackle += 1;
                                    }
                                }
                                if ($value1->action_id == config('constants.action_map.clear.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $total_clear += 1;
                                    if ($value1->result == 1) {
                                        $clear += 1;
                                    }
                                }
                                if ($value1->action_id == config('constants.action_map.second_ball.id') && ($value1->member_anonymous_id == $member_anonymous_home || $value1->member_anonymous_id == $member_anonymous_guest)) {
                                    $total_second_ball += 1;
                                    if ($value1->result == 1 && $value1->member_anonymous_id == $member_anonymous_home) {
                                        $second_ball += 1;
                                    }
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $member_anonymous_guest) {
                                    if ($value1->guest_gk_member_id == $value->id) {
                                        $total_save += 1;
                                    } elseif ($value1->home_gk_member_id == $value->id) {
                                        $total_save += 1;
                                    }
                                }
                                $contribution_score = json_decode($value1->action_contribution_score, true);
                                if ((in_array($value1->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && $value1->member_anonymous_id == $member_anonymous_home) || ($value1->member_anonymous_id == -2 && in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value1->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value1->result != 1)) {
                                    if (isset($contribution_data['shoot'])) {
                                        $save += 1;
                                    } elseif (isset($contribution_score['stop_pk'])) {
                                        $save += 1;
                                    } elseif ($value1->guest_gk_member_id == $value->id) {
                                        $save += 1;
                                    } elseif ($value1->home_gk_member_id == $value->id) {
                                        $save += 1;
                                    }
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && $value1->member_anonymous_id == $member_anonymous_guest) {
                                    if ($value1->guest_gk_member_id == $value->id) {
                                        $total_catch_cross += 1;
                                    } elseif ($value1->home_gk_member_id == $value->id) {
                                        $total_catch_cross += 1;
                                    }
                                }
                                if ($value1->action_id == config('constants.action_map.catching.id') && $value1->member_anonymous_id == $member_anonymous_home && isset($contribution_data['cross'])) {
                                    $catch_cross += 1;
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $member_anonymous_guest) {
                                    if ($value1->guest_gk_member_id == $value->id) {
                                        $total_lose += 1;
                                    } elseif ($value1->home_gk_member_id == $value->id) {
                                        $total_lose += 1;
                                    }
                                    if ($value1->result == 1) {
                                        $lose += 1;
                                    }
                                }
                            }
                        } else if ($request->sub_time == 2) {
                            if ($value1->timer_at > $ms_in_round1 && $value1->timer_at <= $ms_in_round2) {
                                if ($value1->member_anonymous_id == $member_anonymous_home || $value1->member_anonymous_id == $member_anonymous_guest) {
                                    $check_temporary = true;
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $kick += 1;
                                    if ($value1->result == 1) {
                                        $goal += 1;
                                    }
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $member_anonymous_home && in_array($value1->ball_goal_number, config('constants.goal_numbers'))) {
                                    $kick_goal += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.tackle_overhead.id') && ($value1->member_anonymous_id == $member_anonymous_home || $value1->member_anonymous_id == $member_anonymous_guest)) {
                                    if ($value1->is_pitch_home_area) {
                                        $total_tackle_overhead_home += 1;
                                        if ($value1->member_anonymous_id == $member_anonymous_home) {
                                            $tackle_overhead_home += 1;
                                        }
                                    }
                                    if ($value1->is_pitch_guest_area) {
                                        $total_tackle_overhead_guest += 1;
                                        if ($value1->member_anonymous_id == $member_anonymous_home) {
                                            $tackle_overhead_guest += 1;
                                        }
                                    }
                                }
                                if ($value1->action_id == config('constants.action_map.pass.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $total_pass_dribble += 1;
                                    if ($value1->result == 1) {
                                        $pass_dribble += 1;
                                    }
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $total_cross += 1;
                                    if ($value1->result == 1) {
                                        $cross += 1;
                                    }
                                }
                                $contribution_data = json_decode($value1->action_contribution_data, true);
                                if ($value1->action_id == config('constants.action_map.tackle.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $total_tackle += 1;
                                    if (isset($contribution_data['seize'])) {
                                        $tackle += 1;
                                    }
                                }
                                if ($value1->action_id == config('constants.action_map.clear.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $total_clear += 1;
                                    if ($value1->result == 1) {
                                        $clear += 1;
                                    }
                                }
                                if ($value1->action_id == config('constants.action_map.second_ball.id') && ($value1->member_anonymous_id == $member_anonymous_home || $value1->member_anonymous_id == $member_anonymous_guest)) {
                                    $total_second_ball += 1;
                                    if ($value1->result == 1 && $value1->member_anonymous_id == $member_anonymous_home) {
                                        $second_ball += 1;
                                    }
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $member_anonymous_guest) {
                                    if ($value1->guest_gk_member_id == $value->id) {
                                        $total_save += 1;
                                    } elseif ($value1->home_gk_member_id == $value->id) {
                                        $total_save += 1;
                                    }
                                }
                                $contribution_score = json_decode($value1->action_contribution_score, true);
                                if ((in_array($value1->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && $value1->member_anonymous_id == $member_anonymous_home) || ($value1->member_anonymous_id == -2 && in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value1->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value1->result != 1)) {
                                    if (isset($contribution_data['shoot'])) {
                                        $save += 1;
                                    } elseif (isset($contribution_score['stop_pk'])) {
                                        $save += 1;
                                    } elseif ($value1->guest_gk_member_id == $value->id) {
                                        $save += 1;
                                    } elseif ($value1->home_gk_member_id == $value->id) {
                                        $save += 1;
                                    }
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && $value1->member_anonymous_id == $member_anonymous_guest) {
                                    if ($value1->guest_gk_member_id == $value->id) {
                                        $total_catch_cross += 1;
                                    } elseif ($value1->home_gk_member_id == $value->id) {
                                        $total_catch_cross += 1;
                                    }
                                }
                                if ($value1->action_id == config('constants.action_map.catching.id') && $value1->member_anonymous_id == $member_anonymous_home && isset($contribution_data['cross'])) {
                                    $catch_cross += 1;
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $member_anonymous_guest) {
                                    if ($value1->guest_gk_member_id == $value->id) {
                                        $total_lose += 1;
                                    } elseif ($value1->home_gk_member_id == $value->id) {
                                        $total_lose += 1;
                                    }
                                    if ($value1->result == 1) {
                                        $lose += 1;
                                    }
                                }
                            }
                        } else if ($request->sub_time == 3) {
                            if ($value1->timer_at > $ms_in_round2) {
                                if ($value1->member_anonymous_id == $member_anonymous_home || $value1->member_anonymous_id == $member_anonymous_guest) {
                                    $check_temporary = true;
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $kick += 1;
                                    if ($value1->result == 1) {
                                        $goal += 1;
                                    }
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $member_anonymous_home && in_array($value1->ball_goal_number, config('constants.goal_numbers'))) {
                                    $kick_goal += 1;
                                }
                                if ($value1->action_id == config('constants.action_map.tackle_overhead.id') && ($value1->member_anonymous_id == $member_anonymous_home || $value1->member_anonymous_id == $member_anonymous_guest)) {
                                    if ($value1->is_pitch_home_area) {
                                        $total_tackle_overhead_home += 1;
                                        if ($value1->member_anonymous_id == $member_anonymous_home) {
                                            $tackle_overhead_home += 1;
                                        }
                                    }
                                    if ($value1->is_pitch_guest_area) {
                                        $total_tackle_overhead_guest += 1;
                                        if ($value1->member_anonymous_id == $member_anonymous_home) {
                                            $tackle_overhead_guest += 1;
                                        }
                                    }
                                }
                                if ($value1->action_id == config('constants.action_map.pass.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $total_pass_dribble += 1;
                                    if ($value1->result == 1) {
                                        $pass_dribble += 1;
                                    }
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $total_cross += 1;
                                    if ($value1->result == 1) {
                                        $cross += 1;
                                    }
                                }
                                $contribution_data = json_decode($value1->action_contribution_data, true);
                                if ($value1->action_id == config('constants.action_map.tackle.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $total_tackle += 1;
                                    if (isset($contribution_data['seize'])) {
                                        $tackle += 1;
                                    }
                                }
                                if ($value1->action_id == config('constants.action_map.clear.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $total_clear += 1;
                                    if ($value1->result == 1) {
                                        $clear += 1;
                                    }
                                }
                                if ($value1->action_id == config('constants.action_map.second_ball.id') && ($value1->member_anonymous_id == $member_anonymous_home || $value1->member_anonymous_id == $member_anonymous_guest)) {
                                    $total_second_ball += 1;
                                    if ($value1->result == 1 && $value1->member_anonymous_id == $member_anonymous_home) {
                                        $second_ball += 1;
                                    }
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $member_anonymous_guest) {
                                    if ($value1->guest_gk_member_id == $value->id) {
                                        $total_save += 1;
                                    } elseif ($value1->home_gk_member_id == $value->id) {
                                        $total_save += 1;
                                    }
                                }
                                $contribution_score = json_decode($value1->action_contribution_score, true);
                                if ((in_array($value1->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && $value1->member_anonymous_id == $member_anonymous_home) || ($value1->member_anonymous_id == -2 && in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value1->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value1->result != 1)) {
                                    if (isset($contribution_data['shoot'])) {
                                        $save += 1;
                                    } elseif (isset($contribution_score['stop_pk'])) {
                                        $save += 1;
                                    } elseif ($value1->guest_gk_member_id == $value->id) {
                                        $save += 1;
                                    } elseif ($value1->home_gk_member_id == $value->id) {
                                        $save += 1;
                                    }
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && $value1->member_anonymous_id == $member_anonymous_guest) {
                                    if ($value1->guest_gk_member_id == $value->id) {
                                        $total_catch_cross += 1;
                                    } elseif ($value1->home_gk_member_id == $value->id) {
                                        $total_catch_cross += 1;
                                    }
                                }
                                if ($value1->action_id == config('constants.action_map.catching.id') && $value1->member_anonymous_id == $member_anonymous_home && isset($contribution_data['cross'])) {
                                    $catch_cross += 1;
                                }
                                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $member_anonymous_guest) {
                                    if ($value1->guest_gk_member_id == $value->id) {
                                        $total_lose += 1;
                                    } elseif ($value1->home_gk_member_id == $value->id) {
                                        $total_lose += 1;
                                    }
                                    if ($value1->result == 1) {
                                        $lose += 1;
                                    }
                                }
                            }
                        } else {
                            if ($value1->member_anonymous_id == $member_anonymous_home || $value1->member_anonymous_id == $member_anonymous_guest) {
                                $check_temporary = true;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $member_anonymous_home) {
                                $kick += 1;
                                if ($value1->result == 1) {
                                    $goal += 1;
                                }
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $member_anonymous_home && in_array($value1->ball_goal_number, config('constants.goal_numbers'))) {
                                $kick_goal += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.tackle_overhead.id') && ($value1->member_anonymous_id == $member_anonymous_home || $value1->member_anonymous_id == $member_anonymous_guest)) {
                                if ($value1->is_pitch_home_area) {
                                    $total_tackle_overhead_home += 1;
                                    if ($value1->member_anonymous_id == $member_anonymous_home) {
                                        $tackle_overhead_home += 1;
                                    }
                                }
                                if ($value1->is_pitch_guest_area) {
                                    $total_tackle_overhead_guest += 1;
                                    if ($value1->member_anonymous_id == $member_anonymous_home) {
                                        $tackle_overhead_guest += 1;
                                    }
                                }
                            }
                            if ($value1->action_id == config('constants.action_map.pass.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                $total_pass_dribble += 1;
                                if ($value1->result == 1) {
                                    $pass_dribble += 1;
                                }
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && $value1->member_anonymous_id == $member_anonymous_home) {
                                $total_cross += 1;
                                if ($value1->result == 1) {
                                    $cross += 1;
                                }
                            }
                            $contribution_data = json_decode($value1->action_contribution_data, true);
                            if ($value1->action_id == config('constants.action_map.tackle.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                $total_tackle += 1;
                                if (isset($contribution_data['seize'])) {
                                    $tackle += 1;
                                }
                            }
                            if ($value1->action_id == config('constants.action_map.clear.id') && $value1->member_anonymous_id == $member_anonymous_home) {
                                $total_clear += 1;
                                if ($value1->result == 1) {
                                    $clear += 1;
                                }
                            }
                            if ($value1->action_id == config('constants.action_map.second_ball.id') && ($value1->member_anonymous_id == $member_anonymous_home || $value1->member_anonymous_id == $member_anonymous_guest)) {
                                $total_second_ball += 1;
                                if ($value1->result == 1 && $value1->member_anonymous_id == $member_anonymous_home) {
                                    $second_ball += 1;
                                }
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $member_anonymous_guest) {
                                if ($value1->guest_gk_member_id == $value->id) {
                                    $total_save += 1;
                                } elseif ($value1->home_gk_member_id == $value->id) {
                                    $total_save += 1;
                                }
                            }
                            $contribution_score = json_decode($value1->action_contribution_score, true);
                            if ((in_array($value1->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && $value1->member_anonymous_id == $member_anonymous_home) || ($value1->member_anonymous_id == -2 && in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value1->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value1->result != 1)) {
                                if (isset($contribution_data['shoot'])) {
                                    $save += 1;
                                } elseif (isset($contribution_score['stop_pk'])) {
                                    $save += 1;
                                } elseif ($value1->guest_gk_member_id == $value->id) {
                                    $save += 1;
                                } elseif ($value1->home_gk_member_id == $value->id) {
                                    $save += 1;
                                }
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && $value1->member_anonymous_id == $member_anonymous_guest) {
                                if ($value1->guest_gk_member_id == $value->id) {
                                    $total_catch_cross += 1;
                                } elseif ($value1->home_gk_member_id == $value->id) {
                                    $total_catch_cross += 1;
                                }
                            }
                            if ($value1->action_id == config('constants.action_map.catching.id') && $value1->member_anonymous_id == $member_anonymous_home && isset($contribution_data['cross'])) {
                                $catch_cross += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $member_anonymous_guest) {
                                if ($value1->guest_gk_member_id == $value->id) {
                                    $total_lose += 1;
                                } elseif ($value1->home_gk_member_id == $value->id) {
                                    $total_lose += 1;
                                }
                                if ($value1->result == 1) {
                                    $lose += 1;
                                }
                            }
                        }
                    }
                }
            }
            $ratio_goal                  = $this->getResult($goal, $kick);
            $ratio_kick_goal             = $this->getResult($kick_goal, $kick);
            $ratio_tackle_overhead_home  = $this->getResult($tackle_overhead_home, $total_tackle_overhead_home);
            $ratio_tackle_overhead_guest = $this->getResult($tackle_overhead_guest, $total_tackle_overhead_guest);
            $ratio_pass_dribble          = $this->getResult($pass_dribble, $total_pass_dribble);
            $ratio_cross                 = $this->getResult($cross, $total_cross);
            $ratio_tackle                = $this->getResult($tackle, $total_tackle);
            $ratio_clear                 = $this->getResult($clear, $total_clear);
            $ratio_second_ball           = $this->getResult($second_ball, $total_second_ball);
            $ratio_save                  = $this->getResult($save, $total_save);
            $ratio_catch_cross           = $this->getResult($catch_cross, $total_catch_cross);
            $ratio_lose                  = $this->getResult($lose, $total_lose);

            if ($check_temporary == true) {
                $member_temporary                                = [];
                $member_temporary['first_name']                  = '仮選手';
                $member_temporary['last_name']                   = '';
                $member_temporary['position_name']               = '?';
                $member_temporary['number_official']             = '?';
                $member_temporary['ratio_goal']                  = $ratio_goal;
                $member_temporary['ratio_kick_goal']             = $ratio_kick_goal;
                $member_temporary['ratio_tackle_overhead_home']  = $ratio_tackle_overhead_home;
                $member_temporary['ratio_tackle_overhead_guest'] = $ratio_tackle_overhead_guest;
                $member_temporary['ratio_pass_dribble']          = $ratio_pass_dribble;
                $member_temporary['ratio_cross']                 = $ratio_cross;
                $member_temporary['ratio_clear']                 = $ratio_clear;
                $member_temporary['ratio_tackle']                = $ratio_tackle;
                $member_temporary['ratio_second_ball']           = $ratio_second_ball;
                $member_temporary['ratio_save']                  = $ratio_save;
                $member_temporary['ratio_catch_cross']           = $ratio_catch_cross;
                $member_temporary['ratio_lose']                  = $ratio_lose;
                $member->push((object) $member_temporary);
                // end member temporary
            }

            $sum_ratio_goal                  = $sum_ratio_goal + $ratio_goal;
            $sum_ratio_kick_goal             = $sum_ratio_kick_goal + $ratio_kick_goal;
            $sum_ratio_tackle_overhead_home  = $sum_ratio_tackle_overhead_home + $ratio_tackle_overhead_home;
            $sum_ratio_tackle_overhead_guest = $sum_ratio_tackle_overhead_guest + $ratio_tackle_overhead_guest;
            $sum_ratio_pass_dribble          = $sum_ratio_pass_dribble + $ratio_pass_dribble;
            $sum_ratio_cross                 = $sum_ratio_cross + $ratio_cross;
            $sum_ratio_tackle                = $sum_ratio_tackle + $ratio_tackle;
            $sum_ratio_clear                 = $sum_ratio_clear + $ratio_clear;
            $sum_ratio_second_ball           = $sum_ratio_second_ball + $ratio_second_ball;
            $sum_ratio_save                  = $sum_ratio_save + $ratio_save;
            $sum_ratio_catch_cross           = $sum_ratio_catch_cross + $ratio_catch_cross;
            $sum_ratio_lose                  = $sum_ratio_lose + $ratio_lose;

            // avg
            $avg['ratio_goal']                  = $this->avg($sum_ratio_goal, count($member));
            $avg['ratio_kick_goal']             = $this->avg($sum_ratio_kick_goal, count($member));
            $avg['ratio_tackle_overhead_home']  = $this->avg($sum_ratio_tackle_overhead_home, count($member));
            $avg['ratio_tackle_overhead_guest'] = $this->avg($sum_ratio_tackle_overhead_guest, count($member));
            $avg['ratio_pass_dribble']          = $this->avg($sum_ratio_pass_dribble, count($member));
            $avg['ratio_cross']                 = $this->avg($sum_ratio_cross, count($member));
            $avg['ratio_tackle']                = $this->avg($sum_ratio_tackle, count($member));
            $avg['ratio_clear']                 = $this->avg($sum_ratio_clear, count($member));
            $avg['ratio_second_ball']           = $this->avg($sum_ratio_tackle_overhead_guest, count($member));
            $avg['ratio_save']                  = $this->avg($sum_ratio_save, count($member));
            $avg['ratio_catch_cross']           = $this->avg($sum_ratio_catch_cross, count($member));
            $avg['ratio_lose']                  = $this->avg($sum_ratio_lose, count($member));
        }
        return response()->json(['result' => true, 'data' => $member, 'sum' => (object) $sum, 'avg' => (object) $avg], 200);
    }

    public function personalByMatch(Request $request)
    {
        $team_home = $this->__teamRepo->getTeamIsHome(Auth::guard('web')->user()->id);
        $match     = $this->__matchRepo->getMatchStat($request->all(), $team_home->id);
        $match_id  = $match->pluck('id')->toArray();
        $match     = $match->get();
        if (empty($match)) {
            return response()->json(['result' => true, 'message' => 'Null']);
        }
        $member    = $this->__memberRepo->getMemberStats($team_home->id);
        $member_id = $member->pluck('id')->toArray();
        $member    = $member->get();
        $stats     = $this->__statRepo->getStatsTeams($match_id, $request->round);
        foreach ($member as $key => $value) {
            $array                     = [];
            $sum_goal                  = 0;
            $sum_kick                  = 0;
            $sum_kick_goal             = 0;
            $sum_assist                = 0;
            $sum_last_pass             = 0;
            $sum_cross                 = 0;
            $sum_pass_dribble          = 0;
            $sum_fouled                = 0;
            $sum_tackle                = 0;
            $sum_steal                 = 0;
            $sum_intercept             = 0;
            $sum_shoot_block           = 0;
            $sum_cross_block           = 0;
            $sum_foul                  = 0;
            $sum_clear                 = 0;
            $sum_second_ball           = 0;
            $sum_corner_kick           = 0;
            $sum_free_kick             = 0;
            $sum_pk                    = 0;
            $sum_tackle_overhead_home  = 0;
            $sum_tackle_overhead_guest = 0;
            $sum_guest_kick            = 0;
            $sum_guest_kick_goal       = 0;
            $sum_guest_lose            = 0;
            $sum_save_kick             = 0;
            $sum_save_penalty          = 0;
            $sum_punching              = 0;
            $sum_pass                  = 0;
            $sum_guest_pass            = 0;
            $sum_contribute            = 0;

            $sum_ratio_goal                  = 0;
            $sum_ratio_kick_goal             = 0;
            $sum_ratio_tackle_overhead_home  = 0;
            $sum_ratio_tackle_overhead_guest = 0;
            $sum_ratio_pass_dribble          = 0;
            $sum_ratio_cross                 = 0;
            $sum_ratio_tackle                = 0;
            $sum_ratio_clear                 = 0;
            $sum_ratio_second_ball           = 0;
            $sum_ratio_save                  = 0;
            $sum_ratio_catch_cross           = 0;
            $sum_ratio_lose                  = 0;
            $count                           = 0;
            if ($request->personal_type == 1) {
                foreach ($match as $key1 => $value1) {
                    $time  = null;
                    $check = false;
                    if ($request->round) {
                        if ($request->round == 1) {
                            $time  = $value1->round1_time;
                            $check = true;
                        } else if ($request->round == 2) {
                            $time  = $value1->round2_time;
                            $check = true;
                        } else if ($request->round == 3) {
                            $time  = $value1->round3_time;
                            $check = true;
                        } else if ($request->round == 4) {
                            $time  = $value1->round4_time;
                            $check = true;
                        } else if ($request->round == 5 || $request->round == 6) {
                            $time  = $value1->extra_time;
                            $check = true;
                        }
                    }
                    if ($check && is_null($time)) {
                        $array[$key1]['start_date']            = date("Y/m/d", strtotime($value1->start_date));
                        $array[$key1]['team1_name']            = $value1->team1->name;
                        $array[$key1]['team2_name']            = $value1->team2->name;
                        $array[$key1]['goal']                  = '--';
                        $array[$key1]['kick']                  = '--';
                        $array[$key1]['kick_goal']             = '--';
                        $array[$key1]['assist']                = '--';
                        $array[$key1]['last_pass']             = '--';
                        $array[$key1]['cross']                 = '--';
                        $array[$key1]['pass_dribble']          = '--';
                        $array[$key1]['fouled']                = '--';
                        $array[$key1]['tackle']                = '--';
                        $array[$key1]['steal']                 = '--';
                        $array[$key1]['intercept']             = '--';
                        $array[$key1]['shoot_block']           = '--';
                        $array[$key1]['cross_block']           = '--';
                        $array[$key1]['foul']                  = '--';
                        $array[$key1]['clear']                 = '--';
                        $array[$key1]['second_ball']           = '--';
                        $array[$key1]['corner_kick']           = '--';
                        $array[$key1]['free_kick']             = '--';
                        $array[$key1]['ok']                    = '--';
                        $array[$key1]['tackle_overhead_home']  = '--';
                        $array[$key1]['tackle_overhead_guest'] = '--';
                        $array[$key1]['guest_kick']            = '--';
                        $array[$key1]['guest_kick_goal']       = '--';
                        $array[$key1]['guest_lose']            = '--';
                        $array[$key1]['save_kick']             = '--';
                        $array[$key1]['save_penalty']          = '--';
                        $array[$key1]['punching']              = '--';
                        $array[$key1]['pass']                  = '--';
                        $array[$key1]['guest_pass']            = '--';
                        $array[$key1]['contribute']            = '--';
                    } else {
                        $count += 1;
                        $box_score_personal_number             = TransformDataStat::boxScorePersonalNumber($stats, $member_id, $value, $value1, $time, $request->sub_time);
                        $array[$key1]['start_date']            = date("Y/m/d", strtotime($value1->start_date));
                        $array[$key1]['team1_name']            = $value1->team1->name;
                        $array[$key1]['team2_name']            = $value1->team2->name;
                        $array[$key1]['goal']                  = $box_score_personal_number['goal'];
                        $array[$key1]['kick']                  = $box_score_personal_number['kick'];
                        $array[$key1]['kick_goal']             = $box_score_personal_number['kick_goal'];
                        $array[$key1]['assist']                = $box_score_personal_number['assist'];
                        $array[$key1]['last_pass']             = $box_score_personal_number['last_pass'];
                        $array[$key1]['cross']                 = $box_score_personal_number['cross'];
                        $array[$key1]['pass_dribble']          = $box_score_personal_number['pass_dribble'];
                        $array[$key1]['fouled']                = $box_score_personal_number['fouled'];
                        $array[$key1]['tackle']                = $box_score_personal_number['tackle'];
                        $array[$key1]['steal']                 = $box_score_personal_number['steal'];
                        $array[$key1]['intercept']             = $box_score_personal_number['intercept'];
                        $array[$key1]['shoot_block']           = $box_score_personal_number['shoot_block'];
                        $array[$key1]['cross_block']           = $box_score_personal_number['cross_block'];
                        $array[$key1]['foul']                  = $box_score_personal_number['foul'];
                        $array[$key1]['clear']                 = $box_score_personal_number['clear'];
                        $array[$key1]['second_ball']           = $box_score_personal_number['second_ball'];
                        $array[$key1]['corner_kick']           = $box_score_personal_number['corner_kick'];
                        $array[$key1]['free_kick']             = $box_score_personal_number['free_kick'];
                        $array[$key1]['pk']                    = $box_score_personal_number['pk'];
                        $array[$key1]['tackle_overhead_home']  = $box_score_personal_number['tackle_overhead_home'];
                        $array[$key1]['tackle_overhead_guest'] = $box_score_personal_number['tackle_overhead_guest'];
                        $array[$key1]['guest_kick']            = $box_score_personal_number['guest_kick'];
                        $array[$key1]['guest_kick_goal']       = $box_score_personal_number['guest_kick_goal'];
                        $array[$key1]['guest_lose']            = $box_score_personal_number['guest_lose'];
                        $array[$key1]['save_kick']             = $box_score_personal_number['save_kick'];
                        $array[$key1]['save_penalty']          = $box_score_personal_number['save_penalty'];
                        $array[$key1]['punching']              = $box_score_personal_number['punching'];
                        $array[$key1]['pass']                  = $box_score_personal_number['pass'];
                        $array[$key1]['guest_pass']            = $box_score_personal_number['guest_pass'];
                        $array[$key1]['contribute']            = $box_score_personal_number['contribute'];

                        $sum_goal                  = $sum_goal + $box_score_personal_number['goal'];
                        $sum_kick                  = $sum_kick + $box_score_personal_number['kick'];
                        $sum_kick_goal             = $sum_kick_goal + $box_score_personal_number['kick_goal'];
                        $sum_assist                = $sum_assist + $box_score_personal_number['assist'];
                        $sum_last_pass             = $sum_last_pass + $box_score_personal_number['last_pass'];
                        $sum_cross                 = $sum_cross + $box_score_personal_number['cross'];
                        $sum_pass_dribble          = $sum_pass_dribble + $box_score_personal_number['pass_dribble'];
                        $sum_fouled                = $sum_fouled + $box_score_personal_number['fouled'];
                        $sum_tackle                = $sum_tackle + $box_score_personal_number['tackle'];
                        $sum_steal                 = $sum_steal + $box_score_personal_number['steal'];
                        $sum_intercept             = $sum_intercept + $box_score_personal_number['intercept'];
                        $sum_shoot_block           = $sum_shoot_block + $box_score_personal_number['shoot_block'];
                        $sum_cross_block           = $sum_cross_block + $box_score_personal_number['cross_block'];
                        $sum_foul                  = $sum_foul + $box_score_personal_number['foul'];
                        $sum_clear                 = $sum_clear + $box_score_personal_number['clear'];
                        $sum_second_ball           = $sum_second_ball + $box_score_personal_number['second_ball'];
                        $sum_corner_kick           = $sum_corner_kick + $box_score_personal_number['corner_kick'];
                        $sum_free_kick             = $sum_free_kick + $box_score_personal_number['free_kick'];
                        $sum_pk                    = $sum_pk + $box_score_personal_number['pk'];
                        $sum_tackle_overhead_home  = $sum_tackle_overhead_home + $box_score_personal_number['tackle_overhead_home'];
                        $sum_tackle_overhead_guest = $sum_tackle_overhead_guest + $box_score_personal_number['tackle_overhead_guest'];
                        $sum_guest_kick            = $sum_guest_kick + $box_score_personal_number['guest_kick'];
                        $sum_guest_kick_goal       = $sum_guest_kick_goal + $box_score_personal_number['guest_kick_goal'];
                        $sum_guest_lose            = $sum_guest_lose + $box_score_personal_number['guest_lose'];
                        $sum_save_kick             = $sum_save_kick + $box_score_personal_number['save_kick'];
                        $sum_save_penalty          = $sum_save_penalty + $box_score_personal_number['save_penalty'];
                        $sum_punching              = $sum_punching + $box_score_personal_number['punching'];
                        $sum_pass                  = $sum_pass + $box_score_personal_number['pass'];
                        $sum_guest_pass            = $sum_guest_pass + $box_score_personal_number['guest_pass'];
                        $sum_contribute            = $sum_contribute + $box_score_personal_number['contribute'];
                    }
                }
                $member[$key]->match                     = $array;
                $member[$key]->sum_goal                  = $sum_goal;
                $member[$key]->sum_kick                  = $sum_kick;
                $member[$key]->sum_kick_goal             = $sum_kick_goal;
                $member[$key]->sum_assist                = $sum_assist;
                $member[$key]->sum_last_pass             = $sum_last_pass;
                $member[$key]->sum_cross                 = $sum_cross;
                $member[$key]->sum_pass_dribble          = $sum_pass_dribble;
                $member[$key]->sum_fouled                = $sum_fouled;
                $member[$key]->sum_tackle                = $sum_tackle;
                $member[$key]->sum_steal                 = $sum_steal;
                $member[$key]->sum_intercept             = $sum_intercept;
                $member[$key]->sum_shoot_block           = $sum_shoot_block;
                $member[$key]->sum_cross_block           = $sum_cross_block;
                $member[$key]->sum_foul                  = $sum_foul;
                $member[$key]->sum_clear                 = $sum_clear;
                $member[$key]->sum_second_ball           = $sum_second_ball;
                $member[$key]->sum_corner_kick           = $sum_corner_kick;
                $member[$key]->sum_free_kick             = $sum_free_kick;
                $member[$key]->sum_pk                    = $sum_pk;
                $member[$key]->sum_tackle_overhead_home  = $sum_tackle_overhead_home;
                $member[$key]->sum_tackle_overhead_guest = $sum_tackle_overhead_guest;
                $member[$key]->sum_guest_kick            = $sum_guest_kick;
                $member[$key]->sum_guest_kick_goal       = $sum_guest_kick_goal;
                $member[$key]->sum_guest_lose            = $sum_guest_lose;
                $member[$key]->sum_save_kick             = $sum_save_kick;
                $member[$key]->sum_save_penalty          = $sum_save_penalty;
                $member[$key]->sum_punching              = $sum_punching;
                $member[$key]->sum_pass                  = $sum_pass;
                $member[$key]->sum_guest_pass            = $sum_guest_pass;
                $member[$key]->sum_contribute            = $sum_contribute;

                $member[$key]->avg_goal                  = $this->avg($sum_goal, $count);
                $member[$key]->avg_kick                  = $this->avg($sum_kick, $count);
                $member[$key]->avg_kick_goal             = $this->avg($sum_kick_goal, $count);
                $member[$key]->avg_assist                = $this->avg($sum_assist, $count);
                $member[$key]->avg_last_pass             = $this->avg($sum_last_pass, $count);
                $member[$key]->avg_cross                 = $this->avg($sum_cross, $count);
                $member[$key]->avg_pass_dribble          = $this->avg($sum_pass_dribble, $count);
                $member[$key]->avg_fouled                = $this->avg($sum_fouled, $count);
                $member[$key]->avg_tackle                = $this->avg($sum_tackle, $count);
                $member[$key]->avg_steal                 = $this->avg($sum_steal, $count);
                $member[$key]->avg_intercept             = $this->avg($sum_intercept, $count);
                $member[$key]->avg_shoot_block           = $this->avg($sum_shoot_block, $count);
                $member[$key]->avg_cross_block           = $this->avg($sum_cross_block, $count);
                $member[$key]->avg_foul                  = $this->avg($sum_foul, $count);
                $member[$key]->avg_clear                 = $this->avg($sum_clear, $count);
                $member[$key]->avg_second_ball           = $this->avg($sum_second_ball, $count);
                $member[$key]->avg_corner_kick           = $this->avg($sum_corner_kick, $count);
                $member[$key]->avg_free_kick             = $this->avg($sum_free_kick, $count);
                $member[$key]->avg_pk                    = $this->avg($sum_pk, $count);
                $member[$key]->avg_tackle_overhead_home  = $this->avg($sum_tackle_overhead_home, $count);
                $member[$key]->avg_tackle_overhead_guest = $this->avg($sum_tackle_overhead_guest, $count);
                $member[$key]->avg_guest_kick            = $this->avg($sum_guest_kick, $count);
                $member[$key]->avg_guest_kick_goal       = $this->avg($sum_guest_kick_goal, $count);
                $member[$key]->avg_guest_lose            = $this->avg($sum_guest_lose, $count);
                $member[$key]->avg_save_kick             = $this->avg($sum_save_kick, $count);
                $member[$key]->avg_save_penalty          = $this->avg($sum_save_penalty, $count);
                $member[$key]->avg_punching              = $this->avg($sum_punching, $count);
                $member[$key]->avg_pass                  = $this->avg($sum_pass, $count);
                $member[$key]->avg_guest_pass            = $this->avg($sum_guest_pass, $count);
                $member[$key]->avg_contribute            = $this->avg($sum_contribute, $count);
            } else {
                foreach ($match as $key1 => $value1) {
                    $time  = null;
                    $check = false;
                    if ($request->round) {
                        if ($request->round == 1) {
                            $time  = $value1->round1_time;
                            $check = true;
                        } else if ($request->round == 2) {
                            $time  = $value1->round2_time;
                            $check = true;
                        } else if ($request->round == 3) {
                            $time  = $value1->round3_time;
                            $check = true;
                        } else if ($request->round == 4) {
                            $time  = $value1->round4_time;
                            $check = true;
                        } else if ($request->round == 5 || $request->round == 6) {
                            $time  = $value1->extra_time;
                            $check = true;
                        }
                    }
                    if ($check && is_null($time)) {
                        $array[$key1]['start_date']                  = date("Y/m/d", strtotime($value1->start_date));
                        $array[$key1]['team1_name']                  = $value1->team1->name;
                        $array[$key1]['team2_name']                  = $value1->team2->name;
                        $array[$key1]['ratio_goal']                  = '--';
                        $array[$key1]['ratio_kick_goal']             = '--';
                        $array[$key1]['ratio_tackle_overhead_home']  = '--';
                        $array[$key1]['ratio_tackle_overhead_guest'] = '--';
                        $array[$key1]['ratio_pass_dribble']          = '--';
                        $array[$key1]['ratio_cross']                 = '--';
                        $array[$key1]['ratio_tackle']                = '--';
                        $array[$key1]['ratio_clear']                 = '--';
                        $array[$key1]['ratio_second_ball']           = '--';
                        $array[$key1]['ratio_save']                  = '--';
                        $array[$key1]['ratio_catch_cross']           = '--';
                        $array[$key1]['ratio_lose']                  = '--';
                    } else {
                        $count += 1;
                        $box_score_personal_probability              = TransformDataStat::boxScorePersonalProbability($stats, $member_id, $value, $value1, $time, $request->sub_time);
                        $array[$key1]['start_date']                  = date("Y/m/d", strtotime($value1->start_date));
                        $array[$key1]['team1_name']                  = $value1->team1->name;
                        $array[$key1]['team2_name']                  = $value1->team2->name;
                        $array[$key1]['ratio_goal']                  = $box_score_personal_probability['ratio_goal'];
                        $array[$key1]['ratio_kick_goal']             = $box_score_personal_probability['ratio_kick_goal'];
                        $array[$key1]['ratio_tackle_overhead_home']  = $box_score_personal_probability['ratio_tackle_overhead_home'];
                        $array[$key1]['ratio_tackle_overhead_guest'] = $box_score_personal_probability['ratio_tackle_overhead_guest'];
                        $array[$key1]['ratio_pass_dribble']          = $box_score_personal_probability['ratio_pass_dribble'];
                        $array[$key1]['ratio_cross']                 = $box_score_personal_probability['ratio_cross'];
                        $array[$key1]['ratio_tackle']                = $box_score_personal_probability['ratio_tackle'];
                        $array[$key1]['ratio_clear']                 = $box_score_personal_probability['ratio_clear'];
                        $array[$key1]['ratio_second_ball']           = $box_score_personal_probability['ratio_second_ball'];
                        $array[$key1]['ratio_save']                  = $box_score_personal_probability['ratio_save'];
                        $array[$key1]['ratio_catch_cross']           = $box_score_personal_probability['ratio_catch_cross'];
                        $array[$key1]['ratio_lose']                  = $box_score_personal_probability['ratio_lose'];

                        $sum_ratio_goal                  = $sum_ratio_goal + $box_score_personal_probability['ratio_goal'];
                        $sum_ratio_kick_goal             = $sum_ratio_kick_goal + $box_score_personal_probability['ratio_kick_goal'];
                        $sum_ratio_tackle_overhead_home  = $sum_ratio_tackle_overhead_home + $box_score_personal_probability['ratio_tackle_overhead_home'];
                        $sum_ratio_tackle_overhead_guest = $sum_ratio_tackle_overhead_guest + $box_score_personal_probability['ratio_tackle_overhead_guest'];
                        $sum_ratio_pass_dribble          = $sum_ratio_pass_dribble + $box_score_personal_probability['ratio_pass_dribble'];
                        $sum_ratio_cross                 = $sum_ratio_cross + $box_score_personal_probability['ratio_cross'];
                        $sum_ratio_tackle                = $sum_ratio_tackle + $box_score_personal_probability['ratio_tackle'];
                        $sum_ratio_clear                 = $sum_ratio_clear + $box_score_personal_probability['ratio_clear'];
                        $sum_ratio_second_ball           = $sum_ratio_second_ball + $box_score_personal_probability['ratio_second_ball'];
                        $sum_ratio_save                  = $sum_ratio_save + $box_score_personal_probability['ratio_save'];
                        $sum_ratio_catch_cross           = $sum_ratio_catch_cross + $box_score_personal_probability['ratio_catch_cross'];
                        $sum_ratio_lose                  = $sum_ratio_lose + $box_score_personal_probability['ratio_lose'];
                    }
                }
                $member[$key]->match                           = $array;
                $member[$key]->avg_ratio_goal                  = $this->avg($sum_ratio_goal, $count);
                $member[$key]->avg_ratio_kick_goal             = $this->avg($sum_ratio_kick_goal, $count);
                $member[$key]->avg_ratio_tackle_overhead_home  = $this->avg($sum_ratio_tackle_overhead_home, $count);
                $member[$key]->avg_ratio_tackle_overhead_guest = $this->avg($sum_ratio_tackle_overhead_guest, $count);
                $member[$key]->avg_ratio_pass_dribble          = $this->avg($sum_ratio_pass_dribble, $count);
                $member[$key]->avg_ratio_cross                 = $this->avg($sum_ratio_cross, $count);
                $member[$key]->avg_ratio_tackle                = $this->avg($sum_ratio_tackle, $count);
                $member[$key]->avg_ratio_clear                 = $this->avg($sum_ratio_clear, $count);
                $member[$key]->avg_ratio_second_ball           = $this->avg($sum_ratio_tackle_overhead_guest, $count);
                $member[$key]->avg_ratio_save                  = $this->avg($sum_ratio_save, $count);
                $member[$key]->avg_ratio_catch_cross           = $this->avg($sum_ratio_catch_cross, $count);
                $member[$key]->avg_ratio_lose                  = $this->avg($sum_ratio_lose, $count);
            }

        }
        return response()->json(['result' => true, 'data' => $member], 200);
    }

    public function chart(Request $request)
    {
        $team = $this->__teamRepo->find($request->team);
        return view('web.period_aggregations.chart', compact('team'));
    }

    public function getStats(Request $request)
    {
        $team_home       = $this->__teamRepo->getTeamIsHome(Auth::guard('web')->user()->id);
        $member_home     = $this->__memberRepo->getMemberStats($team_home->id)->get();
        $member_home_id  = $this->__memberRepo->getMemberStats($team_home->id)->pluck('id')->toArray();
        $member_guest    = $this->__memberRepo->getMemberStats($request->team)->get();
        $member_guest_id = $this->__memberRepo->getMemberStats($request->team)->pluck('id')->toArray();
        $match           = $this->__matchRepo->getMatchStat($request->all(), $team_home->id);
        $match_id        = $match->pluck('id')->toArray();
        $match           = $match->get();
        $stats           = $this->__statRepo->getStats($match_id);
        return response()->json(['result' => true, 'team_home' => $team_home, 'member_home' => $member_home, 'member_home_id' => $member_home_id, 'member_guest' => $member_guest, 'member_guest_id' => $member_guest_id, 'match' => $match, 'stats' => $stats], 200);
    }
}

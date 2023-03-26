<?php

namespace App\Http\Controllers\Web;

use App\Helpers\TransformDataStat;
use App\Repositories\FolderRepository;
use App\Repositories\LineUpRepository;
use App\Repositories\MatchRepository;
use App\Repositories\MemberRepository;
use App\Repositories\StatRepository;
use App\Repositories\StatsVideoRepository;
use App\Repositories\TeamRepository;
use App\Repositories\VideoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScorebookMatchesStatController extends BaseController
{
    protected $__matchRepo;protected $__lineUpRepo;
    protected $__teamRepo;
    protected $__statRepo;
    protected $__memberRepo;
    protected $__folderRepo;
    protected $__videoRepo;
    protected $__statsVideoRepo;

    public function __construct(MatchRepository $matchRepository, LineUpRepository $lineUpRepository, TeamRepository $teamRepo, StatRepository $statRepo, MemberRepository $memberRepo, FolderRepository $folderRepo, VideoRepository $videoRepo, StatsVideoRepository $statsVideoRepo)
    {
        $this->__matchRepo      = $matchRepository;
        $this->__lineUpRepo     = $lineUpRepository;
        $this->__teamRepo       = $teamRepo;
        $this->__statRepo       = $statRepo;
        $this->__memberRepo     = $memberRepo;
        $this->__folderRepo     = $folderRepo;
        $this->__videoRepo      = $videoRepo;
        $this->__statsVideoRepo = $statsVideoRepo;
    }

    public function index($id, Request $request)
    {
        $auth_id    = Auth::guard('web')->user()->id;
        $match_list = $this->__matchRepo->getListMatchByAuth($auth_id)->pluck('id')->toArray();
        if (!in_array($id, $match_list)) {
           return abort(404);
        }else {
            $match = $this->__matchRepo->findByIdWithRelationship($id);
            if ($match) {
                $color_team1 = $match->team1->color_home;
                if ($match->team_color1 == 2) {
                    $color_team1 = $match->team1->color_guest;
                }
                $color_team2 = $match->team2->color_home;
                if ($match->team_color2 == 2) {
                    $color_team2 = $match->team2->color_guest;
                }
                $member_id_team1 = $this->__memberRepo->getMemberStats($match->team1->id)->pluck('id')->toArray();
                $member_id_team2 = $this->__memberRepo->getMemberStats($match->team2->id)->pluck('id')->toArray();
                $stats           = $this->__statRepo->getStatsTeam($match->id);
                $goal            = [];
                $goal_team1      = 0;
                $goal_team2      = 0;
                $goal_1st_team1  = 0;
                $goal_1st_team2  = 0;
                $goal_2nd_team1  = 0;
                $goal_2nd_team2  = 0;
                $goal_3rd_team1  = 0;
                $goal_3rd_team2  = 0;
                $goal_4th_team1  = 0;
                $goal_4th_team2  = 0;
                $goal_ext1_team1 = 0;
                $goal_ext1_team2 = 0;
                $goal_ext2_team1 = 0;
                $goal_ext2_team2 = 0;
                foreach ($stats as $key => $value) {
                    if ($value->action_id == config('constants.action_map.kick.id') && $value->result == 1 && $value->created_at_round == '_1ST' && in_array($value->member_id, $member_id_team1)) {
                        $goal_1st_team1 += 1;
                    }
                    if ($value->action_id == config('constants.action_map.kick.id') && $value->result == 1 && $value->created_at_round == '_1ST' && in_array($value->member_id, $member_id_team2)) {
                        $goal_1st_team2 += 1;
                    }
                    if ($value->action_id == config('constants.action_map.kick.id') && $value->result == 1 && $value->created_at_round == '_2ND' && in_array($value->member_id, $member_id_team1)) {
                        $goal_2nd_team1 += 1;
                    }
                    if ($value->action_id == config('constants.action_map.kick.id') && $value->result == 1 && $value->created_at_round == '_2ND' && in_array($value->member_id, $member_id_team2)) {
                        $goal_2nd_team2 += 1;
                    }
                    if ($value->action_id == config('constants.action_map.kick.id') && $value->result == 1 && $value->created_at_round == '_3RD' && in_array($value->member_id, $member_id_team1)) {
                        $goal_3rd_team1 += 1;
                    }
                    if ($value->action_id == config('constants.action_map.kick.id') && $value->result == 1 && $value->created_at_round == '_3RD' && in_array($value->member_id, $member_id_team2)) {
                        $goal_3rd_team2 += 1;
                    }
                    if ($value->action_id == config('constants.action_map.kick.id') && $value->result == 1 && $value->created_at_round == '_4TH' && in_array($value->member_id, $member_id_team1)) {
                        $goal_4th_team1 += 1;
                    }
                    if ($value->action_id == config('constants.action_map.kick.id') && $value->result == 1 && $value->created_at_round == '_4TH' && in_array($value->member_id, $member_id_team2)) {
                        $goal_4th_team2 += 1;
                    }
                    if ($value->action_id == config('constants.action_map.kick.id') && $value->result == 1 && $value->created_at_round == '_EXT1' && in_array($value->member_id, $member_id_team1)) {
                        $goal_ext1_team1 += 1;
                    }
                    if ($value->action_id == config('constants.action_map.kick.id') && $value->result == 1 && $value->created_at_round == '_EXT1' && in_array($value->member_id, $member_id_team2)) {
                        $goal_ext1_team2 += 1;
                    }
                    if ($value->action_id == config('constants.action_map.kick.id') && $value->result == 1 && $value->created_at_round == '_EXT2' && in_array($value->member_id, $member_id_team1)) {
                        $goal_ext2_team1 += 1;
                    }
                    if ($value->action_id == config('constants.action_map.kick.id') && $value->result == 1 && $value->created_at_round == '_EXT2' && in_array($value->member_id, $member_id_team2)) {
                        $goal_ext2_team2 += 1;
                    }
                    if ($value->action_id == config('constants.action_map.kick.id') && $value->result == 1 && in_array($value->member_id, $member_id_team1)) {
                        $goal_team1 += 1;
                    }
                    if ($value->action_id == config('constants.action_map.kick.id') && $value->result == 1 && in_array($value->member_id, $member_id_team2)) {
                        $goal_team2 += 1;
                    }
                }
                $goal['goal_1st_team1']  = $goal_1st_team1;
                $goal['goal_1st_team2']  = $goal_1st_team2;
                $goal['goal_2nd_team1']  = $goal_2nd_team1;
                $goal['goal_2nd_team2']  = $goal_2nd_team2;
                $goal['goal_3rd_team1']  = $goal_3rd_team1;
                $goal['goal_3rd_team2']  = $goal_3rd_team2;
                $goal['goal_4th_team1']  = $goal_4th_team1;
                $goal['goal_4th_team2']  = $goal_4th_team2;
                $goal['goal_ext1_team1'] = $goal_ext1_team1;
                $goal['goal_ext1_team2'] = $goal_ext1_team2;
                $goal['goal_ext2_team1'] = $goal_ext2_team1;
                $goal['goal_ext2_team2'] = $goal_ext2_team2;
                $goal['match_team1']     = $goal_team1;
                $goal['match_team2']     = $goal_team2;
                $goal['color_team1']     = config('constants.team_color.' . $color_team1);
                $goal['color_team2']     = config('constants.team_color.' . $color_team2);
                $goal['color_team1_id']  = $color_team1;
                $goal['color_team2_id']  = $color_team2;
                $goal                    = (object) $goal;

                $match_common_info = $this->__matchRepo->getCommonInfo($id);
                return view('web.scorebook.matches_stat', compact('match', 'goal', 'id', 'match_common_info'));
            }
            return abort(404);
        }

    }

    public function avg($value, $count)
    {
        if ($value === 0) {
            return 0;
        }

        return round($value / $count, 1);
    }

    public function getResult($counterValue, $counterTotal)
    {
        if ($counterTotal === 0) {
            return 0;
        }

        return round(($counterValue / $counterTotal) * 100, 0);
    }

    public function timePeriod()
    {

    }

    public function personal($id, Request $request)
    {
        $match = $this->__matchRepo->findByIdWithRelationship($id);
        $time  = 0;
        if ($request->round) {
            if ($request->round == 1) {
                $time = $match->round1_time;
            } else if ($request->round == 2) {
                $time = $match->round2_time;
            } else if ($request->round == 3) {
                $time = $match->round3_time;
            } else if ($request->round == 4) {
                $time = $match->round4_time;
            } else if ($request->round == 5 || $request->round == 6) {
                $time = $match->extra_time;
            }
        }
        $team_home     = $match->team2->id;
        $line_up_home  = $match->lineup_id2;
        $team_guest    = $match->team1->id;
        $line_up_guest = $match->lineup_id1;
        if ($match->team1->is_home == 1 || $match->team2->is_home != 1) {
            $team_home     = $match->team1->id;
            $line_up_home  = $match->lineup_id1;
            $team_guest    = $match->team2->id;
            $line_up_guest = $match->lineup_id2;
        }
        $team               = $request->team == 1 ? $team_home : $team_guest;
        $line_up            = $request->team == 1 ? $line_up_home : $line_up_guest;
        $temporary          = $request->team == 1 ? -1 : -2;
        $negative_temporary = $request->team == 1 ? -2 : -1;
        $line_up            = $this->__lineUpRepo->findInWeb($line_up);
        $member_id          = [];
        foreach ($line_up->starting as $value) {
            array_push($member_id, $value['member_id']);
        }
        foreach ($line_up->substitute as $value) {
            array_push($member_id, $value['member_id']);
        }
        $member  = $this->__memberRepo->getMemberScoreBookStats($team, $member_id)->get();
        $members = $this->__memberRepo->getMemberStats($team)->get();
        $stats   = $this->__statRepo->getStatsTeamByTimePeriodInRound($match->id, $request->round, $time, $request->sub_time);
        foreach ($stats as $key => $value) {
            if ($value->action_id == config('constants.action_map.change_member_in.id') && !in_array($value->member_id, $member_id)) {
                $member_find = $this->__memberRepo->find($value->member_id);
                if (isset($member_find) && $member_find->team_id == $team) {
                    $member_caculator                    = [];
                    $member_caculator['id']              = $value->member_id;
                    $member_caculator['first_name']      = '?';
                    $member_caculator['last_name']       = '';
                    $member_caculator['position_name']   = '?';
                    $member_caculator['number_official'] = $member_find->number_official;
                    $member->push((object) $member_caculator);
                    array_push($member_id, $value->member_id);
                }
            }
        }
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
                $box_score_personal                  = TransformDataStat::boxScorePersonalNumber($stats, $member_id, $value);
                $member[$key]->goal                  = $box_score_personal['goal'];
                $member[$key]->kick                  = $box_score_personal['kick'];
                $member[$key]->kick_goal             = $box_score_personal['kick_goal'];
                $member[$key]->assist                = $box_score_personal['assist'];
                $member[$key]->last_pass             = $box_score_personal['last_pass'];
                $member[$key]->cross                 = $box_score_personal['cross'];
                $member[$key]->pass_dribble          = $box_score_personal['pass_dribble'];
                $member[$key]->fouled                = $box_score_personal['fouled'];
                $member[$key]->tackle                = $box_score_personal['tackle'];
                $member[$key]->steal                 = $box_score_personal['steal'];
                $member[$key]->intercept             = $box_score_personal['intercept'];
                $member[$key]->shoot_block           = $box_score_personal['shoot_block'];
                $member[$key]->cross_block           = $box_score_personal['cross_block'];
                $member[$key]->foul                  = $box_score_personal['foul'];
                $member[$key]->clear                 = $box_score_personal['clear'];
                $member[$key]->second_ball           = $box_score_personal['second_ball'];
                $member[$key]->corner_kick           = $box_score_personal['corner_kick'];
                $member[$key]->free_kick             = $box_score_personal['free_kick'];
                $member[$key]->pk                    = $box_score_personal['pk'];
                $member[$key]->tackle_overhead_home  = $box_score_personal['tackle_overhead_home'];
                $member[$key]->tackle_overhead_guest = $box_score_personal['tackle_overhead_guest'];
                $member[$key]->guest_kick            = $box_score_personal['guest_kick'];
                $member[$key]->guest_kick_goal       = $box_score_personal['guest_kick_goal'];
                $member[$key]->guest_lose            = $box_score_personal['guest_lose'];
                $member[$key]->save_kick             = $box_score_personal['save_kick'];
                $member[$key]->save_penalty          = $box_score_personal['save_penalty'];
                $member[$key]->punching              = $box_score_personal['punching'];
                $member[$key]->pass                  = $box_score_personal['pass'];
                $member[$key]->guest_pass            = $box_score_personal['guest_pass'];
                $member[$key]->contribute            = $box_score_personal['contribute'];

                $sum_goal                  = $sum_goal + $box_score_personal['goal'];
                $sum_kick                  = $sum_kick + $box_score_personal['kick'];
                $sum_kick_goal             = $sum_kick_goal + $box_score_personal['kick_goal'];
                $sum_assist                = $sum_assist + $box_score_personal['assist'];
                $sum_last_pass             = $sum_last_pass + $box_score_personal['last_pass'];
                $sum_cross                 = $sum_cross + $box_score_personal['cross'];
                $sum_pass_dribble          = $sum_pass_dribble + $box_score_personal['pass_dribble'];
                $sum_fouled                = $sum_fouled + $box_score_personal['fouled'];
                $sum_tackle                = $sum_tackle + $box_score_personal['tackle'];
                $sum_steal                 = $sum_steal + $box_score_personal['steal'];
                $sum_intercept             = $sum_intercept + $box_score_personal['intercept'];
                $sum_shoot_block           = $sum_shoot_block + $box_score_personal['shoot_block'];
                $sum_cross_block           = $sum_cross_block + $box_score_personal['cross_block'];
                $sum_foul                  = $sum_foul + $box_score_personal['foul'];
                $sum_clear                 = $sum_clear + $box_score_personal['clear'];
                $sum_second_ball           = $sum_second_ball + $box_score_personal['second_ball'];
                $sum_corner_kick           = $sum_corner_kick + $box_score_personal['corner_kick'];
                $sum_free_kick             = $sum_free_kick + $box_score_personal['free_kick'];
                $sum_pk                    = $sum_pk + $box_score_personal['pk'];
                $sum_tackle_overhead_home  = $sum_tackle_overhead_home + $box_score_personal['tackle_overhead_home'];
                $sum_tackle_overhead_guest = $sum_tackle_overhead_guest + $box_score_personal['tackle_overhead_guest'];
                $sum_guest_kick            = $sum_guest_kick + $box_score_personal['guest_kick'];
                $sum_guest_kick_goal       = $sum_guest_kick_goal + $box_score_personal['guest_kick_goal'];
                $sum_guest_lose            = $sum_guest_lose + $box_score_personal['guest_lose'];
                $sum_save_kick             = $sum_save_kick + $box_score_personal['save_kick'];
                $sum_save_penalty          = $sum_save_penalty + $box_score_personal['save_penalty'];
                $sum_punching              = $sum_punching + $box_score_personal['punching'];
                $sum_pass                  = $sum_pass + $box_score_personal['pass'];
                $sum_guest_pass            = $sum_guest_pass + $box_score_personal['guest_pass'];
                $sum_contribute            = $sum_contribute + $box_score_personal['contribute'];
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

            foreach ($stats as $key1 => $value1) {
                if ($value1->member_anonymous_id == $temporary || $value1->member_anonymous_id == $negative_temporary) {
                    $check_temporary = true;
                }
                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->result == 1 && $value1->member_anonymous_id == $temporary) {
                    $goal += 1;
                }
                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $temporary) {
                    $kick += 1;
                }
                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $temporary && in_array($value1->ball_goal_number, config('constants.goal_numbers'))) {
                    $kick_goal += 1;
                }
                if ($value1->action_id == config('constants.action_map.assist.id') && $value1->result == 1 && $value1->member_anonymous_id == $temporary) {
                    $assist += 1;
                }
                if ($value1->action_id == config('constants.action_map.assist.id') && $value1->result != 1 && $value1->member_anonymous_id == $temporary) {
                    $last_pass += 1;
                }
                if (in_array($value1->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && $value1->member_anonymous_id == $temporary) {
                    $cross += 1;
                }
                if ($value1->action_id == config('constants.action_map.pass.id') && $value1->member_anonymous_id == $temporary && $value1->result == 1) {
                    $pass_dribble += 1;
                }
                if ($value1->action_id == config('constants.action_map.fouled.id') && $value1->member_anonymous_id == $temporary) {
                    $fouled += 1;
                }
                if ($value1->action_id == config('constants.action_map.tackle.id') && $value1->member_anonymous_id == $temporary) {
                    $tackle += 1;
                }
                $contribution_data = json_decode($value1->action_contribution_data, true);
                if ($value1->action_id == config('constants.action_map.tackle.id') && $value1->member_anonymous_id == $temporary && isset($contribution_data['seize'])) {
                    $steal += 1;
                }
                if ($value1->action_id == config('constants.action_map.intercept.id') && $value1->member_anonymous_id == $temporary) {
                    $intercept += 1;
                }
                if ($value1->action_id == config('constants.action_map.block.id') && $value1->member_anonymous_id == $temporary && isset($contribution_data['shoot_block'])) {
                    $shoot_block += 1;
                }
                if ($value1->action_id == config('constants.action_map.block.id') && $value1->member_anonymous_id == $temporary && isset($contribution_data['cross_block'])) {
                    $cross_block += 1;
                }
                if ($value1->action_id == config('constants.action_map.foul.id') && $value1->member_anonymous_id == $temporary) {
                    $foul += 1;
                }
                if ($value1->action_id == config('constants.action_map.clear.id') && $value1->member_anonymous_id == $temporary) {
                    $clear += 1;
                }
                if ($value1->action_id == config('constants.action_map.second_ball.id') && $value1->member_anonymous_id == $temporary) {
                    $second_ball += 1;
                }
                if ($value1->action_id == config('constants.action_map.corner_kick.id') && $value1->member_anonymous_id == $temporary) {
                    $corner_kick += 1;
                }
                if (in_array($value1->action_id, [config('constants.action_map.direct_free_kick.id'), config('constants.action_map.indirect_free_kick.id')]) && $value1->member_anonymous_id == $temporary) {
                    $free_kick += 1;
                }
                if ($value1->action_id == config('constants.action_map.pk_free_kick.id') && $value1->member_anonymous_id == $temporary) {
                    $pk += 1;
                }
                if ($value1->action_id == config('constants.action_map.tackle_overhead.id') && $value1->member_anonymous_id == $temporary && $value1->result == 1 && ($value1->is_pitch_home_area && !$value1->is_pitch_guest_area)) {
                    $tackle_overhead_home += 1;
                }
                if ($value1->action_id == config('constants.action_map.tackle_overhead.id') && $value1->member_anonymous_id == $temporary && $value1->result == 1 && (!$value1->is_pitch_home_area && $value1->is_pitch_guest_area)) {
                    $tackle_overhead_guest += 1;
                }
                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $negative_temporary) {
                    if ($value1->guest_gk_member_id == $value->id) {
                        $guest_kick += 1;
                    } elseif ($value1->home_gk_member_id == $value->id) {
                        $guest_kick += 1;
                    }
                }
                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $negative_temporary && in_array($value1->ball_goal_number, config('constants.goal_numbers'))) {
                    if ($value1->guest_gk_member_id == $value->id) {
                        $guest_kick_goal += 1;
                    } elseif ($value1->home_gk_member_id == $value->id) {
                        $guest_kick_goal += 1;
                    }
                }
                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $negative_temporary && $value1->result == 1) {
                    if ($value1->guest_gk_member_id == $value->id) {
                        $guest_lose += 1;
                    } elseif ($value1->home_gk_member_id == $value->id) {
                        $guest_lose += 1;
                    }
                }
                $contribution_score = json_decode($value1->action_contribution_score, true);
                if ((in_array($value1->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && $value1->member_anonymous_id == $temporary) || ($value1->member_anonymous_id == $negative_temporary && in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value1->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value1->result != 1)) {
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
                if (in_array($value1->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && $value1->member_anonymous_id == $temporary) {
                    if ((isset($contribution_data['shoot']) || isset($contribution_score['stop_pk'])) && $value1->guest_gk_member_id == $value->id && $value1->is_pa_guest_area) {
                        $save_penalty += 1;
                    } else if ((isset($contribution_data['shoot']) || isset($contribution_score['stop_pk'])) && $value1->home_gk_member_id == $value->id && $value1->is_pa_home_area) {
                        $save_penalty += 1;
                    }
                }
                if (($value1->member_anonymous_id == $negative_temporary && in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value1->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value1->result != 1)) {
                    if ($value1->guest_gk_member_id == $value->id && $value1->is_pa_guest_area) {
                        $save_penalty += 1;
                    } elseif ($value1->home_gk_member_id == $value->id && $value1->is_pa_home_area) {
                        $save_penalty += 1;
                    }
                }
                if ($value1->action_id == config('constants.action_map.punching.id') && $value1->member_anonymous_id == $temporary) {
                    $punching += 1;
                }
                if (in_array($value1->action_id, [config('constants.action_map.punt_kick.id'), config('constants.action_map.throw_ball.id')]) && $value1->member_anonymous_id == $temporary && isset($contribution_data['successful_own_pass'])) {
                    $pass += 1;
                }
                if (in_array($value1->action_id, [config('constants.action_map.punt_kick.id'), config('constants.action_map.throw_ball.id')]) && $value1->member_anonymous_id == $temporary && isset($contribution_data['successful_enemy_pass'])) {
                    $guest_pass += 1;
                }
                if ($value1->member_anonymous_id == $temporary) {
                    if ($value1->action_contribution_score) {
                        $contribution_score = json_decode($value1->action_contribution_score, true);
                        foreach ($contribution_score as $key2 => $value2) {
                            $contribute += $value2;
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
                $box_score_personal                        = TransformDataStat::boxScorePersonalProbability($stats, $member_id, $value);
                $member[$key]->ratio_goal                  = $box_score_personal['ratio_goal'];
                $member[$key]->ratio_kick_goal             = $box_score_personal['ratio_kick_goal'];
                $member[$key]->ratio_tackle_overhead_home  = $box_score_personal['ratio_tackle_overhead_home'];
                $member[$key]->ratio_tackle_overhead_guest = $box_score_personal['ratio_tackle_overhead_guest'];
                $member[$key]->ratio_pass_dribble          = $box_score_personal['ratio_pass_dribble'];
                $member[$key]->ratio_cross                 = $box_score_personal['ratio_cross'];
                $member[$key]->ratio_tackle                = $box_score_personal['ratio_tackle'];
                $member[$key]->ratio_clear                 = $box_score_personal['ratio_clear'];
                $member[$key]->ratio_second_ball           = $box_score_personal['ratio_second_ball'];
                $member[$key]->ratio_save                  = $box_score_personal['ratio_save'];
                $member[$key]->ratio_catch_cross           = $box_score_personal['ratio_catch_cross'];
                $member[$key]->ratio_lose                  = $box_score_personal['ratio_lose'];

                $sum_ratio_goal                  = $sum_ratio_goal + $box_score_personal['ratio_goal'];
                $sum_ratio_kick_goal             = $sum_ratio_kick_goal + $box_score_personal['ratio_kick_goal'];
                $sum_ratio_tackle_overhead_home  = $sum_ratio_tackle_overhead_home + $box_score_personal['ratio_tackle_overhead_home'];
                $sum_ratio_tackle_overhead_guest = $sum_ratio_tackle_overhead_guest + $box_score_personal['ratio_tackle_overhead_guest'];
                $sum_ratio_pass_dribble          = $sum_ratio_pass_dribble + $box_score_personal['ratio_pass_dribble'];
                $sum_ratio_cross                 = $sum_ratio_cross + $box_score_personal['ratio_cross'];
                $sum_ratio_tackle                = $sum_ratio_tackle + $box_score_personal['ratio_tackle'];
                $sum_ratio_clear                 = $sum_ratio_clear + $box_score_personal['ratio_clear'];
                $sum_ratio_second_ball           = $sum_ratio_second_ball + $box_score_personal['ratio_second_ball'];
                $sum_ratio_save                  = $sum_ratio_save + $box_score_personal['ratio_save'];
                $sum_ratio_catch_cross           = $sum_ratio_catch_cross + $box_score_personal['ratio_catch_cross'];
                $sum_ratio_lose                  = $sum_ratio_lose + $box_score_personal['ratio_lose'];
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

            foreach ($stats as $key1 => $value1) {
                if ($value1->member_anonymous_id == $temporary || $value1->member_anonymous_id == $negative_temporary) {
                    $check_temporary = true;
                }
                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $temporary) {
                    $kick += 1;
                    if ($value1->result == 1) {
                        $goal += 1;
                    }
                }
                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $temporary && in_array($value1->ball_goal_number, config('constants.goal_numbers'))) {
                    $kick_goal += 1;
                }
                if ($value1->action_id == config('constants.action_map.tackle_overhead.id') && ($value1->member_anonymous_id == $temporary || $value1->member_anonymous_id == $negative_temporary)) {
                    if ($value1->is_pitch_home_area) {
                        $total_tackle_overhead_home += 1;
                        if ($value1->member_anonymous_id == $temporary) {
                            $tackle_overhead_home += 1;
                        }
                    }
                    if ($value1->is_pitch_guest_area) {
                        $total_tackle_overhead_guest += 1;
                        if ($value1->member_anonymous_id == $temporary) {
                            $tackle_overhead_guest += 1;
                        }
                    }
                }
                if ($value1->action_id == config('constants.action_map.pass.id') && $value1->member_anonymous_id == $temporary) {
                    $total_pass_dribble += 1;
                    if ($value1->result == 1) {
                        $pass_dribble += 1;
                    }
                }
                if (in_array($value1->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && $value1->member_anonymous_id == $temporary) {
                    $total_cross += 1;
                    if ($value1->result == 1) {
                        $cross += 1;
                    }
                }
                $contribution_data = json_decode($value1->action_contribution_data, true);
                if ($value1->action_id == config('constants.action_map.tackle.id') && $value1->member_anonymous_id == $temporary) {
                    $total_tackle += 1;
                    if (isset($contribution_data['seize'])) {
                        $tackle += 1;
                    }
                }
                if ($value1->action_id == config('constants.action_map.clear.id') && $value1->member_anonymous_id == $temporary) {
                    $total_clear += 1;
                    if ($value1->result == 1) {
                        $clear += 1;
                    }
                }
                if ($value1->action_id == config('constants.action_map.second_ball.id') && ($value1->member_anonymous_id == $temporary || $value1->member_anonymous_id == $negative_temporary)) {
                    $total_second_ball += 1;
                    if ($value1->result == 1 && $value1->member_anonymous_id == $temporary) {
                        $second_ball += 1;
                    }
                }
                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $negative_temporary) {
                    if ($value1->guest_gk_member_id == $value->member_id) {
                        $total_save += 1;
                    } elseif ($value1->home_gk_member_id == $value->member_id) {
                        $total_save += 1;
                    }
                }
                $contribution_score = json_decode($value1->action_contribution_score, true);
                if ((in_array($value1->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && $value1->member_anonymous_id == $temporary) || ($value1->member_anonymous_id == $negative_temporary && in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value1->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value1->result != 1)) {
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
                if (in_array($value1->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && $value1->member_anonymous_id == $negative_temporary) {
                    if ($value1->guest_gk_member_id == $value->member_id) {
                        $total_catch_cross += 1;
                    } elseif ($value1->home_gk_member_id == $value->member_id) {
                        $total_catch_cross += 1;
                    }
                }
                if ($value1->action_id == config('constants.action_map.catching.id') && $value1->member_anonymous_id == $temporary && isset($contribution_data['cross'])) {
                    $catch_cross += 1;
                }
                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_anonymous_id == $negative_temporary) {
                    if ($value1->guest_gk_member_id == $value->member_id) {
                        $total_lose += 1;
                    } elseif ($value1->home_gk_member_id == $value->member_id) {
                        $total_lose += 1;
                    }
                    if ($value1->result == 1) {
                        $lose += 1;
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

    public function team($id, Request $request)
    {
        $match = $this->__matchRepo->findByIdWithRelationship($id);
        $time  = 0;
        if ($request->round) {
            if ($request->round == 1) {
                $time = $match->round1_time;
            } else if ($request->round == 2) {
                $time = $match->round2_time;
            } else if ($request->round == 3) {
                $time = $match->round3_time;
            } else if ($request->round == 4) {
                $time = $match->round4_time;
            } else if ($request->round == 5 || $request->round == 6) {
                $time = $match->extra_time;
            }
        }
        $color_team1 = $match->team1->color_home;
        if ($match->team_color1 == 2) {
            $color_team1 = $match->team1->color_guest;
        }
        $color_team2 = $match->team2->color_home;
        if ($match->team_color2 == 2) {
            $color_team2 = $match->team2->color_guest;
        }
        $team_1               = $this->__teamRepo->find($match->team_id1);
        $team_2               = $this->__teamRepo->find($match->team_id2);
        $member_team_1        = $this->__memberRepo->getMemberStats($match->team_id1)->pluck('id')->toArray();
        $member_team_2        = $this->__memberRepo->getMemberStats($match->team_id2)->pluck('id')->toArray();
        $stats                = $this->__statRepo->getStatsTeamByTimePeriodInRound($match->id, $request->round, $time, $request->sub_time);
        $member_anonymous_id1 = -1;
        $member_anonymous_id2 = -2;
        if ($request->team_type == 1) {
            $box_score_team1               = TransformDataStat::boxScoreTeamNumber($stats, $member_team_1, $team_1, null, null, null, $member_anonymous_id1);
            $team_1->goal                  = $box_score_team1['goal'];
            $team_1->kick                  = $box_score_team1['kick'];
            $team_1->kick_goal             = $box_score_team1['kick_goal'];
            $team_1->assist                = $box_score_team1['assist'];
            $team_1->last_pass             = $box_score_team1['last_pass'];
            $team_1->cross                 = $box_score_team1['cross'];
            $team_1->pass_dribble          = $box_score_team1['pass_dribble'];
            $team_1->fouled                = $box_score_team1['fouled'];
            $team_1->cut_ball              = $box_score_team1['cut_ball'];
            $team_1->clear                 = $box_score_team1['clear'];
            $team_1->block                 = $box_score_team1['block'];
            $team_1->foul                  = $box_score_team1['foul'];
            $team_1->second_ball           = $box_score_team1['second_ball'];
            $team_1->is_pa                 = $box_score_team1['is_pa'];
            $team_1->penalty_golf          = $box_score_team1['penalty_golf'];
            $team_1->corner_kick           = $box_score_team1['corner_kick'];
            $team_1->free_kick             = $box_score_team1['free_kick'];
            $team_1->pk                    = $box_score_team1['pk'];
            $team_1->tackle_overhead_home  = $box_score_team1['tackle_overhead_home'];
            $team_1->tackle_overhead_guest = $box_score_team1['tackle_overhead_guest'];
            $team_1->save                  = $box_score_team1['save'];

            $box_score_team2               = TransformDataStat::boxScoreTeamNumber($stats, $member_team_2, $team_2, null, null, null, $member_anonymous_id2);
            $team_2->goal                  = $box_score_team2['goal'];
            $team_2->kick                  = $box_score_team2['kick'];
            $team_2->kick_goal             = $box_score_team2['kick_goal'];
            $team_2->assist                = $box_score_team2['assist'];
            $team_2->last_pass             = $box_score_team2['last_pass'];
            $team_2->cross                 = $box_score_team2['cross'];
            $team_2->pass_dribble          = $box_score_team2['pass_dribble'];
            $team_2->fouled                = $box_score_team2['fouled'];
            $team_2->cut_ball              = $box_score_team2['cut_ball'];
            $team_2->clear                 = $box_score_team2['clear'];
            $team_2->block                 = $box_score_team2['block'];
            $team_2->foul                  = $box_score_team2['foul'];
            $team_2->second_ball           = $box_score_team2['second_ball'];
            $team_2->is_pa                 = $box_score_team2['is_pa'];
            $team_2->penalty_golf          = $box_score_team2['penalty_golf'];
            $team_2->corner_kick           = $box_score_team2['corner_kick'];
            $team_2->free_kick             = $box_score_team2['free_kick'];
            $team_2->pk                    = $box_score_team2['pk'];
            $team_2->tackle_overhead_home  = $box_score_team2['tackle_overhead_home'];
            $team_2->tackle_overhead_guest = $box_score_team2['tackle_overhead_guest'];
            $team_2->save                  = $box_score_team2['save'];
        } else {
            $box_score_team1                     = TransformDataStat::boxScoreTeamProbability($stats, $member_team_1, $team_1, null, null, null, $member_anonymous_id1);
            $team_1->ratio_goal                  = $box_score_team1['ratio_goal'];
            $team_1->ratio_kick_goal             = $box_score_team1['ratio_kick_goal'];
            $team_1->ratio_tackle_overhead_home  = $box_score_team1['ratio_tackle_overhead_home'];
            $team_1->ratio_tackle_overhead_guest = $box_score_team1['ratio_tackle_overhead_guest'];
            $team_1->ratio_pass_dribble          = $box_score_team1['ratio_pass_dribble'];
            $team_1->ratio_cross                 = $box_score_team1['ratio_cross'];
            $team_1->ratio_tackle                = $box_score_team1['ratio_tackle'];
            $team_1->ratio_clear                 = $box_score_team1['ratio_clear'];
            $team_1->ratio_second_ball           = $box_score_team1['ratio_second_ball'];
            $team_1->ratio_save                  = $box_score_team1['ratio_save'];
            $team_1->ratio_catch_cross           = $box_score_team1['ratio_catch_cross'];
            $team_1->ratio_goal_play             = $box_score_team1['ratio_goal_play'];
            $team_1->ratio_throw                 = $box_score_team1['ratio_throw'];
            $team_1->ratio_lose                  = $box_score_team1['ratio_lose'];

            $box_score_team2                     = TransformDataStat::boxScoreTeamProbability($stats, $member_team_2, $team_2, null, null, null, $member_anonymous_id2);
            $team_2->ratio_goal                  = $box_score_team2['ratio_goal'];
            $team_2->ratio_kick_goal             = $box_score_team2['ratio_kick_goal'];
            $team_2->ratio_tackle_overhead_home  = $box_score_team2['ratio_tackle_overhead_home'];
            $team_2->ratio_tackle_overhead_guest = $box_score_team2['ratio_tackle_overhead_guest'];
            $team_2->ratio_pass_dribble          = $box_score_team2['ratio_pass_dribble'];
            $team_2->ratio_cross                 = $box_score_team2['ratio_cross'];
            $team_2->ratio_tackle                = $box_score_team2['ratio_tackle'];
            $team_2->ratio_clear                 = $box_score_team2['ratio_clear'];
            $team_2->ratio_second_ball           = $box_score_team2['ratio_second_ball'];
            $team_2->ratio_save                  = $box_score_team2['ratio_save'];
            $team_2->ratio_catch_cross           = $box_score_team2['ratio_catch_cross'];
            $team_2->ratio_goal_play             = $box_score_team2['ratio_goal_play'];
            $team_2->ratio_throw                 = $box_score_team2['ratio_throw'];
            $team_2->ratio_lose                  = $box_score_team2['ratio_lose'];

        }

        if ($color_team1 === 1) {
            $team_1->class_css = 'reset_color';

        }
        if ($color_team2 === 1) {
            $team_2->class_css = 'reset_color';

        }
        $team_1->color_team = config('constants.team_color.' . $color_team1);
        $team_2->color_team = config('constants.team_color.' . $color_team2);
        return response()->json(['result' => true, 'team_1' => $team_1, 'team_2' => $team_2], 200);
    }
}

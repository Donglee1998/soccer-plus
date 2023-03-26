<?php

namespace App\Http\Controllers\Web;

use App\Helpers\TransformDataStat;
use App\Repositories\LineUpRepository;
use App\Repositories\MatchRepository;
use App\Repositories\MemberRepository;
use App\Repositories\StatRepository;
use App\Repositories\TeamRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScorebookMatchesChartController extends BaseController
{
    protected $__matchRepo;
    protected $__lineUpRepo;
    protected $__teamRepo;
    protected $__statRepo;
    protected $__memberRepo;

    public function __construct(MatchRepository $matchRepository, LineUpRepository $lineUpRepository, TeamRepository $teamRepo, StatRepository $statRepo, MemberRepository $memberRepo)
    {
        $this->__matchRepo        = $matchRepository;
        $this->__lineUpRepo       = $lineUpRepository;
        $this->__teamRepo         = $teamRepo;
        $this->__statRepo         = $statRepo;
        $this->__memberRepo       = $memberRepo;
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
                $team_home  = $match->team2->id;
                $line_up_id = $match->lineup_id2;
                if ($match->team1->is_home == 1 || $match->team2->is_home != 1) {
                    $team_home  = $match->team1->id;
                    $line_up_id = $match->lineup_id1;
                }
                $line_up     = $this->__lineUpRepo->findInWeb($line_up_id);
                $member_home = [];
                foreach ($line_up->starting as $value) {
                    array_push($member_home, ['member_id' => $value['member_id'], 'number_official' => $value['number_official'], 'first_name' => $value['first_name'] ?? null, 'last_name' => $value['last_name'] ?? null]);
                }
                foreach ($line_up->substitute as $value) {
                    array_push($member_home, ['member_id' => $value['member_id'], 'number_official' => $value['number_official'], 'first_name' => $value['first_name'] ?? null, 'last_name' => $value['last_name'] ?? null]);
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
                return view('web.scorebook.matches_chart', compact('match', 'goal', 'id', 'member_home', 'match_common_info'));
            }
            return abort(404);
        }
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
        $box_score_team1      = TransformDataStat::boxScoreTeamNumber($stats, $member_team_1, $team_1);
        $team_1->goal         = $box_score_team1['goal'];
        $team_1->kick         = $box_score_team1['kick'];
        $team_1->kick_goal    = $box_score_team1['kick_goal'];
        $team_1->cut_ball     = $box_score_team1['cut_ball'];
        $team_1->foul         = $box_score_team1['foul'];
        $team_1->fouled       = $box_score_team1['fouled'];
        $team_1->corner_kick  = $box_score_team1['corner_kick'];
        $team_1->penalty_golf = $box_score_team1['penalty_golf'];
        $team_1->free_kick    = $box_score_team1['free_kick'];
        $team_1->cross        = $box_score_team1['cross'];
        $team_1->color_team   = config('constants.team_color.' . $color_team1);

        $box_score_team2      = TransformDataStat::boxScoreTeamNumber($stats, $member_team_2, $team_2);
        $team_2->goal         = $box_score_team2['goal'];
        $team_2->kick         = $box_score_team2['kick'];
        $team_2->kick_goal    = $box_score_team2['kick_goal'];
        $team_2->cut_ball     = $box_score_team2['cut_ball'];
        $team_2->foul         = $box_score_team2['foul'];
        $team_2->fouled       = $box_score_team2['fouled'];
        $team_2->corner_kick  = $box_score_team2['corner_kick'];
        $team_2->penalty_golf = $box_score_team2['penalty_golf'];
        $team_2->free_kick    = $box_score_team2['free_kick'];
        $team_2->cross        = $box_score_team2['cross'];
        $team_2->color_team   = config('constants.team_color.' . $color_team2);

        return response()->json(['result' => true, 'team_1' => $team_1, 'team_2' => $team_2], 200);
    }

    public function chart($id)
    {
        $match       = $this->__matchRepo->findByIdWithRelationship($id);
        $color_team1 = $match->team1->color_home;
        if ($match->team_color1 == 2) {
            $color_team1 = $match->team1->color_guest;
        }
        $color_team2 = $match->team2->color_home;
        if ($match->team_color2 == 2) {
            $color_team2 = $match->team2->color_guest;
        }
        $team_1                = $this->__teamRepo->find($match->team_id1);
        $team_1->color_team    = config('constants.team_color.' . $color_team1);
        $team_2                = $this->__teamRepo->find($match->team_id2);
        $team_2->color_team    = config('constants.team_color.' . $color_team2);
        $member_team_1         = $this->__memberRepo->getMemberStats($match->team_id1)->pluck('id')->toArray();
        $member_team_2         = $this->__memberRepo->getMemberStats($match->team_id2)->pluck('id')->toArray();
        $team_home             = $match->team2->id;
        $line_up_team_home_id  = $match->lineup_id2;
        $team_guest            = $match->team1->id;
        $line_up_team_guest_id = $match->lineup_id1;
        if ($match->team1->is_home == 1 || $match->team2->is_home != 1) {
            $team_home             = $match->team1->id;
            $line_up_team_home_id  = $match->lineup_id1;
            $team_guest            = $match->team2->id;
            $line_up_team_guest_id = $match->lineup_id2;
        }
        $line_up_team_home  = $this->__lineUpRepo->findInWeb($line_up_team_home_id);
        $line_up_team_guest = $this->__lineUpRepo->findInWeb($line_up_team_guest_id);
        $arr_member_home    = [];
        $opt_member_home    = [];
        foreach ($line_up_team_home->starting as $value) {
            array_push($arr_member_home, $value['member_id']);
            array_push($opt_member_home, ['member_id' => $value['member_id'], 'number_official' => $value['number_official'], 'first_name' => $value['first_name'] ?? null, 'last_name' => $value['last_name'] ?? null]);
        }
        foreach ($line_up_team_home->substitute as $value) {
            array_push($arr_member_home, $value['member_id']);
            array_push($opt_member_home, ['member_id' => $value['member_id'], 'number_official' => $value['number_official'], 'first_name' => $value['first_name'] ?? null, 'last_name' => $value['last_name'] ?? null]);
        }
        $arr_member_guest = [];
        $opt_member_guest = [];
        foreach ($line_up_team_guest->starting as $value) {
            array_push($arr_member_guest, $value['member_id']);
            array_push($opt_member_guest, ['member_id' => $value['member_id'], 'number_official' => $value['number_official'], 'first_name' => $value['first_name'] ?? null, 'last_name' => $value['last_name'] ?? null]);
        }
        foreach ($line_up_team_guest->substitute as $value) {
            array_push($arr_member_guest, $value['member_id']);
            array_push($opt_member_guest, ['member_id' => $value['member_id'], 'number_official' => $value['number_official'], 'first_name' => $value['first_name'] ?? null, 'last_name' => $value['last_name'] ?? null]);
        }
        $stats = $this->__statRepo->getStatsTeam($id);
        foreach ($stats as $key => $value) {
            if ($value->action_id == config('constants.action_map.change_member_in.id') && !in_array($value->member_id, $arr_member_home)) {
                $member_find = $this->__memberRepo->find($value->member_id);
                if (isset($member_find) && $member_find->team_id == $team_1->id) {
                    array_push($arr_member_home, $value->member_id);
                }
            }
            if ($value->action_id == config('constants.action_map.change_member_in.id') && !in_array($value->member_id, $arr_member_guest)) {
                $member_find = $this->__memberRepo->find($value->member_id);
                if (isset($member_find) && $member_find->team_id == $team_2->id) {
                    array_push($arr_member_guest, $value->member_id);
                }
            }
        }

        return response()->json(['result' => true, 'stats' => $stats, 'match' => $match, 'arr_member_home' => $arr_member_home, 'arr_member_guest' => $arr_member_guest, 'opt_member_home' => (object) $opt_member_home, 'opt_member_guest' => (object) $opt_member_guest, 'team_1' => $team_1, 'team_2' => $team_2, 'member_team_1' => $member_team_1, 'member_team_2' => $member_team_2], 200);
    }
}

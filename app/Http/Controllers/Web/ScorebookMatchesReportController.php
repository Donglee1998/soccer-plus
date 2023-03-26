<?php

namespace App\Http\Controllers\Web;

// use App\Helpers\TransformDataStat;
use App\Repositories\CommentRepository;
use App\Repositories\LineUpRepository;
use App\Repositories\MatchRepository;
use App\Repositories\MemberRepository;
use App\Repositories\StatRepository;
use App\Repositories\TeamRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScorebookMatchesReportController extends BaseController
{
    protected $__matchRepo;
    protected $__lineUpRepo;
    protected $__teamRepo;
    protected $__statRepo;
    protected $__memberRepo;
    protected $__commentRepo;

    public function __construct(MatchRepository $matchRepository, LineUpRepository $lineUpRepository, TeamRepository $teamRepo, StatRepository $statRepo, MemberRepository $memberRepo, CommentRepository $commentRepo)
    {
        $this->__matchRepo   = $matchRepository;
        $this->__lineUpRepo  = $lineUpRepository;
        $this->__teamRepo    = $teamRepo;
        $this->__statRepo    = $statRepo;
        $this->__memberRepo  = $memberRepo;
        $this->__commentRepo = $commentRepo;
    }

    public function index($id, Request $request)
    {
        $auth_id    = Auth::guard('web')->user()->id;
        $match_list = $this->__matchRepo->getListMatchByAuth($auth_id)->pluck('id')->toArray();
        if (!in_array($id, $match_list)) {
           return abort(404);
        }else {
            $match = $this->__matchRepo->findByIdWithRelationship($id);

            if (!$match) {
                return abort(404);
            }

            // specification (đặc tả) → Part 1
            $match_common_info = $this->__matchRepo->getCommonInfo($id);

            // Find team home
            $team_home_id = $match->team_owner == 1 ? $match->team1->id : $match->team2->id;

            $lineup1           = $this->__lineUpRepo->findInWeb($match->lineup_id1);
            $lineup2           = $this->__lineUpRepo->findInWeb($match->lineup_id2);
            $lineup1->starting = collect($lineup1->starting)->map(function ($member) {
                $member['position_label'] = config('constants.member_position.label.' . $member['position']);
                $member['full_name']      = trim(($member['first_name'] || $member['last_name']) ? $member['first_name'] . "  " . $member['last_name'] : '?');
                return $member;
            });
            $lineup2->starting = collect($lineup2->starting)->map(function ($member) {
                $member['position_label'] = config('constants.member_position.label.' . $member['position']);
                $member['full_name']      = trim(($member['first_name'] || $member['last_name']) ? $member['first_name'] . "  " . $member['last_name'] : '?');
                return $member;
            });
            $lineup1->substitute = collect($lineup1->substitute)->map(function ($member) {
                $member['position_label'] = config('constants.member_position.label.' . $member['position']);
                $member['full_name']      = trim(($member['first_name'] || $member['last_name']) ? $member['first_name'] . "  " . $member['last_name'] : '?');
                return $member;
            });
            $lineup2->substitute = collect($lineup2->substitute)->map(function ($member) {
                $member['position_label'] = config('constants.member_position.label.' . $member['position']);
                $member['full_name']      = trim(($member['first_name'] || $member['last_name']) ? $member['first_name'] . "  " . $member['last_name'] : '?');
                return $member;
            });

            $stats = $this->__statRepo->getStatsTeam($match->id);

            $stats_by_part4 = $stats;

            // specification → Part 3
            $change_player_args = [
                'team_left'  => [],
                'team_right' => [],
            ];
            foreach ($stats as $stat) {
                if (in_array($stat->action_id, [config('constants.action_map.change_member_in.id'), config('constants.action_map.change_member_out.id')])) {
                    if ($team_home_id == $stat->member?->team_id) {
                        $change_player_args['team_left'][] = $stat;
                    } else {
                        $change_player_args['team_right'][] = $stat;
                    }
                }
            }

            // specification → Part 2
            $rounds = collect($stats)->groupBy('created_at_round');
            $rounds = array_keys($rounds->toArray());
            $stats  = collect($stats)->groupBy('member_id');

            // remove PK round
            if (($key = array_search('_PK', $rounds)) !== false) {
                unset($rounds[$key]);
            }

            // list member for function check member create by calculator
            $list_member_id = [];
            foreach ($lineup1->starting as $member_item) {
                array_push($list_member_id, $member_item['member_id']);
            }
            foreach ($lineup1->substitute as $member_item) {
                array_push($list_member_id, $member_item['member_id']);
            }
            foreach ($lineup2->starting as $member_item) {
                array_push($list_member_id, $member_item['member_id']);
            }
            foreach ($lineup2->substitute as $member_item) {
                array_push($list_member_id, $member_item['member_id']);
            }

            $member_caculator_args = [];

            $goal           = [];
            // $action_kick_id = config('constants.action_map.kick.id');

            $list_action_kick = [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')];


            foreach ($stats as $member_id => $member_stats) {

                // Set val 0 for each round
                foreach ($rounds as $round) {
                    $goal[$member_id][$round] = 0;
                }

                foreach ($member_stats as $key => $stat) {
                    if (is_anonymous_stat_belong_to_team($match->team_id1, $team_home_id, $stat->member_anonymous_id)) {
                        $member_id = $stat->member_anonymous_id;

                        if (!isset($goal['anonymous_left'][$member_id][$round])) {
                            // Set val 0 for each round
                            foreach ($rounds as $round) {
                                $goal['anonymous_left'][$member_id][$round] = 0;
                            }
                        }

                        if (in_array($stat->action_id, $list_action_kick)) {
                            $goal['anonymous_left'][$member_id][$stat->created_at_round] += 1;
                        }

                    } elseif (is_anonymous_stat_belong_to_team($match->team_id2, $team_home_id, $stat->member_anonymous_id)) {
                        $member_id = $stat->member_anonymous_id;

                        if (!isset($goal['anonymous_right'][$member_id][$round])) {
                            // Set val 0 for each round
                            foreach ($rounds as $round) {
                                $goal['anonymous_right'][$member_id][$round] = 0;
                            }
                        }

                        if (in_array($stat->action_id, $list_action_kick)) {
                            $goal['anonymous_right'][$member_id][$stat->created_at_round] += 1;
                        }

                    } else {
                        if (in_array($stat->action_id, $list_action_kick)) {
                            $goal[$member_id][$stat->created_at_round] += 1;
                        }
                    }

                    // check member is create by calculator
                    if ($stat->action_id == config('constants.action_map.change_member_in.id') && !in_array($stat->member_id, $list_member_id)) {
                        $team_position = '';
                        if ($team_home_id == $stat->member?->team_id) {
                            $team_position = 'team_left';
                        } else {
                            $team_position = 'team_right';
                        }
                        $member_caculator_args[$team_position][] = [
                            'member_id'       => $stat->member_id,
                            'first_name'      => '?',
                            'last_name'       => '',
                            'position'        => $stat->member?->position,
                            'position_name'   => '?',
                            'number_official' => $stat->member?->number_official,
                            'full_name'       => trim(($stat->member?->first_name || $stat->member?->last_name) ? $stat->member?->first_name . "  " . $stat->member?->last_name : '?'),
                        ];
                    }
                }
            }

            // specification → Part 4
            $card_type_args = [
                0 => '_',
                1 => 'none',
                2 => 'yellow',
                3 => 'red',
            ];

            // initial value by statistics
            $action_by_key_args = [
                'kick' => 'シュート', // シュート
                'kick_' => '枠内シュート', // 枠内シュート ($stat->action_id == kick and $stat->result == 0)
                'goal_kick' => 'GK', // GK (ゴールキック)
                'corner_kick' => 'CK', // CK (コーナーキック)
                'direct_free_kick' => '直接FK', // 直接FK
                'indirect_free_kick' => '間接FK', // 間接FK
                'offside' => 'オフサイド', // オフサイド
                'pk_free_kick' => 'PK', // PK
                'yellow' => '警告', // 警告
                'red' => '退場', // 退場
            ];
            $action_label_args   = [];
            $statistics_by_teams = [];
            foreach ($action_by_key_args as $name => $label) {
                foreach ($rounds as $round) {
                    $action_id = config("constants.action_map.$name.id");
                    if ($name == 'kick_') {
                        $action_id = 'kick_';
                    }
                    if (in_array($name, ['yellow', 'red'])) {
                        $action_id = $name;
                    }
                    $statistics_by_teams[$action_id]['team_left'][str_replace('_', '', $round)]  = 0;
                    $statistics_by_teams[$action_id]['team_right'][str_replace('_', '', $round)] = 0;
                    $action_label_args[$action_id]                                               = $label;
                }
            }

            foreach ($stats_by_part4 as $k => $stat) {
                if ($stat->created_at_round == '_PK') {
                    continue;
                }

                if (empty($stat->member?->team_id)) {
                    continue;
                }

                if ($team_home_id == $stat->member?->team_id) {
                    $team_position = 'team_left';
                } else {
                    $team_position = 'team_right';
                }
                
                $card_type     = $card_type_args[$stat->fouls_judgment_type_id] ?? '';
                $round_by_stat = str_replace('_', '', $stat->created_at_round);
                foreach ($action_by_key_args as $name => $label) {
                    if ($name == 'kick' && $stat->action_id == config("constants.action_map.kick.id") && $stat->result == 1) {
                        $statistics_by_teams[$stat->action_id][$team_position][$round_by_stat] += 1;
                    } elseif ($name == 'kick_' && $stat->action_id == config("constants.action_map.kick.id") && $stat->result == 0) {
                        $statistics_by_teams['kick_'][$team_position][$round_by_stat] += 1;
                    } elseif ($card_type == $name && $stat->action_id == config("constants.action_map.foul.id")) {
                        if ($card_type == 'yellow') {
                            $statistics_by_teams[$card_type][$team_position][$round_by_stat] += 1;
                        } elseif ($card_type == 'red') {
                            $statistics_by_teams[$card_type][$team_position][$round_by_stat] += 1;
                        }
                    } elseif ($stat->action_id == config("constants.action_map.$name.id")) {
                        if ($name == 'pk_free_kick' && $stat->action_id == config("constants.action_map.pk_free_kick.id") && $stat->result == 1) {
                            $statistics_by_teams[1][$team_position][$round_by_stat] += 1;
                            $statistics_by_teams['kick_'][$team_position][$round_by_stat] += 1;
                        }
                        $statistics_by_teams[$stat->action_id][$team_position][$round_by_stat] += 1;
                    }
                }
            }

            // Find member foul ファウル
            $stat_by_foul_args = [];
            foreach ($stats_by_part4 as $k => $stat) {
                if ($stat->action_id == config("constants.action_map.foul.id")) {
                    if ($stat->member_id) {
                        if ($team_home_id == $stat->member?->team_id) {
                            $stat_by_foul_args[$match->team_id1][] = $stat;
                        } else {
                            $stat_by_foul_args[$match->team_id2][] = $stat;
                        }
                    } else {
                        if (is_anonymous_stat_belong_to_team($match->team_id1, $team_home_id, $stat->member_anonymous_id)) {
                            $stat_by_foul_args[$match->team_id1][] = $stat;
                        } elseif (is_anonymous_stat_belong_to_team($match->team_id2, $team_home_id, $stat->member_anonymous_id)) {
                            $stat_by_foul_args[$match->team_id2][] = $stat;
                        }
                    }
                }
            }

            // specification → Part 5
            $user      = auth()->guard('web')->user();
            $condition = [
                'match_id'   => $id,
                'created_by' => $user->id,
            ];
            $comment = $this->__commentRepo->getDetail($condition);

            // specification → Part 6
            $starting1 = collect($lineup1->starting)->groupBy('position'); // cầu thủ ở đội hình xuất phát
            $starting2 = collect($lineup2->starting)->groupBy('position'); // cầu thủ ở đội hình xuất phát

            return view('web.scorebook.matches_report', compact('match', 'id', 'match_common_info', 'comment',
                'lineup1', 'lineup2', 'starting1', 'starting2', 'goal', 'rounds', 'change_player_args', 'statistics_by_teams',
                'action_label_args', 'stat_by_foul_args', 'card_type_args', 'member_caculator_args'));
        }
    }

}

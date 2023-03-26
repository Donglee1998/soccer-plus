<?php

namespace App\Http\Controllers\Web;

use App\Helpers\TransformDataStat;
use App\Repositories\CommentRepository;
use App\Repositories\LineUpRepository;
use App\Repositories\MatchHistoryRepository;
use App\Repositories\MatchRepository;
use App\Repositories\MemberRepository;
use App\Repositories\StatRepository;
use App\Repositories\TeamRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScorebookMatchesPDFReportController extends BaseController
{
    protected $__matchRepo;
    protected $__matchHistoryRepo;
    protected $__lineUpRepo;
    protected $__teamRepo;
    protected $__statRepo;
    protected $__memberRepo;
    protected $__commentRepo;

    public function __construct(MatchRepository $matchRepository, LineUpRepository $lineUpRepository, MatchHistoryRepository $matchHistoryRepository, TeamRepository $teamRepo, StatRepository $statRepo, MemberRepository $memberRepo, CommentRepository $commentRepo)
    {
        $this->__matchRepo        = $matchRepository;
        $this->__lineUpRepo       = $lineUpRepository;
        $this->__matchHistoryRepo = $matchHistoryRepository;
        $this->__teamRepo         = $teamRepo;
        $this->__statRepo         = $statRepo;
        $this->__memberRepo       = $memberRepo;
        $this->__commentRepo      = $commentRepo;
    }

    public function index($matches_id, Request $request)
    {
        $auth_id    = Auth::guard('web')->user()->id;
        $match_list = $this->__matchRepo->getListMatchByAuth($auth_id)->pluck('id')->toArray();
        if (!in_array($matches_id, $match_list)) {
           return abort(404);
        }else {
            //001
            $kick_ball_change_players = $this->kickBallChangePlayers($request->matches_id);
            //002
            $ball_control_rate_of_teams = $this->ballControlRateOfTeams($request->matches_id);
            $match                      = $ball_control_rate_of_teams['match'];
            $round                      = $ball_control_rate_of_teams['round'];
            $ball_control_rate          = $ball_control_rate_of_teams['ball_control_rate'];
            $starting1                  = $ball_control_rate_of_teams['starting1'];
            $substitute1                = $ball_control_rate_of_teams['substitute1'];
            $starting2                  = $ball_control_rate_of_teams['starting2'];
            $substitute2                = $ball_control_rate_of_teams['substitute2'];
            $team_1                     = $ball_control_rate_of_teams['team_1'];
            $team_2                     = $ball_control_rate_of_teams['team_2'];
            $comment                    = $ball_control_rate_of_teams['comment'];
            //003
            $starting_line_up_vertical_charts = $this->startingLineUpVerticalCharts($request->matches_id);

            $analysis_chart_teams = $this->analysisChartTeams($request->matches_id);

            return view('web.pdf_report.index', compact(
                'kick_ball_change_players',
                'match',
                'round',
                'ball_control_rate',
                'starting1',
                'substitute1',
                'starting2',
                'substitute2',
                'team_1',
                'team_2',
                'comment',
                'starting_line_up_vertical_charts',
                'analysis_chart_teams',
            ));
        }
    }

    // report001
    public function kickBallChangePlayers($matches_id)
    {
        if (!@$matches_id) {
            abort(404);
        }
        $data_match = $this->__getDataMatch($matches_id);
        if (is_null($data_match)) {
            abort(404);
        }
        $list_data = $this->__getListData($data_match);
        /**
         * specification → 1-12 Part 1
         */
        $match = $this->__getMatch($list_data, $data_match);
        /**
         * specification → 13-16 Part 1
         */
        $rounds = $this->__getRounds($list_data);
        
        //Start next part, get value default
        $lineup1 = $this->__getLineup($data_match->lineup_id1);
        $lineup2 = $this->__getLineup($data_match->lineup_id2);
        $stats   = $this->__statRepo->getStatsTeam($data_match->id);
        // Find team home
        $team_home_id   = $data_match->team_owner == 1 ? $data_match->team1->id : $data_match->team2->id;
        $stats_by_part4 = $stats;
        /**
         * specification → Part 3
         */
        $change_player_args = $this->__getChangePlayer($stats, $team_home_id);
        /**
         * specification → Part 2
         */
        $report_round = $this->__getReportRound($stats, $data_match, $team_home_id, $lineup1, $lineup2);
        // specification → Part 4
        $statistics = $this->__getStatisticsAction($report_round['rounds'], $stats_by_part4, $team_home_id, $data_match);

        //Get data
        $data = [
            'match'               => $match,
            'round'               => $rounds,
            'report_round'        => $report_round,
            'change_player_args'  => $change_player_args,
            'statistics_by_teams' => $statistics['statistics_by_teams'],
            'action_label_args'   => $statistics['action_label_args'],
            'stat_by_foul_args'   => $statistics['stat_by_foul_args'],
            'two_teams_args'      => $statistics['two_teams_args'],
            'card_type_args'      => $statistics['card_type_args'],
        ];

        return $data;
    }
    // report002
    public function ballControlRateOfTeams($id)
    {
        $match = $this->__matchRepo->findByIdWithRelationship($id);
        if (!$match) {
            return abort(404);
        }
        // data team in match
        $list_data = $this->__getListData($match);
        $round     = $this->__getRounds($list_data);

        //時間帯支配率・ゴール・シュート
        $ball_control_rate = $this->_getDataTeamBallControlRate($match->team1_ball_control, $match->team2_ball_control);

        // show infor teams
        $lineup1     = $this->__lineUpRepo->findInWeb($match->lineup_id1);
        $lineup2     = $this->__lineUpRepo->findInWeb($match->lineup_id2);
        $starting1   = collect($lineup1->starting)->groupBy('position');
        $starting2   = collect($lineup2->starting)->groupBy('position');
        $substitute1 = collect($lineup1->substitute)->groupBy('position');
        $substitute2 = collect($lineup2->substitute)->groupBy('position');
        //チームスタッツ
        $team_1               = $this->__teamRepo->find($match->team_id1);
        $team_2               = $this->__teamRepo->find($match->team_id2);
        $member_team_1        = $this->__memberRepo->getMemberStats($match->team_id1)->pluck('id')->toArray();
        $member_team_2        = $this->__memberRepo->getMemberStats($match->team_id2)->pluck('id')->toArray();
        $stats                = $this->__statRepo->getStatsTeamByTimePeriodInRound($match->id, 0, 0, "");
        $member_anonymous_id1 = -1;
        $member_anonymous_id2 = -2;

        $team_1 = $this->_getDataMatchsTeams($stats, $member_team_1, $team_1, $member_anonymous_id1);
        $team_2 = $this->_getDataMatchsTeams($stats, $member_team_2, $team_2, $member_anonymous_id2);

        // 戦評
        $comment = $this->__commentRepo->getDetail(['match_id' => $match->id]);
        $title   = '試合レポートPDF｜サッカープラス - Soccer-Plus';

        return [
            'match'             => $match,
            'round'             => $round,
            'ball_control_rate' => $ball_control_rate,
            'starting1'         => $starting1,
            'substitute1'       => $substitute1,
            'starting2'         => $starting2,
            'substitute2'       => $substitute2,
            'team_1'            => $team_1,
            'team_2'            => $team_2,
            'comment'           => $comment,
        ];
    }
    // report003
    public function startingLineUpVerticalCharts($matches_id)
    {
        $data = array();
        if (!@$matches_id) {
            abort(404);
        }
        $match = $this->__getDataMatch($matches_id);
        if (is_null($match)) {
            abort(404);
        }
        $match_common_info = $this->__getListData($match);
        /**
         * Part 1
         */
        $position_key   = config('constants.member_position.key');
        $position_label = config('constants.member_position.label');
        $FW             = (int) $position_key['FW'];
        $MF             = (int) $position_key['MF'];
        $DF             = (int) $position_key['DF'];
        $GK             = (int) $position_key['GK'];
        $position_args  = [$FW, $MF, $DF, $GK];
        // Find team home
        $team_home_id = $match->team_owner == 1 ? $match->team1->id : $match->team2->id;
        $color_team1  = $match->team1->color_home;
        if ($match->team_color1 == 2) {
            $color_team1 = $match->team1->color_guest;
        }
        $color_team2 = $match->team2->color_home;
        if ($match->team_color2 == 2) {
            $color_team2 = $match->team2->color_guest;
        }

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

        $starting1 = collect($lineup1->starting)->groupBy('position'); // cầu thủ ở đội hình xuất phát
        $starting2 = collect($lineup2->starting)->groupBy('position'); // cầu thủ ở đội hình xuất phát
        /**
         * Part 2
         */
        $time                 = 0;
        $team_1               = $this->__teamRepo->find($match->team_id1);
        $team_2               = $this->__teamRepo->find($match->team_id2);
        $member_team_1        = $this->__memberRepo->getMemberStats($match->team_id1)->pluck('id')->toArray();
        $member_team_2        = $this->__memberRepo->getMemberStats($match->team_id2)->pluck('id')->toArray();
        $stats                = $this->__statRepo->getStatsTeamByTimePeriodInRound($match->id, null, $time, null); // $round = null, $time = 0, $sub_time = null same page ScorebookMatchesStatController
        $member_anonymous_id1 = -1;
        $member_anonymous_id2 = -2;
        //Tab 2 in admin
        $box_score_team1               = TransformDataStat::boxScoreTeamProbability($stats, $member_team_1, $team_1, null, null, null, $member_anonymous_id1);
        $team_1->ratio_goal            = $box_score_team1['ratio_goal']; // Tỉ lệ ghi bàn
        $team_1->ratio_kick_goal       = $box_score_team1['ratio_kick_goal']; // Tỉ lệ sút gôn
        $team_1->ratio_cross           = $box_score_team1['ratio_cross']; // Tỉ lệ cross bóng thành công
        $team_1->ratio_tackle_overhead = $box_score_team1['ratio_tackle_overhead']; // Tỉ lệ tranh bóng trên không
        $team_1->ratio_tackle          = $box_score_team1['ratio_tackle']; // Tỉ lệ cướp bóng
        $team_1->ratio_clear           = $box_score_team1['ratio_clear']; // Tỉ lệ clear bóng
        $team_1->ratio_save            = $box_score_team1['ratio_save']; // Tỉ lệ save sút bóng
        $team_1->ratio_second_ball     = $box_score_team1['ratio_second_ball']; // Tỉ lệ thu hồi bóng 2

        $box_score_team2               = TransformDataStat::boxScoreTeamProbability($stats, $member_team_2, $team_2, null, null, null, $member_anonymous_id2);
        $team_2->ratio_goal            = $box_score_team2['ratio_goal']; // Tỉ lệ ghi bàn
        $team_2->ratio_kick_goal       = $box_score_team2['ratio_kick_goal']; // Tỉ lệ sút gôn
        $team_2->ratio_cross           = $box_score_team2['ratio_cross']; // Tỉ lệ cross bóng thành công
        $team_2->ratio_tackle_overhead = $box_score_team2['ratio_tackle_overhead']; // Tỉ lệ tranh bóng trên không
        $team_2->ratio_tackle          = $box_score_team2['ratio_tackle']; //Tỉ lệ cướp bóng
        $team_2->ratio_clear           = $box_score_team2['ratio_clear']; //Tỉ lệ clear bóng
        $team_2->ratio_save            = $box_score_team2['ratio_save']; // Tỉ lệ save sút bóng
        $team_2->ratio_second_ball     = $box_score_team2['ratio_second_ball']; // Tỉ lệ thu hồi bóng 2

        $title = '試合レポートPDF｜サッカープラス - Soccer-Plus';

        return [
            'color_team1'       => $color_team1,
            'color_team2'       => $color_team2,
            'lineup1'           => $lineup1,
            'starting1'         => $starting1,
            'lineup2'           => $lineup2,
            'starting2'         => $starting2,
            'match_common_info' => $match_common_info,
            'position_args'     => $position_args,
            'position_label'    => $position_label,
            'FW'                => $FW,
            'MF'                => $MF,
            'DF'                => $DF,
            'GK'                => $GK,
            'team_1'            => $team_1,
            'team_2'            => $team_2,
        ];
    }
    // report004
    public function analysisChartTeams($id)
    {
        $match                        = $this->__matchRepo->findByIdWithRelationship($id);
        $member_anonymous_id          = -1;
        $negative_member_anonymous_id = -2;
        $zones                        = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L'];
        $color_team1                  = $match->team1->color_home;
        $result                       = 1;
        if ($match->team_color1 == 2) {
            $color_team1 = $match->team1->color_guest;
        }
        $color_team2 = $match->team2->color_home;
        if ($match->team_color2 == 2) {
            $color_team2 = $match->team2->color_guest;
        }
        $team_1             = $this->__teamRepo->find($match->team_id1);
        $team_1->color_team = config('constants.team_color.' . $color_team1);
        $team_2             = $this->__teamRepo->find($match->team_id2);
        $team_2->color_team = config('constants.team_color.' . $color_team2);
        $member_team_1      = $this->__memberRepo->getMemberStats($match->team_id1)->pluck('id')->toArray();
        $member_team_2      = $this->__memberRepo->getMemberStats($match->team_id2)->pluck('id')->toArray();
        if ($match->team1->is_home != 1 && $match->team2->is_home != 1) {
            if ($match->team_owner == 1) {
                $team_home             = $match->team1->id;
                $line_up_team_home_id  = $match->lineup_id1;
                $team_guest            = $match->team2->id;
                $line_up_team_guest_id = $match->lineup_id2;
                $color_team_home       = $team_1->color_team;
                $color_team_guest      = $team_2->color_team;
                $team_home_name        = $match->team1->name;
                $team_guest_name       = $match->team2->name;
            } else {
                $team_home             = $match->team2->id;
                $line_up_team_home_id  = $match->lineup_id2;
                $team_guest            = $match->team1->id;
                $line_up_team_guest_id = $match->lineup_id1;
                $color_team_home       = $team_2->color_team;
                $color_team_guest      = $team_1->color_team;
                $team_home_name        = $match->team2->name;
                $team_guest_name       = $match->team1->name;
            }
        } else {
            if ($match->team1->is_home == 1) {
                $team_home             = $match->team1->id;
                $line_up_team_home_id  = $match->lineup_id1;
                $team_guest            = $match->team2->id;
                $line_up_team_guest_id = $match->lineup_id2;
                $color_team_home       = $team_1->color_team;
                $color_team_guest      = $team_2->color_team;
                $team_home_name        = $match->team1->name;
                $team_guest_name       = $match->team2->name;
            } else {
                if ($match->team_owner == 1) {
                    $team_home             = $match->team2->id;
                    $line_up_team_home_id  = $match->lineup_id2;
                    $team_guest            = $match->team1->id;
                    $line_up_team_guest_id = $match->lineup_id1;
                    $color_team_home       = $team_2->color_team;
                    $color_team_guest      = $team_1->color_team;
                    $team_home_name        = $match->team2->name;
                    $team_guest_name       = $match->team1->name;
                } else {
                    $team_home             = $match->team1->id;
                    $line_up_team_home_id  = $match->lineup_id1;
                    $team_guest            = $match->team2->id;
                    $line_up_team_guest_id = $match->lineup_id2;
                    $color_team_home       = $team_1->color_team;
                    $color_team_guest      = $team_2->color_team;
                    $team_home_name        = $match->team1->name;
                    $team_guest_name       = $match->team2->name;
                }
            }
        }
        $line_up_team_home  = $this->__lineUpRepo->findInWeb($line_up_team_home_id);
        $line_up_team_guest = $this->__lineUpRepo->findInWeb($line_up_team_guest_id);
        $arr_member_home    = [];
        foreach ($line_up_team_home->starting as $value) {
            array_push($arr_member_home, $value['member_id']);
        }
        foreach ($line_up_team_home->substitute as $value) {
            array_push($arr_member_home, $value['member_id']);
        }
        $arr_member_guest = [];
        foreach ($line_up_team_guest->starting as $value) {
            array_push($arr_member_guest, $value['member_id']);
        }
        foreach ($line_up_team_guest->substitute as $value) {
            array_push($arr_member_guest, $value['member_id']);
        }
        $stats                    = $this->__statRepo->getStatsTeam($id);
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
        $goal_number_analysis_home      = [];
        $goal_coordinate_analysis_home  = [];
        $goal_number_analysis_guest     = [];
        $goal_coordinate_analysis_guest = [];
        for ($i = 1; $i <= 19; $i++) {
            $counter_value_home  = 0;
            $counter_total_home  = 0;
            $counter_value_guest = 0;
            $counter_total_guest = 0;
            foreach ($stats as $key => $value) {
                if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value->ball_goal_number == $i && (in_array($value->member_id, $arr_member_home) || $value->member_anonymous_id == $member_anonymous_id) && in_array($value->shoot_area_key, $zones)) {
                    $counter_total_home += 1;
                    $goal_coordinate_analysis_home[$i][$value->id]['coord_x'] = $value->ball_goal_number_coord_x;
                    $goal_coordinate_analysis_home[$i][$value->id]['coord_y'] = $value->ball_goal_number_coord_y;
                    if ($value->result == 1) {
                        $counter_value_home += 1;
                    }
                }
                if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value->ball_goal_number == $i && (in_array($value->member_id, $arr_member_guest) || $value->member_anonymous_id == $negative_member_anonymous_id) && in_array($value->shoot_area_key, $zones)) {
                    $counter_total_guest += 1;
                    $goal_coordinate_analysis_guest[$i][$value->id]['coord_x'] = $value->ball_goal_number_coord_x;
                    $goal_coordinate_analysis_guest[$i][$value->id]['coord_y'] = $value->ball_goal_number_coord_y;
                    if ($value->result == 1) {
                        $counter_value_guest += 1;
                    }
                }
            }
            $goal_number_analysis_home[$i]['counter_value_home'] = $counter_value_home;
            $goal_number_analysis_home[$i]['counter_total_home'] = $counter_total_home;
            $goal_number_analysis_home[$i]['probability']   = $this->__roundNumberProbability($counter_value_home, $counter_total_home);
            $goal_number_analysis_home[$i]['color']         = $this->__renderColorShortChart($this->__roundNumberProbability($counter_value_home, $counter_total_home));
            $goal_number_analysis_guest[$i]['counter_value_guest'] = $counter_value_guest;
            $goal_number_analysis_guest[$i]['counter_total_guest'] = $counter_total_guest;
            $goal_number_analysis_guest[$i]['probability']   = $this->__roundNumberProbability($counter_value_guest, $counter_total_guest);
            $goal_number_analysis_guest[$i]['color']         = $this->__renderColorShortChart($this->__roundNumberProbability($counter_value_guest, $counter_total_guest));
        }

        $title = '試合レポートPDF｜サッカープラス - Soccer-Plus';

        return [
            'goal_number_analysis_home'            => $goal_number_analysis_home,
            'goal_coordinate_analysis_home'        => $goal_coordinate_analysis_home,
            'goal_number_analysis_guest'           => $goal_number_analysis_guest,
            'goal_coordinate_analysis_guest'       => $goal_coordinate_analysis_guest,
            'analysis_home_kick_goal'              => $this->__analysisKick($stats, $arr_member_home, $member_anonymous_id),
            'analysis_guest_kick_goal'             => $this->__analysisKick($stats, $arr_member_guest, $negative_member_anonymous_id),
            'analysis_home_kick_opportunity'       => $this->__analysisKick($stats, $arr_member_home, $member_anonymous_id, [1, 0]),
            'analysis_guest_kick_opportunity'      => $this->__analysisKick($stats, $arr_member_guest, $negative_member_anonymous_id, [1, 0]),
            'color_team_home'                      => $color_team_home,
            'color_team_guest'                     => $color_team_guest,
            'team_home_name'                       => $team_home_name,
            'team_guest_name'                      => $team_guest_name,
        ];
    }

    public function __analysisKick($stats, $arr_member_id, $member_anonymous_id, $result = [1])
    {
        $pk                 = 0;
        $set_play_direct    = 0;
        $kick_from_set_play = 0;
        $cross              = 0;
        $through_pass       = 0;
        $short_pass         = 0;
        $long_pass          = 0;
        $pass               = 0;
        $overflow           = 0;
        $short_counter      = 0;
        $other              = 0;
        foreach ($stats as $key => $value) {
            if ($value->action_id == config('constants.action_map.pk_free_kick.id') && (in_array($value->member_id, $arr_member_id) || $value->member_anonymous_id == $member_anonymous_id) && in_array($value->result, $result)) {
                $pk += 1;
            }
            if ($value->action_id == config('constants.action_map.kick.id') && (in_array($value->member_id, $arr_member_id) || $value->member_anonymous_id == $member_anonymous_id) && $value->action_kick_situation_id == config('constants.kick_situation.key.set_play_direct') && in_array($value->result, $result)) {
                $set_play_direct += 1;
            }
            if ($value->action_id == config('constants.action_map.kick.id') && (in_array($value->member_id, $arr_member_id) || $value->member_anonymous_id == $member_anonymous_id) && $value->action_kick_situation_id == config('constants.kick_situation.key.kick_from_set_play') && in_array($value->result, $result)) {
                $kick_from_set_play += 1;
            }
            if ($value->action_id == config('constants.action_map.kick.id') && (in_array($value->member_id, $arr_member_id) || $value->member_anonymous_id == $member_anonymous_id) && $value->action_kick_situation_id == config('constants.kick_situation.key.cross') && in_array($value->result, $result)) {
                $cross += 1;
            }
            if ($value->action_id == config('constants.action_map.kick.id') && (in_array($value->member_id, $arr_member_id) || $value->member_anonymous_id == $member_anonymous_id) && $value->action_kick_situation_id == config('constants.kick_situation.key.through_pass') && in_array($value->result, $result)) {
                $through_pass += 1;
            }
            if ($value->action_id == config('constants.action_map.kick.id') && (in_array($value->member_id, $arr_member_id) || $value->member_anonymous_id == $member_anonymous_id) && $value->action_kick_situation_id == config('constants.kick_situation.key.short_pass') && in_array($value->result, $result)) {
                $short_pass += 1;
            }
            if ($value->action_id == config('constants.action_map.kick.id') && (in_array($value->member_id, $arr_member_id) || $value->member_anonymous_id == $member_anonymous_id) && $value->action_kick_situation_id == config('constants.kick_situation.key.long_pass') && in_array($value->result, $result)) {
                $long_pass += 1;
            }
            if ($value->action_id == config('constants.action_map.kick.id') && (in_array($value->member_id, $arr_member_id) || $value->member_anonymous_id == $member_anonymous_id) && $value->action_kick_situation_id == config('constants.kick_situation.key.pass') && in_array($value->result, $result)) {
                $pass += 1;
            }
            if ($value->action_id == config('constants.action_map.kick.id') && (in_array($value->member_id, $arr_member_id) || $value->member_anonymous_id == $member_anonymous_id) && $value->action_kick_situation_id == config('constants.kick_situation.key.overflow') && in_array($value->result, $result)) {
                $overflow += 1;
            }
            if ($value->action_id == config('constants.action_map.kick.id') && (in_array($value->member_id, $arr_member_id) || $value->member_anonymous_id == $member_anonymous_id) && $value->action_kick_situation_id == config('constants.kick_situation.key.short_counter') && in_array($value->result, $result)) {
                $short_counter += 1;
            }
            if ($value->action_id == config('constants.action_map.kick.id') && (in_array($value->member_id, $arr_member_id) || $value->member_anonymous_id == $member_anonymous_id) && $value->action_kick_situation_id == config('constants.kick_situation.key.other') && in_array($value->result, $result)) {
                $other += 1;
            }
        }
        $analysis                       = [];
        $analysis['pk']                 = $pk;
        $analysis['set_play_direct']    = $set_play_direct;
        $analysis['kick_from_set_play'] = $kick_from_set_play;
        $analysis['cross']              = $cross;
        $analysis['through_pass']       = $through_pass;
        $analysis['short_pass']         = $short_pass;
        $analysis['long_pass']          = $long_pass;
        $analysis['pass']               = $pass;
        $analysis['overflow']           = $overflow;
        $analysis['short_counter']      = $short_counter;
        $analysis['other']              = $other;

        return $analysis;
    }

    public function __roundNumberProbability($value, $total)
    {
        if ($total == 0) {
            return 0;
        }

        $number = ($value / $total) * 100;
        return round($number, 0);
    }

    public function __renderColorShortChart($ratio)
    {
        if ($ratio > 80) {
            return 'level level5';
        } else if ($ratio > 60) {
            return 'level level4';
        } else if ($ratio > 40) {
            return 'level level3';
        } else if ($ratio > 20) {
            return 'level level2';
        } else {
            return '';
        }
    }
    // report005
    public function analysisChartAwayTeams(Request $request)
    {
        $data  = array();
        $title = '試合レポートPDF｜サッカープラス - Soccer-Plus';

        return view('web.pdf_report.analysischart_awayteam', [
            'data' => $data,
        ]);
    }
    // render report file PDF
    public function renderReportPDF($html, $title): void
    {
        $defaultConfig     = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs          = $defaultConfig['fontDir'];
        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData          = $defaultFontConfig['fontdata'];
        $mpdf              = new \Mpdf\Mpdf([
            'fontDir'      => array_merge($fontDirs, [
                'fonts/',
            ]),
            'fontdata'     => $fontData + [
                'ipaexg' => [
                    'R' => 'ipaexg.ttf',
                ],
            ],
            'default_font' => 'ipaexg',
            'orientation'  => 'L', // P
            'mode'         => 'utf-8',
            'format'       => 'A4', //A4-L, L, [300, 400]
        ]);
        // $mpdf->showImageErrors = true;
        $mpdf->SetTitle($title);
        $mpdf->SetAuthor('soccer-plus.jp');

        $mpdf->WriteHTML($html);
        $mpdf->SetProtection(array('print'));
        $mpdf->Output();
    }

    protected function __getDataMatch($id)
    {
        return $this->__matchRepo->findByIdWithRelationship($id);
    }

    protected function __getListData($data_match)
    {
        return $this->__matchRepo->getCommonInfo($data_match->id);
    }

    private function _getDataMatchsTeams($stats, $member_team, $team, $member_anonymous_id)
    {
        $score_team = TransformDataStat::boxScoreTeamNumber($stats, $member_team, $team, null, null, null, $member_anonymous_id);

        $team->goal                  = $score_team['goal'] ?? '';
        $team->kick                  = $score_team['kick'] ?? '';
        $team->kick_goal             = $score_team['kick_goal'] ?? '';
        $team->assist                = $score_team['assist'] ?? '';
        $team->last_pass             = $score_team['last_pass'] ?? '';
        $team->cross                 = $score_team['cross'] ?? '';
        $team->pass_dribble          = $score_team['pass_dribble'] ?? '';
        $team->fouled                = $score_team['fouled'] ?? '';
        $team->cut_ball              = $score_team['cut_ball'] ?? '';
        $team->clear                 = $score_team['clear'] ?? '';
        $team->block                 = $score_team['block'] ?? '';
        $team->foul                  = $score_team['foul'] ?? '';
        $team->second_ball           = $score_team['second_ball'] ?? '';
        $team->is_pa                 = $score_team['is_pa'] ?? '';
        $team->penalty_golf          = $score_team['penalty_golf'] ?? '';
        $team->corner_kick           = $score_team['corner_kick'] ?? '';
        $team->free_kick             = $score_team['free_kick'] ?? '';
        $team->pk                    = $score_team['pk'] ?? '';
        $team->tackle_overhead_home  = $score_team['tackle_overhead_home'] ?? '';
        $team->tackle_overhead_guest = $score_team['tackle_overhead_guest'] ?? '';
        $team->save                  = $score_team['save'] ?? '';

        return $team;
    }

    private function _getDataTeamBallControlRate($team1_ball_control, $team2_ball_control)
    {
        $ball_control_rate = [];
        if ($team1_ball_control && $team2_ball_control) {
            $team1_ball = json_decode($team1_ball_control);
            $team2_ball = json_decode($team2_ball_control);
            foreach ($team1_ball as $key => $value) {
                $ball_control = [
                    'team1_rate' => (array) $value,
                    'team2_rate' => (array) @$team2_ball->$key,
                ];
                $ball_control_rate[$key] = $ball_control;
            }
        }

        return $ball_control_rate;
    }

    protected function __getMatch($list_data, $data_match)
    {
        $round_time = $this->__getRoundTime($list_data);

        if (!is_null($data_match->start_date)) {
            $start_date_time = $list_data->match->start_date->format('Y/m/d') . ' / ' . $list_data->match->start_time;
        }

        return [
            'type'            => config('constants.match_type.label.' . $list_data->match->type),
            'conference_name' => $list_data->match->conference_name,
            'start_date_time' => $start_date_time ?? null,
            'place'           => $list_data->match->place,
            'round_time'      => $round_time,
            'number_people'   => $list_data->match->number_people,
            'penalty'         => config('constants.penalty.label.' . $list_data->match->penalty),
            'pitch_type'      => config('constants.pitch_type.label.' . $list_data->match->pitch_type),
            'situation'       => config('constants.situation.label.' . $list_data->match->situation),
            'referee'         => $list_data->match->referee,
            'linesman'        => $list_data->match->linesman,
            'fourth_referee'  => $list_data->match->fourth_referee,
        ];
    }

    protected function __getRoundTime($list_data)
    {
        $name_round = [
            'round1_time' => '1ST',
            'round2_time' => '2ND',
            'round3_time' => '3RD',
            'round4_time' => '4TH',
        ];
        $round_time = [
            'round1_time' => $list_data->match->round1_time,
            'round2_time' => $list_data->match->round2_time,
            'round3_time' => $list_data->match->round3_time,
            'round4_time' => $list_data->match->round4_time,
        ];
        foreach ($round_time as $key => $value) {
            if (!is_null($value)) {
                if ($key == 'round1_time') {
                    $round_time[$key] = $name_round[$key] . '：' . $value . '分';
                } else {
                    $round_time[$key] = ' / ' . $name_round[$key] . '：' . $value . '分';
                }
            } else {
                unset($round_time[$key]);
            }
        }
        return implode("", $round_time);
    }

    protected function __getChangePlayer($stats, $team_home_id)
    {
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

        return $change_player_args;
    }

    protected function __getReportRound($stats, $data_match, $team_home_id, $lineup1, $lineup2)
    {
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

        $goal                   = [];
        $action_kick_id         = config('constants.action_map.kick.id');
        $action_pk_free_kick_id = config('constants.action_map.pk_free_kick.id');

        foreach ($stats as $member_id => $member_stats) {

            // Set val 0 for each round
            foreach ($rounds as $round) {
                $goal[$member_id][$round] = 0;
            }

            foreach ($member_stats as $key => $stat) {
                if (is_anonymous_stat_belong_to_team($data_match->team_id1, $team_home_id, $stat->member_anonymous_id)) {
                    $member_id = $stat->member_anonymous_id;

                    if (!isset($goal['anonymous_left'][$member_id][$round])) {
                        // Set val 0 for each round
                        foreach ($rounds as $round) {
                            $goal['anonymous_left'][$member_id][$round] = 0;
                        }
                    }

                    if ($stat->action_id == $action_kick_id || $stat->action_id == $action_pk_free_kick_id) {
                        $goal['anonymous_left'][$member_id][$stat->created_at_round] += 1;
                    }
                } elseif (is_anonymous_stat_belong_to_team($data_match->team_id2, $team_home_id, $stat->member_anonymous_id)) {
                    $member_id = $stat->member_anonymous_id;

                    if (!isset($goal['anonymous_right'][$member_id][$round])) {
                        // Set val 0 for each round
                        foreach ($rounds as $round) {
                            $goal['anonymous_right'][$member_id][$round] = 0;
                        }
                    }

                    if ($stat->action_id == $action_kick_id || $stat->action_id == $action_pk_free_kick_id) {
                        $goal['anonymous_right'][$member_id][$stat->created_at_round] += 1;
                    }
                } else {
                    if ($stat->action_id == $action_kick_id || $stat->action_id == $action_pk_free_kick_id) {
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

        return [
            'rounds'                => $rounds,
            'lineup1_starting'      => $lineup1->starting,
            'lineup2_starting'      => $lineup2->starting,
            'goal'                  => $goal,
            'member_caculator_args' => $member_caculator_args,
        ];
    }

    protected function __getLineup($lineup_id)
    {
        $lineup           = $this->__lineUpRepo->findInWeb($lineup_id);
        $lineup->starting = collect($lineup->starting)->map(function ($member) {
            $member['position_label'] = config('constants.member_position.label.' . $member['position']);
            $member['full_name']      = trim(($member['first_name'] || $member['last_name']) ? $member['first_name'] . "  " . $member['last_name'] : '?');
            return $member;
        });
        $lineup->substitute = collect($lineup->substitute)->map(function ($member) {
            $member['position_label'] = config('constants.member_position.label.' . $member['position']);
            $member['full_name']      = trim(($member['first_name'] || $member['last_name']) ? $member['first_name'] . "  " . $member['last_name'] : '?');
            return $member;
        });

        return $lineup;
    }

    protected function __getStatisticsAction($rounds, $stats_by_part4, $team_home_id, $data_match)
    {
        $card_type_args = [
            0 => '_',
            1 => 'none',
            2 => 'yellow',
            3 => 'red',
        ];

        // initial value by statistics
        $action_by_key_args = [
            'kick'               => 'シュート',     // シュート
            'kick_'              => '枠内シュート',   // 枠内シュート ($stat->action_id == kick and $stat->result == 0)
            'goal_kick'          => 'GK',       // GK (ゴールキック)
            'corner_kick'        => 'CK',       // CK (コーナーキック)
            'direct_free_kick'   => '直接FK',     // 直接FK
            'indirect_free_kick' => '間接FK',     // 間接FK
            'offside'            => 'オフサイド',    // オフサイド
            'pk_free_kick'       => 'PK',       // PK
            'yellow'             => '警告',       // 警告
            'red'                => '退場',       // 退場
        ];
        $action_label_args   = [];
        $statistics_by_teams = [];
        $stat_by_foul_args   = [];
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
                    if ($name == 'pk_free_kick' && $stat->action_id == config("constants.action_map.pk_free_kick.id")) {
                        $statistics_by_teams[1][$team_position][$round_by_stat] += 1;
                        $statistics_by_teams['kick_'][$team_position][$round_by_stat] += 1;
                    }
                    $statistics_by_teams[$stat->action_id][$team_position][$round_by_stat] += 1;
                }
            }
        }
        // Find member foul ファウル
        foreach ($stats_by_part4 as $k => $stat) {
            if ($stat->action_id == config("constants.action_map.foul.id")) {
                if ($stat->member_id) {
                    if ($team_home_id == $stat->member?->team_id) {
                        $stat_by_foul_args[$data_match->team_id1][] = $stat;
                    } else {
                        $stat_by_foul_args[$data_match->team_id2][] = $stat;
                    }
                } else {
                    if (is_anonymous_stat_belong_to_team($data_match->team_id1, $team_home_id, $stat->member_anonymous_id)) {
                        $stat_by_foul_args[$data_match->team_id1][] = $stat;
                    } elseif (is_anonymous_stat_belong_to_team($data_match->team_id2, $team_home_id, $stat->member_anonymous_id)) {
                        $stat_by_foul_args[$data_match->team_id2][] = $stat;
                    }
                }
            }
        }
        $two_teams_args = [
            $data_match->team_id1 => $data_match->team1->name,
            $data_match->team_id2 => $data_match->team2->name,
        ];

        return [
            'statistics_by_teams' => $statistics_by_teams,
            'action_label_args'   => $action_label_args,
            'stat_by_foul_args'   => $stat_by_foul_args,
            'two_teams_args'      => $two_teams_args,
            'card_type_args'      => $card_type_args,
        ];
    }

    protected function __getRounds($list_data) {
        $stat_goals_team1 = collect($list_data->stat_goals['team1'])->sortBy('time')->sortBy('round');
        $stat_goals_team2 = collect($list_data->stat_goals['team2'])->sortBy('time')->sortBy('round');
        if (isset($list_data->stat_score['_PK'])) {
            $list_data->stat_score['_PK']['team1'] = $list_data->match->team1_score_pk ?? 0;
            $list_data->stat_score['_PK']['team2'] = $list_data->match->team2_score_pk ?? 0;
        }
        
        return [
            'team1'            => $list_data->match->team1->name,
            'team2'            => $list_data->match->team2->name,
            'team1_score'      => $list_data->match->team1_score,
            'team2_score'      => $list_data->match->team2_score,
            'stat_score'       => $list_data->stat_score,
            'stat_goals'       => $list_data->stat_goals,
            'stat_goals_team1' => $stat_goals_team1,
            'stat_goals_team2' => $stat_goals_team2
        ];
    }
}

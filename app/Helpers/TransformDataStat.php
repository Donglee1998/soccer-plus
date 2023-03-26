<?php

namespace App\Helpers;

class TransformDataStat
{
    public static function boxScoreTeamNumber($stats, $member_team, $team, $match = null, $time = null, $sub_time = null, $member_anonymous_id = null)
    {
        $box_score                    = [];
        $goal                         = 0;
        $kick                         = 0;
        $kick_goal                    = 0;
        $assist                       = 0;
        $last_pass                    = 0;
        $cross                        = 0;
        $pass_dribble                 = 0;
        $fouled                       = 0;
        $cut_ball                     = 0;
        $clear                        = 0;
        $block                        = 0;
        $foul                         = 0;
        $second_ball                  = 0;
        $is_pa                        = 0;
        $penalty_golf                 = 0;
        $corner_kick                  = 0;
        $free_kick                    = 0;
        $pk                           = 0;
        $tackle_overhead_home         = 0;
        $tackle_overhead_guest        = 0;
        $save                         = 0;
        $negative_member_anonymous_id = $member_anonymous_id == -1 ? -2 : -1;
        if ($match) {
            $ms_in_round1 = $time * 60000 / 3;
            $ms_in_round2 = $time * 60000 / 3 * 2;
            foreach ($stats as $key => $value) {
                if ($value->match_id == $match->id) {
                    if ($sub_time == 1) {
                        if ($value->timer_at <= $ms_in_round1) {
                            if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value->result == 1 && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $goal += 1;
                            }
                            if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $kick += 1;
                            }
                            if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && in_array($value->ball_goal_number, config('constants.goal_numbers'))) {
                                $kick_goal += 1;
                            }
                            if ($value->action_id == config('constants.action_map.assist.id') && $value->result == 1 && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $assist += 1;
                            }
                            if ($value->action_id == config('constants.action_map.assist.id') && $value->result != 1 && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $last_pass += 1;
                            }
                            if (in_array($value->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $cross += 1;
                            }
                            if ($value->action_id == config('constants.action_map.pass.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && $value->result == 1) {
                                $pass_dribble += 1;
                            }
                            if ($value->action_id == config('constants.action_map.fouled.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $fouled += 1;
                            }
                            if (in_array($value->action_id, [config('constants.action_map.tackle.id'), config('constants.action_map.block.id'), config('constants.action_map.intercept.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && $value->result == 1) {
                                $cut_ball += 1;
                            }
                            if ($value->action_id == config('constants.action_map.clear.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $clear += 1;
                            }
                            if ($value->action_id == config('constants.action_map.block.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $block += 1;
                            }
                            if ($value->action_id == config('constants.action_map.foul.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $foul += 1;
                            }
                            if ($value->action_id == config('constants.action_map.second_ball.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $second_ball += 1;
                            }
                            if ((($value->is_pa_guest_area && $team->is_home) || ($value->is_pa_home_area && !$team->is_home)) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $is_pa += 1;
                            }
                            if ($value->action_id == config('constants.action_map.goal_kick.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $penalty_golf += 1;
                            }
                            if ($value->action_id == config('constants.action_map.corner_kick.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $corner_kick += 1;
                            }
                            if ($value->action_id == config('constants.action_map.direct_free_kick.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $free_kick += 1;
                            }
                            if ($value->action_id == config('constants.action_map.pk_free_kick.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $pk += 1;
                            }
                            if ((($value->is_pitch_home_area && $team->is_home) || ($value->is_pitch_guest_area && !$team->is_home)) && $value->action_id == config('constants.action_map.tackle_overhead.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && $value->result == 1) {
                                $tackle_overhead_home += 1;
                            }
                            if ((($value->is_pitch_guest_area && $team->is_home) || ($value->is_pitch_home_area && !$team->is_home)) && $value->action_id == config('constants.action_map.tackle_overhead.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && $value->result == 1) {
                                $tackle_overhead_guest += 1;
                            }
                            $contribution_data  = json_decode($value->action_contribution_data, true);
                            $contribution_score = json_decode($value->action_contribution_score, true);
                            if ((in_array($value->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) || (((!in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $negative_member_anonymous_id) && in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value->result != 1)) {
                                if (isset($contribution_data['shoot'])) {
                                    $save += 1;
                                } elseif (isset($contribution_score['stop_pk'])) {
                                    $save += 1;
                                } elseif (in_array($value->guest_gk_member_id, $member_team)) {
                                    $save += 1;
                                } elseif (in_array($value->home_gk_member_id, $member_team)) {
                                    $save += 1;
                                }
                            }
                        }
                    } else if ($sub_time == 2) {
                        if ($value->timer_at > $ms_in_round1 && $value->timer_at <= $ms_in_round2) {
                            if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value->result == 1 && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $goal += 1;
                            }
                            if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $kick += 1;
                            }
                            if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && in_array($value->ball_goal_number, config('constants.goal_numbers'))) {
                                $kick_goal += 1;
                            }
                            if ($value->action_id == config('constants.action_map.assist.id') && $value->result == 1 && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $assist += 1;
                            }
                            if ($value->action_id == config('constants.action_map.assist.id') && $value->result != 1 && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $last_pass += 1;
                            }
                            if (in_array($value->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $cross += 1;
                            }
                            if ($value->action_id == config('constants.action_map.pass.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && $value->result == 1) {
                                $pass_dribble += 1;
                            }
                            if ($value->action_id == config('constants.action_map.fouled.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $fouled += 1;
                            }
                            if (in_array($value->action_id, [config('constants.action_map.tackle.id'), config('constants.action_map.block.id'), config('constants.action_map.intercept.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && $value->result == 1) {
                                $cut_ball += 1;
                            }
                            if ($value->action_id == config('constants.action_map.clear.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $clear += 1;
                            }
                            if ($value->action_id == config('constants.action_map.block.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $block += 1;
                            }
                            if ($value->action_id == config('constants.action_map.foul.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $foul += 1;
                            }
                            if ($value->action_id == config('constants.action_map.second_ball.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $second_ball += 1;
                            }
                            if ((($value->is_pa_guest_area && $team->is_home) || ($value->is_pa_home_area && !$team->is_home)) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $is_pa += 1;
                            }
                            if ($value->action_id == config('constants.action_map.goal_kick.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $penalty_golf += 1;
                            }
                            if ($value->action_id == config('constants.action_map.corner_kick.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $corner_kick += 1;
                            }
                            if ($value->action_id == config('constants.action_map.direct_free_kick.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $free_kick += 1;
                            }
                            if ($value->action_id == config('constants.action_map.pk_free_kick.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $pk += 1;
                            }
                            if ((($value->is_pitch_home_area && $team->is_home) || ($value->is_pitch_guest_area && !$team->is_home)) && $value->action_id == config('constants.action_map.tackle_overhead.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && $value->result == 1) {
                                $tackle_overhead_home += 1;
                            }
                            if ((($value->is_pitch_guest_area && $team->is_home) || ($value->is_pitch_home_area && !$team->is_home)) && $value->action_id == config('constants.action_map.tackle_overhead.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && $value->result == 1) {
                                $tackle_overhead_guest += 1;
                            }
                            $contribution_data  = json_decode($value->action_contribution_data, true);
                            $contribution_score = json_decode($value->action_contribution_score, true);
                            if ((in_array($value->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) || (((!in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $negative_member_anonymous_id) && in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value->result != 1)) {
                                if (isset($contribution_data['shoot'])) {
                                    $save += 1;
                                } elseif (isset($contribution_score['stop_pk'])) {
                                    $save += 1;
                                } elseif (in_array($value->guest_gk_member_id, $member_team)) {
                                    $save += 1;
                                } elseif (in_array($value->home_gk_member_id, $member_team)) {
                                    $save += 1;
                                }
                            }
                        }
                    } else if ($sub_time == 3) {
                        if ($value->timer_at > $ms_in_round2) {
                            if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value->result == 1 && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $goal += 1;
                            }
                            if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $kick += 1;
                            }
                            if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && in_array($value->ball_goal_number, config('constants.goal_numbers'))) {
                                $kick_goal += 1;
                            }
                            if ($value->action_id == config('constants.action_map.assist.id') && $value->result == 1 && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $assist += 1;
                            }
                            if ($value->action_id == config('constants.action_map.assist.id') && $value->result != 1 && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $last_pass += 1;
                            }
                            if (in_array($value->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $cross += 1;
                            }
                            if ($value->action_id == config('constants.action_map.pass.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && $value->result == 1) {
                                $pass_dribble += 1;
                            }
                            if ($value->action_id == config('constants.action_map.fouled.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $fouled += 1;
                            }
                            if (in_array($value->action_id, [config('constants.action_map.tackle.id'), config('constants.action_map.block.id'), config('constants.action_map.intercept.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && $value->result == 1) {
                                $cut_ball += 1;
                            }
                            if ($value->action_id == config('constants.action_map.clear.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $clear += 1;
                            }
                            if ($value->action_id == config('constants.action_map.block.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $block += 1;
                            }
                            if ($value->action_id == config('constants.action_map.foul.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $foul += 1;
                            }
                            if ($value->action_id == config('constants.action_map.second_ball.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $second_ball += 1;
                            }
                            if ((($value->is_pa_guest_area && $team->is_home) || ($value->is_pa_home_area && !$team->is_home)) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $is_pa += 1;
                            }
                            if ($value->action_id == config('constants.action_map.goal_kick.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $penalty_golf += 1;
                            }
                            if ($value->action_id == config('constants.action_map.corner_kick.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $corner_kick += 1;
                            }
                            if ($value->action_id == config('constants.action_map.direct_free_kick.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $free_kick += 1;
                            }
                            if ($value->action_id == config('constants.action_map.pk_free_kick.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $pk += 1;
                            }
                            if ((($value->is_pitch_home_area && $team->is_home) || ($value->is_pitch_guest_area && !$team->is_home)) && $value->action_id == config('constants.action_map.tackle_overhead.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && $value->result == 1) {
                                $tackle_overhead_home += 1;
                            }
                            if ((($value->is_pitch_guest_area && $team->is_home) || ($value->is_pitch_home_area && !$team->is_home)) && $value->action_id == config('constants.action_map.tackle_overhead.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && $value->result == 1) {
                                $tackle_overhead_guest += 1;
                            }
                            $contribution_data  = json_decode($value->action_contribution_data, true);
                            $contribution_score = json_decode($value->action_contribution_score, true);
                            if ((in_array($value->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) || (((!in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $negative_member_anonymous_id) && in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value->result != 1)) {
                                if (isset($contribution_data['shoot'])) {
                                    $save += 1;
                                } elseif (isset($contribution_score['stop_pk'])) {
                                    $save += 1;
                                } elseif (in_array($value->guest_gk_member_id, $member_team)) {
                                    $save += 1;
                                } elseif (in_array($value->home_gk_member_id, $member_team)) {
                                    $save += 1;
                                }
                            }
                        }
                    } else {
                        if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value->result == 1 && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                            $goal += 1;
                        }
                        if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                            $kick += 1;
                        }
                        if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && in_array($value->ball_goal_number, config('constants.goal_numbers'))) {
                            $kick_goal += 1;
                        }
                        if ($value->action_id == config('constants.action_map.assist.id') && $value->result == 1 && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                            $assist += 1;
                        }
                        if ($value->action_id == config('constants.action_map.assist.id') && $value->result != 1 && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                            $last_pass += 1;
                        }
                        if (in_array($value->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                            $cross += 1;
                        }
                        if ($value->action_id == config('constants.action_map.pass.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && $value->result == 1) {
                            $pass_dribble += 1;
                        }
                        if ($value->action_id == config('constants.action_map.fouled.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                            $fouled += 1;
                        }
                        if (in_array($value->action_id, [config('constants.action_map.tackle.id'), config('constants.action_map.block.id'), config('constants.action_map.intercept.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && $value->result == 1) {
                            $cut_ball += 1;
                        }
                        if ($value->action_id == config('constants.action_map.clear.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                            $clear += 1;
                        }
                        if ($value->action_id == config('constants.action_map.block.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                            $block += 1;
                        }
                        if ($value->action_id == config('constants.action_map.foul.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                            $foul += 1;
                        }
                        if ($value->action_id == config('constants.action_map.second_ball.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                            $second_ball += 1;
                        }
                        if ((($value->is_pa_guest_area && $team->is_home) || ($value->is_pa_home_area && !$team->is_home)) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                            $is_pa += 1;
                        }
                        if ($value->action_id == config('constants.action_map.goal_kick.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                            $penalty_golf += 1;
                        }
                        if ($value->action_id == config('constants.action_map.corner_kick.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                            $corner_kick += 1;
                        }
                        if ($value->action_id == config('constants.action_map.direct_free_kick.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                            $free_kick += 1;
                        }
                        if ($value->action_id == config('constants.action_map.pk_free_kick.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                            $pk += 1;
                        }
                        if ((($value->is_pitch_home_area && $team->is_home) || ($value->is_pitch_guest_area && !$team->is_home)) && $value->action_id == config('constants.action_map.tackle_overhead.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && $value->result == 1) {
                            $tackle_overhead_home += 1;
                        }
                        if ((($value->is_pitch_guest_area && $team->is_home) || ($value->is_pitch_home_area && !$team->is_home)) && $value->action_id == config('constants.action_map.tackle_overhead.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && $value->result == 1) {
                            $tackle_overhead_guest += 1;
                        }
                        $contribution_data  = json_decode($value->action_contribution_data, true);
                        $contribution_score = json_decode($value->action_contribution_score, true);
                        if ((in_array($value->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) || (((!in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $negative_member_anonymous_id) && in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value->result != 1)) {
                            if (isset($contribution_data['shoot'])) {
                                $save += 1;
                            } elseif (isset($contribution_score['stop_pk'])) {
                                $save += 1;
                            } elseif (in_array($value->guest_gk_member_id, $member_team)) {
                                $save += 1;
                            } elseif (in_array($value->home_gk_member_id, $member_team)) {
                                $save += 1;
                            }
                        }
                    }
                }
            }
        } else {
            foreach ($stats as $key => $value) {
                if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value->result == 1 && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                    $goal += 1;
                }
                if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                    $kick += 1;
                }
                if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && in_array($value->ball_goal_number, config('constants.goal_numbers'))) {
                    $kick_goal += 1;
                }
                if ($value->action_id == config('constants.action_map.assist.id') && $value->result == 1 && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                    $assist += 1;
                }
                if ($value->action_id == config('constants.action_map.assist.id') && $value->result != 1 && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                    $last_pass += 1;
                }
                if (in_array($value->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                    $cross += 1;
                }
                if ($value->action_id == config('constants.action_map.pass.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && $value->result == 1) {
                    $pass_dribble += 1;
                }
                if ($value->action_id == config('constants.action_map.fouled.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                    $fouled += 1;
                }
                if (in_array($value->action_id, [config('constants.action_map.tackle.id'), config('constants.action_map.block.id'), config('constants.action_map.intercept.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && $value->result == 1) {
                    $cut_ball += 1;
                }
                if ($value->action_id == config('constants.action_map.clear.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                    $clear += 1;
                }
                if ($value->action_id == config('constants.action_map.block.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                    $block += 1;
                }
                if ($value->action_id == config('constants.action_map.foul.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                    $foul += 1;
                }
                if ($value->action_id == config('constants.action_map.second_ball.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                    $second_ball += 1;
                }
                if ((($value->is_pa_guest_area && $team->is_home) || ($value->is_pa_home_area && !$team->is_home)) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                    $is_pa += 1;
                }
                if ($value->action_id == config('constants.action_map.goal_kick.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                    $penalty_golf += 1;
                }
                if ($value->action_id == config('constants.action_map.corner_kick.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                    $corner_kick += 1;
                }
                if ($value->action_id == config('constants.action_map.direct_free_kick.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                    $free_kick += 1;
                }
                if ($value->action_id == config('constants.action_map.pk_free_kick.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                    $pk += 1;
                }
                if ((($value->is_pitch_home_area && $team->is_home) || ($value->is_pitch_guest_area && !$team->is_home)) && $value->action_id == config('constants.action_map.tackle_overhead.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && $value->result == 1) {
                    $tackle_overhead_home += 1;
                }
                if ((($value->is_pitch_guest_area && $team->is_home) || ($value->is_pitch_home_area && !$team->is_home)) && $value->action_id == config('constants.action_map.tackle_overhead.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && $value->result == 1) {
                    $tackle_overhead_guest += 1;
                }
                $contribution_data  = json_decode($value->action_contribution_data, true);
                $contribution_score = json_decode($value->action_contribution_score, true);
                if ((in_array($value->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) || (((!in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $negative_member_anonymous_id) && in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value->result != 1)) {
                    if (isset($contribution_data['shoot'])) {
                        $save += 1;
                    } elseif (isset($contribution_score['stop_pk'])) {
                        $save += 1;
                    } elseif (in_array($value->guest_gk_member_id, $member_team)) {
                        $save += 1;
                    } elseif (in_array($value->home_gk_member_id, $member_team)) {
                        $save += 1;
                    }
                }
            }
        }
        $box_score['goal']                  = $goal;
        $box_score['kick']                  = $kick;
        $box_score['kick_goal']             = $kick_goal;
        $box_score['assist']                = $assist;
        $box_score['last_pass']             = $last_pass;
        $box_score['cross']                 = $cross;
        $box_score['pass_dribble']          = $pass_dribble;
        $box_score['fouled']                = $fouled;
        $box_score['cut_ball']              = $cut_ball;
        $box_score['clear']                 = $clear;
        $box_score['block']                 = $block;
        $box_score['foul']                  = $foul;
        $box_score['second_ball']           = $second_ball;
        $box_score['is_pa']                 = $is_pa;
        $box_score['penalty_golf']          = $penalty_golf;
        $box_score['corner_kick']           = $corner_kick;
        $box_score['free_kick']             = $free_kick;
        $box_score['pk']                    = $pk;
        $box_score['tackle_overhead_home']  = $tackle_overhead_home;
        $box_score['tackle_overhead_guest'] = $tackle_overhead_guest;
        $box_score['save']                  = $save;

        return $box_score;
    }

    public static function boxScoreTeamProbability($stats, $member_team, $team, $match = null, $time = null, $sub_time = null, $member_anonymous_id = null)
    {
        $box_score                    = [];
        $goal                         = 0;
        $kick                         = 0;
        $kick_goal                    = 0;
        $total_tackle_overhead_home   = 0;
        $tackle_overhead_home         = 0;
        $total_tackle_overhead_guest  = 0;
        $tackle_overhead_guest        = 0;
        $total_pass_dribble           = 0;
        $pass_dribble                 = 0;
        $total_cross                  = 0;
        $cross                        = 0;
        $total_tackle                 = 0;
        $tackle                       = 0;
        $total_clear                  = 0;
        $clear                        = 0;
        $total_second_ball            = 0;
        $second_ball                  = 0;
        $total_save                   = 0;
        $save                         = 0;
        $total_catch_cross            = 0;
        $catch_cross                  = 0;
        $total_goal_play              = 0;
        $goal_play                    = 0;
        $total_throw                  = 0;
        $throw                        = 0;
        $total_lose                   = 0;
        $lose                         = 0;
        $negative_member_anonymous_id = $member_anonymous_id == -1 ? -2 : -1;

        if ($match) {
            $ms_in_round1 = $time * 60000 / 3;
            $ms_in_round2 = $time * 60000 / 3 * 2;
            foreach ($stats as $key => $value) {
                if ($value->match_id == $match->id) {
                    if ($sub_time == 1) {
                        if ($value->timer_at <= $ms_in_round1) {
                            if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value->result == 1 && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $goal += 1;
                            }
                            if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $kick += 1;
                            }
                            if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && in_array($value->ball_goal_number, config('constants.goal_numbers'))) {
                                $kick_goal += 1;
                            }
                            if ($value->action_id == config('constants.action_map.tackle_overhead.id') && (((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) || in_array($value->sub_member_id, $member_team))) {
                                if (($value->is_pitch_home_area && $team->is_home) || ($value->is_pitch_guest_area && !$team->is_home)) {
                                    $total_tackle_overhead_home += 1;
                                    if (in_array($value->member_id, $member_team) || $value->member_anonymous_id == $member_anonymous_id) {
                                        $tackle_overhead_home += 1;
                                    }
                                }
                                if (($value->is_pitch_guest_area && $team->is_home) || ($value->is_pitch_home_area && !$team->is_home)) {
                                    $total_tackle_overhead_guest += 1;
                                    if (in_array($value->member_id, $member_team) || $value->member_anonymous_id == $member_anonymous_id) {
                                        $tackle_overhead_guest += 1;
                                    }
                                }
                            }
                            if ($value->action_id == config('constants.action_map.pass.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $total_pass_dribble += 1;
                                if ($value->result == 1) {
                                    $pass_dribble += 1;
                                }
                            }
                            if (in_array($value->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $total_cross += 1;
                                if ($value->result == 1) {
                                    $cross += 1;
                                }
                            }
                            $contribution_data = json_decode($value->action_contribution_data, true);
                            if ($value->action_id == config('constants.action_map.tackle.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $total_tackle += 1;
                                if (isset($contribution_data['seize'])) {
                                    $tackle += 1;
                                }
                            }
                            if ($value->action_id == config('constants.action_map.clear.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $total_clear += 1;
                                if ($value->result == 1) {
                                    $clear += 1;
                                }
                            }
                            if ($value->action_id == config('constants.action_map.second_ball.id')) {
                                $total_second_ball += 1;
                                if ($value->result == 1 && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                    $second_ball += 1;
                                }
                            }
                            $contribution_score = json_decode($value->action_contribution_score, true);
                            if ((in_array($value->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) || (((!in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $negative_member_anonymous_id) && in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value->result != 1)) {
                                if (isset($contribution_data['shoot'])) {
                                    $save += 1;
                                } elseif (isset($contribution_score['stop_pk'])) {
                                    $save += 1;
                                } elseif (in_array($value->guest_gk_member_id, $member_team)) {
                                    $save += 1;
                                } elseif (in_array($value->home_gk_member_id, $member_team)) {
                                    $save += 1;
                                }
                            }
                            if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && ((!in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $negative_member_anonymous_id)) {
                                $total_save += 1;
                            }
                            if (in_array($value->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && ((!in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $negative_member_anonymous_id)) {
                                $total_catch_cross += 1;
                            }
                            if ($value->action_id == config('constants.action_map.catching.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                if (isset($contribution_data['cross'])) {
                                    $catch_cross += 1;
                                }
                            }
                            if ($value->action_id == config('constants.action_map.pk_free_kick.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $total_goal_play += 1;
                                if ($value->result == 1) {
                                    $goal_play += 1;
                                }
                            }
                            if ($value->action_id == config('constants.action_map.kick.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && in_array($value->action_kick_situation_id, [config('constants.kick_situation.key.set_play_direct'), config('constants.kick_situation.key.kick_from_set_play')])) {
                                $total_goal_play += 1;
                                if ($value->result == 1) {
                                    $goal_play += 1;
                                }
                            }
                            if ($value->action_id == config('constants.action_map.throw_from_the_side.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $total_throw += 1;
                                if ($value->result == 1) {
                                    $throw += 1;
                                }
                            }
                            if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && ((!in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $negative_member_anonymous_id)) {
                                $total_lose += 1;
                                if ($value->result == 1) {
                                    $lose += 1;
                                }
                            }
                        }
                    } else if ($sub_time == 2) {
                        if ($value->timer_at > $ms_in_round1 && $value->timer_at <= $ms_in_round2) {
                            if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value->result == 1 && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $goal += 1;
                            }
                            if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $kick += 1;
                            }
                            if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && in_array($value->ball_goal_number, config('constants.goal_numbers'))) {
                                $kick_goal += 1;
                            }
                            if ($value->action_id == config('constants.action_map.tackle_overhead.id') && (((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) || in_array($value->sub_member_id, $member_team))) {
                                if (($value->is_pitch_home_area && $team->is_home) || ($value->is_pitch_guest_area && !$team->is_home)) {
                                    $total_tackle_overhead_home += 1;
                                    if (in_array($value->member_id, $member_team) || $value->member_anonymous_id == $member_anonymous_id) {
                                        $tackle_overhead_home += 1;
                                    }
                                }
                                if (($value->is_pitch_guest_area && $team->is_home) || ($value->is_pitch_home_area && !$team->is_home)) {
                                    $total_tackle_overhead_guest += 1;
                                    if (in_array($value->member_id, $member_team) || $value->member_anonymous_id == $member_anonymous_id) {
                                        $tackle_overhead_guest += 1;
                                    }
                                }
                            }
                            if ($value->action_id == config('constants.action_map.pass.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $total_pass_dribble += 1;
                                if ($value->result == 1) {
                                    $pass_dribble += 1;
                                }
                            }
                            if (in_array($value->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $total_cross += 1;
                                if ($value->result == 1) {
                                    $cross += 1;
                                }
                            }
                            $contribution_data = json_decode($value->action_contribution_data, true);
                            if ($value->action_id == config('constants.action_map.tackle.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $total_tackle += 1;
                                if (isset($contribution_data['seize'])) {
                                    $tackle += 1;
                                }
                            }
                            if ($value->action_id == config('constants.action_map.clear.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $total_clear += 1;
                                if ($value->result == 1) {
                                    $clear += 1;
                                }
                            }
                            if ($value->action_id == config('constants.action_map.second_ball.id')) {
                                $total_second_ball += 1;
                                if ($value->result == 1 && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                    $second_ball += 1;
                                }
                            }
                            $contribution_score = json_decode($value->action_contribution_score, true);
                            if ((in_array($value->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) || (((!in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $negative_member_anonymous_id) && in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value->result != 1)) {
                                if (isset($contribution_data['shoot'])) {
                                    $save += 1;
                                } elseif (isset($contribution_score['stop_pk'])) {
                                    $save += 1;
                                } elseif (in_array($value->guest_gk_member_id, $member_team)) {
                                    $save += 1;
                                } elseif (in_array($value->home_gk_member_id, $member_team)) {
                                    $save += 1;
                                }
                            }
                            if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && ((!in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $negative_member_anonymous_id)) {
                                $total_save += 1;
                            }
                            if (in_array($value->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && ((!in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $negative_member_anonymous_id)) {
                                $total_catch_cross += 1;
                            }
                            if ($value->action_id == config('constants.action_map.catching.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                if (isset($contribution_data['cross'])) {
                                    $catch_cross += 1;
                                }
                            }
                            if ($value->action_id == config('constants.action_map.pk_free_kick.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $total_goal_play += 1;
                                if ($value->result == 1) {
                                    $goal_play += 1;
                                }
                            }
                            if ($value->action_id == config('constants.action_map.kick.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && in_array($value->action_kick_situation_id, [config('constants.kick_situation.key.set_play_direct'), config('constants.kick_situation.key.kick_from_set_play')])) {
                                $total_goal_play += 1;
                                if ($value->result == 1) {
                                    $goal_play += 1;
                                }
                            }
                            if ($value->action_id == config('constants.action_map.throw_from_the_side.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $total_throw += 1;
                                if ($value->result == 1) {
                                    $throw += 1;
                                }
                            }
                            if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && ((!in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $negative_member_anonymous_id)) {
                                $total_lose += 1;
                                if ($value->result == 1) {
                                    $lose += 1;
                                }
                            }
                        }
                    } else if ($sub_time == 3) {
                        if ($value->timer_at > $ms_in_round2) {
                            if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value->result == 1 && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $goal += 1;
                            }
                            if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $kick += 1;
                            }
                            if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && in_array($value->ball_goal_number, config('constants.goal_numbers'))) {
                                $kick_goal += 1;
                            }
                            if ($value->action_id == config('constants.action_map.tackle_overhead.id') && (((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) || in_array($value->sub_member_id, $member_team))) {
                                if (($value->is_pitch_home_area && $team->is_home) || ($value->is_pitch_guest_area && !$team->is_home)) {
                                    $total_tackle_overhead_home += 1;
                                    if (in_array($value->member_id, $member_team) || $value->member_anonymous_id == $member_anonymous_id) {
                                        $tackle_overhead_home += 1;
                                    }
                                }
                                if (($value->is_pitch_guest_area && $team->is_home) || ($value->is_pitch_home_area && !$team->is_home)) {
                                    $total_tackle_overhead_guest += 1;
                                    if (in_array($value->member_id, $member_team) || $value->member_anonymous_id == $member_anonymous_id) {
                                        $tackle_overhead_guest += 1;
                                    }
                                }
                            }
                            if ($value->action_id == config('constants.action_map.pass.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $total_pass_dribble += 1;
                                if ($value->result == 1) {
                                    $pass_dribble += 1;
                                }
                            }
                            if (in_array($value->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $total_cross += 1;
                                if ($value->result == 1) {
                                    $cross += 1;
                                }
                            }
                            $contribution_data = json_decode($value->action_contribution_data, true);
                            if ($value->action_id == config('constants.action_map.tackle.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $total_tackle += 1;
                                if (isset($contribution_data['seize'])) {
                                    $tackle += 1;
                                }
                            }
                            if ($value->action_id == config('constants.action_map.clear.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $total_clear += 1;
                                if ($value->result == 1) {
                                    $clear += 1;
                                }
                            }
                            if ($value->action_id == config('constants.action_map.second_ball.id')) {
                                $total_second_ball += 1;
                                if ($value->result == 1 && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                    $second_ball += 1;
                                }
                            }
                            $contribution_score = json_decode($value->action_contribution_score, true);
                            if ((in_array($value->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) || (((!in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $negative_member_anonymous_id) && in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value->result != 1)) {
                                if (isset($contribution_data['shoot'])) {
                                    $save += 1;
                                } elseif (isset($contribution_score['stop_pk'])) {
                                    $save += 1;
                                } elseif (in_array($value->guest_gk_member_id, $member_team)) {
                                    $save += 1;
                                } elseif (in_array($value->home_gk_member_id, $member_team)) {
                                    $save += 1;
                                }
                            }
                            if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && ((!in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $negative_member_anonymous_id)) {
                                $total_save += 1;
                            }
                            if (in_array($value->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && ((!in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $negative_member_anonymous_id)) {
                                $total_catch_cross += 1;
                            }
                            if ($value->action_id == config('constants.action_map.catching.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                if (isset($contribution_data['cross'])) {
                                    $catch_cross += 1;
                                }
                            }
                            if ($value->action_id == config('constants.action_map.pk_free_kick.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $total_goal_play += 1;
                                if ($value->result == 1) {
                                    $goal_play += 1;
                                }
                            }
                            if ($value->action_id == config('constants.action_map.kick.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && in_array($value->action_kick_situation_id, [config('constants.kick_situation.key.set_play_direct'), config('constants.kick_situation.key.kick_from_set_play')])) {
                                $total_goal_play += 1;
                                if ($value->result == 1) {
                                    $goal_play += 1;
                                }
                            }
                            if ($value->action_id == config('constants.action_map.throw_from_the_side.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $total_throw += 1;
                                if ($value->result == 1) {
                                    $throw += 1;
                                }
                            }
                            if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && ((!in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $negative_member_anonymous_id)) {
                                $total_lose += 1;
                                if ($value->result == 1) {
                                    $lose += 1;
                                }
                            }
                        }
                    } else {
                        if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value->result == 1 && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                            $goal += 1;
                        }
                        if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                            $kick += 1;
                        }
                        if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && in_array($value->ball_goal_number, config('constants.goal_numbers'))) {
                            $kick_goal += 1;
                        }
                        if ($value->action_id == config('constants.action_map.tackle_overhead.id') && (((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) || in_array($value->sub_member_id, $member_team))) {
                            if (($value->is_pitch_home_area && $team->is_home) || ($value->is_pitch_guest_area && !$team->is_home)) {
                                $total_tackle_overhead_home += 1;
                                if (in_array($value->member_id, $member_team) || $value->member_anonymous_id == $member_anonymous_id) {
                                    $tackle_overhead_home += 1;
                                }
                            }
                            if (($value->is_pitch_guest_area && $team->is_home) || ($value->is_pitch_home_area && !$team->is_home)) {
                                $total_tackle_overhead_guest += 1;
                                if (in_array($value->member_id, $member_team) || $value->member_anonymous_id == $member_anonymous_id) {
                                    $tackle_overhead_guest += 1;
                                }
                            }
                        }
                        if ($value->action_id == config('constants.action_map.pass.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                            $total_pass_dribble += 1;
                            if ($value->result == 1) {
                                $pass_dribble += 1;
                            }
                        }
                        if (in_array($value->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                            $total_cross += 1;
                            if ($value->result == 1) {
                                $cross += 1;
                            }
                        }
                        $contribution_data = json_decode($value->action_contribution_data, true);
                        if ($value->action_id == config('constants.action_map.tackle.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                            $total_tackle += 1;
                            if (isset($contribution_data['seize'])) {
                                $tackle += 1;
                            }
                        }
                        if ($value->action_id == config('constants.action_map.clear.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                            $total_clear += 1;
                            if ($value->result == 1) {
                                $clear += 1;
                            }
                        }
                        if ($value->action_id == config('constants.action_map.second_ball.id')) {
                            $total_second_ball += 1;
                            if ($value->result == 1 && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                                $second_ball += 1;
                            }
                        }
                        $contribution_score = json_decode($value->action_contribution_score, true);
                        if ((in_array($value->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) || (((!in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $negative_member_anonymous_id) && in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value->result != 1)) {
                            if (isset($contribution_data['shoot'])) {
                                $save += 1;
                            } elseif (isset($contribution_score['stop_pk'])) {
                                $save += 1;
                            } elseif (in_array($value->guest_gk_member_id, $member_team)) {
                                $save += 1;
                            } elseif (in_array($value->home_gk_member_id, $member_team)) {
                                $save += 1;
                            }
                        }
                        if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && ((!in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $negative_member_anonymous_id)) {
                            $total_save += 1;
                        }
                        if (in_array($value->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && ((!in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $negative_member_anonymous_id)) {
                            $total_catch_cross += 1;
                        }
                        if ($value->action_id == config('constants.action_map.catching.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                            if (isset($contribution_data['cross'])) {
                                $catch_cross += 1;
                            }
                        }
                        if ($value->action_id == config('constants.action_map.pk_free_kick.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                            $total_goal_play += 1;
                            if ($value->result == 1) {
                                $goal_play += 1;
                            }
                        }
                        if ($value->action_id == config('constants.action_map.kick.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && in_array($value->action_kick_situation_id, [config('constants.kick_situation.key.set_play_direct'), config('constants.kick_situation.key.kick_from_set_play')])) {
                            $total_goal_play += 1;
                            if ($value->result == 1) {
                                $goal_play += 1;
                            }
                        }
                        if ($value->action_id == config('constants.action_map.throw_from_the_side.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                            $total_throw += 1;
                            if ($value->result == 1) {
                                $throw += 1;
                            }
                        }
                        if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && ((!in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $negative_member_anonymous_id)) {
                            $total_lose += 1;
                            if ($value->result == 1) {
                                $lose += 1;
                            }
                        }
                    }
                }
            }
        } else {
            foreach ($stats as $key => $value) {
                if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value->result == 1 && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                    $goal += 1;
                }
                if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                    $kick += 1;
                }
                if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && in_array($value->ball_goal_number, config('constants.goal_numbers'))) {
                    $kick_goal += 1;
                }
                if ($value->action_id == config('constants.action_map.tackle_overhead.id') && (((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) || in_array($value->sub_member_id, $member_team))) {
                    if (($value->is_pitch_home_area && $team->is_home) || ($value->is_pitch_guest_area && !$team->is_home)) {
                        $total_tackle_overhead_home += 1;
                        if (in_array($value->member_id, $member_team) || $value->member_anonymous_id == $member_anonymous_id) {
                            $tackle_overhead_home += 1;
                        }
                    }
                    if (($value->is_pitch_guest_area && $team->is_home) || ($value->is_pitch_home_area && !$team->is_home)) {
                        $total_tackle_overhead_guest += 1;
                        if (in_array($value->member_id, $member_team) || $value->member_anonymous_id == $member_anonymous_id) {
                            $tackle_overhead_guest += 1;
                        }
                    }
                }
                if ($value->action_id == config('constants.action_map.pass.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                    $total_pass_dribble += 1;
                    if ($value->result == 1) {
                        $pass_dribble += 1;
                    }
                }
                if (in_array($value->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                    $total_cross += 1;
                    if ($value->result == 1) {
                        $cross += 1;
                    }
                }
                $contribution_data = json_decode($value->action_contribution_data, true);
                if ($value->action_id == config('constants.action_map.tackle.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                    $total_tackle += 1;
                    if (isset($contribution_data['seize'])) {
                        $tackle += 1;
                    }
                }
                if ($value->action_id == config('constants.action_map.clear.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                    $total_clear += 1;
                    if ($value->result == 1) {
                        $clear += 1;
                    }
                }
                if ($value->action_id == config('constants.action_map.second_ball.id')) {
                    $total_second_ball += 1;
                    if ($value->result == 1 && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                        $second_ball += 1;
                    }
                }
                $contribution_score = json_decode($value->action_contribution_score, true);
                if ((in_array($value->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) || (((!in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $negative_member_anonymous_id) && in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value->result != 1)) {
                    if (isset($contribution_data['shoot'])) {
                        $save += 1;
                    } elseif (isset($contribution_score['stop_pk'])) {
                        $save += 1;
                    } elseif (in_array($value->guest_gk_member_id, $member_team)) {
                        $save += 1;
                    } elseif (in_array($value->home_gk_member_id, $member_team)) {
                        $save += 1;
                    }
                }
                if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && ((!in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $negative_member_anonymous_id)) {
                    $total_save += 1;
                }
                if (in_array($value->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && ((!in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $negative_member_anonymous_id)) {
                    $total_catch_cross += 1;
                }
                if ($value->action_id == config('constants.action_map.catching.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                    if (isset($contribution_data['cross'])) {
                        $catch_cross += 1;
                    }
                }
                if ($value->action_id == config('constants.action_map.pk_free_kick.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                    $total_goal_play += 1;
                    if ($value->result == 1) {
                        $goal_play += 1;
                    }
                }
                if ($value->action_id == config('constants.action_map.kick.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id) && in_array($value->action_kick_situation_id, [config('constants.kick_situation.key.set_play_direct'), config('constants.kick_situation.key.kick_from_set_play')])) {
                    $total_goal_play += 1;
                    if ($value->result == 1) {
                        $goal_play += 1;
                    }
                }
                if ($value->action_id == config('constants.action_map.throw_from_the_side.id') && ((in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $member_anonymous_id)) {
                    $total_throw += 1;
                    if ($value->result == 1) {
                        $throw += 1;
                    }
                }
                if (in_array($value->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && ((!in_array($value->member_id, $member_team) && $value->member_id) || $value->member_anonymous_id == $negative_member_anonymous_id)) {
                    $total_lose += 1;
                    if ($value->result == 1) {
                        $lose += 1;
                    }
                }
            }
        }
        $box_score['ratio_goal']                  = TransformDataStat::getResult($goal, $kick);
        $box_score['ratio_kick_goal']             = TransformDataStat::getResult($kick_goal, $kick);
        $box_score['ratio_tackle_overhead_home']  = TransformDataStat::getResult($tackle_overhead_home, $total_tackle_overhead_home);
        $box_score['ratio_tackle_overhead_guest'] = TransformDataStat::getResult($tackle_overhead_guest, $total_tackle_overhead_guest);
        $box_score['ratio_pass_dribble']          = TransformDataStat::getResult($pass_dribble, $total_pass_dribble);
        $box_score['ratio_cross']                 = TransformDataStat::getResult($cross, $total_cross);
        $box_score['ratio_tackle']                = TransformDataStat::getResult($tackle, $total_tackle);
        $box_score['ratio_clear']                 = TransformDataStat::getResult($clear, $total_clear);
        $box_score['ratio_second_ball']           = TransformDataStat::getResult($second_ball, $total_second_ball);
        $box_score['ratio_save']                  = TransformDataStat::getResult($save, $total_save);
        $box_score['ratio_catch_cross']           = TransformDataStat::getResult($catch_cross, $total_catch_cross);
        $box_score['ratio_goal_play']             = TransformDataStat::getResult($goal_play, $total_goal_play);
        $box_score['ratio_throw']                 = TransformDataStat::getResult($throw, $total_throw);
        $box_score['ratio_lose']                  = TransformDataStat::getResult($lose, $total_lose);
        //Total tackle overhead of match
        $tackle_overhead                    = $tackle_overhead_home + $tackle_overhead_guest;
        $total_tackle_overhead              = $total_tackle_overhead_home + $total_tackle_overhead_guest;
        $box_score['ratio_tackle_overhead'] = TransformDataStat::getResult($tackle_overhead, $total_tackle_overhead);

        return $box_score;
    }

    public static function boxScorePersonalNumber($stats, $member_id, $value, $match = null, $time = null, $sub_time = null)
    {
        $box_score             = [];
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
        if ($match) {
            $ms_in_round1 = $time * 60000 / 3;
            $ms_in_round2 = $time * 60000 / 3 * 2;
            foreach ($stats as $key1 => $value1) {
                if ($value1->match_id == $match->id) {
                    if ($sub_time == 1) {
                        if ($value1->timer_at <= $ms_in_round1) {
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->result == 1 && $value1->member_id == $value->id) {
                                $goal += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_id == $value->id) {
                                $kick += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_id == $value->id && in_array($value1->ball_goal_number, config('constants.goal_numbers'))) {
                                $kick_goal += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.assist.id') && $value1->result == 1 && $value1->member_id == $value->id) {
                                $assist += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.assist.id') && $value1->result != 1 && $value1->member_id == $value->id) {
                                $last_pass += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && $value1->member_id == $value->id) {
                                $cross += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.pass.id') && $value1->member_id == $value->id && $value1->result == 1) {
                                $pass_dribble += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.fouled.id') && $value1->member_id == $value->id) {
                                $fouled += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.tackle.id') && $value1->member_id == $value->id) {
                                $tackle += 1;
                            }
                            $contribution_data = json_decode($value1->action_contribution_data, true);
                            if ($value1->action_id == config('constants.action_map.tackle.id') && $value1->member_id == $value->id && isset($contribution_data['seize'])) {
                                $steal += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.intercept.id') && $value1->member_id == $value->id) {
                                $intercept += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.block.id') && $value1->member_id == $value->id && isset($contribution_data['shoot_block'])) {
                                $shoot_block += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.block.id') && $value1->member_id == $value->id && isset($contribution_data['cross_block'])) {
                                $cross_block += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.foul.id') && $value1->member_id == $value->id) {
                                $foul += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.clear.id') && $value1->member_id == $value->id) {
                                $clear += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.second_ball.id') && $value1->member_id == $value->id) {
                                $second_ball += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.corner_kick.id') && $value1->member_id == $value->id) {
                                $corner_kick += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.direct_free_kick.id'), config('constants.action_map.indirect_free_kick.id')]) && $value1->member_id == $value->id) {
                                $free_kick += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.pk_free_kick.id') && $value1->member_id == $value->id) {
                                $pk += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.tackle_overhead.id') && $value1->member_id == $value->id && $value1->result == 1 && ($value1->is_pitch_home_area && !$value1->is_pitch_guest_area)) {
                                $tackle_overhead_home += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.tackle_overhead.id') && $value1->member_id == $value->id && $value1->result == 1 && (!$value1->is_pitch_home_area && $value1->is_pitch_guest_area)) {
                                $tackle_overhead_guest += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_id) {
                                if ($value1->guest_gk_member_id == $value->id) {
                                    $guest_kick += 1;
                                } elseif ($value1->home_gk_member_id == $value->id) {
                                    $guest_kick += 1;
                                }
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_id && in_array($value1->ball_goal_number, config('constants.goal_numbers'))) {
                                if ($value1->guest_gk_member_id == $value->id) {
                                    $guest_kick_goal += 1;
                                } elseif ($value1->home_gk_member_id == $value->id) {
                                    $guest_kick_goal += 1;
                                }
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_id && $value1->result == 1) {
                                if ($value1->guest_gk_member_id == $value->id) {
                                    $guest_lose += 1;
                                } elseif ($value1->home_gk_member_id == $value->id) {
                                    $guest_lose += 1;
                                }
                            }
                            $contribution_score = json_decode($value1->action_contribution_score, true);
                            if ((in_array($value1->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && $value1->member_id == $value->id) || (!in_array($value1->member_id, $member_id) && $value1->member_id && in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value1->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value1->result != 1)) {
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
                            if (in_array($value1->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && $value1->member_id == $value->id) {
                                if ((isset($contribution_data['shoot']) || isset($contribution_score['stop_pk'])) && $value1->guest_gk_member_id == $value->id && $value1->is_pa_guest_area) {
                                    $save_penalty += 1;
                                } else if ((isset($contribution_data['shoot']) || isset($contribution_score['stop_pk'])) && $value1->home_gk_member_id == $value->id && $value1->is_pa_home_area) {
                                    $save_penalty += 1;
                                }
                            }
                            if ((!in_array($value1->member_id, $member_id) && in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value1->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value1->result != 1)) {
                                if ($value1->guest_gk_member_id == $value->id && $value1->is_pa_guest_area) {
                                    $save_penalty += 1;
                                } elseif ($value1->home_gk_member_id == $value->id && $value1->is_pa_home_area) {
                                    $save_penalty += 1;
                                }
                            }
                            if ($value1->action_id == config('constants.action_map.punching.id') && $value1->member_id == $value->id) {
                                $punching += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.punt_kick.id'), config('constants.action_map.throw_ball.id')]) && $value1->member_id == $value->id && isset($contribution_data['successful_own_pass'])) {
                                $pass += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.punt_kick.id'), config('constants.action_map.throw_ball.id')]) && $value1->member_id == $value->id && isset($contribution_data['successful_enemy_pass'])) {
                                $guest_pass += 1;
                            }
                            if ($value1->member_id == $value->id) {
                                if ($value1->action_contribution_score) {
                                    $contribution_score = json_decode($value1->action_contribution_score, true);
                                    foreach ($contribution_score as $key2 => $value2) {
                                        $contribute += $value2;
                                    }
                                }
                            }
                        }
                    } else if ($sub_time == 2) {
                        if ($value1->timer_at > $ms_in_round1 && $value1->timer_at <= $ms_in_round2) {
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->result == 1 && $value1->member_id == $value->id) {
                                $goal += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_id == $value->id) {
                                $kick += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_id == $value->id && in_array($value1->ball_goal_number, config('constants.goal_numbers'))) {
                                $kick_goal += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.assist.id') && $value1->result == 1 && $value1->member_id == $value->id) {
                                $assist += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.assist.id') && $value1->result != 1 && $value1->member_id == $value->id) {
                                $last_pass += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && $value1->member_id == $value->id) {
                                $cross += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.pass.id') && $value1->member_id == $value->id && $value1->result == 1) {
                                $pass_dribble += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.fouled.id') && $value1->member_id == $value->id) {
                                $fouled += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.tackle.id') && $value1->member_id == $value->id) {
                                $tackle += 1;
                            }
                            $contribution_data = json_decode($value1->action_contribution_data, true);
                            if ($value1->action_id == config('constants.action_map.tackle.id') && $value1->member_id == $value->id && isset($contribution_data['seize'])) {
                                $steal += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.intercept.id') && $value1->member_id == $value->id) {
                                $intercept += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.block.id') && $value1->member_id == $value->id && isset($contribution_data['shoot_block'])) {
                                $shoot_block += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.block.id') && $value1->member_id == $value->id && isset($contribution_data['cross_block'])) {
                                $cross_block += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.foul.id') && $value1->member_id == $value->id) {
                                $foul += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.clear.id') && $value1->member_id == $value->id) {
                                $clear += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.second_ball.id') && $value1->member_id == $value->id) {
                                $second_ball += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.corner_kick.id') && $value1->member_id == $value->id) {
                                $corner_kick += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.direct_free_kick.id'), config('constants.action_map.indirect_free_kick.id')]) && $value1->member_id == $value->id) {
                                $free_kick += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.pk_free_kick.id') && $value1->member_id == $value->id) {
                                $pk += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.tackle_overhead.id') && $value1->member_id == $value->id && $value1->result == 1 && ($value1->is_pitch_home_area && !$value1->is_pitch_guest_area)) {
                                $tackle_overhead_home += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.tackle_overhead.id') && $value1->member_id == $value->id && $value1->result == 1 && (!$value1->is_pitch_home_area && $value1->is_pitch_guest_area)) {
                                $tackle_overhead_guest += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_id) {
                                if ($value1->guest_gk_member_id == $value->id) {
                                    $guest_kick += 1;
                                } elseif ($value1->home_gk_member_id == $value->id) {
                                    $guest_kick += 1;
                                }
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_id && in_array($value1->ball_goal_number, config('constants.goal_numbers'))) {
                                if ($value1->guest_gk_member_id == $value->id) {
                                    $guest_kick_goal += 1;
                                } elseif ($value1->home_gk_member_id == $value->id) {
                                    $guest_kick_goal += 1;
                                }
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->result == 1 && $value1->member_id) {
                                if ($value1->guest_gk_member_id == $value->id) {
                                    $guest_lose += 1;
                                } elseif ($value1->home_gk_member_id == $value->id) {
                                    $guest_lose += 1;
                                }
                            }
                            $contribution_score = json_decode($value1->action_contribution_score, true);
                            if ((in_array($value1->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && $value1->member_id == $value->id) || (!in_array($value1->member_id, $member_id) && $value1->member_id && in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value1->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value1->result != 1)) {
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
                            if (in_array($value1->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && $value1->member_id == $value->id) {
                                if ((isset($contribution_data['shoot']) || isset($contribution_score['stop_pk'])) && $value1->guest_gk_member_id == $value->id && $value1->is_pa_guest_area) {
                                    $save_penalty += 1;
                                } else if ((isset($contribution_data['shoot']) || isset($contribution_score['stop_pk'])) && $value1->home_gk_member_id == $value->id && $value1->is_pa_home_area) {
                                    $save_penalty += 1;
                                }
                            }
                            if ((!in_array($value1->member_id, $member_id) && in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value1->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value1->result != 1)) {
                                if ($value1->guest_gk_member_id == $value->id && $value1->is_pa_guest_area) {
                                    $save_penalty += 1;
                                } elseif ($value1->home_gk_member_id == $value->id && $value1->is_pa_home_area) {
                                    $save_penalty += 1;
                                }
                            }
                            if ($value1->action_id == config('constants.action_map.punching.id') && $value1->member_id == $value->id) {
                                $punching += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.punt_kick.id'), config('constants.action_map.throw_ball.id')]) && $value1->member_id == $value->id && isset($contribution_data['successful_own_pass'])) {
                                $pass += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.punt_kick.id'), config('constants.action_map.throw_ball.id')]) && $value1->member_id == $value->id && isset($contribution_data['successful_enemy_pass'])) {
                                $guest_pass += 1;
                            }
                            if ($value1->member_id == $value->id) {
                                if ($value1->action_contribution_score) {
                                    $contribution_score = json_decode($value1->action_contribution_score, true);
                                    foreach ($contribution_score as $key2 => $value2) {
                                        $contribute += $value2;
                                    }
                                }
                            }
                        }
                    } else if ($sub_time == 3) {
                        if ($value1->timer_at > $ms_in_round2) {
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->result == 1 && $value1->member_id == $value->id) {
                                $goal += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_id == $value->id) {
                                $kick += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_id == $value->id && in_array($value1->ball_goal_number, config('constants.goal_numbers'))) {
                                $kick_goal += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.assist.id') && $value1->result == 1 && $value1->member_id == $value->id) {
                                $assist += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.assist.id') && $value1->result != 1 && $value1->member_id == $value->id) {
                                $last_pass += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && $value1->member_id == $value->id) {
                                $cross += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.pass.id') && $value1->member_id == $value->id && $value1->result == 1) {
                                $pass_dribble += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.fouled.id') && $value1->member_id == $value->id) {
                                $fouled += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.tackle.id') && $value1->member_id == $value->id) {
                                $tackle += 1;
                            }
                            $contribution_data = json_decode($value1->action_contribution_data, true);
                            if ($value1->action_id == config('constants.action_map.tackle.id') && $value1->member_id == $value->id && isset($contribution_data['seize'])) {
                                $steal += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.intercept.id') && $value1->member_id == $value->id) {
                                $intercept += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.block.id') && $value1->member_id == $value->id && isset($contribution_data['shoot_block'])) {
                                $shoot_block += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.block.id') && $value1->member_id == $value->id && isset($contribution_data['cross_block'])) {
                                $cross_block += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.foul.id') && $value1->member_id == $value->id) {
                                $foul += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.clear.id') && $value1->member_id == $value->id) {
                                $clear += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.second_ball.id') && $value1->member_id == $value->id) {
                                $second_ball += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.corner_kick.id') && $value1->member_id == $value->id) {
                                $corner_kick += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.direct_free_kick.id'), config('constants.action_map.indirect_free_kick.id')]) && $value1->member_id == $value->id) {
                                $free_kick += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.pk_free_kick.id') && $value1->member_id == $value->id) {
                                $pk += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.tackle_overhead.id') && $value1->member_id == $value->id && $value1->result == 1 && ($value1->is_pitch_home_area && !$value1->is_pitch_guest_area)) {
                                $tackle_overhead_home += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.tackle_overhead.id') && $value1->member_id == $value->id && $value1->result == 1 && (!$value1->is_pitch_home_area && $value1->is_pitch_guest_area)) {
                                $tackle_overhead_guest += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_id) {
                                if ($value1->guest_gk_member_id == $value->id) {
                                    $guest_kick += 1;
                                } elseif ($value1->home_gk_member_id == $value->id) {
                                    $guest_kick += 1;
                                }
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_id && in_array($value1->ball_goal_number, config('constants.goal_numbers'))) {
                                if ($value1->guest_gk_member_id == $value->id) {
                                    $guest_kick_goal += 1;
                                } elseif ($value1->home_gk_member_id == $value->id) {
                                    $guest_kick_goal += 1;
                                }
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->result == 1 && $value1->member_id) {
                                if ($value1->guest_gk_member_id == $value->id) {
                                    $guest_lose += 1;
                                } elseif ($value1->home_gk_member_id == $value->id) {
                                    $guest_lose += 1;
                                }
                            }
                            $contribution_score = json_decode($value1->action_contribution_score, true);
                            if ((in_array($value1->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && $value1->member_id == $value->id) || (!in_array($value1->member_id, $member_id) && $value1->member_id && in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value1->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value1->result != 1)) {
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
                            if (in_array($value1->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && $value1->member_id == $value->id) {
                                if ((isset($contribution_data['shoot']) || isset($contribution_score['stop_pk'])) && $value1->guest_gk_member_id == $value->id && $value1->is_pa_guest_area) {
                                    $save_penalty += 1;
                                } else if ((isset($contribution_data['shoot']) || isset($contribution_score['stop_pk'])) && $value1->home_gk_member_id == $value->id && $value1->is_pa_home_area) {
                                    $save_penalty += 1;
                                }
                            }
                            if ((!in_array($value1->member_id, $member_id) && in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value1->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value1->result != 1)) {
                                if ($value1->guest_gk_member_id == $value->id && $value1->is_pa_guest_area) {
                                    $save_penalty += 1;
                                } elseif ($value1->home_gk_member_id == $value->id && $value1->is_pa_home_area) {
                                    $save_penalty += 1;
                                }
                            }
                            if ($value1->action_id == config('constants.action_map.punching.id') && $value1->member_id == $value->id) {
                                $punching += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.punt_kick.id'), config('constants.action_map.throw_ball.id')]) && $value1->member_id == $value->id && isset($contribution_data['successful_own_pass'])) {
                                $pass += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.punt_kick.id'), config('constants.action_map.throw_ball.id')]) && $value1->member_id == $value->id && isset($contribution_data['successful_enemy_pass'])) {
                                $guest_pass += 1;
                            }
                            if ($value1->member_id == $value->id) {
                                if ($value1->action_contribution_score) {
                                    $contribution_score = json_decode($value1->action_contribution_score, true);
                                    foreach ($contribution_score as $key2 => $value2) {
                                        $contribute += $value2;
                                    }
                                }
                            }
                        }
                    } else {
                        if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->result == 1 && $value1->member_id == $value->id) {
                            $goal += 1;
                        }
                        if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_id == $value->id) {
                            $kick += 1;
                        }
                        if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_id == $value->id && in_array($value1->ball_goal_number, config('constants.goal_numbers'))) {
                            $kick_goal += 1;
                        }
                        if ($value1->action_id == config('constants.action_map.assist.id') && $value1->result == 1 && $value1->member_id == $value->id) {
                            $assist += 1;
                        }
                        if ($value1->action_id == config('constants.action_map.assist.id') && $value1->result != 1 && $value1->member_id == $value->id) {
                            $last_pass += 1;
                        }
                        if (in_array($value1->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && $value1->member_id == $value->id) {
                            $cross += 1;
                        }
                        if ($value1->action_id == config('constants.action_map.pass.id') && $value1->member_id == $value->id && $value1->result == 1) {
                            $pass_dribble += 1;
                        }
                        if ($value1->action_id == config('constants.action_map.fouled.id') && $value1->member_id == $value->id) {
                            $fouled += 1;
                        }
                        if ($value1->action_id == config('constants.action_map.tackle.id') && $value1->member_id == $value->id) {
                            $tackle += 1;
                        }
                        $contribution_data = json_decode($value1->action_contribution_data, true);
                        if ($value1->action_id == config('constants.action_map.tackle.id') && $value1->member_id == $value->id && isset($contribution_data['seize'])) {
                            $steal += 1;
                        }
                        if ($value1->action_id == config('constants.action_map.intercept.id') && $value1->member_id == $value->id) {
                            $intercept += 1;
                        }
                        if ($value1->action_id == config('constants.action_map.block.id') && $value1->member_id == $value->id && isset($contribution_data['shoot_block'])) {
                            $shoot_block += 1;
                        }
                        if ($value1->action_id == config('constants.action_map.block.id') && $value1->member_id == $value->id && isset($contribution_data['cross_block'])) {
                            $cross_block += 1;
                        }
                        if ($value1->action_id == config('constants.action_map.foul.id') && $value1->member_id == $value->id) {
                            $foul += 1;
                        }
                        if ($value1->action_id == config('constants.action_map.clear.id') && $value1->member_id == $value->id) {
                            $clear += 1;
                        }
                        if ($value1->action_id == config('constants.action_map.second_ball.id') && $value1->member_id == $value->id) {
                            $second_ball += 1;
                        }
                        if ($value1->action_id == config('constants.action_map.corner_kick.id') && $value1->member_id == $value->id) {
                            $corner_kick += 1;
                        }
                        if (in_array($value1->action_id, [config('constants.action_map.direct_free_kick.id'), config('constants.action_map.indirect_free_kick.id')]) && $value1->member_id == $value->id) {
                            $free_kick += 1;
                        }
                        if ($value1->action_id == config('constants.action_map.pk_free_kick.id') && $value1->member_id == $value->id) {
                            $pk += 1;
                        }
                        if ($value1->action_id == config('constants.action_map.tackle_overhead.id') && $value1->member_id == $value->id && $value1->result == 1 && ($value1->is_pitch_home_area && !$value1->is_pitch_guest_area)) {
                            $tackle_overhead_home += 1;
                        }
                        if ($value1->action_id == config('constants.action_map.tackle_overhead.id') && $value1->member_id == $value->id && $value1->result == 1 && (!$value1->is_pitch_home_area && $value1->is_pitch_guest_area)) {
                            $tackle_overhead_guest += 1;
                        }
                        if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_id) {
                            if ($value1->guest_gk_member_id == $value->id) {
                                $guest_kick += 1;
                            } elseif ($value1->home_gk_member_id == $value->id) {
                                $guest_kick += 1;
                            }
                        }
                        if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_id && in_array($value1->ball_goal_number, config('constants.goal_numbers'))) {
                            if ($value1->guest_gk_member_id == $value->id) {
                                $guest_kick_goal += 1;
                            } elseif ($value1->home_gk_member_id == $value->id) {
                                $guest_kick_goal += 1;
                            }
                        }
                        if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->result == 1 && $value1->member_id) {
                            if ($value1->guest_gk_member_id == $value->id) {
                                $guest_lose += 1;
                            } elseif ($value1->home_gk_member_id == $value->id) {
                                $guest_lose += 1;
                            }
                        }
                        $contribution_score = json_decode($value1->action_contribution_score, true);
                        if ((in_array($value1->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && $value1->member_id == $value->id) || (!in_array($value1->member_id, $member_id) && $value1->member_id && in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value1->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value1->result != 1)) {
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
                        if (in_array($value1->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && $value1->member_id == $value->id) {
                            if ((isset($contribution_data['shoot']) || isset($contribution_score['stop_pk'])) && $value1->guest_gk_member_id == $value->id && $value1->is_pa_guest_area) {
                                $save_penalty += 1;
                            } else if ((isset($contribution_data['shoot']) || isset($contribution_score['stop_pk'])) && $value1->home_gk_member_id == $value->id && $value1->is_pa_home_area) {
                                $save_penalty += 1;
                            }
                        }
                        if ((!in_array($value1->member_id, $member_id) && in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value1->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value1->result != 1)) {
                            if ($value1->guest_gk_member_id == $value->id && $value1->is_pa_guest_area) {
                                $save_penalty += 1;
                            } elseif ($value1->home_gk_member_id == $value->id && $value1->is_pa_home_area) {
                                $save_penalty += 1;
                            }
                        }
                        if ($value1->action_id == config('constants.action_map.punching.id') && $value1->member_id == $value->id) {
                            $punching += 1;
                        }
                        if (in_array($value1->action_id, [config('constants.action_map.punt_kick.id'), config('constants.action_map.throw_ball.id')]) && $value1->member_id == $value->id && isset($contribution_data['successful_own_pass'])) {
                            $pass += 1;
                        }
                        if (in_array($value1->action_id, [config('constants.action_map.punt_kick.id'), config('constants.action_map.throw_ball.id')]) && $value1->member_id == $value->id && isset($contribution_data['successful_enemy_pass'])) {
                            $guest_pass += 1;
                        }
                        if ($value1->member_id == $value->id) {
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
        } else {
            foreach ($stats as $key1 => $value1) {
                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->result == 1 && $value1->member_id == $value->id) {
                    $goal += 1;
                }
                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_id == $value->id) {
                    $kick += 1;
                }
                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_id == $value->id && in_array($value1->ball_goal_number, config('constants.goal_numbers'))) {
                    $kick_goal += 1;
                }
                if ($value1->action_id == config('constants.action_map.assist.id') && $value1->result == 1 && $value1->member_id == $value->id) {
                    $assist += 1;
                }
                if ($value1->action_id == config('constants.action_map.assist.id') && $value1->result != 1 && $value1->member_id == $value->id) {
                    $last_pass += 1;
                }
                if (in_array($value1->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && $value1->member_id == $value->id) {
                    $cross += 1;
                }
                if ($value1->action_id == config('constants.action_map.pass.id') && $value1->member_id == $value->id && $value1->result == 1) {
                    $pass_dribble += 1;
                }
                if ($value1->action_id == config('constants.action_map.fouled.id') && $value1->member_id == $value->id) {
                    $fouled += 1;
                }
                if ($value1->action_id == config('constants.action_map.tackle.id') && $value1->member_id == $value->id) {
                    $tackle += 1;
                }
                $contribution_data = json_decode($value1->action_contribution_data, true);
                if ($value1->action_id == config('constants.action_map.tackle.id') && $value1->member_id == $value->id && isset($contribution_data['seize'])) {
                    $steal += 1;
                }
                if ($value1->action_id == config('constants.action_map.intercept.id') && $value1->member_id == $value->id) {
                    $intercept += 1;
                }
                if ($value1->action_id == config('constants.action_map.block.id') && $value1->member_id == $value->id && isset($contribution_data['shoot_block'])) {
                    $shoot_block += 1;
                }
                if ($value1->action_id == config('constants.action_map.block.id') && $value1->member_id == $value->id && isset($contribution_data['cross_block'])) {
                    $cross_block += 1;
                }
                if ($value1->action_id == config('constants.action_map.foul.id') && $value1->member_id == $value->id) {
                    $foul += 1;
                }
                if ($value1->action_id == config('constants.action_map.clear.id') && $value1->member_id == $value->id) {
                    $clear += 1;
                }
                if ($value1->action_id == config('constants.action_map.second_ball.id') && $value1->member_id == $value->id) {
                    $second_ball += 1;
                }
                if ($value1->action_id == config('constants.action_map.corner_kick.id') && $value1->member_id == $value->id) {
                    $corner_kick += 1;
                }
                if (in_array($value1->action_id, [config('constants.action_map.direct_free_kick.id'), config('constants.action_map.indirect_free_kick.id')]) && $value1->member_id == $value->id) {
                    $free_kick += 1;
                }
                if ($value1->action_id == config('constants.action_map.pk_free_kick.id') && $value1->member_id == $value->id) {
                    $pk += 1;
                }
                if ($value1->action_id == config('constants.action_map.tackle_overhead.id') && $value1->member_id == $value->id && $value1->result == 1 && ($value1->is_pitch_home_area && !$value1->is_pitch_guest_area)) {
                    $tackle_overhead_home += 1;
                }
                if ($value1->action_id == config('constants.action_map.tackle_overhead.id') && $value1->member_id == $value->id && $value1->result == 1 && (!$value1->is_pitch_home_area && $value1->is_pitch_guest_area)) {
                    $tackle_overhead_guest += 1;
                }
                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_id) {
                    if ($value1->guest_gk_member_id == $value->id) {
                        $guest_kick += 1;
                    } elseif ($value1->home_gk_member_id == $value->id) {
                        $guest_kick += 1;
                    }
                }
                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_id && in_array($value1->ball_goal_number, config('constants.goal_numbers'))) {
                    if ($value1->guest_gk_member_id == $value->id) {
                        $guest_kick_goal += 1;
                    } elseif ($value1->home_gk_member_id == $value->id) {
                        $guest_kick_goal += 1;
                    }
                }
                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->result == 1 && $value1->member_id) {
                    if ($value1->guest_gk_member_id == $value->id) {
                        $guest_lose += 1;
                    } elseif ($value1->home_gk_member_id == $value->id) {
                        $guest_lose += 1;
                    }
                }
                $contribution_score = json_decode($value1->action_contribution_score, true);
                if ((in_array($value1->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && $value1->member_id == $value->id) || (!in_array($value1->member_id, $member_id) && $value1->member_id && in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value1->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value1->result != 1)) {
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
                if (in_array($value1->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && $value1->member_id == $value->id) {
                    if ((isset($contribution_data['shoot']) || isset($contribution_score['stop_pk'])) && $value1->guest_gk_member_id == $value->id && $value1->is_pa_guest_area) {
                        $save_penalty += 1;
                    } else if ((isset($contribution_data['shoot']) || isset($contribution_score['stop_pk'])) && $value1->home_gk_member_id == $value->id && $value1->is_pa_home_area) {
                        $save_penalty += 1;
                    }
                }
                if ((!in_array($value1->member_id, $member_id) && in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value1->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value1->result != 1)) {
                    if ($value1->guest_gk_member_id == $value->id && $value1->is_pa_guest_area) {
                        $save_penalty += 1;
                    } elseif ($value1->home_gk_member_id == $value->id && $value1->is_pa_home_area) {
                        $save_penalty += 1;
                    }
                }
                if ($value1->action_id == config('constants.action_map.punching.id') && $value1->member_id == $value->id) {
                    $punching += 1;
                }
                if (in_array($value1->action_id, [config('constants.action_map.punt_kick.id'), config('constants.action_map.throw_ball.id')]) && $value1->member_id == $value->id && isset($contribution_data['successful_own_pass'])) {
                    $pass += 1;
                }
                if (in_array($value1->action_id, [config('constants.action_map.punt_kick.id'), config('constants.action_map.throw_ball.id')]) && $value1->member_id == $value->id && isset($contribution_data['successful_enemy_pass'])) {
                    $guest_pass += 1;
                }
                if ($value1->member_id == $value->id) {
                    if ($value1->action_contribution_score) {
                        $contribution_score = json_decode($value1->action_contribution_score, true);
                        foreach ($contribution_score as $key2 => $value2) {
                            $contribute += $value2;
                        }
                    }
                }
            }
        }
        $box_score['goal']                  = $goal;
        $box_score['kick']                  = $kick;
        $box_score['kick_goal']             = $kick_goal;
        $box_score['assist']                = $assist;
        $box_score['last_pass']             = $last_pass;
        $box_score['cross']                 = $cross;
        $box_score['pass_dribble']          = $pass_dribble;
        $box_score['fouled']                = $fouled;
        $box_score['tackle']                = $tackle;
        $box_score['steal']                 = $steal;
        $box_score['intercept']             = $intercept;
        $box_score['shoot_block']           = $shoot_block;
        $box_score['cross_block']           = $cross_block;
        $box_score['foul']                  = $foul;
        $box_score['clear']                 = $clear;
        $box_score['second_ball']           = $second_ball;
        $box_score['corner_kick']           = $corner_kick;
        $box_score['free_kick']             = $free_kick;
        $box_score['pk']                    = $pk;
        $box_score['tackle_overhead_home']  = $tackle_overhead_home;
        $box_score['tackle_overhead_guest'] = $tackle_overhead_guest;
        $box_score['guest_kick']            = $guest_kick;
        $box_score['guest_kick_goal']       = $guest_kick_goal;
        $box_score['guest_lose']            = $guest_lose;
        $box_score['save_kick']             = $save_kick;
        $box_score['save_penalty']          = $save_penalty;
        $box_score['punching']              = $punching;
        $box_score['pass']                  = $pass;
        $box_score['guest_pass']            = $guest_pass;
        $box_score['contribute']            = $contribute;

        return $box_score;
    }

    public static function boxScorePersonalProbability($stats, $member_id, $value, $match = null, $time = null, $sub_time = null)
    {
        $box_score                   = [];
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

        if ($match) {
            $ms_in_round1 = $time * 60000 / 3;
            $ms_in_round2 = $time * 60000 / 3 * 2;
            foreach ($stats as $key1 => $value1) {
                if ($value1->match_id == $match->id) {
                    if ($sub_time == 1) {
                        if ($value1->timer_at <= $ms_in_round1) {
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_id == $value->id) {
                                $kick += 1;
                                if ($value1->result == 1) {
                                    $goal += 1;
                                }
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_id == $value->id && in_array($value1->ball_goal_number, config('constants.goal_numbers'))) {
                                $kick_goal += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.tackle_overhead.id') && ($value1->member_id == $value->id || $value1->sub_member_id == $value->id)) {
                                if ($value1->is_pitch_home_area) {
                                    $total_tackle_overhead_home += 1;
                                    if ($value1->member_id == $value->id) {
                                        $tackle_overhead_home += 1;
                                    }
                                }
                                if ($value1->is_pitch_guest_area) {
                                    $total_tackle_overhead_guest += 1;
                                    if ($value1->member_id == $value->id) {
                                        $tackle_overhead_guest += 1;
                                    }
                                }
                            }
                            if ($value1->action_id == config('constants.action_map.pass.id') && $value1->member_id == $value->id) {
                                $total_pass_dribble += 1;
                                if ($value1->result == 1) {
                                    $pass_dribble += 1;
                                }
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && $value1->member_id == $value->id) {
                                $total_cross += 1;
                                if ($value1->result == 1) {
                                    $cross += 1;
                                }
                            }
                            $contribution_data = json_decode($value1->action_contribution_data, true);
                            if ($value1->action_id == config('constants.action_map.tackle.id') && $value1->member_id == $value->id) {
                                $total_tackle += 1;
                                if (isset($contribution_data['seize'])) {
                                    $tackle += 1;
                                }
                            }
                            if ($value1->action_id == config('constants.action_map.clear.id') && $value1->member_id == $value->id) {
                                $total_clear += 1;
                                if ($value1->result == 1) {
                                    $clear += 1;
                                }
                            }
                            if ($value1->action_id == config('constants.action_map.second_ball.id') && ($value1->member_id == $value->id || $value1->sub_member_id == $value->id)) {
                                $total_second_ball += 1;
                                if ($value1->result == 1 && $value1->member_id == $value->id) {
                                    $second_ball += 1;
                                }
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_id) {
                                if ($value1->guest_gk_member_id == $value->id) {
                                    $total_save += 1;
                                } elseif ($value1->home_gk_member_id == $value->id) {
                                    $total_save += 1;
                                }
                            }
                            $contribution_score = json_decode($value1->action_contribution_score, true);
                            if ((in_array($value1->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && $value1->member_id == $value->id) || (!in_array($value1->member_id, $member_id) && $value1->member_id && in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value1->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value1->result != 1)) {
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
                            if (in_array($value1->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_id) {
                                if ($value1->guest_gk_member_id == $value->id) {
                                    $total_catch_cross += 1;
                                } elseif ($value1->home_gk_member_id == $value->id) {
                                    $total_catch_cross += 1;
                                }
                            }
                            if ($value1->action_id == config('constants.action_map.catching.id') && $value1->member_id == $value->id && isset($contribution_data['cross'])) {
                                $catch_cross += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_id) {
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
                    } else if ($sub_time == 2) {
                        if ($value1->timer_at > $ms_in_round1 && $value1->timer_at <= $ms_in_round2) {
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_id == $value->id) {
                                $kick += 1;
                                if ($value1->result == 1) {
                                    $goal += 1;
                                }
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_id == $value->id && in_array($value1->ball_goal_number, config('constants.goal_numbers'))) {
                                $kick_goal += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.tackle_overhead.id') && ($value1->member_id == $value->id || $value1->sub_member_id == $value->id)) {
                                if ($value1->is_pitch_home_area) {
                                    $total_tackle_overhead_home += 1;
                                    if ($value1->member_id == $value->id) {
                                        $tackle_overhead_home += 1;
                                    }
                                }
                                if ($value1->is_pitch_guest_area) {
                                    $total_tackle_overhead_guest += 1;
                                    if ($value1->member_id == $value->id) {
                                        $tackle_overhead_guest += 1;
                                    }
                                }
                            }
                            if ($value1->action_id == config('constants.action_map.pass.id') && $value1->member_id == $value->id) {
                                $total_pass_dribble += 1;
                                if ($value1->result == 1) {
                                    $pass_dribble += 1;
                                }
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && $value1->member_id == $value->id) {
                                $total_cross += 1;
                                if ($value1->result == 1) {
                                    $cross += 1;
                                }
                            }
                            $contribution_data = json_decode($value1->action_contribution_data, true);
                            if ($value1->action_id == config('constants.action_map.tackle.id') && $value1->member_id == $value->id) {
                                $total_tackle += 1;
                                if (isset($contribution_data['seize'])) {
                                    $tackle += 1;
                                }
                            }
                            if ($value1->action_id == config('constants.action_map.clear.id') && $value1->member_id == $value->id) {
                                $total_clear += 1;
                                if ($value1->result == 1) {
                                    $clear += 1;
                                }
                            }
                            if ($value1->action_id == config('constants.action_map.second_ball.id') && ($value1->member_id == $value->id || $value1->sub_member_id == $value->id)) {
                                $total_second_ball += 1;
                                if ($value1->result == 1 && $value1->member_id == $value->id) {
                                    $second_ball += 1;
                                }
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_id) {
                                if ($value1->guest_gk_member_id == $value->id) {
                                    $total_save += 1;
                                } elseif ($value1->home_gk_member_id == $value->id) {
                                    $total_save += 1;
                                }
                            }
                            $contribution_score = json_decode($value1->action_contribution_score, true);
                            if ((in_array($value1->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && $value1->member_id == $value->id) || (!in_array($value1->member_id, $member_id) && $value1->member_id && in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value1->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value1->result != 1)) {
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
                            if (in_array($value1->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_id) {
                                if ($value1->guest_gk_member_id == $value->id) {
                                    $total_catch_cross += 1;
                                } elseif ($value1->home_gk_member_id == $value->id) {
                                    $total_catch_cross += 1;
                                }
                            }
                            if ($value1->action_id == config('constants.action_map.catching.id') && $value1->member_id == $value->id && isset($contribution_data['cross'])) {
                                $catch_cross += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_id) {
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
                    } else if ($sub_time == 3) {
                        if ($value1->timer_at > $ms_in_round2) {
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_id == $value->id) {
                                $kick += 1;
                                if ($value1->result == 1) {
                                    $goal += 1;
                                }
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_id == $value->id && in_array($value1->ball_goal_number, config('constants.goal_numbers'))) {
                                $kick_goal += 1;
                            }
                            if ($value1->action_id == config('constants.action_map.tackle_overhead.id') && ($value1->member_id == $value->id || $value1->sub_member_id == $value->id)) {
                                if ($value1->is_pitch_home_area) {
                                    $total_tackle_overhead_home += 1;
                                    if ($value1->member_id == $value->id) {
                                        $tackle_overhead_home += 1;
                                    }
                                }
                                if ($value1->is_pitch_guest_area) {
                                    $total_tackle_overhead_guest += 1;
                                    if ($value1->member_id == $value->id) {
                                        $tackle_overhead_guest += 1;
                                    }
                                }
                            }
                            if ($value1->action_id == config('constants.action_map.pass.id') && $value1->member_id == $value->id) {
                                $total_pass_dribble += 1;
                                if ($value1->result == 1) {
                                    $pass_dribble += 1;
                                }
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && $value1->member_id == $value->id) {
                                $total_cross += 1;
                                if ($value1->result == 1) {
                                    $cross += 1;
                                }
                            }
                            $contribution_data = json_decode($value1->action_contribution_data, true);
                            if ($value1->action_id == config('constants.action_map.tackle.id') && $value1->member_id == $value->id) {
                                $total_tackle += 1;
                                if (isset($contribution_data['seize'])) {
                                    $tackle += 1;
                                }
                            }
                            if ($value1->action_id == config('constants.action_map.clear.id') && $value1->member_id == $value->id) {
                                $total_clear += 1;
                                if ($value1->result == 1) {
                                    $clear += 1;
                                }
                            }
                            if ($value1->action_id == config('constants.action_map.second_ball.id') && ($value1->member_id == $value->id || $value1->sub_member_id == $value->id)) {
                                $total_second_ball += 1;
                                if ($value1->result == 1 && $value1->member_id == $value->id) {
                                    $second_ball += 1;
                                }
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_id) {
                                if ($value1->guest_gk_member_id == $value->id) {
                                    $total_save += 1;
                                } elseif ($value1->home_gk_member_id == $value->id) {
                                    $total_save += 1;
                                }
                            }
                            $contribution_score = json_decode($value1->action_contribution_score, true);
                            if ((in_array($value1->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && $value1->member_id == $value->id) || (!in_array($value1->member_id, $member_id) && $value1->member_id && in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value1->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value1->result != 1)) {
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
                            if (in_array($value1->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_id) {
                                if ($value1->guest_gk_member_id == $value->id) {
                                    $total_catch_cross += 1;
                                } elseif ($value1->home_gk_member_id == $value->id) {
                                    $total_catch_cross += 1;
                                }
                            }
                            if ($value1->action_id == config('constants.action_map.catching.id') && $value1->member_id == $value->id && isset($contribution_data['cross'])) {
                                $catch_cross += 1;
                            }
                            if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_id) {
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
                        if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_id == $value->id) {
                            $kick += 1;
                            if ($value1->result == 1) {
                                $goal += 1;
                            }
                        }
                        if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_id == $value->id && in_array($value1->ball_goal_number, config('constants.goal_numbers'))) {
                            $kick_goal += 1;
                        }
                        if ($value1->action_id == config('constants.action_map.tackle_overhead.id') && ($value1->member_id == $value->id || $value1->sub_member_id == $value->id)) {
                            if ($value1->is_pitch_home_area) {
                                $total_tackle_overhead_home += 1;
                                if ($value1->member_id == $value->id) {
                                    $tackle_overhead_home += 1;
                                }
                            }
                            if ($value1->is_pitch_guest_area) {
                                $total_tackle_overhead_guest += 1;
                                if ($value1->member_id == $value->id) {
                                    $tackle_overhead_guest += 1;
                                }
                            }
                        }
                        if ($value1->action_id == config('constants.action_map.pass.id') && $value1->member_id == $value->id) {
                            $total_pass_dribble += 1;
                            if ($value1->result == 1) {
                                $pass_dribble += 1;
                            }
                        }
                        if (in_array($value1->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && $value1->member_id == $value->id) {
                            $total_cross += 1;
                            if ($value1->result == 1) {
                                $cross += 1;
                            }
                        }
                        $contribution_data = json_decode($value1->action_contribution_data, true);
                        if ($value1->action_id == config('constants.action_map.tackle.id') && $value1->member_id == $value->id) {
                            $total_tackle += 1;
                            if (isset($contribution_data['seize'])) {
                                $tackle += 1;
                            }
                        }
                        if ($value1->action_id == config('constants.action_map.clear.id') && $value1->member_id == $value->id) {
                            $total_clear += 1;
                            if ($value1->result == 1) {
                                $clear += 1;
                            }
                        }
                        if ($value1->action_id == config('constants.action_map.second_ball.id') && ($value1->member_id == $value->id || $value1->sub_member_id == $value->id)) {
                            $total_second_ball += 1;
                            if ($value1->result == 1 && $value1->member_id == $value->id) {
                                $second_ball += 1;
                            }
                        }
                        if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_id) {
                            if ($value1->guest_gk_member_id == $value->id) {
                                $total_save += 1;
                            } elseif ($value1->home_gk_member_id == $value->id) {
                                $total_save += 1;
                            }
                        }
                        $contribution_score = json_decode($value1->action_contribution_score, true);
                        if ((in_array($value1->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && $value1->member_id == $value->id) || (!in_array($value1->member_id, $member_id) && $value1->member_id && in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value1->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value1->result != 1)) {
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
                        if (in_array($value1->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_id) {
                            if ($value1->guest_gk_member_id == $value->id) {
                                $total_catch_cross += 1;
                            } elseif ($value1->home_gk_member_id == $value->id) {
                                $total_catch_cross += 1;
                            }
                        }
                        if ($value1->action_id == config('constants.action_map.catching.id') && $value1->member_id == $value->id && isset($contribution_data['cross'])) {
                            $catch_cross += 1;
                        }
                        if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_id) {
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
        } else {
            foreach ($stats as $key1 => $value1) {
                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_id == $value->id) {
                    $kick += 1;
                    if ($value1->result == 1) {
                        $goal += 1;
                    }
                }
                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && $value1->member_id == $value->id && in_array($value1->ball_goal_number, config('constants.goal_numbers'))) {
                    $kick_goal += 1;
                }
                if ($value1->action_id == config('constants.action_map.tackle_overhead.id') && ($value1->member_id == $value->id || $value1->sub_member_id == $value->id)) {
                    if ($value1->is_pitch_home_area) {
                        $total_tackle_overhead_home += 1;
                        if ($value1->member_id == $value->id) {
                            $tackle_overhead_home += 1;
                        }
                    }
                    if ($value1->is_pitch_guest_area) {
                        $total_tackle_overhead_guest += 1;
                        if ($value1->member_id == $value->id) {
                            $tackle_overhead_guest += 1;
                        }
                    }
                }
                if ($value1->action_id == config('constants.action_map.pass.id') && $value1->member_id == $value->id) {
                    $total_pass_dribble += 1;
                    if ($value1->result == 1) {
                        $pass_dribble += 1;
                    }
                }
                if (in_array($value1->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && $value1->member_id == $value->id) {
                    $total_cross += 1;
                    if ($value1->result == 1) {
                        $cross += 1;
                    }
                }
                $contribution_data = json_decode($value1->action_contribution_data, true);
                if ($value1->action_id == config('constants.action_map.tackle.id') && $value1->member_id == $value->id) {
                    $total_tackle += 1;
                    if (isset($contribution_data['seize'])) {
                        $tackle += 1;
                    }
                }
                if ($value1->action_id == config('constants.action_map.clear.id') && $value1->member_id == $value->id) {
                    $total_clear += 1;
                    if ($value1->result == 1) {
                        $clear += 1;
                    }
                }
                if ($value1->action_id == config('constants.action_map.second_ball.id') && ($value1->member_id == $value->id || $value1->sub_member_id == $value->id)) {
                    $total_second_ball += 1;
                    if ($value1->result == 1 && $value1->member_id == $value->id) {
                        $second_ball += 1;
                    }
                }
                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_id) {
                    if ($value1->guest_gk_member_id == $value->id) {
                        $total_save += 1;
                    } elseif ($value1->home_gk_member_id == $value->id) {
                        $total_save += 1;
                    }
                }
                $contribution_score = json_decode($value1->action_contribution_score, true);
                if ((in_array($value1->action_id, [config('constants.action_map.catching.id'), config('constants.action_map.punching.id'), config('constants.action_map.gk_action_stop.id')]) && $value1->member_id == $value->id) || (!in_array($value1->member_id, $member_id) && $value1->member_id && in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && in_array($value1->action_kick_gk_id, [config('constants.gk_actions.key.saving'), config('constants.gk_actions.key.punch_ball'), config('constants.gk_actions.key.catch_ball')]) && $value1->result != 1)) {
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
                if (in_array($value1->action_id, [config('constants.action_map.cross.id'), config('constants.action_map.early_cross.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_id) {
                    if ($value1->guest_gk_member_id == $value->id) {
                        $total_catch_cross += 1;
                    } elseif ($value1->home_gk_member_id == $value->id) {
                        $total_catch_cross += 1;
                    }
                }
                if ($value1->action_id == config('constants.action_map.catching.id') && $value1->member_id == $value->id && isset($contribution_data['cross'])) {
                    $catch_cross += 1;
                }
                if (in_array($value1->action_id, [config('constants.action_map.kick.id'), config('constants.action_map.pk_free_kick.id')]) && !in_array($value1->member_id, $member_id) && $value1->member_id) {
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
        $box_score['ratio_goal']                  = TransformDataStat::getResult($goal, $kick);
        $box_score['ratio_kick_goal']             = TransformDataStat::getResult($kick_goal, $kick);
        $box_score['ratio_tackle_overhead_home']  = TransformDataStat::getResult($tackle_overhead_home, $total_tackle_overhead_home);
        $box_score['ratio_tackle_overhead_guest'] = TransformDataStat::getResult($tackle_overhead_guest, $total_tackle_overhead_guest);
        $box_score['ratio_pass_dribble']          = TransformDataStat::getResult($pass_dribble, $total_pass_dribble);
        $box_score['ratio_cross']                 = TransformDataStat::getResult($cross, $total_cross);
        $box_score['ratio_tackle']                = TransformDataStat::getResult($tackle, $total_tackle);
        $box_score['ratio_clear']                 = TransformDataStat::getResult($clear, $total_clear);
        $box_score['ratio_second_ball']           = TransformDataStat::getResult($second_ball, $total_second_ball);
        $box_score['ratio_save']                  = TransformDataStat::getResult($save, $total_save);
        $box_score['ratio_catch_cross']           = TransformDataStat::getResult($catch_cross, $total_catch_cross);
        $box_score['ratio_lose']                  = TransformDataStat::getResult($lose, $total_lose);

        return $box_score;
    }

    public static function getResult($counterValue, $counterTotal)
    {
        if ($counterTotal === 0) {
            return 0;
        }

        return round(($counterValue / $counterTotal) * 100, 0);
    }
}

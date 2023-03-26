import $ from 'jquery';
import {ACTION_MAP, goalConfig, gkActions} from './constants-box-score.js';

export function boxScoreTeamNumber(stats, member_team, team, round, time = null, sub_time = null, match = null, member_anonymous_id = null) {
	var box_score             = {};
    var goal                  = 0;
    var kick                  = 0;
    var kick_goal             = 0;
    var assist                = 0;
    var last_pass             = 0;
    var cross                 = 0;
    var pass_dribble          = 0;
    var fouled                = 0;
    var cut_ball              = 0;
    var clear                 = 0;
    var block                 = 0;
    var foul                  = 0;
    var second_ball           = 0;
    var is_pa                 = 0;
    var penalty_golf          = 0;
    var corner_kick           = 0;
    var free_kick             = 0;
    var pk                    = 0;
    var tackle_overhead_home  = 0;
    var tackle_overhead_guest = 0;
    var save                  = 0;
    var rounds                = {1 : '_1ST', 2 : '_2ND', 3 : '_3RD', 4 : '_4TH', 5 : '_EXT1', 6 : '_EXT2'};
    var ms_in_round1 = null;
    var ms_in_round2 = null;
    if (time) {
        var ms_in_round1 = time * 60000 / 3;
        var ms_in_round2 = time * 60000 / 3 * 2;
    };

    if (match) {

    } else {
        $.each( stats, function( key, value ) {
            if (round != 0) {
                if (value.created_at_round == rounds[round]) {
                    if (sub_time == 1) {
                        if (value.timer_at <= ms_in_round1) {
                            if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(value.action_id) && value.result == 1 && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                goal += 1;
                            }
                            if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(value.action_id) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                kick += 1;
                            }
                            if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(value.action_id) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id) && !!goalConfig.goalNumbers.includes(value.ball_goal_number)) {
                                kick_goal += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.ASSIST.id && value.result == 1 && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                assist += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.ASSIST.id && value.result != 1 && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                last_pass += 1;
                            }
                            if (!! [ACTION_MAP.VALUES.CROSS.id, ACTION_MAP.VALUES.EARLY_CROSS.id].includes(value.action_id) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                cross += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.PASS.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id) && value.result == 1) {
                                pass_dribble += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.FOULED.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                fouled += 1;
                            }
                            if (!! [ACTION_MAP.VALUES.TACKLE.id, ACTION_MAP.VALUES.BLOCK.id, ACTION_MAP.VALUES.INTERCEPT.id].includes(value.action_id) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id) && value.result == 1) {
                                cut_ball += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.CLEAR.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                clear += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.BLOCK.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                block += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.FOUL.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                foul += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.SECOND_BALL.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                second_ball += 1;
                            }
                            if (((value.is_pa_guest_area && team.is_home) || (value.is_pa_home_area && !team.is_home)) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                is_pa += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.GOAL_KICK.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                penalty_golf += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.CORNER_KICK.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                corner_kick += 1;
                            }
                            if (!! [ACTION_MAP.VALUES.DIRECT_FREE_KICK.id, ACTION_MAP.VALUES.INDIRECT_FREE_KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(value.action_id) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                free_kick += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.PK_FREE_KICK.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                pk += 1;
                            }
                            if (((value.is_pitch_home_area && team.is_home) || (value.is_pitch_guest_area && !team.is_home)) && value.action_id == ACTION_MAP.VALUES.TACKLE_OVERHEAD.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id) && value.result == 1) {
                                tackle_overhead_home += 1;
                            }
                            if (((value.is_pitch_guest_area && team.is_home) || (value.is_pitch_home_area && !team.is_home)) && value.action_id == ACTION_MAP.VALUES.TACKLE_OVERHEAD.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id) && value.result == 1) {
                                tackle_overhead_guest += 1;
                            }
                            const contributionData = JSON.parse(value.action_contribution_data);
                            const contributionScore = JSON.parse(value.action_contribution_score);
                            if ((!![ ACTION_MAP.VALUES.CATCHING.id, ACTION_MAP.VALUES.PUNCHING.id, ACTION_MAP.VALUES.GK_ACTION_STOP.id ].includes(value.action_id) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) || (!member_team.includes(value.member_id) &&
                            !![ ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(value.action_id) && !![ gkActions.value.saving.id, gkActions.value.punch_ball.id, gkActions.value.catch_ball.id ].includes(value.action_kick_gk_id) && !value.result) ) {
                                if (contributionData?.shoot) save += 1;
                                else if (contributionScore?.stop_pk) save += 1;
                                else if (member_team.includes(value.guest_gk_member_id)) save += 1;
                                else if (member_team.includes(value.home_gk_member_id)) save += 1;
                            }
                        }
                    } else if (sub_time == 2) {
                        if (value.timer_at > ms_in_round1 && value.timer_at <= ms_in_round2) {
                            if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(value.action_id) && value.result == 1 && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                goal += 1;
                            }
                            if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(value.action_id) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                kick += 1;
                            }
                            if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(value.action_id) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id) && !!goalConfig.goalNumbers.includes(value.ball_goal_number)) {
                                kick_goal += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.ASSIST.id && value.result == 1 && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                assist += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.ASSIST.id && value.result != 1 && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                last_pass += 1;
                            }
                            if (!! [ACTION_MAP.VALUES.CROSS.id, ACTION_MAP.VALUES.EARLY_CROSS.id].includes(value.action_id) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                cross += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.PASS.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id) && value.result == 1) {
                                pass_dribble += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.FOULED.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                fouled += 1;
                            }
                            if (!! [ACTION_MAP.VALUES.TACKLE.id, ACTION_MAP.VALUES.BLOCK.id, ACTION_MAP.VALUES.INTERCEPT.id].includes(value.action_id) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id) && value.result == 1) {
                                cut_ball += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.CLEAR.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                clear += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.BLOCK.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                block += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.FOUL.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                foul += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.SECOND_BALL.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                second_ball += 1;
                            }
                            if (((value.is_pa_guest_area && team.is_home) || (value.is_pa_home_area && !team.is_home)) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                is_pa += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.GOAL_KICK.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                penalty_golf += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.CORNER_KICK.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                corner_kick += 1;
                            }
                            if (!! [ACTION_MAP.VALUES.DIRECT_FREE_KICK.id, ACTION_MAP.VALUES.INDIRECT_FREE_KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(value.action_id) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                free_kick += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.PK_FREE_KICK.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                pk += 1;
                            }
                            if (((value.is_pitch_home_area && team.is_home) || (value.is_pitch_guest_area && !team.is_home)) && value.action_id == ACTION_MAP.VALUES.TACKLE_OVERHEAD.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id) && value.result == 1) {
                                tackle_overhead_home += 1;
                            }
                            if (((value.is_pitch_guest_area && team.is_home) || (value.is_pitch_home_area && !team.is_home)) && value.action_id == ACTION_MAP.VALUES.TACKLE_OVERHEAD.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id) && value.result == 1) {
                                tackle_overhead_guest += 1;
                            }
                            const contributionData = JSON.parse(value.action_contribution_data);
                            const contributionScore = JSON.parse(value.action_contribution_score);
                            if ((!![ ACTION_MAP.VALUES.CATCHING.id, ACTION_MAP.VALUES.PUNCHING.id, ACTION_MAP.VALUES.GK_ACTION_STOP.id ].includes(value.action_id) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) || (!member_team.includes(value.member_id) &&
                            !![ ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(value.action_id) && !![ gkActions.value.saving.id, gkActions.value.punch_ball.id, gkActions.value.catch_ball.id ].includes(value.action_kick_gk_id) && !value.result) ) {
                                if (contributionData?.shoot) save += 1;
                                else if (contributionScore?.stop_pk) save += 1;
                                else if (member_team.includes(value.guest_gk_member_id)) save += 1;
                                else if (member_team.includes(value.home_gk_member_id)) save += 1;
                            }
                        }
                    } else if (sub_time == 3) {
                        if (value.timer_at > ms_in_round2) {
                            if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(value.action_id) && value.result == 1 && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                goal += 1;
                            }
                            if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(value.action_id) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                kick += 1;
                            }
                            if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(value.action_id) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id) && !!goalConfig.goalNumbers.includes(value.ball_goal_number)) {
                                kick_goal += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.ASSIST.id && value.result == 1 && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                assist += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.ASSIST.id && value.result != 1 && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                last_pass += 1;
                            }
                            if (!! [ACTION_MAP.VALUES.CROSS.id, ACTION_MAP.VALUES.EARLY_CROSS.id].includes(value.action_id) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                cross += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.PASS.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id) && value.result == 1) {
                                pass_dribble += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.FOULED.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                fouled += 1;
                            }
                            if (!! [ACTION_MAP.VALUES.TACKLE.id, ACTION_MAP.VALUES.BLOCK.id, ACTION_MAP.VALUES.INTERCEPT.id].includes(value.action_id) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id) && value.result == 1) {
                                cut_ball += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.CLEAR.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                clear += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.BLOCK.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                block += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.FOUL.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                foul += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.SECOND_BALL.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                second_ball += 1;
                            }
                            if (((value.is_pa_guest_area && team.is_home) || (value.is_pa_home_area && !team.is_home)) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                is_pa += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.GOAL_KICK.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                penalty_golf += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.CORNER_KICK.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                corner_kick += 1;
                            }
                            if (!! [ACTION_MAP.VALUES.DIRECT_FREE_KICK.id, ACTION_MAP.VALUES.INDIRECT_FREE_KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(value.action_id) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                free_kick += 1;
                            }
                            if (value.action_id == ACTION_MAP.VALUES.PK_FREE_KICK.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                                pk += 1;
                            }
                            if (((value.is_pitch_home_area && team.is_home) || (value.is_pitch_guest_area && !team.is_home)) && value.action_id == ACTION_MAP.VALUES.TACKLE_OVERHEAD.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id) && value.result == 1) {
                                tackle_overhead_home += 1;
                            }
                            if (((value.is_pitch_guest_area && team.is_home) || (value.is_pitch_home_area && !team.is_home)) && value.action_id == ACTION_MAP.VALUES.TACKLE_OVERHEAD.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id) && value.result == 1) {
                                tackle_overhead_guest += 1;
                            }
                            const contributionData = JSON.parse(value.action_contribution_data);
                            const contributionScore = JSON.parse(value.action_contribution_score);
                            if ((!![ ACTION_MAP.VALUES.CATCHING.id, ACTION_MAP.VALUES.PUNCHING.id, ACTION_MAP.VALUES.GK_ACTION_STOP.id ].includes(value.action_id) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) || (!member_team.includes(value.member_id) &&
                            !![ ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(value.action_id) && !![ gkActions.value.saving.id, gkActions.value.punch_ball.id, gkActions.value.catch_ball.id ].includes(value.action_kick_gk_id) && !value.result) ) {
                                if (contributionData?.shoot) save += 1;
                                else if (contributionScore?.stop_pk) save += 1;
                                else if (member_team.includes(value.guest_gk_member_id)) save += 1;
                                else if (member_team.includes(value.home_gk_member_id)) save += 1;
                            }
                        }
                    } else {
                        if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(value.action_id) && value.result == 1 && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                            goal += 1;
                        }
                        if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(value.action_id) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                            kick += 1;
                        }
                        if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(value.action_id) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id) && !!goalConfig.goalNumbers.includes(value.ball_goal_number)) {
                            kick_goal += 1;
                        }
                        if (value.action_id == ACTION_MAP.VALUES.ASSIST.id && value.result == 1 && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                            assist += 1;
                        }
                        if (value.action_id == ACTION_MAP.VALUES.ASSIST.id && value.result != 1 && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                            last_pass += 1;
                        }
                        if (!! [ACTION_MAP.VALUES.CROSS.id, ACTION_MAP.VALUES.EARLY_CROSS.id].includes(value.action_id) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                            cross += 1;
                        }
                        if (value.action_id == ACTION_MAP.VALUES.PASS.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id) && value.result == 1) {
                            pass_dribble += 1;
                        }
                        if (value.action_id == ACTION_MAP.VALUES.FOULED.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                            fouled += 1;
                        }
                        if (!! [ACTION_MAP.VALUES.TACKLE.id, ACTION_MAP.VALUES.BLOCK.id, ACTION_MAP.VALUES.INTERCEPT.id].includes(value.action_id) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id) && value.result == 1) {
                            cut_ball += 1;
                        }
                        if (value.action_id == ACTION_MAP.VALUES.CLEAR.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                            clear += 1;
                        }
                        if (value.action_id == ACTION_MAP.VALUES.BLOCK.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                            block += 1;
                        }
                        if (value.action_id == ACTION_MAP.VALUES.FOUL.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                            foul += 1;
                        }
                        if (value.action_id == ACTION_MAP.VALUES.SECOND_BALL.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                            second_ball += 1;
                        }
                        if (((value.is_pa_guest_area && team.is_home) || (value.is_pa_home_area && !team.is_home)) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                            is_pa += 1;
                        }
                        if (value.action_id == ACTION_MAP.VALUES.GOAL_KICK.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                            penalty_golf += 1;
                        }
                        if (value.action_id == ACTION_MAP.VALUES.CORNER_KICK.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                            corner_kick += 1;
                        }
                        if (!! [ACTION_MAP.VALUES.DIRECT_FREE_KICK.id, ACTION_MAP.VALUES.INDIRECT_FREE_KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(value.action_id) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                            free_kick += 1;
                        }
                        if (value.action_id == ACTION_MAP.VALUES.PK_FREE_KICK.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                            pk += 1;
                        }
                        if (((value.is_pitch_home_area && team.is_home) || (value.is_pitch_guest_area && !team.is_home)) && value.action_id == ACTION_MAP.VALUES.TACKLE_OVERHEAD.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id) && value.result == 1) {
                            tackle_overhead_home += 1;
                        }
                        if (((value.is_pitch_guest_area && team.is_home) || (value.is_pitch_home_area && !team.is_home)) && value.action_id == ACTION_MAP.VALUES.TACKLE_OVERHEAD.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id) && value.result == 1) {
                            tackle_overhead_guest += 1;
                        }
                        const contributionData = JSON.parse(value.action_contribution_data);
                        const contributionScore = JSON.parse(value.action_contribution_score);
                        if ((!![ ACTION_MAP.VALUES.CATCHING.id, ACTION_MAP.VALUES.PUNCHING.id, ACTION_MAP.VALUES.GK_ACTION_STOP.id ].includes(value.action_id) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) || (!member_team.includes(value.member_id) &&
                        !![ ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(value.action_id) && !![ gkActions.value.saving.id, gkActions.value.punch_ball.id, gkActions.value.catch_ball.id ].includes(value.action_kick_gk_id) && !value.result) ) {
                            if (contributionData?.shoot) save += 1;
                            else if (contributionScore?.stop_pk) save += 1;
                            else if (member_team.includes(value.guest_gk_member_id)) save += 1;
                            else if (member_team.includes(value.home_gk_member_id)) save += 1;
                        }
                    }
                }
            } else {
                if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(value.action_id) && value.result == 1 && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                    goal += 1;
                }
                if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(value.action_id) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                    kick += 1;
                }
                if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(value.action_id) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id) && !!goalConfig.goalNumbers.includes(value.ball_goal_number)) {
                    kick_goal += 1;
                }
                if (value.action_id == ACTION_MAP.VALUES.ASSIST.id && value.result == 1 && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                    assist += 1;
                }
                if (value.action_id == ACTION_MAP.VALUES.ASSIST.id && value.result != 1 && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                    last_pass += 1;
                }
                if (!! [ACTION_MAP.VALUES.CROSS.id, ACTION_MAP.VALUES.EARLY_CROSS.id].includes(value.action_id) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                    cross += 1;
                }
                if (value.action_id == ACTION_MAP.VALUES.PASS.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id) && value.result == 1) {
                    pass_dribble += 1;
                }
                if (value.action_id == ACTION_MAP.VALUES.FOULED.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                    fouled += 1;
                }
                if (!! [ACTION_MAP.VALUES.TACKLE.id, ACTION_MAP.VALUES.BLOCK.id, ACTION_MAP.VALUES.INTERCEPT.id].includes(value.action_id) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id) && value.result == 1) {
                    cut_ball += 1;
                }
                if (value.action_id == ACTION_MAP.VALUES.CLEAR.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                    clear += 1;
                }
                if (value.action_id == ACTION_MAP.VALUES.BLOCK.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                    block += 1;
                }
                if (value.action_id == ACTION_MAP.VALUES.FOUL.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                    foul += 1;
                }
                if (value.action_id == ACTION_MAP.VALUES.SECOND_BALL.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                    second_ball += 1;
                }
                if (((value.is_pa_guest_area && team.is_home) || (value.is_pa_home_area && !team.is_home)) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                    is_pa += 1;
                }
                if (value.action_id == ACTION_MAP.VALUES.GOAL_KICK.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                    penalty_golf += 1;
                }
                if (value.action_id == ACTION_MAP.VALUES.CORNER_KICK.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                    corner_kick += 1;
                }
                if (!! [ACTION_MAP.VALUES.DIRECT_FREE_KICK.id, ACTION_MAP.VALUES.INDIRECT_FREE_KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(value.action_id) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                    free_kick += 1;
                }
                if (value.action_id == ACTION_MAP.VALUES.PK_FREE_KICK.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) {
                    pk += 1;
                }
                if (((value.is_pitch_home_area && team.is_home) || (value.is_pitch_guest_area && !team.is_home)) && value.action_id == ACTION_MAP.VALUES.TACKLE_OVERHEAD.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id) && value.result == 1) {
                    tackle_overhead_home += 1;
                }
                if (((value.is_pitch_guest_area && team.is_home) || (value.is_pitch_home_area && !team.is_home)) && value.action_id == ACTION_MAP.VALUES.TACKLE_OVERHEAD.id && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id) && value.result == 1) {
                    tackle_overhead_guest += 1;
                }
                const contributionData = JSON.parse(value.action_contribution_data);
                const contributionScore = JSON.parse(value.action_contribution_score);
                if ((!![ ACTION_MAP.VALUES.CATCHING.id, ACTION_MAP.VALUES.PUNCHING.id, ACTION_MAP.VALUES.GK_ACTION_STOP.id ].includes(value.action_id) && (member_team.includes(value.member_id) || value.member_anonymous_id == member_anonymous_id)) || (!member_team.includes(value.member_id) &&
                !![ ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(value.action_id) && !![ gkActions.value.saving.id, gkActions.value.punch_ball.id, gkActions.value.catch_ball.id ].includes(value.action_kick_gk_id) && !value.result) ) {
                    if (contributionData?.shoot) save += 1;
                    else if (contributionScore?.stop_pk) save += 1;
                    else if (member_team.includes(value.guest_gk_member_id)) save += 1;
                    else if (member_team.includes(value.home_gk_member_id)) save += 1;
                }
            }
        });
    }

    box_score.goal                  = goal;
    box_score.kick                  = kick;
    box_score.kick_goal             = kick_goal;
    box_score.assist                = assist;
    box_score.last_pass             = last_pass;
    box_score.cross                 = cross;
    box_score.pass_dribble          = pass_dribble;
    box_score.fouled                = fouled;
    box_score.cut_ball              = cut_ball;
    box_score.clear                 = clear;
    box_score.block                 = block;
    box_score.foul                  = foul;
    box_score.second_ball           = second_ball;
    box_score.is_pa                 = is_pa;
    box_score.penalty_golf          = penalty_golf;
    box_score.corner_kick           = corner_kick;
    box_score.free_kick             = free_kick;
    box_score.pk                    = pk;
    box_score.tackle_overhead_home  = tackle_overhead_home;
    box_score.tackle_overhead_guest = tackle_overhead_guest;
    box_score.save                  = save;

    return box_score;
}

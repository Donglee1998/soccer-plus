<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CreateStatTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input_stats = json_decode(file_get_contents(__DIR__.'/data/input-stats.json'), true);
        $match       = \DB::table('matches')->where('conference_name', 'howard_test_stt2')->select('id')->first();

        foreach ($input_stats as $stat)
        {
            \DB::table('stats')->insert([
                'match_id'                      => $match->id,
                'member_id'                     => isset($stat['member_id']) ? $stat['member_id'] : NULL,
                'sub_member_id'                 => isset($stat['sub_member_id']) ? $stat['sub_member_id'] : NULL,
                'action_id'                     => isset($stat['action_id']) ? $stat['action_id'] : NULL,
                'action_created'                => isset($stat['action_created']) ? $stat['action_created'] : NULL,
                'sub_action_id'                 => isset($stat['sub_action_id']) ? $stat['sub_action_id'] : NULL,
                'coord_x'                       => isset($stat['coord_x']) ? $stat['coord_x'] : NULL,
                'coord_y'                       => isset($stat['coord_y']) ? $stat['coord_y'] : NULL,
                'result'                        => isset($stat['result']) ? $stat['result'] : NULL,
                'created_at'                    => isset($stat['created_at']) ? $stat['created_at'] : NULL,
                'created_at_round'              => isset($stat['created_at_round']) ? $stat['created_at_round'] : NULL,
                // attributes of error
                'fouls_id'                      => isset($stat['fouls_id']) ? $stat['fouls_id'] : NULL,
                'fouls_judgment_type_id'        => isset($stat['fouls_judgment_type_id']) ? $stat['fouls_judgment_type_id'] : NULL,
                'fouls_reason_received_card_id' => isset($stat['fouls_reason_received_card_id']) ? $stat['fouls_reason_received_card_id'] : NULL,
                'fouls_free_kick_id'            => isset($stat['fouls_free_kick_id']) ? $stat['fouls_free_kick_id'] : NULL,
                // attributes of kick
                'ball_goal_coord_x'             => isset($stat['ball_goal_coord_x']) ? $stat['ball_goal_coord_x'] : NULL,
                'ball_goal_coord_y'             => isset($stat['ball_goal_coord_y']) ? $stat['ball_goal_coord_y'] : NULL,
                'ball_goal_number'              => isset($stat['ball_goal_number']) ? $stat['ball_goal_number'] : NULL,
                'action_kick_of_player_id'      => isset($stat['action_kick_of_player_id']) ? $stat['action_kick_of_player_id'] : NULL,
                'action_kick_situation_id'      => isset($stat['action_kick_situation_id']) ? $stat['action_kick_situation_id'] : NULL,
                'action_kick_gk_id'             => isset($stat['action_kick_gk_id']) ? $stat['action_kick_gk_id'] : NULL,
                'action_kick_block_id'          => isset($stat['action_kick_block_id']) ? $stat['action_kick_block_id'] : NULL,
                // attributes of contribution
                'action_contribution_id'        => isset($stat['action_contribution_id']) ? $stat['action_contribution_id'] : NULL,
                'action_contribution_data'      => isset($stat['action_contribution_data']) ? $stat['action_contribution_data'] : NULL,
                'action_contribution_score'     => isset($stat['action_contribution_score']) ? $stat['action_contribution_score'] : NULL,
                // attributes of pa area
                'is_pa_home_area'               => isset($stat['is_pa_home_area']) ? $stat['is_pa_home_area'] : NULL,
                'is_pa_guest_area'              => isset($stat['is_pa_guest_area']) ? $stat['is_pa_guest_area'] : NULL,
                // attributes of wings area
                'is_wings_home_area'            => isset($stat['is_wings_home_area']) ? $stat['is_wings_home_area'] : NULL,
                'is_wings_guest_area'           => isset($stat['is_wings_guest_area']) ? $stat['is_wings_guest_area'] : NULL,
                // attributes of pitch area
                'is_pitch_home_area'            => isset($stat['is_pitch_home_area']) ? $stat['is_pitch_home_area'] : NULL,
                'is_pitch_guest_area'           => isset($stat['is_pitch_guest_area']) ? $stat['is_pitch_guest_area'] : NULL,
                // attributes of GK
                'home_gk_id'                    => isset($stat['home_gk_id']) ? $stat['home_gk_id'] : NULL,
                'guest_gk_id'                   => isset($stat['guest_gk_id']) ? $stat['guest_gk_id'] : NULL,
                // attributes flag is edit.
                'is_edit'                       => isset($stat['is_edit']) ? $stat['is_edit'] : NULL,
            ]);
        }
    }
}

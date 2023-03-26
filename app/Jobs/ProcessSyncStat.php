<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use DB;
use App\Repositories\MatchRepository;
use App\Models\Tournament;

class ProcessSyncStat implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     */
    public $tries = 5;

    /**
     * The number of seconds the job can run before timing out.
     */
    public $timeout = 1200;

    private $_data;
    private $_matchRepo;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data = [])
    {
        $this->_data = $data;
        $this->_matchRepo = new MatchRepository(new Tournament);
        ini_set('max_execution_time', 0); // Set unlimited time
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user_id        = auth('api')->user()->id;
        $uuid           = auth('api')->getPayload()->get('uuid');
        $stats      = $this->_data['stats'];
        $matches    = $this->_data['matches'];
        if (!$matches) {
            return false;
        }
        
        $condition = [
            'created_by' => $user_id,
            'uuid'       => $uuid,
            'match_id'   => $matches['id'],
        ];
        $self_matches = $this->_matchRepo->getListSync($condition);

        DB::beginTransaction();
        try {
            DB::table('stats')->whereIN('match_id', array_values($self_matches))->delete();
            foreach ($stats as $index => $stat) {
                if (in_array($stat['match_id'], array_keys($self_matches))) {
                    DB::table('stats')->insert([
                        'match_id'                       => @$self_matches[$stat['match_id']],
                        'member_id'                      => @$stat['member_id'] ? $stat['member_id'] : NULL,
                        'member_anonymous_id'            => !empty($stat['member_anonymous_id']) ? $stat['member_anonymous_id'] : NULL,
                        'sub_member_id'                  => @$stat['sub_member_id'] ? $stat['sub_member_id'] : NULL,
                        'order'                          => $index + 1,
                        'action_id'                      => !empty($stat['action_id']) ? $stat['action_id'] : NULL,
                        'sub_action_id'                  => !empty($stat['sub_action_id']) ? $stat['sub_action_id'] : NULL,
                        'coord_x'                        => !empty($stat['coord_x']) ? $stat['coord_x'] : NULL,
                        'coord_y'                        => !empty($stat['coord_y']) ? $stat['coord_y'] : NULL,
                        'result'                         => isset($stat['result']) ? $stat['result'] : NULL,
                        'created_at'                     => !empty($stat['created_at']) ? $stat['created_at'] : NULL,
                        'created_at_round'               => !empty($stat['created_at_round']) ? $stat['created_at_round'] : NULL,
                        'fouls_id'                       => !empty($stat['fouls_id']) ? $stat['fouls_id'] : NULL,
                        'fouls_judgment_type_id'         => !empty($stat['fouls_judgment_type_id']) ? $stat['fouls_judgment_type_id'] : NULL,
                        'fouls_reason_received_card_id'  => !empty($stat['fouls_reason_received_card_id']) ? $stat['fouls_reason_received_card_id'] : NULL,
                        'fouls_free_kick_id'             => !empty($stat['fouls_free_kick_id']) ? $stat['fouls_free_kick_id'] : NULL,
                        'ball_goal_coord_x'              => !empty($stat['ball_goal_coord_x']) ? $stat['ball_goal_coord_x'] : NULL,
                        'ball_goal_coord_y'              => !empty($stat['ball_goal_coord_y']) ? $stat['ball_goal_coord_y'] : NULL,
                        'ball_goal_number'               => !empty($stat['ball_goal_number']) ? $stat['ball_goal_number'] : NULL,
                        'action_kick_situation_id'       => !empty($stat['action_kick_situation_id']) ? $stat['action_kick_situation_id'] : NULL,
                        'action_kick_gk_id'              => !empty($stat['action_kick_gk_id']) ? $stat['action_kick_gk_id'] : NULL,
                        'action_kick_block_id'           => !empty($stat['action_kick_block_id']) ? $stat['action_kick_block_id'] : NULL,
                        'action_contribution_data'       => !empty($stat['action_contribution_data']) ? $stat['action_contribution_data'] : NULL,
                        'action_contribution_score'      => !empty($stat['action_contribution_score']) ? $stat['action_contribution_score'] : NULL,
                        'is_pa_home_area'                => isset($stat['is_pa_home_area']) ? $stat['is_pa_home_area'] : NULL,
                        'is_pa_guest_area'               => isset($stat['is_pa_guest_area']) ? $stat['is_pa_guest_area'] : NULL,
                        'is_wings_home_area'             => isset($stat['is_wings_home_area']) ? $stat['is_wings_home_area'] : NULL,
                        'is_wings_guest_area'            => isset($stat['is_wings_guest_area']) ? $stat['is_wings_guest_area'] : NULL,
                        'is_pitch_home_area'             => isset($stat['is_pitch_home_area']) ? $stat['is_pitch_home_area'] : NULL,
                        'is_pitch_guest_area'            => isset($stat['is_pitch_guest_area']) ? $stat['is_pitch_guest_area'] : NULL,
                        'guest_gk_member_id'             => @$stat['guest_gk_member_id'] ? $stat['guest_gk_member_id'] : NULL,
                        'is_edit'                        => !empty($stat['is_edit']) ? $stat['is_edit'] : NULL,
                        'ball_goal_type'                 => isset($stat['ball_goal_type']) ? $stat['ball_goal_type'] : NULL,
                        'ball_goal_action_goalkeeper_id' => !empty($stat['ball_goal_action_goalkeeper_id']) ? $stat['ball_goal_action_goalkeeper_id'] : NULL,
                        'ball_goal_pk_round'             => !empty($stat['ball_goal_pk_round']) ? $stat['ball_goal_pk_round'] : NULL,
                        'account_level'                  => !empty($stat['account_level']) ? $stat['account_level'] : NULL,
                        'home_gk_member_id'              => @$stat['home_gk_member_id'] ? $stat['home_gk_member_id'] : NULL,
                        'action_kick_member_id'          => !empty($stat['action_kick_member_id']) ? $stat['action_kick_member_id'] : NULL,
                        'timer_at'                 => !empty($stat['timer_at']) ? $stat['timer_at'] : NULL,
                        'timer_additional_at'      => !empty($stat['timer_additional_at']) ? $stat['timer_additional_at'] : NULL,
                        'sub_coord_x'              => !empty($stat['sub_coord_x']) ? $stat['sub_coord_x'] : NULL,
                        'sub_coord_y'              => !empty($stat['sub_coord_y']) ? $stat['sub_coord_y'] : NULL,
                        'shoot_area_key'           => !empty($stat['shoot_area_key']) ? $stat['shoot_area_key'] : NULL,
                        'pattern'                  => !empty($stat['pattern']) ? $stat['pattern'] : NULL,
                        'ball_goal_number_coord_x' => !empty($stat['ball_goal_number_coord_x']) ? $stat['ball_goal_number_coord_x'] : NULL,
                        'ball_goal_number_coord_y' => !empty($stat['ball_goal_number_coord_y']) ? $stat['ball_goal_number_coord_y'] : NULL,
                        'is_change_court' => isset($stat['is_change_court']) ? $stat['is_change_court'] : NULL,
                    ]);
                }
            }
            DB::commit();
        }catch (\Exception $e) {
            DB::rollBack();
            report($e);
        }
    }
}

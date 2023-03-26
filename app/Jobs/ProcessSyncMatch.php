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


class ProcessSyncMatch implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     */
    public $tries = 2;

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
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $match   = $this->_data;
        $user_id = auth('api')->user()->id;
        $uuid    = auth('api')->getPayload()->get('uuid');

        $condition = [
            'created_by' => $user_id,
            'uuid'       => $uuid,
        ];
        $self_matches = $this->_matchRepo->getListSync($condition);

        $match['created_by'] = $user_id;
        $match['match_id']   = $match['id'];
        $match['uuid']       = $uuid;
        $match['team1_score'] = $match['team1_score'] ? $match['team1_score'] : 0;
        $match['team2_score'] = $match['team2_score'] ? $match['team2_score'] : 0;
        if (@$self_matches[$match['id']]) {
            $match['id'] = $self_matches[$match['id']];
        }else{
            $match['id'] = NULL;
        }
        $columns = array_keys($match);

        DB::beginTransaction();
        try {
            DB::table('matches')->upsert($match, ['id'], $columns);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
        }
    }

}

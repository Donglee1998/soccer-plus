<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use DB;
use App\Repositories\TeamRepository;
use App\Models\Team;

class ProcessSyncTeam implements ShouldQueue
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
    private $_teamRepo;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data = [])
    {
        $this->_data = $data;
        $this->_teamRepo = new TeamRepository(new Team);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data    = collect($this->_data);
        $user_id   = auth('api')->user()->id;

        $condition = [
            'created_by' => $user_id
        ];
        $self_teams = $this->_teamRepo->getListSync($condition);

        $teams = [];
        foreach ($data as $key => $team) {
            $team['created_by'] = $user_id;
            if (isset($self_teams[$team['id']])) {
                if ($team['updated_at'] < date('Y-m-d H:i:s', strtotime($self_teams[$team['id']]))) {
                    continue;
                }
            }else{
                $team_exist =  $this->_teamRepo->find($team['id']);
                if ($team_exist) {
                    continue;
                }
            }
            $teams[] = $team;
        }


        DB::beginTransaction();
        try {
            if ($teams) {
                $columns = array_keys($data[0]);
                $data = DB::table('teams')->upsert($teams, ['id'], $columns);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
        }
    }
}

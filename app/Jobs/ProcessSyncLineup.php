<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use DB;
use App\Repositories\LineUpRepository;
use App\Models\Lineup;

class ProcessSynclineup implements ShouldQueue
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
    private $_lineupRepo;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data = [])
    {
        $this->_data = $data;
        $this->_lineupRepo = new LineUpRepository(new Lineup);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data    = collect($this->_data);
        $user_id = auth('api')->user()->id;
        $uuid    = auth('api')->getPayload()->get('uuid');
        $condition = [
            'created_by' => $user_id,
        ];
        $self_lineups = $this->_lineupRepo->getListSync($condition);

        $lineups = [];
        foreach ($data as $key => $lineup) {
            $lineup['created_by'] = $user_id;
            if (!isset($self_lineups[$lineup['id']])) {
                $lineup_exist = $this->_lineupRepo->find($lineup['id']);
                if ($lineup_exist) {
                    continue;
                }
            }
            $lineups[] = $lineup;;
        }
        DB::beginTransaction();
        try {
            if ($lineups) {
                $columns = array_keys($lineups[0]);
                $data = DB::table('lineups')->upsert($lineups, ['id'], $columns);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
        }
    }
}

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
use App\Repositories\MemberRepository;
use App\Models\Member;

class ProcessSyncMember implements ShouldQueue
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
    private $_memberRepo;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data = [])
    {
        $this->_data = $data;
        $this->_teamRepo = new TeamRepository(new Team);
        $this->_memberRepo = new MemberRepository(new Member);
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

        $condition = [
            'created_by' => $user_id,
        ];

        $team_ids = $this->_teamRepo->getListSync($condition);
        $self_members = $this->_memberRepo->getListSync($condition);

        $members = [];
        foreach ($data as $key => $member) {
            $member['created_by'] = $user_id;
            $member['position'] = !empty($member['position']) ? $member['position'] : 0;
            if (!isset($team_ids[$member['team_id']])) {
                continue;
            }
            if (isset($self_members[$member['id']])) {
                if ($member['updated_at'] < date('Y-m-d H:i:s', strtotime($self_members[$member['id']]))) {
                    continue;
                }
            }else{
                $member_exist =  $this->_memberRepo->find($member['id']);
                if ($member_exist) {
                    continue;
                }
            }
            $members[] = $member;
        }


        DB::beginTransaction();
        try {
            if ($members) {
                $columns = array_keys($data[0]);
                $data = DB::table('members')->upsert($members, ['id'], $columns);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
        }
    }

}

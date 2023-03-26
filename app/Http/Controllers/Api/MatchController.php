<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Stat;
use Illuminate\Support\Facades\Bus;
use App\Jobs\ProcessSyncStat;
use App\Jobs\ProcessSyncTeam;
use App\Jobs\ProcessSyncMember;
use App\Jobs\ProcessSyncMatch;
use App\Jobs\ProcessSyncLineup;
use App\Jobs\ProcessSyncTactic;
use App\Jobs\ProcessSyncSheet;
use App\Http\Requests\Api\SyncRequest;

class MatchController extends Controller
{

    /**
     * sync data matches
     *
     * @return \Illuminate\Http\Response
     */
    public function sync(SyncRequest $request)
    {
        try {
            if (!auth('api')->user()->has_sync_contract) {
                return $this->response(['success' => false, 'message' => config('constants.sync.no_contract_message')], 403);
            }

            $data = $request->all();
            if (!empty($data)) {
                foreach ($data as $match){
                    Bus::chain([
                        new ProcessSyncTeam($match['teams']),
                        new ProcessSyncMember($match['members']),
                        new ProcessSyncLineup($match['lineups']),
                        new ProcessSyncMatch($match['matches']),
                        new ProcessSyncStat($match),
                    ])->dispatch();
                }
            }
            return $this->response(['success' => true]);
        } catch (\Exception $e) {
            report($e);
            return $this->responseFailure($e);
        }
    }
}

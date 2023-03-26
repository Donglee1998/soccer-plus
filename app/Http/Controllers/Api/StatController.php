<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use App\Jobs\ProcessSyncStat;
use App\Jobs\ProcessSyncTeam;
use App\Jobs\ProcessSyncMember;
use App\Jobs\ProcessSyncMatch;
use App\Jobs\ProcessSyncLineup;
use App\Http\Requests\Api\SyncStatRequest;

class StatController extends Controller
{

    /**
     * sync data of a match
     *
     * @return \Illuminate\Http\Response
     */
    public function sync(SyncStatRequest $request)
    {
        try {
            if (!auth('api')->user()->has_sync_contract) {
                return $this->response(['success' => false, 'message' => config('constants.sync.no_contract_message')], 403);
            }

            $data = $request->all();
            if (!empty($data)) {
                Bus::chain([
                    new ProcessSyncTeam($data['teams']),
                    new ProcessSyncMember($data['members']),
                    new ProcessSyncLineup($data['lineups']),
                    new ProcessSyncMatch($data['matches']),
                    new ProcessSyncStat($data),
                ])->dispatch();
            }
            return $this->response(['success' => true]);
        } catch (\Exception $e) {
            report($e);
            return $this->responseFailure($e);
        }
    }
}

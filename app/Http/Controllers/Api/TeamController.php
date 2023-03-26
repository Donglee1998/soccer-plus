<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\TeamRequest;
use Illuminate\Http\Request;
use App\Repositories\TeamRepository;
use App\Repositories\RegistrationRepository;
use App\Http\Resources\Team\TeamIsHomeResource;
use DB;

class TeamController extends Controller
{

    protected $__teamRepo;
    protected $__registrationRepo;

    public function __construct(TeamRepository $teamRepository, RegistrationRepository $registrationRepository)
    {
        $this->__teamRepo = $teamRepository;
        $this->__registrationRepo = $registrationRepository;
    }

    /**
     * sync data all teams
     *
     * @return \Illuminate\Http\Response
     */
    public function sync(TeamRequest $request)
    {
        $data      = $request->teams;
        $user = auth('api')->user();
        if (!$user->has_sync_contract) {
            return $this->response(['success' => false, 'message' => config('constants.sync.no_contract_message')], 403);
        }

        $condition = [
            'created_by' => $user->id
        ];
        $self_teams = $this->__teamRepo->getListSync($condition);
        $teams = [];
        foreach ($data as $key => $team) {
            $team['created_by'] = $user->id;
            if (isset($self_teams[$team['id']])) {
                if ($team['updated_at'] < date('Y-m-d H:i:s', strtotime($self_teams[$team['id']]))) {
                    continue;
                }
            }else{
                $team_exist =  $this->__teamRepo->find($team['id']);
                if ($team_exist) {
                    continue;
                }
            }
            $teams[] = $team;
        }

        
        DB::beginTransaction();
        try {
            if ($teams) {
                $columns = array_keys($teams[0]);
                DB::table('teams')->upsert($teams, ['id'], $columns);
            }
            DB::commit();

            $all_teams = $this->__teamRepo->getAllTeam($condition);
            return $this->response(['success' => true, 'data' => $all_teams]);
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
        }
    }

    /**
     * get data team is_home
     *
     * @return \Illuminate\Http\Response
     */
    public function getTeamIsHome(Request $request)
    {
        try {
            $user = auth('api')->user();
            $team = $this->__teamRepo->getTeamIsHome($user->id);
            $data = new TeamIsHomeResource($team);

            return $this->response($data);
        } catch (\Exception $e) {
            report($e);
            return $this->responseFailure($e);
        }
    }
}

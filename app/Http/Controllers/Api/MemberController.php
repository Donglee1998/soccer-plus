<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\MemberRequest;
use Illuminate\Http\Request;
use DB;
use Illuminate\Http\JsonResponse;
use App\Repositories\MemberRepository;
use App\Repositories\TeamRepository;
use App\Repositories\LineUpRepository;
use App\Http\Resources\LineUp\LineUpListResource;
use App\Http\Resources\Member\MemberListResource;

class MemberController extends Controller
{

    protected $__memberRepo;
    protected $__teamRepo;
    protected $__lineupRepo;

    public function __construct(MemberRepository $memberRepository, TeamRepository $teamRepository, LineupRepository $lineupRepository)
    {
        $this->__memberRepo = $memberRepository;
        $this->__teamRepo   = $teamRepository;
        $this->__lineupRepo = $lineupRepository;
    }

    /**
     * sync data all members
     *
     * @return \Illuminate\Http\Response
     */
    public function sync(MemberRequest $request)
    {
        if (!auth('api')->user()->has_sync_contract) {
            return $this->response(['success' => false, 'message' => config('constants.sync.no_contract_message')], 403);
        }

        $user_id = auth('api')->user()->id;

        $condition = [
            'created_by' => $user_id,
            'id_team'    => $request->team_id
        ];
        $team = $this->__teamRepo->findTeam($condition);
        if (!$team) {
            return $this->response(['success' => false, 'message' => '該当チームを先にサーバーへ送信してください。']);
        }

        $members = $this->__getMembers($request, $user_id);
        $lineups = $this->__getLineups($request, $user_id);
        DB::beginTransaction();
        try {
            if ($members) {
                $columns = array_keys($members[0]);
                $data = DB::table('members')->upsert($members, ['id'], $columns);
            }
            if ($lineups) {
                $columns = array_keys($lineups[0]);
                $data = DB::table('lineups')->upsert($lineups, ['id'], $columns);
            }
            DB::commit();

            $condition = [
                'created_by' => $user_id,
                'team_id'    => $team->id
            ];
            $all_members = $this->__memberRepo->getAllMember($condition);
            $all_lineups = $this->__lineupRepo->getAllLineup($condition);
            $all_members = new MemberListResource($all_members);
            $all_lineups = new LineUpListResource($all_lineups);
            $data = [
                'members' => $all_members,
                'lineups' => $all_lineups,
            ];
            return $this->response(['success' => true, 'data' => $data]);
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
        }
    }

    /**
     * get data members sync
     *
     * @return Array
     */
    protected function __getMembers($request, $user_id) {
        $data_members = $request->members;
        $condition = [
            'created_by' => $user_id
        ];
        $self_members = $this->__memberRepo->getListSync($condition);

        $members = [];
        foreach ($data_members as $key => $member) {
            $member['created_by'] = $user_id;
            $member['position'] = !empty($member['position']) ? $member['position'] : 0;
            if (isset($self_members[$member['id']])) {
                if ($member['updated_at'] < date('Y-m-d H:i:s', strtotime($self_members[$member['id']]))) {
                    continue;
                }
            }else{
                $member_exist =  $this->__memberRepo->find($member['id']);
                if ($member_exist) {
                    continue;
                }
            }
            $members[] = $member;
        }
        return $members;
    }

    /**
     * get data lineups sync
     *
     * @return Array
     */
    protected function __getLineups($request, $user_id) {
        $data_lineups = $request->lineups;
        $condition = [
            'created_by' => $user_id,
            'team_id'    => $request->team_id,
        ];
        $self_lineups = $this->__lineupRepo->getListSync($condition);
        $lineups = [];
        foreach ($data_lineups as $key => $lineup) {
            $lineup['created_by'] = $user_id;
            $lineup['team_id'] = $request->team_id;
            if (!isset($self_lineups[$lineup['id']])) {
                $lineup_exist = $this->__lineupRepo->find($lineup['id']);
                if ($lineup_exist) {
                    continue;
                }
            }
            $lineups[] = $lineup;
        }
        return $lineups;
    }
}

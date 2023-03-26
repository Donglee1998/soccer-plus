<?php

namespace App\Http\Controllers\Web;

use App\Repositories\TeamRepository;
use App\Repositories\MemberRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\Web\TeamRequest;
use App\Models\Member;
use App\Models\Lineup;

class TeamController extends BaseController
{
    protected $__teamRepo;
    protected $__memberRepo;
    private $view = 'web.team.';

    public function __construct(TeamRepository $teamRepo, MemberRepository $memberRepo)
    {
        $this->__teamRepo   = $teamRepo;
        $this->__memberRepo = $memberRepo;
    }

    public function index()
    {
        $user = Auth::guard('web')->user();
        $conditions['created_by'] = $user->id;
        $columns = ['id', 'color_home', 'name', 'created_by', 'is_home'];
        $teams = $this->__teamRepo->getList($conditions, $columns);

        return view($this->view . 'list', compact('teams'));
    }

    public function show($id)
    {
        $user = Auth::guard('web')->user();
        $conditions['created_by'] = $user->id;
        $conditions['id_team']    = $id;
        $columns = ['color_home', 'name', 'color_guest', 'abbreviation', 'gender', 'hometown', 'supervisor', 'coach', 'manager', 'trainer', 'explanation'];
        $team = $this->__teamRepo->findTeam($conditions, $columns);

        if (empty($team)) {
            abort(404);
        }

        return view($this->view . 'detail', compact('team'));
    }

    public function memberOfTeam($id)
    {
        $user = Auth::guard('web')->user();
        $conditions['team_id'] = $id;
        $conditions['created_by'] = $user->id;
        $columns = ['id', 'team_id' ,'number_official', 'position', 'last_name', 'first_name'];
        $list_member = $this->__memberRepo->memberOfTeam($conditions, $columns);

        return view($this->view . 'member_team', compact('list_member'));
    }
}

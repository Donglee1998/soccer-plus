<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\MemberRepository;
use App\Repositories\TeamRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Imports\MembersImport;
use Excel;
use App\Http\Requests\Admin\MemberRequest;

class MemberController extends Controller
{
    protected $__memberRepo;
    protected $__teamRepo;

    public function __construct(MemberRepository $memberRepo, TeamRepository $teamRepo)
    {
        $this->__memberRepo = $memberRepo;
        $this->__teamRepo = $teamRepo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id = null)
    {
        $team = $this->__teamRepo->find($id);
        if (!$team || @$team->is_home != 1) {
            return redirect()->route('admin.registration.index');
        }
        $registration = $team->registration;
        $condition = [
            'team_id' => $team->id,
        ];
        $data = $this->__memberRepo->getList($condition);
        return view('admin.member.index', compact('data', 'team', 'registration'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $team_id = null, $member_id = null)
    {
        $data = [
            'team_id' => $team_id
        ];

        $team = $this->__teamRepo->find($team_id);
        if (!$team || @$team->is_home != 1) {
            return redirect()->route('admin.registration.index');
        }

        if ($member_id) {
            $data = $this->__memberRepo->find($member_id);
            if (!$data) {
                return redirect()->route('admin.registration.index');
            }
        }

        return view('admin.member.edit', compact('data'));

    }

    /**
     * Confirm the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editConfirm(MemberRequest $request, $team_id = null, $member_id = null)
    {
        $data = $request->get('data');
        $data['team_id'] = $team_id;
        $data['member_id'] = $member_id;

        return view('admin.member.confirm', compact('data'));
    }

    /**
     * Create or Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editStore(MemberRequest $request, $team_id = null, $member_id = null)
    {
        if ($request->has('data')) {
            $data = $request->get('data');
            if ($request->submit === 'back') {
                return redirect()->route('admin.member.edit', ['team_id' => $team_id, 'member_id' => $member_id])->withInput();
            } elseif ($request->submit === 'done') {
                DB::beginTransaction();
                try {
                    if ($member_id) {
                        $this->__memberRepo->update($data, $member_id);
                    }else{
                        $team = $this->__teamRepo->find($team_id);
                        $data['team_id'] = $team->id;
                        $data['created_by'] = $team->created_by;
                        $data['id'] = uniqid();
                        $this->__memberRepo->create($data);
                    }
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    report($e);
                }
            }
        }

        return redirect()->route('admin.team.member', ['id' => $team_id]);
    }

    /**
     * Trash the mass resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function massTrash(Request $request)
    {
        try {
            $this->__memberRepo->massTrash($request->ids);

            return $this->jsonData(['success' => true]);
        } catch (\Exception $e) {
            report($e);
            return $this->jsonError($e);
        }
    }

    /**
     * Import csv member
     *
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        try {
            $team_id = $request->team_id;
            $team = $this->__teamRepo->find($team_id);
            $created_by = $team->created_by;

            $enc = get_input_encoding($request->file('file'));
            Excel::import(new MembersImport($team_id, $created_by, $enc), $request->file('file'));
            return response()->json(['success' => true]);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            report($e);
        }
    }
}

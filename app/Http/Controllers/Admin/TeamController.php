<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\TeamRequest;
use App\Repositories\TeamRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    protected $__teamRepo;

    public function __construct(TeamRepository $teamRepo)
    {
        $this->__teamRepo = $teamRepo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id = null)
    {
        $data = [];
        $data['id']      = $id;
        $data = $this->__teamRepo->find($id);
        if (!$data || @$data->is_home != 1) {
            return redirect()->route('admin.registration.index');
        }

        return view('admin.team.edit', compact('data'));
    }

    /**
     * Confirm the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editConfirm(TeamRequest $request, $id = null)
    {
        $data = $request->get('data');
        $data['id'] = $id;

        return view('admin.team.confirm', compact('data'));
    }

    /**
     * Create or Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editStore(TeamRequest $request, $id = null)
    {
        if ($request->has('data')) {
            $data = $request->get('data');
            if ($request->submit === 'back') {
                return redirect()->route('admin.team.edit', ['id' => $id])->withInput();
            } elseif ($request->submit === 'done') {
                DB::beginTransaction();
                try {
                    $this->__teamRepo->update($data, $id);
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    report($e);
                }
            }
        }

        return redirect()->route('admin.registration.index');
    }
}

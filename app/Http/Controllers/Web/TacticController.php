<?php

namespace App\Http\Controllers\Web;

use App\Repositories\TacticRepository;
use App\Repositories\SheetRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class TacticController extends BaseController
{
    protected $__tacticRepo;
    protected $__sheetRepo;
    private $view = 'web.tactic.';

    public function __construct(TacticRepository $tacticRepo, SheetRepository $sheetRepo)
    {
        $this->__tacticRepo = $tacticRepo;
        $this->__sheetRepo  = $sheetRepo;
    }

    public function index()
    {
        $user                       = Auth::guard('web')->user();
        $conditions['created_by']   = $user->id;
        $data = $this->__tacticRepo->getList($conditions);

        return view($this->view . 'index', compact('data'));
    }

    public function show($tactic)
    {
        $user = Auth::guard('web')->user();
        $conditions['created_by'] = $user->id;
        $conditions['id_tactic']  = $tactic;
        $tactic = $this->__tacticRepo->getTacticDetail($conditions);

        if(empty($tactic)) {
            return abort(404);
        }

        return view($this->view . 'detail', compact('tactic'));
    }

    public function destroy(Request $request)
    {
        $user = Auth::guard('web')->user();

        $ischeck = checkPasswordAdmin($user, $request->password_admin);

        return $ischeck->status() === 200 ? $this->_detroyTactic($user, $request->id_tactic) : $ischeck;
    }

    private function _detroyTactic($user, $id_tactic = [])
    {
        try {
            $condition = [
                'created_by' => $user->id ?? '',
            ];
            if (!empty($id_tactic)) {
                $condition['array_id_tactic'] = array_map('intval', explode(",", $id_tactic));
            }

            $this->__sheetRepo->deleteSheetFollowTactic($condition);
            $this->__tacticRepo->deleteTactic($condition);

            return response()->json([
                'message'   => 'Removed Tactic Success.',
                'status'    => true
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {

            return response()->json([
                'message'   => $e->getMessage(),
                'status'    => false
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

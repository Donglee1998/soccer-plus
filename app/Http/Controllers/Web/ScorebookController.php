<?php

namespace App\Http\Controllers\Web;

use App\Repositories\MatchRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ScorebookController extends BaseController
{
    protected $__matchRepo;
    private $view = 'web.scorebook.';

    public function __construct(MatchRepository $matchRepo)
    {
        $this->__matchRepo = $matchRepo;
    }

    public function index(Request $request)
    {
        $user       = Auth::guard('web')->user();
        $conditions = [
            'created_by'        => $user->id,
            'keyword'           => $request->keyword ?? '',
            'type_match'        => intval($request->type_match) ?? '',
            'start_date_match'  => reFormatDate($request->start_date_match) ?? '',
            'end_date_match'    => reFormatDate($request->end_date_match) ?? '',
        ];
        $columns    = ['id', 'type', 'start_date', 'team_id1', 'team_id2', 'team1_score', 'team2_score', 'created_by'];
        $matchs     = $this->__matchRepo->getList($conditions, $columns);

        if ($request->ajax()) {

            return view($this->view . 'data-list', compact('matchs'))->render();
        }

        return view($this->view . 'list', compact('matchs'));
    }

    public function destroy(Request $request) 
    {
        $user = Auth::guard('web')->user();

        $ischeck = checkPasswordAdmin($user, $request->password_admin);

        return $ischeck->status() === 200 ? $this->_detroyMatch($user, $request->value_match) : $ischeck;
    }

    private function _detroyMatch($user, $value_match)
    {
        try {
            $condition = [
                'created_by'    => $user->id ?? '',
            ];
            if (!empty($value_match)) {
                $condition['array_id_match'] = array_map('intval', explode(",", $value_match));
            }

            $this->__matchRepo->deleteMatch($condition);
    
            return response()->json([
                'message'   => 'Removed Match Success.',
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

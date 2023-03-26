<?php

namespace App\Http\Controllers\Web;

use App\Repositories\MemberRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MemberController extends BaseController
{
    protected $__memberRepo;
    private $view = 'web.member.';

    public function __construct(MemberRepository $memberRepo)
    {
        $this->__memberRepo = $memberRepo;
    }

    public function show(Request $request)
    {
        $user = Auth::guard('web')->user();
        $conditions = [
            'created_by'    => $user->id,
            'team_id'       => $request->team,
            'member_id'     => $request->member
        ];

        $member = $this->__memberRepo->getDetail($conditions);

        if (empty($member)) {
            abort(404);
        }

        return view($this->view . 'detail', compact('member'));
    }
}

<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Requests\Web\CommentRequest;
use Illuminate\Support\Facades\DB;
use App\Repositories\MatchRepository;
use App\Repositories\CommentRepository;

class ScorebookMatchesCommentController extends BaseController
{
    protected $__commentRepo;
    protected $__matchRepo;

    public function __construct(MatchRepository $matchRepository, CommentRepository $commentRepo)
    {
        $this->__matchRepo   = $matchRepository;
        $this->__commentRepo = $commentRepo;
    }

    /**
     * Display form comment
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $user = auth()->guard('web')->user();
        $match = $this->__matchRepo->getDetail($request->matches_id);
        if (!$match) {
            return abort(404);
        }

        $condition = [
            'match_id'   => $match->id,
            'created_by' => $user->id,
        ];
        $data = $this->__commentRepo->getDetail($condition);

        return view('web.scorebook.matches_comment', compact('data'));
    }

    /**
     * Save form comment
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request) 
    {
    	$user = auth()->guard('web')->user();
    	$data = $request->only('name', 'title', 'content');
    	$condition = [
            'match_id'   => $request->matches_id,
            'created_by' => $user->id,
        ];
        $comment = $this->__commentRepo->getDetail($condition);

        DB::beginTransaction();
        try {
	    	if ($comment) {
	    		$comment->update($data);
	    	}else{
	    		$data = array_merge($data, $condition);
	        	$this->__commentRepo->create($data);
	    	}
	    	DB::commit();
	        return redirect()->route('web.scorebook.list');
	    } catch (\Exception $e) {
            DB::rollBack();
            report($e);
        }
    }
}

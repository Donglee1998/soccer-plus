<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\NewsRequest;
use App\Repositories\NewsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    protected $__newsRepo;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->__newsRepo = $newsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $condition = [
            'search' => $request->search,
        ];
        if ($request->route()->getName() == 'admin.news.index') {
            $condition['category'] = config('constants.news_category.key.news');
        }else{
            $condition['category'] = config('constants.news_category.key.manual');
        }
        $data = $this->__newsRepo->querylist($condition);

        return view('admin.news.index', compact('data'));
    }

    /**
     * Preview the specified resource in storage
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function preview(Request $request)
    {
        $news        = $request->get('data');
        $uniqid      = \Str::random(9);
        $data_encode  = json_encode($news);
        $news_session = app_session($uniqid);
        $news_session->set($data_encode);

        $args = [
            'uniqid'   => $uniqid,
            'category' => $news['category'],
        ];

        return response()->json($args);
    }

    /**
     * Temporarily save data and skip validation
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveDraft(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->get('data');
            $data['is_draft'] = 1;

            $this->__newsRepo->create($data);
            DB::commit();
            return redirect()->route('admin.news.index');
        } catch (\Exception $e) {
            report($e);
            DB::rollBack();
        }
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
        if ($request->route()->getName() == 'admin.news.edit') {
            $data['category'] = config('constants.news_category.key.news');
        }else{
            $data['category'] = config('constants.news_category.key.manual');
        }
        if ($id) {
            $condition = [
                'id'       => $id,
                'category' => $data['category'],
            ];
            $data = $this->__newsRepo->adminGetDetail($condition);

            if (!$data) {
                return redirect()->route('admin.news.index');
            }
        }
        return view('admin.news.edit', compact('data'));
    }

    /**
     * Confirm the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editConfirm(NewsRequest $request, $id = null)
    {
        $data = $request->get('data');

        return view('admin.news.confirm', compact('data'));
    }

    /**
     * Create or Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editStore(NewsRequest $request, $id = null)
    {
        if ($request->has('data')) {
            $data = $request->get('data');
            $route = 'news';
            if ($data['category'] == config('constants.news_category.key.manual')) {
                $route = 'manual';
            }
            if ($request->submit === 'back') {
                return redirect()->route('admin.'. $route .'.edit', ['id' => $id])->withInput();
            } elseif ($request->submit === 'done') {
                DB::beginTransaction();
                try {
                    if ($id) {
                        $data['is_draft'] = 0;
                        $news = $this->__newsRepo->update($data, $id);
                    } else {
                        $data['order'] = $this->__newsRepo->getOrder();
                        $news = $this->__newsRepo->create($data);
                    }
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    report($e);
                }
            }
        }
        return redirect()->route('admin.'. $route .'.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        try {
            $news = $this->__newsRepo->find($id);

            if ($news) {
                $this->__newsRepo->delete($id);

                return $this->jsonData(['redirect_url' => route('admin.news.index')]);
            }
        } catch (\Exception $e) {
            report($e);
            return $this->jsonError($e);
        }
    }

    /**
     * Update status the mass resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function massUpdateStatus(Request $request)
    {
        try {
            $this->__newsRepo->toggleStatusList($request->ids, $request->state);

            return $this->jsonData(['success' => true]);
        } catch (\Exception $e) {
            report($e);
            return $this->jsonError($e);
        }
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
            $this->__newsRepo->massTrash($request->ids);

            return $this->jsonData(['success' => true]);
        } catch (\Exception $e) {
            report($e);
            return $this->jsonError($e);
        }
    }

    /**
     * Update order resource
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateSort(Request $request)
    {
        foreach ($request->positions as $position) {
            $this->__newsRepo->update(['order' => $position[1]], $position[0]);
        }
        return response()->json('success');
    }
}

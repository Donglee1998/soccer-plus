<?php

namespace App\Http\Controllers\Web;

use App\Repositories\NewsRepository;
use Illuminate\Http\Request;

class NewsController extends BaseController
{
    protected $__newsRepo;

    public function __construct(NewsRepository $newsRepo)
    {
        $this->__newsRepo = $newsRepo;
    }

    /**
     * Preview news top
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Int  $id
     * @return \Illuminate\Http\Response
     */
    public function preview($uniqid = null)
    {
        $news_session = app_session($uniqid);
        $news_saved  = $news_session->get($uniqid);
        if ($news_saved) {
            $news = (object) $news_saved;
            return view('web.news.show_top', compact('news'));
        }

        return redirect()->route('web.top');
    }

    /**
     * List notifications
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Int  $$id
     * @return \Illuminate\Http\Response
     */

    public function listManual(Request $request)
    {
        $manuals = $this->__newsRepo->getListManual();

        return view('web.news.manual_list', compact('manuals'));
    }

    /**
     * List notifications
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Int  $$id
     * @return \Illuminate\Http\Response
     */

    public function listNews(Request $request)
    {
        $news = $this->__newsRepo->getListNews();

        return view('web.news.notification_list', compact('news'));
    }

     /**
     * Show notifications
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Int  $$id
     * @return \Illuminate\Http\Response
     */
    public function detailNews($category, $id) {
        $condition = [
            'id'           => $id,
            'category'     => config('constants.news_category.key.news'),
            'sub_category' => config('constants.news_sub_category.key.'.$category),
        ];
        $news = $this->__newsRepo->getDetailNews($condition);

        if (!$news) {
            return abort(404);
        }

        return view('web.news.notification_detail', compact('news'));
    }

    /**
     * Show notifications
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Int  $$id
     * @return \Illuminate\Http\Response
     */
    public function detailManual(Request $request, $id)
    {
        $condition = [
            'id'       => $id,
            'category' => config('constants.news_category.key.manual')
        ];
        $manual = $this->__newsRepo->getDetailNews($condition);

        if (!$manual) {
            return abort(404);
        }
        return view('web.news.manual_detail', compact('manual'));
    }
}

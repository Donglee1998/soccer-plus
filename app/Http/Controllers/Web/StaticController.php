<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

class StaticController extends BaseController
{
    public function top()
    {
        return view('web.top.index');
    }

    public function faq()
    {
        return view('web.faq.index');
    }

    public function privacy()
    {
        return view('web.privacy');
    }

    public function company()
    {
        return view('web.company');
    }

    public function tos()
    {
        return view('web.tos');
    }
}

@extends('web.layouts.default', ['title' => $news->title], ['pageName' => 'pageNews'])
@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="お知らせ">
        <h1 class="keyvTitle">お知らせ</h1>
    </div>
    <div class="content">
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a><span>/</span></li>
                <li><em><a href="{{ route('web.news.list') }}">お知らせ</a><span>/</span></li>
                <li>{{ $news->title }}</li>
            </ul>
            @if ($news)
                <article class="post">
                    <div class='headline4'>
                        <div class="postTime">
                            <time>{{ format_date($news->public_date, 'Y年m月d日') }}</time>
                            <a href="#">{{ config('constants.news_sub_category.label.'. $news->sub_category) }}</a>
                        </div>
                        <h2>{{ $news->title }}</h2>
                    </div>

                    <div class="postContent ck-content txtCm01">
                        {!! $news->editor !!}
                    </div>
                </article>
            @endif
            <div class="textCenter">
                <a href="{{ url()->previous() }}" class="btnStrategy">
                    お知らせ一覧に戻る
                    <span class="positionLeft">
                        <img src="/assets/img/svg/ic_circle_left.svg" alt="">
                    </span>
                </a>
            </div>
        </div>
    </div>
@endsection
@push('css')
<link rel="stylesheet" href="{{ get_file_version('/assets/admin/ckeditor/ckeditor.css') }}">
@endpush

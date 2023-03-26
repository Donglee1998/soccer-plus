@php
if($news->category == config('constants.news_category.key.news')){
    $title = 'お知らせ';
}else{
    $title = 'マニュアル';
}
@endphp
@extends('web.layouts.default', ['title' => $news->title ?? ''], ['pageName' => 'pageNews'])
@section('content')
<div class="keyv">
    <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="{{ $title }}">
    <h1 class="keyvTitle">{{ $title }}</h1>
</div>
<div class="content">
    <div class="inner01">
        <ul class="breadscrumb">
            <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a><span>/</span></li>
            <li><em>{{ $title }}</em></li>
        </ul>
        @if($news->category == config('constants.news_category.key.news'))
        <article class="post">
            @if ($news->public_date || isset($news->sub_category))
                <div class='headline4'>
                    <div class="postTime">
                        @if ($news->public_date)
                            <time>{{ format_date($news->public_date, 'Y年m月d日') }}</time>
                        @endif
                        @if (isset($news->category))
                            <a href="#">{{ config('constants.news_sub_category.label.'. $news->sub_category) }}</a>
                        @endif
                    </div>
                    <h2>{{ $news->title }}</h2>
                </div>
            @endif
            <div class="postContent ck-content">
                <div class="postContentRow">
                    <div class="txtCm01">{!! $news->editor_convert !!}</div>
                </div>
            </div>
        </article>
        @else
        <div class="procedureBlock">
            <p class="procedureTxt01">SOCCER PLUS 操作説明マニュアル</p>
            <h2 class="headline12">{{ $news->title }}</h2>
            <p class="procedureTxt02">{!! nl2br(e($news->overview)) !!}</p>
        </div>
        <div class="ck-content">
            {!! $news->editor_convert !!}
        </div>
        @endif
        @if($news->category == config('constants.news_category.key.news'))
        <div class="textCenter">
            <a href="#" class="btnStrategy">
                お知らせ一覧に戻る
                <span class="positionLeft">
                    <img src="/assets/img/svg/ic_circle_left.svg" alt="">
                </span>
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
@push('css')
<link rel="stylesheet" href="{{ get_file_version('/assets/admin/ckeditor/ckeditor.css') }}">
@endpush

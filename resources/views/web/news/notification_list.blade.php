@php
$category = array_flip(config('constants.news_sub_category.key'));
@endphp
@extends('web.layouts.default', ['title' => 'お知らせ'], ['pageName' => 'pageNews'])
@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="お知らせ">
        <h1 class="keyvTitle">お知らせ</h1>
    </div>
    <div class="content">
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a><span>/</span></li>
                <li><em>お知らせ</em></li>
            </ul>

            <section>
                <h2 class="headline4">お知らせ一覧</h2>
                @if (count($news))
                    <ul class="newsList">
                        @foreach ($news as $new)
                            <li class="newsItem">
                                <div class="postTime gap30">
                                    <time>{{ format_date($new->public_date, 'Y年m月d日') }}</time>
                                    <a>{{ config('constants.news_sub_category.label.'. $new->sub_category) }}</a>
                                </div>
                                <a class="newsTitle"
                                    href="{{ route('web.news.detail', ['category' => @$category[$new->sub_category], 'id' => $new->id]) }}">{{ $new->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                    {!! $news->appends(request()->all())->links('web.commons.pagination') !!}
                @else
                    <p class="alert">データがありません。</p>
                @endif
            </section>
        </div>
    </div>
@endsection


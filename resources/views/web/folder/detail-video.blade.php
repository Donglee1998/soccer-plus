@extends('web.layouts.default', ['title' => '動画詳細'], ['pageName' => 'videoList'])
@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="プレミアチームのご案内">
        <h1 class="keyvTitle">動画詳細</h1>
    </div>
    <div class="content pbSp30">
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt="home"></a><span>/</span></li>
                <li><a href="{{ route('web.team.album') }}"><em>動画一覧</em></a><span>/</span></li>
                <li><a href="{{ route('web.list.video.folder', ['folder_id' => $video->folder_id]) }}"><em>{{ $video->folder->name }}</em></a><span>/</span></li>
                <li><em class="nameVideo">{{ $video->title }}</em></li>
            </ul>
            <h2 class="headline4 style01">
                <span class="txt nameVideo">{{ $video->title }}</span>
                <a href="#modalEdit" class="btnEdit jsModal">
                    <svg class="icon">
                        <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_pen" />
                    </svg>
                </a>
            </h2>
            <div class="blockVideo center">
                <div class="video">
                    <video controls="" id="myvideo">
                        <source src="{{ $video->url_video }}" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
        <x-web.web-model-edit classTh="jsOkModalEditVideo" title="動画名の編集">
            <input name="video_id" value="{{ $video->id ?? '' }}" hidden>
            <input name="video_name" value="{{ $video->title ?? '' }}">
        </x-web.web-model-edit>
    </div>
@endsection

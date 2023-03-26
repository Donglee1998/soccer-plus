@extends('web.layouts.default', ['title' => 'Play by Play Video'], ['pageName' => 'playByPlay'])
@section('content')
<div class="keyv">
    <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="プレミアチームのご案内">
    <h1 class="keyvTitle"><span>ゲーム記録</span>Play by Play Video</h1>
</div>
<div class="content pagePlayVideo"
    id="matches_id" data-id="{{$matches->id}}" data-team_id1="{{$matches->team_id1}}"
    data-team_id2="{{$matches->team_id2}}" data-round_current="_1ST">
    <div class="inner01">
        <ul class="breadscrumb">
            <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a><span>/</span></li>
            <li><a href="/scorebook">ゲーム記録</a><span>/</span></li>
            <li><em>Play by Play Video</em></li>
        </ul>
        <div class="dateInfo">
            <p class="tag">{{ config('constants.match_type.label.'.$matches->type) }}</p>
            <p class="date">{{ $matches->start_date->format('Y年m月d日') }}</p>
        </div>
        @include('web.scorebook.includes.team-info')
        @include('web.scorebook.includes.score-info')
        <nav class="analysisNav">
            <a href="{{ route('web.scorebook.matches.report', ['matches_id' => $matches->id]) }}">
                <svg class="icon icon01">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_report" />
                </svg>
                <span>試合レポート</span>
            </a>
            <a href="{{ route('web.scorebook.matches.stat', ['matches_id' => $matches->id]) }}">
                <svg class="icon icon02">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_ball" />
                </svg>
                <span>スタッツ</span>
            </a>
            <a href="{{ route('web.scorebook.matches.chart', ['matches_id' => $matches->id]) }}">
                <svg class="icon icon03">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_chart" />
                </svg>
                <span>比較表</span>
            </a>
            <a href="javascript:void(0)" class="active">
                <svg class="icon icon04">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_ytb" />
                </svg>
                <span>Play by Play Video</span>
            </a>
        </nav>
        <div class="timeTab tabArea">
            <nav class="timeTabInfo tab">
                @if($statKeys)
                @foreach ($statKeys as $key)
                <a href="#tab_{{ Str::replace('_','',$key) }}" {!! $loop->first ? 'class="active"' : '' !!} data-round="{{$key}}">
                    <svg class="icon">
                        <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_arrow_down" />
                    </svg>
                    <span>{{ Str::replace('_','',$key) }}</span>
                </a>
                @endforeach
                @endif
            </nav>
            <div class="timeTabContent tabContents">
                @csrf
                @foreach ($statsArgs as $key => $stats)
                    @include('web.scorebook.includes.video-player')
                @endforeach
            </div>
        </div>

        <div class="modal" id="myModal" role="dialog">
            <div class="modal__wrapper">
                <span class="jsCloseModal btnClose">
                    <svg class="icon">
                        <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_close" />
                    </svg>
                </span>
                <div class="modal__content">
                    <div class="blockUpload mb30">
                        <ul class="blockUpload__name">
                            <li>
                                <span class="ttl">フォルダ名</span>

                                <input type="text" placeholder="フォルダ名を入力して下さい">
                            </li>
                        </ul>
                        <span class="btnUpload jsCreateFolder">
                            <em class="add">フォルダを追加</em>
                        </span>
                    </div>
                    <p class="error">※input not null</p>
                    <div class="blockSearch">
                        <input type="text" class="searchTerm jsSeachFolder" placeholder="キーワードで検索">
                        <button type="submit" class="searchBtn">
                            <img src="/assets/img/svg/icon_search.svg" alt="search">
                       </button>
                    </div>
                    <table class="tblList handledCheckCtrl mb0">
                        <thead>
                            <tr>
                                <th>フォルダ名を選択してください</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal" id="myModal1" role="dialog">
            <div class="modal__wrapper">
                <span class="jsCloseModal btnClose">
                    <svg class="icon">
                        <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_close" />
                    </svg>
                </span>
                <div class="modal__content">
                    <div class="blockSearch">
                        <input type="text" class="searchTerm jsSeachFolder" placeholder="キーワードで検索">
                        <button type="submit" class="searchBtn">
                            <img src="/assets/img/svg/icon_search.svg" alt="search">
                       </button>
                    </div>
                    <table class="tblList handledCheckCtrl mb0">
                        <thead>
                            <tr>
                                <th>フォルダ名を選択してください</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal" id="myModal2" role="dialog">
            <div class="modal__wrapper">
                <span class="jsCloseModal btnClose">
                    <svg class="icon">
                        <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_close" />
                    </svg>
                </span>
                <div class="modal__content">
                    <p href="javascript:void(0)" id="backToFolderSelector" class="jsBackToFolderSelector" style="cursor: pointer; margin-bottom: 5px;">
                        ← 戻る
                    </p>
                    <table class="tblList handledCheckCtrl mb0">
                        <thead>
                            <tr>
                                <th class="wid110 center">サムネイル</th>
                                <th>動画タイトル</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal" id="myModal3" role="dialog">
            <div class="modal__wrapper">
                        <span class="jsCloseModal btnClose" id="playTimeModalCloseBtn">
                        <svg class="icon">
                            <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_close" />
                        </svg>
                    </span>
                    <div class="modal__content">
                        <p class="headline6 mb30 center">
                            再生時間の一括変更
                        </p>
                        <div class="blockUpload mb30">
                        <ul class="blockUpload__name w100">
                            <li class="pr0">
                                <span class="ttl">再生時間</span>
                                <input type="hidden" value="" id="playTimeRoundHidden">
                                <input type="hidden" value="/scorebook/matches/{{ $matches->id }}/play_time" id="playTimeUrl">
                                <input type="text" class="center" id="playTimeInput">
                                <span class="ttl">秒</span>
                            </li>
                        </ul>
                        </div>
                        <p class="error" id="errorPlayTime">※input not null</p>
                        <div class="btnGroup style01">
                            <button id="playTimeSubmitButton" type="button" class="btnSubmit style01 pLeft">OK</button>
                            <button class="btnSubmit style01 gray pRight jsCloseModal" href="#">キャンセル</button>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    @include('web.includes.overlay-modal')
</div>
@endsection

@php
$chunk_options = (object) [
    'upload_url' => route('web.ajax.chunk-video.store'),
    'validate_url' => route('web.ajax.chunk-video.album-validate'),
    'save_url' => route('web.ajax.chunk-video.album-save'),
    'chunk_mb' => config('constants.pbpv.space_upload.chunk_mb'),
    'file_types' => implode(',', config('constants.pbpv.valid_video_types')),
];
@endphp

@push('js')
<script>
    document.pd_options = JSON.parse(decodeURIComponent('{{ rawurlencode(json_encode($match_common_info->pd_options)) }}'));
    document.chunk_options = JSON.parse(decodeURIComponent('{{ rawurlencode(json_encode($chunk_options)) }}'));
</script>
@endpush
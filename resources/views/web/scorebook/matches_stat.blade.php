@extends('web.layouts.default', ['title' => 'スタッツ（チーム/個人）'], ['pageName' => 'pageScoreStat'])
@push('css')
<style>
    table tr th.sorting_desc {
      font-weight: bold;
      background-color: black;
    }
    table tr th.sorting_asc {
      font-weight: bold;
      background-color: black;
    }
</style>
@endpush
@section('content')
<x-web.web-popup-loading display="none"></x-web.web-popup-loading>
<div class="keyv">
    <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="スタッツ">
    <h1 class="keyvTitle"><span>ゲーム記録</span>スタッツ</h1>
</div>
<div class="content">
    <div class="inner01">
        <ul class="breadscrumb">
            <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a><span>/</span></li>
            <li><a href="{{ route('web.scorebook.list') }}">ゲーム記録</a><span>/</span></li>
            <li><em>スタッツ</em></li>
        </ul>
        <div class="dateInfo">
            <p class="tag">{{ config('constants.period_aggregation.match_type.label.'.$match->type)}}</p>
            <p class="date">{{ date('Y年m月d日', strtotime($match->start_date)) }}</p>
        </div>
        @include('web.scorebook.includes.team-info')
        @include('web.scorebook.includes.score-info')
        <nav class="analysisNav">
            <a href="{{ route('web.scorebook.matches.report', ['matches_id' => $id]) }}">
                <svg class="icon icon01">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_report" />
                </svg>
                <span>試合レポート</span>
            </a>
            <a href="{{ route('web.scorebook.matches.stat', ['matches_id' => $id]) }}" class="active">
                <svg class="icon icon02">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_ball" />
                </svg>
                <span>スタッツ</span>
            </a>
            <a href="{{ route('web.scorebook.matches.chart', ['matches_id' => $id]) }}">
                <svg class="icon icon03">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_chart" />
                </svg>
                <span>比較表</span>
            </a>
            <a href="{{ route('web.scorebook.matches.video', ['matches_id' => $id]) }}">
                <svg class="icon icon04">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_ytb" />
                </svg>
                <span>Play by Play Video</span>
            </a>
        </nav>
        <div class="timeTab tabArea">
            <div class="col2 itemCenter blockMb40Sp20 tab">
                <nav class="timeTabInfo timeTabCol2 blockMb0Sp25 fS16">
                    <a href="#tab01" class="active">
                        <svg class="icon">
                            <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_arrow_down" />
                        </svg>
                        <span>個人スタッツ</span>
                    </a>
                    <a href="#tab02">
                        <svg class="icon">
                            <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_arrow_down" />
                        </svg>
                        <span>チームスタッツ</span></a>
                </nav>
            </div>
            <div class="timeTabContent tabContents">
                <div id="tab01" class="tabBox">
                    <div class="groupOptionFilter">
                        <div class="playControl mb">
                            <div class="item">
                                <div class="groupCtrl">
                                    <select name="personal" id="personal" class="formControl">
                                        <option value="1" data-tab="1" selected>{{$match->team1->name}}</option>
                                        <option value="2" data-tab="2">{{$match->team2->name}}</option>
                                    </select>
                                    <select name="personal_type" id="personal_type" class="formControl">
                                        <option value="1" data-tab="1" selected>数値を見る</option>
                                        <option value="2" data-tab="2">確率を見る</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="tblTime jsViewOption">
                            <div class="itemHead">時間別で見る</div>
                            <div class="item">
                                <label class="rbCustom">
                                    TOTAL
                                    <input type="radio" name="round" value="0" data-tab="0" checked="checked">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            @if($match->round1_time)
                            <div class="item">
                                <label class="rbCustom">
                                    1ST
                                    <input type="radio" name="round" value="1" data-tab="1">
                                    <span class="checkmark"></span>
                                </label>
                                <div class="groupOption ml10" id="time1">
                                </div>
                            </div>
                            @endif
                            @if($match->round2_time)
                            <div class="item">
                                <label class="rbCustom">
                                    2ND
                                    <input type="radio" name="round" value="2" data-tab="2">
                                    <span class="checkmark"></span>
                                </label>
                                <div class="groupOption ml10" id="time2">
                                </div>
                            </div>
                            @endif
                            @if($match->round3_time)
                            <div class="item">
                                <label class="rbCustom">
                                    3RD
                                    <input type="radio" name="round" value="3" data-tab="3">
                                    <span class="checkmark"></span>
                                </label>
                                <div class="groupOption ml10" id="time3">
                                </div>
                            </div>
                            @endif
                            @if($match->round4_time)
                            <div class="item">
                                <label class="rbCustom">
                                    4TH
                                    <input type="radio" name="round" value="4" data-tab="4">
                                    <span class="checkmark"></span>
                                </label>
                                <div class="groupOption ml10" id="time4">
                                </div>
                            </div>
                            @endif
                            @if($match->extra_time)
                            <div class="item">
                                <label class="rbCustom">
                                    EXT1
                                    <input type="radio" name="round" value="5" data-tab="5">
                                    <span class="checkmark"></span>
                                </label>
                                <div class="groupOption ml10" id="time5">
                                </div>
                            </div>
                            <div class="item">
                                <label class="rbCustom">
                                    EXT2
                                    <input type="radio" name="round" value="6" data-tab="6">
                                    <span class="checkmark"></span>
                                </label>
                                <div class="groupOption ml10" id="time6">
                                </div>
                            </div>
                            @endif
                            <div class="item spNone"></div>
                        </div>
                    </div>
                    <div class="tblScroll">
                        <div class="tblScroll__wrap">
                            <table class="tblList tbl_no_horizontal_line mb0" id="box_score_personal">
                                <thead>
                                </thead>
                            </table>
                            <div id="loading"></div>
                        </div>
                    </div>
                </div>
                <div id="tab02" class="tabBox">
                    <div class="groupOptionFilter">
                        <div class="playControl mb">
                            <div class="item">
                                <div class="groupCtrl">
                                    <select style="width: 200%;" name="team_type" id="team_type" class="formControl">
                                        <option value="1" data-tab="1" selected>数値を見る</option>
                                        <option value="2" data-tab="2">確率を見る</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="tblTime jsViewOption">
                            <div class="itemHead">時間別で見る</div>
                            <div class="item">
                                <label class="rbCustom">
                                    TOTAL
                                    <input type="radio" name="round_team" value="0" data-tab="0" checked="checked">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            @if($match->round1_time)
                            <div class="item">
                                <label class="rbCustom">
                                    1ST
                                    <input type="radio" name="round_team" value="1" data-tab="1">
                                    <span class="checkmark"></span>
                                </label>
                                <div class="groupOption ml10" id="team_time1">
                                </div>
                            </div>
                            @endif
                            @if($match->round2_time)
                            <div class="item">
                                <label class="rbCustom">
                                    2ND
                                    <input type="radio" name="round_team" value="2" data-tab="2">
                                    <span class="checkmark"></span>
                                </label>
                                <div class="groupOption ml10" id="team_time2">
                                </div>
                            </div>
                            @endif
                            @if($match->round3_time)
                            <div class="item">
                                <label class="rbCustom">
                                    3RD
                                    <input type="radio" name="round_team" value="3" data-tab="3">
                                    <span class="checkmark"></span>
                                </label>
                                <div class="groupOption ml10" id="team_time3">
                                </div>
                            </div>
                            @endif
                            @if($match->round4_time)
                            <div class="item">
                                <label class="rbCustom">
                                    4TH
                                    <input type="radio" name="round_team" value="4" data-tab="4">
                                    <span class="checkmark"></span>
                                </label>
                                <div class="groupOption ml10" id="team_time4">
                                </div>
                            </div>
                            @endif
                            @if($match->extra_time)
                            <div class="item">
                                <label class="rbCustom">
                                    EXT1
                                    <input type="radio" name="round_team" value="5" data-tab="5">
                                    <span class="checkmark"></span>
                                </label>
                                <div class="groupOption ml10" id="team_time5">
                                </div>
                            </div>
                            <div class="item">
                                <label class="rbCustom">
                                    EXT2
                                    <input type="radio" name="round_team" value="6" data-tab="6">
                                    <span class="checkmark"></span>
                                </label>
                                <div class="groupOption ml10" id="team_time6">
                                </div>
                            </div>
                            @endif
                            <div class="item spNone"></div>
                        </div>
                    </div>
                    <div id="team">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    window.current_page = 'scorebook_matches_stat';
</script>
@endsection

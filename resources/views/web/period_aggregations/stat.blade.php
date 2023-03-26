@extends('web.layouts.default', ['title' => 'スタッツ'], ['pageName' => 'pagePeriod'])
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
    <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="プレミアチームのご案内">
    <h1 class="keyvTitle"><span>期間別集計</span>スタッツ</h1>
</div>
<div class="content">
    <div class="inner01">
        <ul class="breadscrumb">
            <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a><span>/</span></li>
            <li><a href="/period_aggregation">期間別集計</a><span>/</span></li>
            <li><em>スタッツ</em></li>
        </ul>
        <h2 class="headline4">期間別集計絞り込み</h2>
        <section class="section02">
            <table class="matchTableInfo tableInfo style01">
                <tbody>
                    <tr>
                        <th colspan="2" class="thFull thFullSP">検索条件</th>
                    </tr>
                    <tr>
                        <th rowspan="3" class="thFull thFullPC">検索条件</th>
                        <th>期間</th>
                        <td>{{request()->get('date_from')}} ~ {{request()->get('date_to')}}</td>
                    </tr>
                    <tr>
                        <th>対戦チーム</th>
                        <td>{{ $team->name ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>試合の種類</th>
                        <td>{{ config('constants.period_aggregation.match_type.label.'.request()->get('type'))}}</td>
                    </tr>
                </tbody>
            </table>
        </section>
        <div class="groupOptionFilter" id="optionFilter">
            <h2 class="headline5 mgb30">シュートマップ</h2>
            <div class="playControl mb">
                <div class="item">
                    <div class="groupCtrl">
                        <select style="width: 200%;" name="type" id="type" class="formControl">
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
                <div class="item">
                    <label class="rbCustom">
                        1ST
                        <input type="radio" name="round" value="1" data-tab="1">
                        <span class="checkmark"></span>
                    </label>
                    <div class="groupOption ml10" id="time1">
                    </div>
                </div>
                <div class="item">
                    <label class="rbCustom">
                        2ND
                        <input type="radio" name="round" value="2" data-tab="2">
                        <span class="checkmark"></span>
                    </label>
                    <div class="groupOption ml10" id="time2">
                    </div>
                </div>
                <div class="item">
                    <label class="rbCustom">
                        3RD
                        <input type="radio" name="round" value="3" data-tab="3">
                        <span class="checkmark"></span>
                    </label>
                    <div class="groupOption ml10" id="time3">
                    </div>
                </div>
                <div class="item">
                    <label class="rbCustom">
                        4TH
                        <input type="radio" name="round" value="4" data-tab="4">
                        <span class="checkmark"></span>
                    </label>
                    <div class="groupOption ml10" id="time4">
                    </div>
                </div>
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
                <div class="item spNone"></div>
            </div>
        </div>
        <section class="section01">
            <h2 class="headline5 mb20">試合別集計</h2>
            <div class="tblScroll">
                <div class="tblScroll__wrap mb20">
                    <table class="tblList mb0" id="box_score_team">
                        <thead>
                        </thead>
                    </table>
                    <div id="box_score_team_loading"></div>
                </div>
                <div class="right">
                    <a href="#optionFilter" class="btnCmn03 jsAnchorLink">検索条件に戻る<span class="iconArrow"></span></a>
                </div>
            </div>
        </section>
        <section class="section01">
            <h2 class="headline5 mb20">選手別集計</h2>
            <div class="tblScroll spLeft190">
                <div class="tblScroll__wrap mb20">
                    <table class="tblList tbl_no_horizontal_line mb0" id="box_score_personal">
                        <thead>
                        </thead>
                    </table>
                    <div id="box_score_personal_loading"></div>
                </div>
                <div class="right">
                    <a href="#optionFilter" class="btnCmn03 jsAnchorLink">検索条件に戻る<span class="iconArrow"></span></a>
                </div>
            </div>
        </section>
        <section class="section01">
            <h2 class="headline5 mb20">試合で見る選手別集計</h2>
            <div class="box_score_personal_by_match">
            </div>
        </section>
    </div>
</div>
<script type="text/javascript">
    window.current_page = 'period_aggregation_stat';
    window.visiting_team = '{{ $team->name ?? '' }}';
</script>
@endsection

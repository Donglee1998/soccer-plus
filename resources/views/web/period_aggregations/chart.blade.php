@extends('web.layouts.default', ['title' => 'スタッツ'], ['pageName' => 'pagePeriod'])
@section('content')
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
        <div class="groupOptionFilter">
            <h2 class="headline5 mgb30">シュートマップ</h2>
            <div class="playControl mb">
                <div class="item">
                    <div class="groupCtrl">
                        <select name="team" id="team" class="formControl">
                            <option value="1">自チーム</option>
                            <option value="2">{{ $team->name ?? '' }}</option>
                        </select>
                        <select name="personal" id="personal" class="formControl">
                            <option value="0">全ての選手</option>
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
            <div class="shootRate">
                <span class="shootRate__ttl">シュート成功率</span>
                <div class="shootRate__level box">
                    <span>
                        0~20%
                        <em class="level level1"></em>
                    </span>
                    <span>
                        21~40%
                        <em class="level level2"></em>
                    </span>
                    <span>
                        41~60%
                        <em class="level level3"></em>
                    </span>
                    <span>
                        61~80%
                        <em class="level level4"></em>
                    </span>
                    <span>
                        81~100%
                        <em class="level level5"></em>
                    </span>
                </div>
            </div>
            <div class="mapScroll">
                <div class="blockMap blockMap01">
                    <div class="blockMapStats__goal shootRate__level" id="block">
                    </div>
                    <div class="blockMap__picture">
                        <div class="picture__outside">
                            <div class="item handledZone active" data-action="dataZone" data-zone="I">
                                <span class="zone">zone <em>I</em></span>
                            </div>
                        </div>
                        <div class="picture__main">
                            <div class="item handledZone active" data-action="dataZone" data-zone="A">
                                <span class="zone">zone<em>A</em></span>
                            </div>
                            <div class="item handledZone active" data-action="dataZone" data-zone="B">
                                <span class="zone">zone<em>B</em></span>
                            </div>
                            <div class="item handledZone active" data-action="dataZone" data-zone="C">
                                <span class="zone">zone<em>C</em></span>
                            </div>
                            <div class="item handledZone active" data-action="dataZone" data-zone="D">
                                <span class="zone">zone<em>D</em></span>
                            </div>
                            <div class="item handledZone active" data-action="dataZone" data-zone="E">
                                <span class="zone">zone<em>E</em></span>
                            </div>
                            <div class="item handledZone active" data-action="dataZone" data-zone="F">
                                <span class="zone">zone<em>F</em></span>
                            </div>
                            <div class="item handledZone active" data-action="dataZone" data-zone="G">
                                <span class="zone">zone<em>G</em></span>
                            </div>
                            <div class="item handledZone active" data-action="dataZone" data-zone="H">
                                <span class="zone">zone<em>H</em></span>
                            </div>
                            <div class="picture__outside w100">
                                <div class="item handledZone posLeft active" data-action="dataZone" data-zone="J">
                                    <div class="ml40">
                                        <span class="zone">zone<em>J</em></span>
                                    </div>
                                </div>
                                <div class="item handledZone posRight right active" data-action="dataZone" data-zone="K">
                                    <div class="left auto mr40">
                                        <span class="zone">zone<em>K</em></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="picture__outside">
                            <div class="item handledZone active" data-action="dataZone" data-zone="L">
                                <span class="zone">zone<em>L</em></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btnGroupList01">
                <a href="#" class="btnScorebook green handledRemoveZone" data-action="show">
                    <img src="/assets/img/svg/ic_checked.svg" alt="">
                    <span>全てのZONEを解除</span>
                </a>
                <a href="#" class="btnScorebook purple handledSwitchMode" data-action="ratio">
                    <img src="/assets/img/svg/ic_coordinate.svg" alt="">
                    <span>座標表示に切り替え</span>
                </a>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript">
    window.current_page = 'period_aggregation_chart';
    window.visiting_team = '{{ $team->name ?? '' }}';
</script>
@endsection

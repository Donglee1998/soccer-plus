@extends('web.layouts.default', ['title' => '比較表（横棒グラフ）'], ['pageName' => 'pageScoreChart'])
@section('content')
<div class="keyv">
    <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="プレミアチームのご案内">
    <h1 class="keyvTitle"><span>ゲーム記録</span>比較表</h1>
</div>
<div class="content">
    <div class="inner01">
        <ul class="breadscrumb">
            <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a><span>/</span></li>
            <li><a href="{{ route('web.scorebook.list') }}">ゲーム記録</a><span>/</span></li>
            <li><em>比較表</em></li>
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
            <a href="{{ route('web.scorebook.matches.stat', ['matches_id' => $id]) }}">
                <svg class="icon icon02">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_ball" />
                </svg>
                <span>スタッツ</span>
            </a>
            <a href="{{ route('web.scorebook.matches.chart', ['matches_id' => $id]) }}" class="active">
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
        <div class="section01">
            <h2 class="headline5 mgb40">棒グラフ</h2>
            <div class="groupOptionFilter">
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
                        <div class="groupOption ml10" id="team_time1">
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
                        <div class="groupOption ml10" id="team_time2">
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
                        <div class="groupOption ml10" id="team_time3">
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
                        <div class="groupOption ml10" id="team_time4">
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
                        <div class="groupOption ml10" id="team_time5">
                        </div>
                    </div>
                    <div class="item">
                        <label class="rbCustom">
                            EXT2
                            <input type="radio" name="round" value="6" data-tab="6">
                            <span class="checkmark"></span>
                        </label>
                        <div class="groupOption ml10" id="team_time6">
                        </div>
                    </div>
                    @endif
                    <div class="item spNone"></div>
                </div>
            </div>
            <div class="blockChart" id="blockChart">
                <div class="blockChart__item">
                    <canvas id="myChart" width="494" height="560"></canvas>
                </div>
                <div class="blockChart__item">
                    <canvas id="myChart2" width="494" height="560"></canvas>
                </div>
            </div>
        </div>
        <div class="section02">
            <div class="groupOptionFilter">
                <h2 class="headline5 mgb40">シュートマップ</h2>
                <div class="playControl mb">
                    <div class="item">
                        <div class="groupCtrl">
                            <select name="team" id="team" class="formControl">
                                <option value="1">{{$match->team1->name}}</option>
                                <option value="2">{{$match->team2->name}}</option>
                            </select>
                            <select name="personal" id="personal" class="formControl">
                                <option value="0">全ての選手</option>
                                @foreach($member_home as $key => $value)
                                @if($value['number_official'] && ($value['first_name'] || $value['last_name']))
                                    <option value="{{ $value['member_id'] }}">{{ $value['number_official'] . ' ' . $value['first_name'] . ' ' . $value['last_name'] }}</option>
                                @elseif ($value['number_official'] && !$value['first_name'] && !$value['last_name']) {
                                    <option value="{{ $value['member_id'] }}">{{ $value['number_official'] . ' ?'}}</option>
                                @endif
                                @endforeach
                                <option value="-1">? 仮選手</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="tblTime jsViewOption">
                    <div class="itemHead">時間別で見る</div>
                    <div class="item">
                        <label class="rbCustom">
                            TOTAL
                            <input type="radio" name="round_chart" value="0" data-tab="0" checked="checked">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    @if($match->round1_time)
                    <div class="item">
                        <label class="rbCustom">
                            1ST
                            <input type="radio" name="round_chart" value="1" data-tab="1">
                            <span class="checkmark"></span>
                        </label>
                        <div class="groupOption ml10" id="chart_time1">
                        </div>
                    </div>
                    @endif
                    @if($match->round2_time)
                    <div class="item">
                        <label class="rbCustom">
                            2ND
                            <input type="radio" name="round_chart" value="2" data-tab="2">
                            <span class="checkmark"></span>
                        </label>
                        <div class="groupOption ml10" id="chart_time2">
                        </div>
                    </div>
                    @endif
                    @if($match->round3_time)
                    <div class="item">
                        <label class="rbCustom">
                            3RD
                            <input type="radio" name="round_chart" value="3" data-tab="3">
                            <span class="checkmark"></span>
                        </label>
                        <div class="groupOption ml10" id="chart_time3">
                        </div>
                    </div>
                    @endif
                    @if($match->round4_time)
                    <div class="item">
                        <label class="rbCustom">
                            4TH
                            <input type="radio" name="round_chart" value="4" data-tab="4">
                            <span class="checkmark"></span>
                        </label>
                        <div class="groupOption ml10" id="chart_time4">
                        </div>
                    </div>
                    @endif
                    @if($match->extra_time)
                    <div class="item">
                        <label class="rbCustom">
                            EXT1
                            <input type="radio" name="round_chart" value="5" data-tab="5">
                            <span class="checkmark"></span>
                        </label>
                        <div class="groupOption ml10" id="chart_time5">
                        </div>
                    </div>
                    <div class="item">
                        <label class="rbCustom">
                            EXT2
                            <input type="radio" name="round_chart" value="6" data-tab="6">
                            <span class="checkmark"></span>
                        </label>
                        <div class="groupOption ml10" id="chart_time6">
                        </div>
                    </div>
                    @endif
                    <div class="item spNone"></div>
                </div>
            </div>
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
        </div>
        @include('web.scorebook.includes.shoot-chart')
    </div>
</div>
<script type="text/javascript">
    window.current_page = 'scorebook_matches_chart';
</script>
@endsection

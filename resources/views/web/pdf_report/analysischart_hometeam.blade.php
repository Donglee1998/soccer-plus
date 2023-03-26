<div class="wrapReport">
    <div class="inner03">
        <h2 class="headline13 mb20">シュート情報（相手チーム）</h2>
        <div class="blockCommon2">
            <div class="headBox">
                <h3 class="headline3">シュートマップ（マップ）</h3>
                <p class="shootRate__ttl">シュート成功率</p>
                <div class="shootRate__level">
                    <span>0~20%<em class="level level1"></em></span>
                    <span>21~40%<em class="level level2"></em></span>
                    <span>41~60%<em class="level level3"></em></span>
                    <span>61~80%<em class="level level4"></em></span>
                    <span>81~100%<em class="level level5"></em></span>
                </div>
            </div>  
            <div class="contentBox">
                <div class="mapScroll">
                    <div class="blockMap blockMap01">
                        <div class="blockMapStats__goal shootRate__level">
                            <div class="layoutLeft">
                                <div class="layoutItem__zone layout-item__lef">
                                    <div class="goalNumbers__item {{ $data_004['goal_number_analysis_home'][16]['color'] }}" style="background-color: rgb(204, 204, 204);">
                                        <div class="goalRatio">{{ $data_004['goal_number_analysis_home'][16]['probability'] }}<span class="goal-value">%</span></div>
                                        <div class="goalValue font-barlow-semi">({{ $data_004['goal_number_analysis_home'][16]['counter_value_home'] }}/ {{ $data_004['goal_number_analysis_home'][16]['counter_total_home'] }})</div>
                                    </div>
                                </div>
                            </div>
                            <div class="layoutTop">
                                <div class="layoutItem__zone layoutItem__lef">
                                    <div class="goalNumbers__item {{ $data_004['goal_number_analysis_home'][17]['color'] }}" style="background-color: rgb(204, 204, 204);">
                                        <div class="goalRatio">{{ $data_004['goal_number_analysis_home'][17]['probability'] }}<span class="goal-value">%</span></div>
                                        <div class="goalValue font-barlow-semi">({{ $data_004['goal_number_analysis_home'][17]['counter_value_home'] }}/ {{ $data_004['goal_number_analysis_home'][17]['counter_total_home'] }})</div>
                                    </div>
                                </div>
                                <div class="layoutItem__zone layoutItem__right">
                                    <div class="goalNumbers__item {{ $data_004['goal_number_analysis_home'][18]['color'] }}" style="background-color: rgb(204, 204, 204);">
                                        <div class="goalRatio">{{ $data_004['goal_number_analysis_home'][18]['probability'] }}<span class="goal-value">%</span></div>
                                        <div class="goalValue font-barlow-semi">({{ $data_004['goal_number_analysis_home'][18]['counter_value_home'] }}/ {{ $data_004['goal_number_analysis_home'][18]['counter_total_home'] }})</div>
                                    </div>
                                </div>
                            </div>
                            <div class="layoutRight">
                                <div class="layoutItem__zone layout-item__bottom">
                                    <div class="goalNumbers__item {{ $data_004['goal_number_analysis_home'][19]['color'] }}" style="background-color: rgb(204, 204, 204);">
                                        <div class="goalRatio">{{ $data_004['goal_number_analysis_home'][19]['probability'] }}<span class="goal-value">%</span></div>
                                        <div class="goalValue font-barlow-semi">({{ $data_004['goal_number_analysis_home'][19]['counter_value_home'] }}/ {{ $data_004['goal_number_analysis_home'][19]['counter_total_home'] }})</div>
                                    </div>
                                </div>
                            </div>
                            <div class="layoutMiddle">
                                <div class="goalNumbers">
                                    <div class="goalNumbers__wrap">
                                        @for($i = 1; $i <= 15; $i++)
                                        <div class="goalNumbers__item {{ $data_004['goal_number_analysis_home'][$i]['color'] }}">
                                            <div class="goalRatio">
                                                {{ $data_004['goal_number_analysis_home'][$i]['probability'] }} <span class="goalValue">%</span>
                                            </div>
                                            <div class="goalValue">({{ $data_004['goal_number_analysis_home'][$i]['counter_value_home'] }}/ {{ $data_004['goal_number_analysis_home'][$i]['counter_total_home'] }})</div>
                                        </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="blockCommon2">
            <div class="headBox">
                <h3 class="headline3 mb0">シュートマップ（座標）</h3>
            </div>  
            <div class="contentBox">
                <div class="mapScroll">
                    <div class="blockMap blockMap01">
                        <div class="blockMapStats__goal">
                            <div class="layoutLeft">
                                <div class="layoutItem__zone layout-item__lef">
                                    <div class="goalNumbers__item handledScore itemL">
                                        @if($data_004['goal_coordinate_analysis_home'][16] ?? null)
                                            @foreach($data_004['goal_coordinate_analysis_home'][16] as $key => $value)
                                            <p class="coordinate" style="top: {{$value['coord_y']}}%;left: {{$value['coord_x']}}%;transform: translate(-50%, -60%)"><img src="/assets/img/svg/ic_cross.svg" alt=""></p>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="layoutTop">
                                <div class="layoutItem__zone layoutItem__lef">
                                    <div class="goalNumbers__item handledScore itemBot">
                                        @if($data_004['goal_coordinate_analysis_home'][17] ?? null)
                                            @foreach($data_004['goal_coordinate_analysis_home'][17] as $key => $value)
                                            <p class="coordinate" style="top: {{$value['coord_y']}}%;left: {{$value['coord_x']}}%;transform: translate(-50%, -60%)"><img src="/assets/img/svg/ic_cross.svg" alt=""></p>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="layoutItem__zone layoutItem__right">
                                    <div class="goalNumbers__item handledScore itemBot last">
                                        @if($data_004['goal_coordinate_analysis_home'][18] ?? null)
                                            @foreach($data_004['goal_coordinate_analysis_home'][18] as $key => $value)
                                            <p class="coordinate" style="top: {{$value['coord_y']}}%;left: {{$value['coord_x']}}%;transform: translate(-50%, -60%)"><img src="/assets/img/svg/ic_cross.svg" alt=""></p>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="layoutRight">
                                <div class="layoutItem__zone layout-item__lef">
                                    <div class="goalNumbers__item handledScore itemR">
                                        @if($data_004['goal_coordinate_analysis_home'][19] ?? null)
                                            @foreach($data_004['goal_coordinate_analysis_home'][19] as $key => $value)
                                            <p class="coordinate" style="top: {{$value['coord_y']}}%;left: {{$value['coord_x']}}%;transform: translate(-50%, -60%)"><img src="/assets/img/svg/ic_cross.svg" alt=""></p>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="layoutMiddle">
                                <div class="goalNumbers">
                                    <div class="goalNumbers__wrap">
                                        @for($i = 1; $i <= 15; $i++)
                                        <div class="goalNumbers__item">
                                            @if($data_004['goal_coordinate_analysis_home'][$i] ?? null)
                                                @foreach($data_004['goal_coordinate_analysis_home'][$i] as $key => $value)
                                                <p class="coordinate" style="top: {{$value['coord_y']}}%;left: {{$value['coord_x']}}%;transform: translate(-50%, -60%)"><img src="/assets/img/svg/ic_cross.svg" alt=""></p>
                                                @endforeach
                                            @endif
                                        </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- CB_SOCCER_PLUS-1224: hide short chart --}}
        {{-- <div class="blockCommon2" style="page-break-after: always;">
            <div class="headBox">
                <h3 class="headline3">シュートチャート</h3>
                <ul class="listDots">
                    <li class="dotRed">ゴール：1本</li>
                    <li class="dotBlue">セーブ：3本</li>
                    <li class="dotGreen">ブロック：２本</li>
                    <li>枠外：6本</li>
                </ul>
            </div>  
            <div class="contentBox">
                <div class="chartStatMap1">
                    <div class="chartStat2">
                        <span class="arrow" style="width: 90px;transform: rotate(-39deg);left: 169px;top: 57px;"></span>
                        <span class="arrow" style="width: 41px;transform: rotate(-59deg);left: 221px;top: 46px;"></span>
                        <span class="arrowBlue" style="width: 22px;transform: rotate(-48deg);left: 246px;top: 37px;"></span>
                        <span class="arrowGreen" style="width: 88px;transform: rotate(-82deg);left: 223px;top: 74px;"></span>
                        <span class="arrow" style="width: 88px;transform: rotate(-90deg);left: 237px;top: 74px;"></span>
                        <span class="arrowBlue" style="width: 64px;transform: rotate(-114deg);left: 251px;top: 58px;"></span>
                        <span class="arrowGreen" style="width: 38px;transform: rotate(-109deg);left: 278px;top: 49px;"></span>
                        <span class="arrow" style="width: 91px;transform: rotate(-107deg);left: 273px;top: 73px;"></span>
                        <span class="arrowBlue" style="width: 38px;transform: rotate(-135deg);left: 296px;top: 44px;"></span>
                        <span class="arrowRed" style="width: 65px;transform: rotate(-135deg);left: 300px;top: 53px;"></span>
                        <span class="arrow" style="width: 121px;transform: rotate(-136deg);left: 312px;top: 74px;"></span>
                        <span class="arrow" style="width: 90px;transform: rotate(-33deg);left: 236px;top: 55px;"></span>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="blockCommon2 custom">
            <div class="chartCompareBox">
                <div class="infoBox">
                    <p class="ttl">ゴールパターン</p>
                    <p class="infoTeam">
                        <span class="teamColor home">
                            <svg class="icon" style="fill:{{$data_004['color_team_home']}}!important">
                                <use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams" />
                            </svg>
                        </span>
                        <span class="name">{{$data_004['team_home_name']}}</span>
                    </p>
                    <p class="ttl right">失点パターン</p>
                </div>
                <div class="graphCompareBox">
                    <div class="chartCompare2">
                        <div class="graph">
                            @foreach($data_004['analysis_home_kick_goal'] as $key => $value)
                            <div class="item">
                                <span class="bar" style="width: calc({{$value}} * 22px); background-color: {{$data_004['color_team_home']}};color: {{$data_004['color_team_home']}}"><em class="num">{{$value}}</em></span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                        <ul class="listTtl">
                            <li>PK</li>
                            <li>セットプレー直接</li>
                            <li>セットプレーから</li>
                            <li>クロスから</li>
                            <li>スルーパスから</li>
                            <li>ショートパスから</li>
                            <li>ロングパスから</li>
                            <li>ドリブルから</li>
                            <li>こぼれ球から</li>
                            <li>ショートカウンター</li>
                            <li>その他</li>
                        </ul>
                    <div class="chartCompare2">
                        <div class="graph team2">
                            @foreach($data_004['analysis_guest_kick_goal'] as $key => $value)
                            <div class="item">
                                <span class="bar" style="width: calc({{$value}} * 22px)"><em class="num">{{$value}}</em></span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="blockCommon2 custom" style="page-break-after: always;">
            <div class="chartCompareBox">
                <div class="infoBox">
                    <p class="ttl">チャンスパターン</p>
                    <p class="infoTeam">
                        <span class="teamColor home">
                            <svg class="icon" style="fill:{{$data_004['color_team_home']}}!important">
                                <use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams" />
                            </svg>
                        </span>
                        <span class="name">{{$data_004['team_home_name']}}</span>
                    </p>
                    <p class="ttl right">ピンチパターン</p>
                </div>
                <div class="graphCompareBox">
                    <div class="chartCompare2">
                        <div class="graph">
                            @foreach($data_004['analysis_home_kick_opportunity'] as $key => $value)
                            <div class="item">
                                <span class="bar" style="width: calc({{$value}} * 22px); background-color: {{$data_004['color_team_home']}};color: {{$data_004['color_team_home']}}"><em class="num">{{$value}}</em></span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                        <ul class="listTtl">
                            <li>PK</li>
                            <li>セットプレー直接</li>
                            <li>セットプレーから</li>
                            <li>クロスから</li>
                            <li>スルーパスから</li>
                            <li>ショートパスから</li>
                            <li>ロングパスから</li>
                            <li>ドリブルから</li>
                            <li>こぼれ球から</li>
                            <li>ショートカウンター</li>
                            <li>その他</li>
                        </ul>
                    <div class="chartCompare2">
                        <div class="graph team2">
                            @foreach($data_004['analysis_guest_kick_opportunity'] as $key => $value)
                            <div class="item">
                                <span class="bar" style="width: calc({{$value}} * 22px)"><em class="num">{{$value}}</em></span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

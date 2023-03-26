<div class="wrapReport">
    <div class="inner03">
        <h2 class="headline13 mb30">両チームフォーメーション</h2>
        <div class="lineupBox mb30" style="page-break-after: always;">
            <div class="memBox memBox01 home">
                <div class="teamInfo info">
                    <div class="teamInfoName">
                        <span class="teamColor home">
                            @if ($data_003['color_team1'] == 1)
                            <svg class="icon">
                                <use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams-white" /></svg>
                            @else
                            <svg class="icon" style="fill: {{ config('constants.team_color.' . $data_003['color_team1']) }} !important">
                                <use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams" /></svg>
                            @endif
                        </span>
                        <span class="name">{{ $data_003['match_common_info']->match->team1->name }}</span>
                    </div>
                    <p class="diagram">{{ $data_003['lineup1']->pattern_name }}</p>
                </div>
                @php
                    $default_color_change    = 'color:' . config('constants.team_color.4') . ' !important;';
                    $num_background_team_1   = 'background:'. config('constants.team_color.' . $data_003['color_team1']) . ' !important;';
                    $num_background_team_2   = 'background:'. config('constants.team_color.' . $data_003['color_team2']) . ' !important;';
                    $chart_background_team_1 = $num_background_team_1 . 'border-top-color:' . config('constants.team_color.' . $data_003['color_team1']) . ' !important;';
                    $chart_background_team_2 = $num_background_team_2 . 'border-top-color:' . config('constants.team_color.' . $data_003['color_team2']) . ' !important;';
                    $num_chart_team_1        = null;
                    $num_chart_team_2        = null;
                    $default_border_team_1   = '';
                    $default_border_team_2   = '';
                    //Check color white, grey
                    if ($data_003['color_team1'] == 1 || $data_003['color_team1'] == 2 || $data_003['color_team1'] == 3) {
                        $default_border_team_1   = 'border: 1px solid #222 !important;';
                        $num_background_team_1  .= $default_color_change;
                        $num_chart_team_1        = $default_color_change;
                        $chart_background_team_1 = $num_background_team_1 . $default_border_team_1;
                    }
                    if ($data_003['color_team2'] == 1 || $data_003['color_team2'] == 2 || $data_003['color_team2'] == 3) {
                        $default_border_team_2   = 'border: 1px solid #222 !important;';
                        $num_background_team_2  .= $default_color_change;
                        $num_chart_team_2        = $default_color_change;
                        $chart_background_team_2 = $num_background_team_2 . $default_border_team_2;
                    }
                @endphp
                <div class="mapBox">
                    @foreach ($data_003['position_args'] as $position)
                        @if($data_003['MF'] == $position)
                            @isset($data_003['starting1'][$position])
                                @php
                                    $total_before_item = 0;
                                    foreach (array_reverse($data_003['lineup1']->pattern['MF']) as $k => $item) {
                                        $mf_line_number = $k - 2;
                                        $mf_member_args = $data_003['starting1'][$position]->reverse()->values();
                                        echo '<div class="row '. $data_003['position_label'][$position] . '_' . $mf_line_number .'">';
                                        if($item != 0) {
                                            foreach($mf_member_args->slice($total_before_item, $item)->reverse() as $mf_member) {
                                                echo '<p class="infoMem">';
                                                echo '<span class="num" style="' . $num_background_team_1 . '">' . $mf_member['number_official'] . '</span>';
                                                echo '<span class="name">' . $mf_member['full_name'] . '</span>';
                                                echo '</p>';
                                            }
                                        }
                                        echo '</div>';
                                        $total_before_item += $item;
                                    }
                                @endphp
                            @endisset
                        @else
                            @isset($data_003['starting1'][$position])
                            <div class="row {{ $data_003['position_label'][$position] }}">
                                @foreach($data_003['starting1'][$position] as $player)
                                <p class="infoMem">
                                    <span class="num" style="{{ $num_background_team_1 }}">{{ $player['number_official'] }}</span>
                                    <span class="name">{{ $player['full_name'] }}</span>
                                </p>
                                @endforeach
                            </div>
                            @endisset
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="memBox memBox01 away ml30">
                <div class="teamInfo info">
                    <div class="teamInfoName">
                        <span class="teamColor away">
                            @if ($data_003['color_team2'] == 1)
                            <svg class="icon">
                                <use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams-white" /></svg>
                            @else
                            <svg class="icon" style="fill: {{ config('constants.team_color.' . $data_003['color_team2']) }} !important">
                                <use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams" /></svg>
                            @endif
                        </span>
                        <span class="name">{{ $data_003['match_common_info']->match->team2->name }}</span>
                    </div>
                    <p class="diagram">{{ $data_003['lineup2']->pattern_name }}</p>
                </div>
                <div class="mapBox">
                    @foreach ($data_003['position_args'] as $position)
                        @if($data_003['MF'] == $position)
                            @isset($data_003['starting2'][$position])
                                @php
                                $total_before_item = 0;
                                foreach (array_reverse($data_003['lineup2']->pattern['MF']) as $k => $item) {
                                    $mf_line_number = $k - 2;
                                    $mf_member_args = $data_003['starting2'][$position]->reverse()->values();
                                    echo '<div class="row '. $data_003['position_label'][$position] . '_' . $mf_line_number .'">';
                                    if($item != 0) {
                                        foreach($mf_member_args->slice($total_before_item, $item)->reverse() as $mf_member) {
                                            echo '<p class="infoMem">';
                                            echo '<span class="num" style="' . $num_background_team_2 . '">' . $mf_member['number_official'] . '</span>';
                                            echo '<span class="name">' . $mf_member['full_name'] . '</span>';
                                            echo '</p>';
                                        }
                                    }
                                    echo '</div>';
                                    $total_before_item += $item;
                                }
                                @endphp
                            @endisset
                        @else
                            @isset($data_003['starting2'][$position])
                            <div class="row {{ $data_003['position_label'][$position] }}">
                                @foreach($data_003['starting2'][$position] as $player)
                                <p class="infoMem">
                                    <span class="num" style="{{ $num_background_team_2 }}">{{ $player['number_official'] }}</span>
                                    <span class="name">{{ $player['full_name'] }}</span>
                                </p>
                                @endforeach
                            </div>
                            @endisset
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        {{-- <h2 class="headline13 mb30">グラフで比較</h2> --}}
        <div class="groupChartCompare">
            <div class="chartCompare jsChartCompare">
                <div class="head">
                    <p class="ttl">シュート成功率</p>
                </div>
                <div class="contentBox">
                    <ul class="listPer">
                        <li>%</li>
                        <li>10</li>
                        <li>20</li>
                        <li>30</li>
                        <li>40</li>
                        <li>50</li>
                        <li>60</li>
                        <li>70</li>
                        <li>80</li>
                        <li>90</li>
                        <li>100</li>
                    </ul>
                    <div class="graph">
                        <div class="team1" style="height: {{ $data_003['team_1']->ratio_goal }}%; {{ $chart_background_team_1 }}">
                            <p class="percent" style="{{ $num_chart_team_1 ? $num_chart_team_1 : checkNumToDefaultColor($data_003['team_1']->ratio_goal, $data_003['color_team1']) }}">
                                <span class="num">{{ $data_003['team_1']->ratio_goal }}</span>
                                <span class="sub">%</span>
                            </p>
                        </div>
                        <div class="team2" style="height: {{ $data_003['team_2']->ratio_goal }}%; {{ $chart_background_team_2 }}">
                            <p class="percent" style="{{ $num_chart_team_2 ? $num_chart_team_2 : checkNumToDefaultColor($data_003['team_2']->ratio_goal, $data_003['color_team2']) }}">
                                <span class="num">{{ $data_003['team_2']->ratio_goal }}</span>
                                <span class="sub">%</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chartCompare jsChartCompare">
                <div class="head">
                    <p class="ttl">枠内シュート成功率</p>
                </div>
                <div class="contentBox">
                    <ul class="listPer">
                        <li>%</li>
                        <li>10</li>
                        <li>20</li>
                        <li>30</li>
                        <li>40</li>
                        <li>50</li>
                        <li>60</li>
                        <li>70</li>
                        <li>80</li>
                        <li>90</li>
                        <li>100</li>
                    </ul>
                    <div class="graph">
                        <div class="team1" style="height: {{ $data_003['team_1']->ratio_kick_goal }}%; {{ $chart_background_team_1 }}">
                            <p class="percent" style="{{ $num_chart_team_1 ? $num_chart_team_1 : checkNumToDefaultColor($data_003['team_1']->ratio_kick_goal, $data_003['color_team1']) }}">
                                <span class="num">{{ $data_003['team_1']->ratio_kick_goal }}</span>
                                <span class="sub">%</span>
                            </p>
                        </div>
                        <div class="team2" style="height: {{ $data_003['team_2']->ratio_kick_goal }}%; {{ $chart_background_team_2 }}">
                            <p class="percent" style="{{ $num_chart_team_2 ? $num_chart_team_2 : checkNumToDefaultColor($data_003['team_2']->ratio_kick_goal, $data_003['color_team2']) }}">
                                <span class="num">{{ $data_003['team_2']->ratio_kick_goal }}</span>
                                <span class="sub">%</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chartCompare jsChartCompare">
                <div class="head">
                    <p class="ttl">クロス成功率</p>
                </div>
                <div class="contentBox">
                    <ul class="listPer">
                        <li>%</li>
                        <li>10</li>
                        <li>20</li>
                        <li>30</li>
                        <li>40</li>
                        <li>50</li>
                        <li>60</li>
                        <li>70</li>
                        <li>80</li>
                        <li>90</li>
                        <li>100</li>
                    </ul>
                    <div class="graph">
                        <div class="team1" style="height: {{ $data_003['team_1']->ratio_cross }}%; {{ $chart_background_team_1 }}">
                            <p class="percent" style="{{ $num_chart_team_1 ? $num_chart_team_1 : checkNumToDefaultColor($data_003['team_1']->ratio_cross, $data_003['color_team1']) }}">
                                <span class="num">{{ $data_003['team_1']->ratio_cross }}</span>
                                <span class="sub">%</span>
                            </p>
                        </div>
                        <div class="team2" style="height: {{ $data_003['team_2']->ratio_cross }}%; {{ $chart_background_team_2 }}">
                            <p class="percent" style="{{ $num_chart_team_2 ? $num_chart_team_2 : checkNumToDefaultColor($data_003['team_2']->ratio_cross, $data_003['color_team2']) }}">
                                <span class="num">{{ $data_003['team_2']->ratio_cross }}</span>
                                <span class="sub">%</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chartCompare jsChartCompare">
                <div class="head">
                    <p class="ttl">空中戦勝率</p>
                </div>
                <div class="contentBox">
                    <ul class="listPer">
                        <li>%</li>
                        <li>10</li>
                        <li>20</li>
                        <li>30</li>
                        <li>40</li>
                        <li>50</li>
                        <li>60</li>
                        <li>70</li>
                        <li>80</li>
                        <li>90</li>
                        <li>100</li>
                    </ul>
                    <div class="graph">
                        <div class="team1" style="height: {{ $data_003['team_1']->ratio_tackle_overhead }}%; {{ $chart_background_team_1 }}">
                            <p class="percent" style="{{ $num_chart_team_1 ? $num_chart_team_1 : checkNumToDefaultColor($data_003['team_1']->ratio_tackle_overhead, $data_003['color_team1']) }}">
                                <span class="num">{{ $data_003['team_1']->ratio_tackle_overhead }}</span>
                                <span class="sub">%</span>
                            </p>
                        </div>
                        <div class="team2" style="height: {{ $data_003['team_2']->ratio_tackle_overhead }}%; {{ $chart_background_team_2 }}">
                            <p class="percent" style="{{ $num_chart_team_2 ? $num_chart_team_2 : checkNumToDefaultColor($data_003['team_2']->ratio_tackle_overhead, $data_003['color_team2']) }}">
                                <span class="num">{{ $data_003['team_2']->ratio_tackle_overhead }}</span>
                                <span class="sub">%</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chartCompare jsChartCompare">
                <div class="head">
                    <p class="ttl">ボール奪取率</p>
                </div>
                <div class="contentBox">
                    <ul class="listPer">
                        <li>%</li>
                        <li>10</li>
                        <li>20</li>
                        <li>30</li>
                        <li>40</li>
                        <li>50</li>
                        <li>60</li>
                        <li>70</li>
                        <li>80</li>
                        <li>90</li>
                        <li>100</li>
                    </ul>
                    <div class="graph">
                        <div class="team1" style="height: {{ $data_003['team_1']->ratio_tackle }}%; {{ $chart_background_team_1 }}">
                            <p class="percent" style="{{ $num_chart_team_1 ? $num_chart_team_1 : checkNumToDefaultColor($data_003['team_1']->ratio_tackle, $data_003['color_team1']) }}">
                                <span class="num">{{ $data_003['team_1']->ratio_tackle }}</span>
                                <span class="sub">%</span>
                            </p>
                        </div>
                        <div class="team2" style="height: {{ $data_003['team_2']->ratio_tackle }}%; {{ $chart_background_team_2 }}">
                            <p class="percent" style="{{ $num_chart_team_2 ? $num_chart_team_2 : checkNumToDefaultColor($data_003['team_2']->ratio_tackle, $data_003['color_team2']) }}">
                                <span class="num">{{ $data_003['team_2']->ratio_tackle }}</span>
                                <span class="sub">%</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chartCompare jsChartCompare">
                <div class="head">
                    <p class="ttl">インターセプト成功率</p>
                </div>
                <div class="contentBox">
                    <ul class="listPer">
                        <li>%</li>
                        <li>10</li>
                        <li>20</li>
                        <li>30</li>
                        <li>40</li>
                        <li>50</li>
                        <li>60</li>
                        <li>70</li>
                        <li>80</li>
                        <li>90</li>
                        <li>100</li>
                    </ul>
                    <div class="graph">
                        <div class="team1" style="height: {{ $data_003['team_1']->ratio_clear }}%; {{ $chart_background_team_1 }}">
                            <p class="percent" style="{{ $num_chart_team_1 ? $num_chart_team_1 : checkNumToDefaultColor($data_003['team_1']->ratio_clear, $data_003['color_team1']) }}">
                                <span class="num">{{ $data_003['team_1']->ratio_clear }}</span>
                                <span class="sub">%</span>
                            </p>
                        </div>
                        <div class="team2" style="height: {{ $data_003['team_2']->ratio_clear }}%; {{ $chart_background_team_2 }}">
                            <p class="percent" style="{{ $num_chart_team_2 ? $num_chart_team_2 : checkNumToDefaultColor($data_003['team_2']->ratio_clear, $data_003['color_team2']) }}">
                                <span class="num">{{ $data_003['team_2']->ratio_clear }}</span>
                                <span class="sub">%</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chartCompare jsChartCompare">
                <div class="head">
                    <p class="ttl">シュート セーブ率</p>
                </div>
                <div class="contentBox">
                    <ul class="listPer">
                        <li>%</li>
                        <li>10</li>
                        <li>20</li>
                        <li>30</li>
                        <li>40</li>
                        <li>50</li>
                        <li>60</li>
                        <li>70</li>
                        <li>80</li>
                        <li>90</li>
                        <li>100</li>
                    </ul>
                    <div class="graph">
                        <div class="team1" style="height: {{ $data_003['team_1']->ratio_save }}%; {{ $chart_background_team_1 }}">
                            <p class="percent" style="{{ $num_chart_team_1 ? $num_chart_team_1 : checkNumToDefaultColor($data_003['team_1']->ratio_save, $data_003['color_team1']) }}">
                                <span class="num">{{ $data_003['team_1']->ratio_save }}</span>
                                <span class="sub">%</span>
                            </p>
                        </div>
                        <div class="team2" style="height: {{ $data_003['team_2']->ratio_save }}%; {{ $chart_background_team_2 }}">
                            <p class="percent" style="{{ $num_chart_team_2 ? $num_chart_team_2 : checkNumToDefaultColor($data_003['team_2']->ratio_save, $data_003['color_team2']) }}">
                                <span class="num">{{ $data_003['team_2']->ratio_save }}</span>
                                <span class="sub">%</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chartCompare jsChartCompare">
                <div class="head">
                    <p class="ttl">セカンドボール回収率</p>
                </div>
                <div class="contentBox">
                    <ul class="listPer">
                        <li>%</li>
                        <li>10</li>
                        <li>20</li>
                        <li>30</li>
                        <li>40</li>
                        <li>50</li>
                        <li>60</li>
                        <li>70</li>
                        <li>80</li>
                        <li>90</li>
                        <li>100</li>
                    </ul>
                    <div class="graph">
                        <div class="team1" style="height: {{ $data_003['team_1']->ratio_second_ball }}%; {{ $chart_background_team_1 }}">
                            <p class="percent" style="{{ $num_chart_team_1 ? $num_chart_team_1 : checkNumToDefaultColor($data_003['team_1']->ratio_second_ball, $data_003['color_team1']) }}">
                                <span class="num">{{ $data_003['team_1']->ratio_second_ball }}</span>
                                <span class="sub">%</span>
                            </p>
                        </div>
                        <div class="team2" style="height: {{ $data_003['team_2']->ratio_second_ball }}%; {{ $chart_background_team_2 }}">
                            <p class="percent" style="{{ $num_chart_team_2 ? $num_chart_team_2 : checkNumToDefaultColor($data_003['team_2']->ratio_second_ball, $data_003['color_team2']) }}">
                                <span class="num">{{ $data_003['team_2']->ratio_second_ball }}</span>
                                <span class="sub">%</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="noteTeams custom" style="page-break-after: always;">
            <p class="team1"><span style="background: {{ config('constants.team_color.' . $data_003['color_team1']) }} !important; {{ $default_border_team_1 }}"></span>{{ $data_003['match_common_info']->match->team1->name }}</p>
            <p class="team2"><span style="background: {{ config('constants.team_color.' . $data_003['color_team2']) }} !important; {{ $default_border_team_2 }}"></span>{{ $data_003['match_common_info']->match->team2->name }}</p>
        </div>
    </div>
</div>

<div class="wrapReport">
    <div class="inner03">
        <div style="page-break-after: always;">
            <div class="blockScroll mb0 pb0">
                <table class="tblReport">
                    <tbody>
                        <tr>
                            <th>試合種類</th>
                            <td>{{ $data_001['match']['type'] }}</td>
                            <th>大会名</th>
                            <td>{{ $data_001['match']['conference_name'] }}</td>
                            <th>日時</th>
                            <td>{{ $data_001['match']['start_date_time'] }}</td>
                        </tr>
                        <tr>
                            <th>場所</th>
                            <td>{{ $data_001['match']['place'] }}</td>
                            <th>試合時間</th>
                            <td>{{ $data_001['match']['round_time'] }}</td>
                            <th>人数</th>
                            <td>{{ is_null($data_001['match']['number_people']) ? '' : $data_001['match']['number_people'] . '人' }}</td>
                        </tr>
                        <tr>
                            <th>PK戦</th>
                            <td>{{ $data_001['match']['penalty'] }}</td>
                            <th>ピッチ</th>
                            <td>{{ $data_001['match']['pitch_type'] }}</td>
                            <th>状態</th>
                            <td>{{ is_null($data_001['match']['situation']) ? '' : $data_001['match']['situation'] . 'い' }}</td>
                        </tr>
                        <tr>
                            <th>主審</th>
                            <td>{{ $data_001['match']['referee'] }}</td>
                            <th>副審</th>
                            <td>{{ $data_001['match']['linesman'] }}</td>
                            <th>第四審判</th>
                            <td>{{ $data_001['match']['fourth_referee'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @include('web.pdf_report.includes.team-in-match', ['round' => $data_001['round']])
        </div>
        
        <!-- [Part 2] Bảng thống kê sút bóng -->
        <div class="tblScroll {{ count($data_001['report_round']['rounds']) < 6 ? '' : 'tblZoom' }} ratioPrintMode mb0 pb0" style="page-break-after: always;">
            <div class="tblScroll__wrap">
                {{-- Header --}}
                <table class="tblReportMatch mwtblHead">
                    <thead>
                        <tr>
                            <th class="setW03" rowspan="2">選手名</th>
                            <th class="setW02" rowspan="2">番号</th>
                            <th class="mw80" colspan="{{ count($data_001['report_round']['rounds']) + 1 }}">シュート</th>
                            <th class="wGKHead" rowspan="2" colspan="2">ポジション</th>
                            <th class="mw80" colspan="{{ count($data_001['report_round']['rounds']) + 1 }}">シュート</th>
                            <th class="setW02" rowspan="2">番号</th>
                            <th class="setW03" rowspan="2">選手名</th>
                        </tr>
                        <tr>
                            @foreach($data_001['report_round']['rounds'] as $round)
                            <th class="w50p">{{ str_replace('_', '', $round) }}</th>
                            @endforeach
                            <th class="w35p mw80">計</th>
                            <th class="w35p mw80">計</th>
                            @foreach(array_reverse($data_001['report_round']['rounds']) as $round)
                            <th class="w50p">{{ str_replace('_', '', $round) }}</th>
                            @endforeach
                        </tr>
                    </thead>
                </table>
                <!-- starting -->
                {{-- Team 1 --}}
                <div class="tableGroup">
                    <table class="tblReportMatch w50">
                        <tbody>
                            @for ($i=0; $i < count($data_001['report_round']['lineup1_starting']); $i++)
                            <tr>
                                <td class="setW03">{{ @$data_001['report_round']['lineup1_starting'][$i]['full_name'] ?? '?' }}</td>
                                <td class="bgGray setW02">{{ @$data_001['report_round']['lineup1_starting'][$i]['number_official'] }}</td>
                                @php
                                    $goal_left_total = 0;
                                    foreach($data_001['report_round']['rounds'] as $round) {
                                    $goal_left_col = @$data_001['report_round']['goal'][@$data_001['report_round']['lineup1_starting'][$i]['member_id']][$round] ?? 0;
                                    $goal_left_total += $goal_left_col;
                                        echo "<td class=\"w50p\">$goal_left_col</td>";
                                    }
                                @endphp
                                <td class="w35p mw80">{{ $goal_left_total }}</td>
                                <td class="lineGrayL wGK">{{ @$data_001['report_round']['lineup1_starting'][$i]['position_label'] ?? '?' }}</td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                    {{-- Team 2 --}}
                    <table class="tblReportMatch w50">
                        <tbody>
                            @for ($i=0; $i < count($data_001['report_round']['lineup2_starting']); $i++)
                            <tr>
                                <td class="wGK">{{ @$data_001['report_round']['lineup2_starting'][$i]['position_label'] }}</td>
                                @php
                                    $goal_right_total = 0;
                                    $goal_right_col = '';
                                    foreach(array_reverse($data_001['report_round']['rounds']) as $round) {
                                        $goal_right_total += @$data_001['report_round']['goal'][$data_001['report_round']['lineup2_starting'][$i]['member_id']][$round] ?? 0;
                                        $goal_right_col .= "<td class=\"w50p\">".(@$data_001['report_round']['goal'][$data_001['report_round']['lineup2_starting'][$i]['member_id']][$round] ?? 0)."</td>";
                                    }
                                    echo "<td class=\"w35p mw80\">$goal_right_total</td>";
                                    echo $goal_right_col;
                                @endphp
                                <td class="bgGray setW02">{{ @$data_001['report_round']['lineup2_starting'][$i]['number_official'] }}</td>
                                <td class="setW03">{{ @$data_001['report_round']['lineup2_starting'][$i]['full_name'] ?? '?' }}</td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                    <!-- list cầu thủ thay vào sân -->
                    {{-- Team 1 --}}
                    <table class="tblReportMatch lineGrayT w50">
                        @isset($data_001['report_round']['member_caculator_args']['team_left'])
                            @foreach ($data_001['report_round']['member_caculator_args']['team_left'] as $member)
                            <tr>
                                <td class="setW03">{{ $member['full_name'] ?? '?' }}</td>
                                <td class="bgGray setW02">{{ $member['number_official'] }}</td>
                                @php
                                    $goal_left_total = 0;
                                    foreach($data_001['report_round']['rounds'] as $round) {
                                        $goal_left_col = @$data_001['report_round']['goal'][$member['member_id']][$round] ?? 0;
                                        $goal_left_total += $goal_left_col;
                                        echo "<td class=\"w50p\">$goal_left_col</td>";
                                    }
                                @endphp
                                <td class="w35p mw80">{{ $goal_left_total }}</td>
                                <td class="lineGrayL wGK">{{ @$position_label[$member['position']] }}</td>
                            </tr>
                            @endforeach
                        @endisset
                        @isset($data_001['report_round']['goal']['anonymous_left'])
                            @foreach ($data_001['report_round']['goal']['anonymous_left'] as $anonymous_id => $anonymous_item)
                            <tr>
                                <td class="setW03">仮選手</td>
                                <td class="bgGray setW02">?</td>
                                @php
                                    $goal_left_total = 0;
                                    foreach($data_001['report_round']['rounds'] as $round) {
                                        $goal_left_col = @$data_001['report_round']['rounds']['goal']['anonymous_left'][$anonymous_id][$round] ?? 0;
                                        $goal_left_total += $goal_left_col;
                                        echo "<td class=\"w50p\">$goal_left_col</td>";
                                    }
                                @endphp
                                <td class="w35p mw80">{{ $goal_left_total }}</td>
                                <td class="lineGrayL wGK">?</td>
                            </tr>
                            @endforeach
                        @endisset
                        @php
                        $row_empty_show = false;
                        if ((!empty($data_001['report_round']['member_caculator_args']['team_right']) || !empty($data_001['report_round']['goal']['anonymous_right'])) && empty($data_001['report_round']['member_caculator_args']['team_left']) && empty($data_001['report_round']['goal']['anonymous_left'])) {
                            $row_empty_show = true;
                        }
                        @endphp
                        @if($row_empty_show)
                            <tr>
                                <td class="setW03"></td>
                                <td class="bgGray setW02"></td>
                                @foreach($data_001['report_round']['rounds'] as $round)
                                <td class="w50p"></td>
                                @endforeach
                                <td class="w35p mw80"></td>
                                <td class="lineGrayL bgGray01"></td>
                            </tr>
                        @endif
                    </table>
                    {{-- Team 2 --}}
                    <table class="tblReportMatch lineGrayT w50">
                        @isset($data_001['report_round']['member_caculator_args']['team_right'])
                            @foreach ($data_001['report_round']['member_caculator_args']['team_right'] as $member)
                            <tr>
                                <td class="wGK">{{ @$position_label[$member['position']] }}</td>
                                @php
                                $goal_right_total = 0;
                                $goal_right_col   = '';
                                foreach(array_reverse($data_001['report_round']['rounds']) as $round) {
                                    $goal_right_total += @$data_001['report_round']['goal'][$member['member_id']][$round] ?? 0;
                                    $goal_right_col .= "<td class=\"w50p\">".(@$data_001['report_round']['goal'][$member['member_id']][$round] ?? 0)."</td>";
                                }
                                echo "<td class=\"w35p mw80\">$goal_right_total</td>";
                                echo $goal_right_col;
                                @endphp
                                <td class="bgGray setW02">{{ $member['number_official'] }}</td>
                                <td class="setW03">{{ $member['full_name'] ?? '?' }}</td>
                            </tr>
                            @endforeach
                        @endisset
                        @isset($data_001['report_round']['goal']['anonymous_right'])
                            @foreach ($data_001['report_round']['goal']['anonymous_right'] as $anonymous_id => $anonymous_item)
                            <tr>
                                <td class="wGK">?</td>
                                @php
                                $goal_right_total = 0;
                                $goal_right_col = '';
                                foreach(array_reverse($data_001['report_round']['rounds']) as $round) {
                                    $goal_right_total += @$data_001['report_round']['goal']['anonymous_right'][$anonymous_id][$round] ?? 0;
                                    $goal_right_col .= "<td class=\"w50p\">".(@$data_001['report_round']['goal']['anonymous_right'][$anonymous_id][$round] ?? 0)."</td>";
                                }
                                echo "<td class=\"w35p mw80\">$goal_right_total</td>";
                                echo $goal_right_col;
                                @endphp
                                <td class="bgGray setW02">?</td>
                                <td class="setW03">仮選手</td>
                            </tr>
                            @endforeach
                        @endisset
                        @php
                        $row_empty_show = false;
                        if ((!empty($data_001['report_round']['member_caculator_args']['team_left']) || !empty($data_001['report_round']['goal']['anonymous_left'])) && empty($data_001['report_round']['member_caculator_args']['team_right']) && empty($data_001['report_round']['goal']['anonymous_right'])) {
                            $row_empty_show = true;
                        }
                        @endphp
                        @if($row_empty_show)
                            <tr>
                                <td class="wGK"></td>
                                <td class="w35p mw80"></td>
                                @foreach($data_001['report_round']['rounds'] as $round)
                                <td class="w50p"></td>
                                @endforeach
                                <td class="bgGray setW02"></td>
                                <td class="setW03"></td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
        {{-- Part 3 --}}
        @if(!empty($data_001['change_player_args']['team_left']) || !empty($data_001['change_player_args']['team_right']))
        <div class="blockScroll mb0 pb0" style="page-break-after: always;">
            <table class="tblReportMatch changePlayer">
                <thead>
                    <tr>
                        <th class="w105p">時間</th>
                        <th class="w165p" colspan="2">OUT 選手</th>
                        <th class="w50p"><span class="iconChange"></span></th>
                        <th class="w165p" colspan="2">IN 選手</th>
                        <th class="mw120 w120p"></th>
                        <th class="w165p" colspan="2">IN</th>
                        <th class="w50p"><span class="iconChange01"></span></th>
                        <th class="w165p" colspan="2">OUT</th>
                        <th class="w105p">TIME</th>
                    </tr>
                </thead>
            </table>
            <div class="tableGroup01">
                <table class="tblReportMatch changePlayer">
                    <tbody>
                        @php
                            $stat_id_skip = null;
                        @endphp
                        @foreach ($data_001['change_player_args']['team_left'] as $k => $stat)
                            @php
                                $change_player_in_text = '';
                                $change_player_in_num  = '';
                                if ($stat->action_id == config('constants.action_map.change_member_in.id')) {
                                    $member_fullname       = trim(($stat->member?->first_name || $stat->member?->last_name) ? $stat->member?->first_name . "  " . $stat->member?->last_name : '?');
                                    $change_player_in_text = $stat->member?->full_name;
                                    $change_player_in_num  = get_display_number($data_001['match']['type'], $stat->member?->number_official, $stat->member?->number_practice);
                                }
                                $change_player_out_text = '';
                                $change_player_out_out  = '';
                                if ($stat->action_id == config('constants.action_map.change_member_out.id')) {
                                    $member_fullname        = trim(($stat->member?->first_name || $stat->member?->last_name) ? $stat->member?->first_name . "  " . $stat->member?->last_name : '?');
                                    $change_player_out_text = $stat->member?->full_name;
                                    $change_player_out_num  = get_display_number($data_001['match']['type'], $stat->member?->number_official, $stat->member?->number_practice);

                                }
                                // next is exists
                                if (!empty($data_001['change_player_args']['team_left'][$k+1])) {
                                    $stat_next = $data_001['change_player_args']['team_left'][$k+1];
                                    // if current is "out" and next is "in"
                                    if ($stat->action_id == config('constants.action_map.change_member_out.id')
                                        && $stat_next->action_id == config('constants.action_map.change_member_in.id')
                                    ) {
                                        $change_player_in_text = $stat_next->member?->full_name;
                                        $change_player_in_num  = $data_001['match']['type'] == 1 ? $stat_next->member?->number_practice : $stat_next->member?->number_official;
                                        $stat_id_skip          = $stat_next->id;
                                    }
                                }
                                // skip next stat id
                                if ($stat_id_skip == $stat->id) {
                                    continue;
                                }
                            @endphp
                            <tr>
                                <td class="setW01 bgWhite">{{ Str::replace('_', '', $stat->created_at_round) }}：{{ Carbon\Carbon::createFromFormat('i:s', implode(':', parse_duration($stat->timer_at > 0 ? $stat->timer_at / 1000 : 0, false)))->format('i') }}分</td>
                                <td class="w50p">{{ $change_player_out_num }}</td>
                                <td class="setW01 bgWhite">{{ $change_player_out_text ?? '?' }}</td>
                                <td class="w50p bgWhite"><span class="iconChange"></span></td>
                                <td class="w50p">{{ $change_player_in_num }}</td>
                                <td class="setW01 bgWhite">{{ $change_player_in_text ?? '?' }}</td>
                            </tr>
                        @endforeach
                        @empty($data_001['change_player_args']['team_left'])
                            <tr>
                                <td class="setW01 bgWhite"></td>
                                <td class="w50p"></td>
                                <td class="setW01 bgWhite"></td>
                                <td class="w50p bgWhite"></td>
                                <td class="w50p"></td>
                                <td class="setW01 bgWhite"></td>
                            </tr>
                        @endempty
                    </tbody>
                </table>
                <span class="ttl">選手交代</span>
                <table class="tblReportMatch changePlayer">
                    <tbody>
                        @php
                            $stat_id_skip = null;
                        @endphp
                        @foreach ($data_001['change_player_args']['team_right'] as $k => $stat)
                            @php
                            $change_player_in_text = '';
                            $change_player_in_num  = '';
                            if ($stat->action_id == config('constants.action_map.change_member_in.id')) {
                                $member_fullname       = trim(($stat->member?->first_name || $stat->member?->last_name) ? $stat->member?->first_name . "  " . $stat->member?->last_name : '?');
                                $change_player_in_text = $stat->member?->full_name;
                                $change_player_in_num  = get_display_number($data_001['match']['type'], $stat->member?->number_official, $stat->member?->number_practice);

                            }
                            $change_player_out_text = '';
                            $change_player_out_num  = '';
                            if ($stat->action_id == config('constants.action_map.change_member_out.id')) {
                                $member_fullname        = trim(($stat->member?->first_name || $stat->member?->last_name) ? $stat->member?->first_name . "  " . $stat->member?->last_name : '?');
                                $change_player_out_text = $stat->member?->full_name;
                                $change_player_out_num  = get_display_number($data_001['match']['type'], $stat->member?->number_official, $stat->member?->number_practice);
                            }
                            // next is exists
                            if (!empty($data_001['change_player_args']['team_right'][$k+1])) {
                                $stat_next = $data_001['change_player_args']['team_right'][$k+1];
                                // if current is "out" and next is "in"
                                if ($stat->action_id == config('constants.action_map.change_member_out.id')
                                    && $stat_next->action_id == config('constants.action_map.change_member_in.id')
                                ) {
                                    $change_player_in_text = $stat_next->member?->full_name;
                                    $change_player_in_num  = $data_001['match']['type'] == 1 ? $stat_next->member?->number_practice : $stat_next->member?->number_official;
                                    $stat_id_skip          = $stat_next->id;
                                }
                            }
                            // skip next stat id
                            if ($stat_id_skip == $stat->id) {
                                continue;
                            }
                            @endphp
                            <tr>
                                <td class="w50p">{{ $change_player_in_num }}</td>
                                <td class="setW01 bgWhite">{{ $change_player_in_text ?? '?' }}</td>
                                <td class="w50p bgWhite"><span class="iconChange01"></span></td>
                                <td class="w50p">{{ $change_player_out_num }}</td>
                                <td class="setW01 bgWhite">{{ $change_player_out_text ?? '?' }}</td>
                                <td class="setW01 bgWhite">{{ Str::replace('_','',$stat->created_at_round) }}：{{ Carbon\Carbon::createFromFormat('i:s', implode(':',parse_duration($stat->timer_at > 0 ? $stat->timer_at / 1000 : 0, false)))->format('i') }}分</td>
                            </tr>
                        @endforeach
                        @empty($data_001['change_player_args']['team_right'])
                            <tr>
                                <td class="w50p"></td>
                                <td class="setW01 bgWhite"></td>
                                <td class="w50p bgWhite"></td>
                                <td class="w50p"></td>
                                <td class="setW01 bgWhite"></td>
                                <td class="setW01 bgWhite"></td>
                            </tr>
                        @endempty
                    </tbody>
                </table>
            </div>
        </div>
        @endif
        <div class="blockScroll pb0 mb10">
            <table class="tblReportMatch matchParameter tdBg01 setFz">
                <thead>
                    <tr>
                        <th>計</th>
                        @foreach (array_reverse($data_001['report_round']['rounds']) as $round)
                        <th>{{ str_replace('_', '', $round) }}</th>
                        @endforeach
                        <th class="w50">チーム合計</th>
                        @foreach($data_001['report_round']['rounds'] as $round)
                        <th>{{ str_replace('_', '', $round) }}</th>
                        @endforeach
                        <th>計</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Part 3 チーム合計--}}
                    @foreach ($data_001['statistics_by_teams'] as $action => $team_position)
                        <tr>
                            <td>{{ array_sum($team_position['team_left']) }}</td>
                            @foreach (array_reverse($team_position['team_left']) as $statistics_round)
                                <td class="bgWhite">{{ $statistics_round }}</td>
                            @endforeach
                            <td class="bgGray">{{ $data_001['action_label_args'][$action] ?? '' }}</td>
                            @foreach ($team_position['team_right'] as $statistics_round)
                                <td class="bgWhite">{{ $statistics_round }}</td>
                            @endforeach
                            <td>{{ array_sum($team_position['team_right']) }}</td>
                        </tr>
                    @endforeach
                    {{-- Part 3 team card --}}
                    @foreach ($data_001['two_teams_args'] as $match_teams_id => $match_teams_name)
                    <tr>
                        <td class="w150p" colspan="2">{{ $match_teams_name }}</td>
                        <td colspan="{{count($data_001['statistics_by_teams']) + 4}}" class="bgWhite left">
                            @isset($data_001['stat_by_foul_args'][$match_teams_id])
                                @foreach ($data_001['stat_by_foul_args'][$match_teams_id] as $stat)
                                @php
                                    $_number = get_display_number($data_001['match']['type'], $stat->member?->number_official, $stat->member?->number_practice);
                                    $_full_name = $stat->member?->full_name;
                                    if (in_array($stat->member_anonymous_id, [-1, -2]) && empty($stat->member?->full_name)) {
                                        $_full_name = '仮選手';
                                    }
                                    $round_by_stat = str_replace('_', '', $stat->created_at_round);
                                    $fouls_reason_for_red = [
                                        10 => 2,
                                        11 => 3,
                                        12 => 4,
                                        13 => 5,
                                        14 => 6,
                                        15 => 7,
                                    ];
                                    $color_card                    = $data_001['card_type_args'][$stat->fouls_judgment_type_id];
                                    $fouls_reason_received_card_id = $stat->fouls_reason_received_card_id;
                                    $label_card                    = '';
                                    if ($color_card == 'yellow') {
                                        $label_card = 'C';
                                    } if ($color_card == 'red') {
                                        $label_card = 'S';
                                        if ($fouls_reason_received_card_id > 9) {
                                            $fouls_reason_received_card_id = $fouls_reason_for_red[$fouls_reason_received_card_id];
                                        }
                                    }
                                    $label_card .=  $fouls_reason_received_card_id;
                                @endphp
                                <div class="round">
                                    <span class="hf">{{ $round_by_stat }}</span> :
                                    <span class="time">{{ Carbon\Carbon::createFromFormat('i:s', implode(':', parse_duration($stat->timer_at > 0 ? $stat->timer_at / 1000 : 0, false)))->format('i') }}分</span>
                                    <span class="{{ $color_card }}Card">{{ $label_card }}</span>
                                    <span class="numberPlayer mr5">{{ $_number }}</span>
                                    <span class="namePlayer">{{ $_full_name }}</span>
                                </div>
                                @endforeach
                            @endisset
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="foulNoteList" style="page-break-after: always;">
            <div class="item bg01">
                <p class="ttl">警告理由</p>
                <ul class="foulType">
                    <li>
                        <span class="yellowCard">C1</span>不明
                    </li>
                    <li>
                        <span class="yellowCard">C2</span>反スポーツ
                    </li>
                    <li>
                        <span class="yellowCard">C3</span>ラフプレイ
                    </li>
                    <li>
                        <span class="yellowCard">C4</span>異議
                    </li>
                    <li>
                        <span class="yellowCard">C5</span>繰返違反
                    </li>
                    <li>
                        <span class="yellowCard">C6</span>遅延行為
                    </li>
                    <li>
                        <span class="yellowCard">C7</span>距離不足
                    </li>
                    <li>
                        <span class="yellowCard">C8</span>無許可入去
                    </li>
                </ul>
            </div>
            <div class="item bg02">
                <p class="ttl">退場理由</p>
                <ul class="foulType">
                    <li>
                        <span class="redCard">S1</span>不明
                    </li>
                    <li>
                        <span class="redCard">S2</span>著不正
                    </li>
                    <li>
                        <span class="redCard">S3</span>乱暴
                    </li>
                    <li>
                        <span class="redCard">S4</span>つば吐き
                    </li>
                    <li>
                        <span class="redCard">S5</span>阻止（手）
                    </li>
                    <li>
                        <span class="redCard">S6</span>阻止（他）
                    </li>
                    <li>
                        <span class="redCard">S7</span>暴言
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
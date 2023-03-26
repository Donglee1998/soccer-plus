@extends('web.layouts.default', ['title' => '試合レポート'], ['pageName' => 'matchReport'])

@php
$position_key = config('constants.member_position.key');
$position_label = config('constants.member_position.label');
@endphp

@section('content')
<div class="keyv">
    <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="試合レポート">
    <h1 class="keyvTitle"><span>ゲーム記録</span>試合レポート</h1>
</div>
<div class="content">
    <div class="inner01">
        <!-- [Part 1] Thông tin trận đấu -->
        <ul class="breadscrumb">
            <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a><span>/</span></li>
            <li><a href="{{ route('web.scorebook.list') }}">ゲーム記録</a><span>/</span></li>
            <li><em>試合レポート</em></li>
        </ul>
        <div class="dateInfo">
            <p class="tag">{{ config('constants.period_aggregation.match_type.label.'.$match->type)}}</p>
            <p class="date">{{ date('Y年m月d日', strtotime($match->start_date)) }}</p>
        </div>
        @include('web.scorebook.includes.team-info')
        @include('web.scorebook.includes.score-info')
        <nav class="analysisNav">
            <a href="javascript:void(0)" class="active">
                <svg class="icon icon01">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_report" />
                </svg>
                <span>試合レポート</span>
            </a>
            <a href="{{ route('web.scorebook.matches.stat', ['matches_id' => $match->id]) }}">
                <svg class="icon icon02">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_ball" />
                </svg>
                <span>スタッツ</span>
            </a>
            <a href="{{ route('web.scorebook.matches.chart', ['matches_id' => $match->id]) }}">
                <svg class="icon icon03">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_chart" />
                </svg>
                <span>比較表</span>
            </a>
            <a href="{{ route('web.scorebook.matches.video', ['matches_id' => $match->id]) }}">
                <svg class="icon icon04">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_ytb" />
                </svg>
                <span>Play by Play Video</span>
            </a>
        </nav>
        <div class="section01">
            <!-- [Part 2] Bảng thống kê sút bóng -->
            <div class="tblScroll mb0 pb0">
                <div class="tblScroll__wrap">
                    <table class="tblReportMatch mwtblHead">
                        <thead>
                            <tr>
                                <th class="setW03" rowspan="2">選手名</th>
                                <th class="setW02" rowspan="2">番号</th>
                                <th class="mw80" colspan="{{ count($rounds) + 1 }}">シュート</th>
                                <th class="wGKHead" rowspan="2" colspan="2">ポジション</th>
                                <th class="mw80" colspan="{{ count($rounds) + 1 }}">シュート</th>
                                <th class="setW02" rowspan="2">番号</th>
                                <th class="setW03" rowspan="2">選手名</th>
                            </tr>
                            <tr>
                                @foreach($rounds as $round)
                                <th class="w50p">{{ str_replace('_', '', $round) }}</th>
                                @endforeach
                                <th class="w35p mw80">計</th>
                                <th class="w35p mw80">計</th>
                                @foreach(array_reverse($rounds) as $round)
                                <th class="w50p">{{ str_replace('_', '', $round) }}</th>
                                @endforeach
                            </tr>
                        </thead>
                    </table>
                    <div class="tableGroup">
                        <!-- starting -->
                        <table class="tblReportMatch w50">
                            <tbody>
                                @for ($i=0; $i < count($lineup1->starting); $i++)
                                <tr>
                                    <td class="setW03">{{ @$lineup1->starting[$i]['full_name'] ?? '?' }}</td>
                                    <td class="bgGray setW02">{{ @$lineup1->starting[$i]['number_official'] }}</td>
                                    @php
                                        $goal_left_total = 0;
                                        foreach($rounds as $round) {
                                        $goal_left_col = @$goal[$lineup1->starting[$i]['member_id']][$round] ?? 0;
                                        $goal_left_total += $goal_left_col;
                                            echo "<td class=\"w50p\">$goal_left_col</td>";
                                        }
                                    @endphp
                                    <td class="w35p mw80">{{ $goal_left_total }}</td>
                                    <td class="lineGrayL wGK">{{ @$position_label[$lineup1->starting[$i]['position']] }}</td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                        <table class="tblReportMatch w50">
                            <tbody>
                                @for ($i=0; $i < count($lineup1->starting); $i++)
                                <tr>
                                    <td class="wGK">{{ @$position_label[$lineup2->starting[$i]['position']] }}</td>
                                    @php
                                        $goal_right_total = 0;
                                        $goal_right_col = '';
                                        foreach(array_reverse($rounds) as $round) {
                                            $goal_right_total += @$goal[$lineup2->starting[$i]['member_id']][$round] ?? 0;
                                            $goal_right_col .= "<td class=\"w50p\">".(@$goal[$lineup2->starting[$i]['member_id']][$round] ?? 0)."</td>";
                                        }
                                        echo "<td class=\"w35p mw80\">$goal_right_total</td>";
                                        echo $goal_right_col;
                                    @endphp
                                    <td class="bgGray setW02">{{ @$lineup2->starting[$i]['number_official'] }}</td>
                                    <td class="setW03">{{@$lineup2->starting[$i]['full_name'] ?? '?'}}</td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                        <!-- list cầu thủ thay vào sân -->
                        <table class="tblReportMatch lineGrayT w50">
                        @isset($member_caculator_args['team_left'])
                            @foreach ($member_caculator_args['team_left'] as $member)
                            <tr>
                                <td class="setW03">{{ $member['full_name'] ?? '?' }}</td>
                                <td class="bgGray setW02">{{ $member['number_official'] }}</td>
                                @php
                                    $goal_left_total = 0;
                                    foreach($rounds as $round) {
                                        $goal_left_col = @$goal[$member['member_id']][$round] ?? 0;
                                        $goal_left_total += $goal_left_col;
                                        echo "<td class=\"w50p\">$goal_left_col</td>";
                                    }
                                @endphp
                                <td class="w35p mw80">{{ $goal_left_total }}</td>
                                <td class="lineGrayL wGK">{{ @$position_label[$member['position']] }}</td>
                            </tr>
                            @endforeach
                        @endisset
                        @isset($goal['anonymous_left'])
                            @foreach ($goal['anonymous_left'] as $anonymous_id => $anonymous_item)
                            <tr class="anonymous">
                                <td class="setW03">仮選手</td>
                                <td class="bgGray setW02">?</td>
                                @php
                                    $goal_left_total = 0;
                                    foreach($rounds as $round) {
                                        $goal_left_col = @$goal['anonymous_left'][$anonymous_id][$round] ?? 0;
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
                        if (
                            (
                                !empty($member_caculator_args['team_right']) || !empty($goal['anonymous_right'])
                            ) &&
                            empty($member_caculator_args['team_left']) && empty($goal['anonymous_left'])
                            ) {
                            $row_empty_show = true;
                        }
                        @endphp
                        @if($row_empty_show)
                            <tr>
                                <td class="setW03"></td>
                                <td class="bgGray setW02"></td>
                                @foreach($rounds as $round)
                                <td class="w50p"></td>
                                @endforeach
                                <td class="w35p mw80"></td>
                                <td class="lineGrayL wGK"></td>
                            </tr>
                        @endif
                        </table>
                        <table class="tblReportMatch lineGrayT w50">
                        @isset($member_caculator_args['team_right'])
                            @foreach ($member_caculator_args['team_right'] as $member)
                            <tr>
                                <td class="wGK">{{ @$position_label[$member['position']] }}</td>
                                @php
                                $goal_right_total = 0;
                                $goal_right_col = '';
                                foreach(array_reverse($rounds) as $round) {
                                    $goal_right_total += @$goal[$member['member_id']][$round] ?? 0;
                                    $goal_right_col .= "<td class=\"w50p\">".(@$goal[$member['member_id']][$round] ?? 0)."</td>";
                                }
                                echo "<td class=\"w35p mw80\">$goal_right_total</td>";
                                echo $goal_right_col;
                                @endphp
                                <td class="bgGray setW02">{{ $member['number_official'] }}</td>
                                <td class="setW03">{{ $member['full_name'] ?? '?' }}</td>
                            </tr>
                            @endforeach
                        @endisset
                        @isset($goal['anonymous_right'])
                            @foreach ($goal['anonymous_right'] as $anonymous_id => $anonymous_item)
                            <tr class="anonymous">
                                <td class="wGK">?</td>
                                @php
                                $goal_right_total = 0;
                                $goal_right_col = '';
                                foreach(array_reverse($rounds) as $round) {
                                    $goal_right_total += @$goal['anonymous_right'][$anonymous_id][$round] ?? 0;
                                    $goal_right_col .= "<td class=\"w50p\">".(@$goal['anonymous_right'][$anonymous_id][$round] ?? 0)."</td>";
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
                        if (
                            (
                                !empty($member_caculator_args['team_left']) || !empty($goal['anonymous_left'])
                            ) &&
                            empty($member_caculator_args['team_right']) && empty($goal['anonymous_right'])
                            ) {
                            $row_empty_show = true;
                        }
                        @endphp
                        @if($row_empty_show)
                            <tr>
                                <td class="wGK"></td>
                                <td class="w35p mw80"></td>
                                @foreach($rounds as $round)
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
            <!-- [Part 3] Bảng thông tin thay cầu thủ -->
            <div class="tblScroll mb0 pb0">
                <div class="tblScroll__wrap">
                @if(!empty($change_player_args['team_left']) || !empty($change_player_args['team_right']))
                <table class="tblReportMatch changePlayer">
                    <thead>
                        <tr>
                            <th class="setW04">時間</th>
                            <th class="setW04">OUT</th>
                            <th class="mw50 w50p"><span class="iconChange"></span></th>
                            <th class="setW04">IN</th>
                            <th class="mw150 w150p"></th>
                            <th class="setW04">IN</th>
                            <th class="mw50 w50p"><span class="iconChange01"></span></th>
                            <th class="setW04">OUT</th>
                            <th class="setW04">TIME</th>
                        </tr>
                    </thead>
                </table>
                <div class="tableGroup01">
                    <table class="tblReportMatch changePlayer">
                        <tbody>
                        @php
                            $stat_id_skip = null;
                        @endphp
                    @foreach ($change_player_args['team_left'] as $k => $stat)
                        @php
                        $change_player_in_text = '';
                        if ($stat->action_id == config('constants.action_map.change_member_in.id')) {
                            $member_fullname = trim(($stat->member?->first_name || $stat->member?->last_name) ? $stat->member?->first_name . "  " . $stat->member?->last_name : '?');
                            $change_player_in_text = get_display_number($match->type, $stat->member?->number_official, $stat->member?->number_practice);
                            $change_player_in_text .= ' ' . $stat->member?->full_name;
                        }
                        $change_player_out_text = '';
                        if ($stat->action_id == config('constants.action_map.change_member_out.id')) {
                            $member_fullname = trim(($stat->member?->first_name || $stat->member?->last_name) ? $stat->member?->first_name . "  " . $stat->member?->last_name : '?');
                            $change_player_out_text = get_display_number($match->type, $stat->member?->number_official, $stat->member?->number_practice);
                            $change_player_out_text .= ' ' . $stat->member?->full_name;
                        }

                        // next is exists
                        if (!empty($change_player_args['team_left'][$k+1])) {
                            $stat_next = $change_player_args['team_left'][$k+1];
                            // if current is "out" and next is "in"
                            if ($stat->action_id == config('constants.action_map.change_member_out.id')
                                && $stat_next->action_id == config('constants.action_map.change_member_in.id')
                            ) {
                                $change_player_in_text = $match->type == 1 ? $stat_next->member?->number_practice : $stat_next->member?->number_official;
                                $change_player_in_text .= ' ' . $stat_next->member?->full_name;
                                $stat_id_skip = $stat_next->id;
                            }
                        }
                        // skip next stat id
                        if ($stat_id_skip == $stat->id) {
                            continue;
                        }
                        @endphp
                            <tr class="stat_id_{{$stat->id}}">
                                <td class="setW04">{{ Str::replace('_','',$stat->created_at_round) }}：{{ implode(':',parse_duration($stat->timer_at > 0 ? $stat->timer_at / 1000 : 0, false)) }}</td>
                                <td class="setW04">{{ $change_player_out_text }}</td>
                                <td class="w50p mw50"><span class="iconChange"></span></td>
                                <td class="setW04">{{ $change_player_in_text }}</td>
                            </tr>
                    @endforeach
                        @empty($change_player_args['team_left'])
                        <tr class="">
                            <td class="setW04"></td>
                            <td class="setW04"></td>
                            <td class="w50p mw50"></td>
                            <td class="setW04"></td>
                        </tr>
                        @endempty
                        </tbody>
                    </table>
                    <p class="ttl">選手交代</p>
                    <table class="tblReportMatch changePlayer">
                        <tbody>
                        @php
                            $stat_id_skip = null;
                        @endphp
                    @foreach ($change_player_args['team_right'] as $k => $stat)
                        @php
                        $change_player_in_text = '';
                        if ($stat->action_id == config('constants.action_map.change_member_in.id')) {
                            $member_fullname = trim(($stat->member?->first_name || $stat->member?->last_name) ? $stat->member?->first_name . "  " . $stat->member?->last_name : '?');
                            $change_player_in_text = $match->type == 1 ? $stat->member?->number_practice : $stat->member?->number_official;
                            $change_player_in_text .= ' ' . $stat->member?->full_name;
                        }
                        $change_player_out_text = '';
                        if ($stat->action_id == config('constants.action_map.change_member_out.id')) {
                            $member_fullname = trim(($stat->member?->first_name || $stat->member?->last_name) ? $stat->member?->first_name . "  " . $stat->member?->last_name : '?');
                            $change_player_out_text = get_display_number($match->type, $stat->member?->number_official, $stat->member?->number_practice);
                            $change_player_out_text .= ' ' . $stat->member?->full_name;
                        }

                        // next is exists
                        if (!empty($change_player_args['team_right'][$k+1])) {
                            $stat_next = $change_player_args['team_right'][$k+1];
                            // if current is "out" and next is "in"
                            if ($stat->action_id == config('constants.action_map.change_member_out.id')
                                && $stat_next->action_id == config('constants.action_map.change_member_in.id')
                            ) {
                                $change_player_in_text = $match->type == 1 ? $stat_next->member?->number_practice : $stat_next->member?->number_official;
                                $change_player_in_text .= ' ' . $stat_next->member?->full_name;
                                $stat_id_skip = $stat_next->id;
                            }
                        }
                        // skip next stat id
                        if ($stat_id_skip == $stat->id) {
                            continue;
                        }
                        @endphp
                            <tr class="stat_id_{{$stat->id}}">
                                <td class="setW04">{{ $change_player_in_text }}</td>
                                <td  class="w50p mw50"><span class="iconChange01"></span></td>
                                <td class="setW04">{{ $change_player_out_text }}</td>
                                <td class="setW04">{{ Str::replace('_','',$stat->created_at_round) }}：{{ implode(':',parse_duration($stat->timer_at > 0 ? $stat->timer_at / 1000 : 0, false)) }}</td>
                            </tr>
                    @endforeach
                        @empty($change_player_args['team_right'])
                        <tr class="">
                            <td class="setW04"></td>
                            <td class="w50p mw50"></td>
                            <td class="setW04"></td>
                            <td class="setW04"></td>
                        </tr>
                        @endempty
                        </tbody>
                    </table>
                </div>
                @endif
                </div>
            </div>
            <!-- [Part 4] Bảng thống kê theo team cho từng hiệp -->
            <div class="blockScroll pb0 mb10">
                <table class="tblReportMatch matchParameter">
                    <thead>
                        <tr>
                            <th>計</th>
                            @foreach(array_reverse($rounds) as $round)
                            <th>{{ str_replace('_', '', $round) }}</th>
                            @endforeach
                            <th class="w25">チーム合計</th>
                            @foreach($rounds as $round)
                            <th>{{ str_replace('_', '', $round) }}</th>
                            @endforeach
                            <th>計</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($statistics_by_teams as $action => $team_position)
                            <tr>
                                <td>{{ array_sum($team_position['team_left']) }}</td>
                                @foreach (array_reverse($team_position['team_left']) as $statistics_round)
                                    <td class="bgWhite">{{ $statistics_round }}</td>
                                @endforeach
                                <td class="bgGray">{{ $action_label_args[$action] ?? '' }}</td>
                                @foreach ($team_position['team_right'] as $statistics_round)
                                    <td class="bgWhite">{{ $statistics_round }}</td>
                                @endforeach
                                <td>{{ array_sum($team_position['team_right']) }}</td>
                            </tr>
                        @endforeach
                        @php
                            $two_teams_args = [
                                $match_common_info->match->team1->id => $match_common_info->match->team1->name,
                                $match_common_info->match->team2->id => $match_common_info->match->team2->name,
                            ]
                        @endphp
                        @foreach ($two_teams_args as $match_teams_id => $match_teams_name)
                        <tr>
                            <td class="w150p" colspan="3">{{ $match_teams_name }}</td>
                            <td colspan="8" class="bgWhite left">
                                @isset($stat_by_foul_args[$match_teams_id])
                                    @foreach ($stat_by_foul_args[$match_teams_id] as $stat)
                                    @php
                                        $_number = get_display_number($match->type, $stat->member?->number_official, $stat->member?->number_practice);
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
                                        $color_card = $card_type_args[$stat->fouls_judgment_type_id];
                                        $fouls_reason_received_card_id = $stat->fouls_reason_received_card_id;
                                        $label_card = '';
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
                                        <span class="time">{{ implode(':', parse_duration($stat->timer_at > 0 ? $stat->timer_at / 1000 : 0, false)) }}分</span>
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
            <div class="foulNoteList">
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
            <a href="{{ route('web.pdf.index', ['matches_id' => $match->id]) }}" class="btnDeal style01" target="_blank">
                <span>
                    <img src="/assets/img/svg/icon_pdf.svg" alt="価格一覧">
                </span>
                試合レポート詳細をダウンロード
            </a>
        </div>
        <!-- [Part 5] Bình luận trận đấu -->
        <div class="section01">
            <h2 class="headline5 mgb40 flexStyle">
                戦評
                <a href="{{ route('web.scorebook.matches.comment.edit', ['matches_id' => $match->id]) }}" class="btnCmn02 style01">{{ $comment ? '編集する' : '戦評を記入する'}}
                    <svg class="iconArrow"><use xlink:href="/assets/img/svg/symbol-defs.svg#icon_arrow_right"></use></svg>
                </a>
            </h2>
            @if($comment)
            <table class="tableInfo reSize">
                <tbody>
                    <tr>
                        <td class="fw500 w200 bgGray01">回戦</td>
                        <td class="bgWhite">{{ $comment->title ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="fw500 bgGray01">戦評</td>
                        <td>{!! nl2br(e($comment->content ?? '')) !!}</td>
                    </tr>
                    <tr>
                        <td class="fw500 bgGray01">文責</td>
                        <td class="bgWhite">{{ $comment->name ?? '' }}</td>
                    </tr>
                </tbody>
            </table>
            @endif
        </div>
        <!-- [Part 6] Starting member -->
        <div class="section01">
            @php
                $FW = (int)$position_key['FW'];
                $MF = (int)$position_key['MF'];
                $DF = (int)$position_key['DF'];
                $GK = (int)$position_key['GK'];
                $position_args = [$FW,$MF,$DF,$GK];
            @endphp
            <h2 class="headline5 mgb40">スターティングメンバー</h2>
            <div class="lineupBox">
                <div class="memBox home">
                    <p class="info">
                        <span class="team">{{ $match_common_info->match->team1->name }}</span>
                        <span class="diagram">{{ $lineup1->pattern_name }}</span>
                    </p>
                    <div class="mapBox">
                        @foreach ($position_args as $position)
                            @if($MF == $position)
                                @isset($starting1[$position])
                                    @php
                                    $total_before_item = 0;
                                    foreach (array_reverse($lineup1->pattern['MF']) as $k => $item) {
                                        $mf_line_number = $k - 2;
                                        $mf_member_args = $starting1[$position]->reverse()->values();
                                        echo '<!-- '.$position_label[$position] . '_' . $mf_line_number . ' ' . $item .' -->';
                                        echo '<div class="row '. $position_label[$position] . '_' . $mf_line_number .'">';
                                        if($item != 0) {
                                        foreach($mf_member_args->slice($total_before_item, $item)->reverse() as $mf_member) {
                                            echo '<p class="infoMem">';
                                            echo '<span class="num">' . $mf_member['number_official'] . '</span>';
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
                                @isset($starting1[$position])
                                <!-- {{ $position_label[$position] }} -->
                                <div class="row {{ $position_label[$position] }}">
                                    @foreach($starting1[$position] as $player)
                                    <p class="infoMem">
                                        <span class="num">{{ $player['number_official'] }}</span>
                                        <span class="name">{{ $player['full_name'] }}</span>
                                    </p>
                                    @endforeach
                                </div>
                                @endisset
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="memBox away">
                    <p class="info">
                        <span class="team">{{ $match_common_info->match->team2->name }}</span>
                        <span class="diagram">{{ $lineup2->pattern_name }}</span>
                    </p>
                    <div class="mapBox">
                        @foreach ($position_args as $position)
                            @if($MF == $position)
                                @isset($starting2[$position])
                                    @php
                                    $total_before_item = 0;
                                    foreach (array_reverse($lineup2->pattern['MF']) as $k => $item) {
                                        $mf_line_number = $k - 2;
                                        $mf_member_args = $starting2[$position]->reverse()->values();
                                        echo '<!-- '.$position_label[$position] . '_' . $mf_line_number . ' ' . $item .' -->';
                                        echo '<div class="row '. $position_label[$position] . '_' . $mf_line_number .'">';
                                        if($item != 0) {
                                        foreach($mf_member_args->slice($total_before_item, $item)->reverse() as $mf_member) {
                                            echo '<p class="infoMem">';
                                            echo '<span class="num">' . $mf_member['number_official'] . '</span>';
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
                                @isset($starting2[$position])
                                <!-- {{ $position_label[$position] }} -->
                                <div class="row {{ $position_label[$position] }}">
                                    @foreach($starting2[$position] as $player)
                                    <p class="infoMem">
                                        <span class="num">{{ $player['number_official'] }}</span>
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
        </div>
        <!-- [Part 7] Box score team -->
        <div class="section01">
            <h2 class="headline5 mb20">チームスタッツ</h2>
            <div class="toggleDisplay">
                <span class="ttl">表示の切り替え /</span>
                <label class="rbCustom">
                    数値を見る
                    <input type="radio" name="team_type" value="1" checked>
                    <span class="checkmark"></span>
                </label>
                <label class="rbCustom">
                    確率を見る
                    <input type="radio" name="team_type" value="2">
                    <span class="checkmark"></span>
                </label>
            </div>
            @include('web.scorebook.includes.team-info')
            <input type="hidden" name="match_id" value="{{ request()->matches_id}}">
            <div id="team"></div>
        </div>

    </div>
</div>
<script type="text/javascript">
    window.current_page = 'scorebook_matches_report';
</script>
@endsection

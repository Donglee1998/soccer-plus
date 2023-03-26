@php
    $half_time = config('constants.half_time');
    function team_ball_control_rate($team1, $team2, $flag = false) {
        $team_rate = $team1+$team2;
        if ($team_rate) {
            if($flag == true) {
                return number_format(round($team1/($team_rate), 2) * 100);
            } else {
                return number_format(round($team2/($team_rate), 2) * 100);
            }
        }
        return 0;
    }
    $total_team1_rate = 0;
    $total_team2_rate = 0;
    $total_team1_kick = [];
    $total_team2_kick = [];
@endphp
<h2 class="headline13">時間帯支配率・ゴール・シュート</h2>
<div class="blockScroll dFlex mb30" style="page-break-after: always;">
    @foreach($ball_control_rate as $key => $value)
    @php
        $time = (int) str_replace('time_', "", $key);
        $class_nobrl = in_array($time, $half_time['1st_half_time']) ?? 'noBrL';
        $team1_rate_time = @$value['team1_rate']['ball_control'];
        $team2_rate_time = @$value['team2_rate']['ball_control'];
        $team1_rate = team_ball_control_rate($team1_rate_time,$team2_rate_time, true);
        $team2_rate = team_ball_control_rate($team1_rate_time,$team2_rate_time);
        $team1_kick = @$value['team1_rate']['kick'] ?? [];
        $team2_kick = @$value['team2_rate']['kick'] ?? [];
        // total item
        $total_team1_rate += $team1_rate_time;
        $total_team2_rate += $team2_rate_time;
        array_push($total_team1_kick, $team1_kick);
        array_push($total_team2_kick, $team2_kick);
    @endphp
    <div class="timeRateBox {{ $class_nobrl }}">
        <p class="title1">
            <span class="ttl">{{ $time }}</span>
            <span class="sub">分</span>
        </p>
        <div class="info">
            <div class="chartRate jsChartRate">
                <div class="team1" style="background-color: {{ config('constants.team_color.' . $team_color1) }}; width: {{ $team1_rate ?? 0 }}%;">
                    <p class="percent">
                        <span class="num">{{ $team1_rate ?? 0 }}</span>
                        <span class="sub">%</span>
                    </p>
                </div>
                <div class="team2" style="background-color: {{ config('constants.team_color.' . $team_color2) }}; width: {{ $team2_rate ?? 0 }}%;">
                    <p class="percent">
                        <span class="num">{{ $team2_rate ?? 0 }}</span>
                        <span class="sub">%</span>
                    </p>
                </div>
            </div>
            <div class="groupScore">
                <ul class="score">
                    @foreach($team1_kick as $kick)
                    <li class="{{$kick == 1 ? 'active' : ''}}"></li>
                    @endforeach
                </ul>
                <ul class="score">
                    @foreach($team2_kick as $kick)
                    <li class="{{$kick == 1 ? 'active' : ''}}"></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endforeach
    @php
        $total_team1 = team_ball_control_rate($total_team1_rate, $total_team2_rate, true);
        $total_team2 = team_ball_control_rate($total_team1_rate, $total_team2_rate);
    @endphp
    <div class="timeRateBox fullW">
        <p class="title1">
            <span class="ttl01">総合</span>
        </p>
        <div class="info">
            <div class="chartRate jsChartRate">
                <div class="team1" style="background-color: {{ config('constants.team_color.' . $team_color1) }}; width: {{ $total_team1 ?? 0 }}%;">
                    <p class="percent">
                        <span class="num">{{ $total_team1 ?? 0 }}</span>
                        <span class="sub">%</span>
                    </p>
                </div>
                <div class="team2" style="background-color: {{ config('constants.team_color.' . $team_color2) }}; width: {{ $total_team2 ?? 0 }}%;">
                    <p class="percent">
                        <span class="num">{{ $total_team2 ?? 0 }}</span>
                        <span class="sub">%</span>
                    </p>
                </div>
            </div>
            <div class="groupScore">
                <ul class="score">
                    @foreach($total_team1_kick as $team1_kick)
                        @foreach($team1_kick as $kick)
                        <li class="{{$kick == 1 ? 'active' : ''}}"></li>
                        @endforeach
                    @endforeach
                </ul>
                <ul class="score">
                    @foreach($total_team2_kick as $team2_kick)
                        @foreach($team2_kick as $kick)
                        <li class="{{$kick == 1 ? 'active' : ''}}"></li>
                        @endforeach
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

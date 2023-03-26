<div class="scoreInfo">
    <p class="scoreBox">{{ $match_common_info->match->team1_score }}</p>
    <div class="scoreDetail">
        @if($match_common_info->stat_score)
        @foreach ($match_common_info->stat_score as $key => $score)
        <p class="item">
            <span class="point">{{ $score['team1'] }}</span>
            <span class="time">{{ Str::replace('_','',$key) }}</span>
            <span class="point">{{ $score['team2'] }}</span>
        </p>
        @endforeach
        @endif
    </div>
    <p class="scoreBox">{{ $match_common_info->match->team2_score }}</p>
</div>
<div class="scoreInfoDetail">
    <div class="scoreBox">
        @foreach ($match_common_info->stat_goals['team1'] as $goal)
        <p class="item">
            <span class="playerName">{{ $goal['name'] }}</span> /
            <span class="time">{{ $goal['round'] }}</span>
            <span class="minute">{{ $goal['time'] }}</span>
        </p>
        @endforeach
    </div>
    <p class="scoreDetail">得点<br>選手 / 時間</p>
    <div class="scoreBox">
        @foreach ($match_common_info->stat_goals['team2'] as $goal)
        <p class="item">
            <span class="playerName">{{ $goal['name'] }}</span> /
            <span class="time">{{ $goal['round'] }}</span>
            <span class="minute">{{ $goal['time'] }}</span>
        </p>
        @endforeach
    </div>
</div>
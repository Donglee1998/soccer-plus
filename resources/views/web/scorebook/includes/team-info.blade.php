<div class="teamInfo">
    <p class="teamInfoName">
        <span class="teamColor home">
            @php
            $color = $match_common_info->match->team_color1 == 1
                ? $match_common_info->match->team1->color_home
                : $match_common_info->match->team1->color_guest;
            @endphp
            @if ($color == 1)
            <svg class="icon">
                <use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams-white" /></svg>
            @else
            <svg class="icon" style="fill: {{ config('constants.team_color.' . $color) }} !important">
                <use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams" /></svg>
            @endif
        </span>
        <span class="name">{{ $match_common_info->match->team1->name }}</span>
    </p>
    <p class="vsBox">VS</p>
    <p class="teamInfoName">
        <span class="teamColor away">
            @php
            $color = $match_common_info->match->team_color2 == 1
                ? $match_common_info->match->team2->color_home
                : $match_common_info->match->team2->color_guest;
            @endphp
            @if ($color == 1)
            <svg class="icon">
                <use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams-white" /></svg>
            @else
            <svg class="icon" style="fill: {{ config('constants.team_color.' . $color) }} !important">
                <use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams" /></svg>
            @endif
        </span>
        <span class="name">{{ $match_common_info->match->team2->name }}</span>
    </p>
</div>
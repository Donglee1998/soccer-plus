@if ($team_color == 1)
    <svg class="icon">
        <use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams-white" />
    </svg>
    @else
    <svg class="icon" style="fill: {{ config('constants.team_color.' . $team_color) }} !important">
        <use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams" /></svg>
@endif
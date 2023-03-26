@php
    $team_color1 = $match->team_color1 == 1
    ? $match->team1->color_home
    : $match->team1->color_guest;
    $team_color2 = $match->team_color2 == 1
    ? $match->team2->color_home
    : $match->team2->color_guest;
@endphp
<div class="wrapReport">
    <div class="inner03">
        <div class="groupDateInfo">
            <div class="dateInfo mb20 floatL">
                <span class="tagGray">練習試合</span>
                <span class="date">{{$match->start_date ? $match->start_date->format('Y年m月d日') : ''}}</span>
            </div>
            <div class="dateInfo mb20 right">
                <span class="tagGray">更新日</span>
                <span class="date">{{$match->updated_at ? $match->updated_at->format('Y年m月d日 H:i') : ''}}</span>
            </div>
        </div>
        @include('web.pdf_report.includes.team-in-match', ['round' => $round])

        <!--時間帯支配率・ゴール・シュート-->
        @include('web.pdf_report.includes.team-ball-control-rate', ['starting' => $starting1, 'substitute' => $substitute1, 'team_color1' => $team_color1, 'team_color2' => $team_color2])
        <div style="page-break-after: always;">
            <div class="blockScroll02">
                <div class="blockCommon1">
                    <div class="blockCol1">
                        <p class="headline14 team1">
                            <span class="icTeam">
                                @include('web.pdf_report.includes.team-shirt', ['team_color' => $team_color1])
                            </span>
                            <span class="name">{{ $match->team1->name ?? '' }}</span>
                        </p>
                        @include('web.pdf_report.includes.block-teams', ['starting' => $starting1, 'substitute' => $substitute1])
                    </div>
                    @include('web.pdf_report.includes.team-stats', ['team_1' => $team_1, 'team_2' => $team_2, 'team_color1' => $team_color1, 'team_color2' => $team_color2])
                    <div class="blockCol1">
                        <div class="headline14 team2">
                            <span class="icTeam">
                                @include('web.pdf_report.includes.team-shirt', ['team_color' => $team_color2])
                            </span>
                            <span class="name">{{ $match->team2->name ?? '' }}</span>
                        </div>
                        @include('web.pdf_report.includes.block-teams', ['starting' => $starting2, 'substitute' => $substitute2])
                    </div>
                </div>
            </div>
            @include('web.pdf_report.includes.block-comment', ['comment' => $comment])
        </div>
    </div>
</div>



























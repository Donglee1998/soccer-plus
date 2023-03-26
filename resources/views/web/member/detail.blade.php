@extends('web.layouts.default', ['title' => '選手情報'], ['pageName' => 'pageMember'])
@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="選手一覧 選手情報">
        <h1 class="keyvTitle"><span class="subTitle">選手一覧</span>選手情報</h1>
    </div>
    <div class="content">
        @php
            $color_home     = Config::get('constants.team_color.' . strval($member->team->color_home)) ?? '';
            $position       = Config::get('constants.member_position.label.' . strval($member->position)) ?? '';
            $sub_position   = Config::get('constants.member_position.label.' . strval($member->sub_position)) ?? '';
            $dominant_foot  = Config::get('constants.dominant_foot.label.' . strval($member->dominant_foot)) ?? '';
        @endphp
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a><span>/</span></li>
                <li><a href="{{ route('web.team.index') }}">チーム一覧</a><span>/</span></li>
                <li><a href="javascript:history.go(-1)">選手一覧</a><span>/</span></li>
                <li><em>選手情報</em></li>
            </ul>
            <h2 class="headline7">
                @if ( $member->team->color_home == 1)
                    <svg class="imgShirt colorWhite"><use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams-white" /></svg>
                @else
                    <svg class="imgShirt colorGreen" style="fill: {{ $color_home }} !important"><use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams" /></svg>
                @endif
                {{ $member->full_name . '(' . $member->team->name . ')' }}
            </h2>
            <div class="tableTeam">
                <table>
                    <tbody>
                        <tr>
                            <th>名前</th>
                            <td>{{ $member->full_name }}</td>
                        </tr>
                        <tr>
                            <th>生年月日</th>
                            <td>{{ $member->birthday }}</td>
                        </tr>
                        <tr>
                            <th>背番号（練習）</th>
                            <td>{{ $member->number_practice }}</td>
                        </tr>
                        <tr>
                            <th>背番号（公式）</th>
                            <td>{{ $member->number_official }}</td>
                        </tr>
                        <tr>
                            <th>ポジション</th>
                            <td>{{ $position }}</td>
                        </tr>
                        <tr>
                            <th>サブポジション</th>
                            <td>{{ $sub_position }}</td>
                        </tr>
                        <tr>
                            <th>利き足</th>
                            <td>{{ $dominant_foot }}</td>
                        </tr>
                        <tr>
                            <th>身長</th>
                            <td>{{ $member->heigh . 'cm' }}</td>
                        </tr>
                        <tr>
                            <th>体重</th>
                            <td>{{ $member->weight . 'kg' }}</td>
                        </tr>
                        <tr>
                            <th>前所属チーム</th>
                            <td>{{ $member->former_team }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p class="center">
                <a href="javascript:history.go(-1)" class="btnStrategy resetW300">
                    チーム一覧に戻る
                    <span class="positionLeft">
                        <img src="/assets/img/svg/ic_circle_left.svg" alt="チーム一覧に戻る">
                    </span>
                </a>
            </p>
        </div>
    </div>
@endsection
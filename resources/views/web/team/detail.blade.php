@extends('web.layouts.default', ['title' => 'チーム一覧'], ['pageName' => 'pageTeam'])
@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="チーム一覧 チーム情報">
        <h1 class="keyvTitle"><span class="subTitle">チーム一覧</span> チーム情報</h1>
    </div>
    <div class="content">
        @php
            $color_home     = Config::get('constants.team_color.' . strval($team->color_home));
            $color_guest    = Config::get('constants.team_color.' . strval($team->color_guest));
            $gender         = Config::get('constants.gender.' . "label." . strval($team->gender));
        @endphp
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a><span>/</span></li>
                <li><a href="{{ route('web.team.index') }}">チーム一覧</a><span>/</span></li>
                <li><em>チーム情報</em></li>
            </ul>
            <h2 class="headline7">
                @if ( $team->color_home == 1)
                    <svg class="imgShirt colorWhite"><use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams-white" /></svg>
                @else
                    <svg class="imgShirt colorGreen" style="fill: {{ $color_home }} !important"><use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams" /></svg>
                @endif
                {{ $team->name }}
            </h2>
            <div class="tableTeam">
                <table>
                    <tbody>
                        <tr>
                            <th>チーム名</th>
                            <td>{{ $team->name }}</td>
                        </tr>
                        <tr>
                            <th>略称</th>
                            <td>{{ $team->abbreviation }}</td>
                        </tr>
                        <tr>
                            <th>チームカラー</th>
                            <td>
                                <div class="boxTeamColor">
                                    <div class="item">
                                        <span>ホーム</span>
                                        @if ( $team->color_home == 1)
                                            <svg class="imgShirt colorWhite"><use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams-white" /></svg>
                                        @else
                                            <svg class="imgShirt colorGreen" style="fill: {{ $color_home }} !important"><use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams" /></svg>
                                        @endif
                                    </div>
                                    <div class="item">
                                        <span>/　アウェイ</span>
                                        @if ( $team->color_guest == 1)
                                            <svg class="imgShirt colorWhite"><use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams-white" /></svg>
                                        @else
                                            <svg class="imgShirt colorGreen" style="fill: {{ $color_guest }} !important"><use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams" /></svg>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>チーム性別</th>
                            <td>{{ $gender }}</td>
                        </tr>
                        <tr>
                            <th>ホームタウン</th>
                            <td>{{ $team->hometown }}</td>
                        </tr>
                        <tr>
                            <th>監督</th>
                            <td>{{ $team->supervisor }}</td>
                        </tr>
                        <tr>
                            <th>コーチ</th>
                            <td>{{ $team->coach }}</td>
                        </tr>
                        <tr>
                            <th>マネージャー</th>
                            <td>{{ $team->manager }}</td>
                        </tr>
                        <tr>
                            <th>トレーナー</th>
                            <td>{{ $team->trainer }}</td>
                        </tr>
                        <tr>
                            <th>説明</th>
                            <td class="h140">{!! nl2br(e($team->explanation)) !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p class="center">
                <a href="{{ route('web.team.index') }}" class="btnStrategy resetW300">
                    チーム一覧に戻る
                    <span class="positionLeft">
                        <img src="/assets/img/svg/ic_circle_left.svg" alt="チーム一覧に戻る">
                    </span>
                </a>
            </p>
        </div>
    </div>
@endsection

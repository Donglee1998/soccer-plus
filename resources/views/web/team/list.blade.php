@extends('web.layouts.default', ['title' => 'チーム一覧'], ['pageName' => 'pageTeam'])
@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="チーム一覧">
        <h1 class="keyvTitle">チーム一覧</h1>
    </div>
    <div class="content">
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a><span>/</span></li>
                <li><em>チーム一覧</em></li>
            </ul>

            @if (count($teams))
                <ul class="listTeams">
                    @foreach ($teams as $team)
                        @php
                            $color_home = Config::get('constants.team_color.' . strval($team->color_home));
                        @endphp
                        <li class="item">
                            <div class="blockTop">
                                @if ( $team->color_home == 1)
                                    <svg class="imgShirt colorWhite"><use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams-white" /></svg>
                                @else
                                    <svg class="imgShirt colorGreen" style="fill: {{ $color_home }} !important"><use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams" /></svg>
                                @endif
                                <h3 class="title">{{ $team->name }}{{ $team->is_home ? '（マイチーム）' : '' }}</h3>
                            </div>
                            <div class="blockBtm">
                                <a href="{{ route('web.team.show', ['id' => $team->id]) }}" class="btnCmn02">
                                    チーム情報
                                    <svg class="iconArrow"><use xlink:href="/assets/img/svg/symbol-defs.svg#icon_arrow_right" /></svg>
                                </a>
                                <a href="{{ route('web.team.member', $team->id ?? '') }}" class="btnCmn02">
                                    選手情報
                                    <svg class="iconArrow"><use xlink:href="/assets/img/svg/symbol-defs.svg#icon_arrow_right" /></svg>
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>
                {!! $teams->appends(request()->all())->links('web.commons.pagination') !!}
            @else
                <p class="alert">チームデータがありません。</p>
                <!-- / .search alert when no item -->
            @endif
        </div>
    </div>
@endsection
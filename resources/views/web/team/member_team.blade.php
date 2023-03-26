@extends('web.layouts.default', ['title' => 'チーム一覧'], ['pageName' => 'pageTeam'])
@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="チーム一覧 選手情報 ">
        <h1 class="keyvTitle"><span class="subTitle">チーム一覧</span> 選手情報</h1>
    </div>
    <div class="content">
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a><span>/</span></li>
                <li><a href="{{ route('web.team.index') }}">チーム一覧</a><span>/</span></li>
                <li><em>選手情報</em></li>
            </ul>
            @if (count($list_member))
                <table class="tblList tbCenter">
                    <tbody>
                        <tr>
                            <th class="wid50">No.</td>
                            <th class="wid57">POS</th>
                            <th class="title left">選手</th>
                        </tr>
                        @foreach ($list_member as $member)
                            @php
                                $position = Config::get('constants.member_position.' . "label." . strval($member->position));
                            @endphp
                            <tr>
                                <td>{{ $member->number_official ?? '' }}</td>
                                <td>{{ $position ?? '' }}</td>
                                <td class="left wb">
                                    <a href="{{ route('web.team.member.show', ['team' => $member->team_id, 'member' => $member->id]) }}">{{ $member->first_name }} {{ $member->last_name }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            {!! $list_member->appends(request()->all())->links('web.commons.pagination') !!}
            @else
                <p class="alert">チームデータがありません。</p>
                <!-- / .search alert when no item -->
            @endif
            <p class="center mg-t">
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
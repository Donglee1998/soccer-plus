@php
    $title       = '自チーム情報 詳細/編集';
    $colors      = Config::get('constants.team_color');
    $color_home  = @$colors[$data['color_home']];
    $color_guest = @$colors[$data['color_guest']];
@endphp
@extends('admin.layouts.default', ['title' => $title])

@section('content')
<section class="section">
    <h2 class="headline headlineFix"><span>{{ $title }}</span></h2>
    <div class="btn-group-act clearfix">
        <a href="{{ route('admin.team.member', ['id' => $data->id]) }}" class="leftBox blue mt10 button">選手一覧</a>
    </div>

    <x-admin.admin-form-errors :errors="$errors" />
    <x-admin.admin-form method="post" showBtnSubmit='hidden'>
        <table class="sheet mb20" id="registration">
            <input type="hidden" name="data[id]" value="{{old('data.id', $data['id'] ?? '')}}">
            <input type="hidden" name="data[color_home]" value="{{old('data.color_home', $data['color_home'] ?? '')}}">
            <input type="hidden" name="data[color_guest]" value="{{old('data.color_guest', $data['color_guest'] ?? '')}}">
            <x-admin.admin-form-text label="チーム名" require="true" name="data[name]" :value="old('data.name', @$data['name'])"/>
            <tr class="titleTxt">
                <th class="left w20">チームカラー<span class="red">[必須]</span></th>
                <td>
                    <div class="boxTeamColor">
                        <div class="item">
                            <div class="txtLabel">ホーム</div>
                            <div class="img openModal" data-team="color_home">
                                @if ( $data->color_home == 1)
                                    <svg class="imgShirt colorWhite"><use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams-white" /></svg>
                                @else
                                    <svg class="imgShirt colorGreen" style="fill: {{ $color_home }} !important"><use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams" /></svg>
                                @endif
                            </div>
                        </div>
                        <div class="item">
                            <div class="txtLabel">アウェイ</div>
                            <div class="img openModal" data-team="color_guest">
                                @if ( $data->color_guest == 1)
                                    <svg class="imgShirt colorWhite"><use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams-white" /></svg>
                                @else
                                    <svg class="imgShirt colorGreen" style="fill: {{ $color_guest }} !important"><use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams" /></svg>
                                @endif
                            </div>
                        </div>
                    </div>
                </td>
            </tr>

        </table>
        <div class="dFlex center">
            <button type="submit" onclick="this.form.action='{{ route('admin.team.confirm', ['id' => @$data['id']]) }}'" name="submit" value="confirm" data-action="save" id="buttonSubmit" class="auto button inlineBlock blue2 mb0">確認画面へ</button>
        </div>
    </x-admin.admin-form>
    <div class="modalTeam">
        <h2 class="title">ホームカラー選択</h2>
        <div class="blockContent">
            @foreach($colors as $key => $color)
            <div class="selectColor">
                <input id="radio-{{ $key }}" name="team_color" type="radio" value="{{ $key }}">
                <label for="radio-{{ $key }}" class="checkMark"></label>
            </div>
            @endforeach
        </div>
        <div class="blockBtn">
            <button class="cancel btnClose">キャンセル</button>
            <button class="submitColor">OK</button>
        </div>
    </div>
</section>
<div class="overlay"></div>
@endsection
@push('script')
    <script type="text/javascript">
        let colors = {!! json_encode($colors) !!}
    </script>
    <script type="module" src="{{ get_file_version('/assets/admin/js/views/team.js') }}"></script>
@endpush

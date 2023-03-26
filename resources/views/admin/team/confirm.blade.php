@extends('admin.layouts.default', ['title' => '自チーム情報 詳細/編集'])
@php
    $colors      = Config::get('constants.team_color');
    $color_home  = @$colors[$data['color_home']];
    $color_guest = @$colors[$data['color_guest']];
@endphp
@section('content')
    <section class="section">
        <h2 class="headline headlineFix mb20"><span>自チーム情報 詳細/編集</span></h2>
        <x-admin.admin-form-errors :errors="$errors"/>
        <x-admin.admin-form-confirm  method="post" action="{{ route('admin.team.store', ['id' => isset($data['id']) ? $data['id'] : '']) }}" btn-submit="保存する">
            <table class="sheet mb20">
                <input type="text" hidden name="data[id]" value="{{ $data['id'] }}">
                <input type="hidden" name="data[color_home]" value="{{ $data['color_home'] }}">
                <input type="hidden" name="data[color_guest]" value="{{ $data['color_guest'] }}">
                <x-admin.admin-form-confirm-field label="チーム名" require="true" name="data[name]" :value="$data['name']"/>
                
                <tr class="titleTxt">
                <th class="left w20">プレミアム契約<span class="red">[必須]</span></th>
                <td>
                    <div class="boxTeamColor">
                        <div class="item">
                            <div class="txtLabel">ホーム</div>
                            <div class="img openModal" data-team="color_home">
                                @if ( $data['color_home'] == 1)
                                    <svg class="imgShirt colorWhite"><use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams-white" /></svg>
                                @else
                                    <svg class="imgShirt colorGreen" style="fill: {{ $color_home }} !important"><use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams" /></svg>
                                @endif
                            </div>
                        </div>
                        <div class="item">
                            <div class="txtLabel">アウェイ</div>
                            <div class="img openModal" data-team="color_guest">
                                @if ( $data['color_guest'] == 1)
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
        </x-admin-form-confirm>
    </section>
@endsection

@php
    $title = '選手 詳細/編集';
    $member_position = config('constants.member_position.label');
    $member_position = \Arr::set($member_position, '0','未選択');
@endphp
@extends('admin.layouts.default', ['title' => $title])

@section('content')
<section class="section">
    <h2 class="headline headlineFix mb20"><span>{{ $title }}</span></h2>
    <x-admin.admin-form-errors :errors="$errors" />
    <x-admin.admin-form method="post" showBtnSubmit='hidden' action="{{ route('admin.member.confirm', ['team_id' => $data['team_id'], 'member_id' => @$data['id']]) }}">
        <input type="text" hidden name="data[id]" value="{{old('data.id', $data['id'] ?? '')}}">
        <table class="sheet mb20" id="registration">
            <tr>
                <th>名前</th>
                <td>
                    <input type="text" name="data[first_name]" value="{{old('data.first_name', @$data['first_name'])}}">
                    <input type="text" name="data[last_name]" value="{{old('data.last_name', @$data['last_name'])}}">
                </td>
            </tr>
            <x-admin.admin-form-text label="生年月日" name="data[birthday]" :value="old('data.birthday', @$data['birthday'])" class="datepicker"/>
            <x-admin.admin-form-text label="背番号(公式)" require="true" name="data[number_official]" :value="old('data.number_official', @$data['number_official'])" class="numberOfficial"/>
            <x-admin.admin-form-text label="背番号(練習)" require="true" name="data[number_practice]" :value="old('data.number_practice', @$data['number_practice'])" class="numberPractice"/>
            <x-admin.admin-form-radio label="ポジション" name="data[position]" :value="old('data.position', @$data['position'])" :option="$member_position"/>
            <x-admin.admin-form-radio label="サブポジション" name="data[sub_position]" :value="old('data.sub_position', @$data['sub_position'])" :option="$member_position"/>
            <x-admin.admin-form-radio label="利き足" name="data[dominant_foot]" :value="old('data.dominant_foot', @$data['dominant_foot'])" :option="config('constants.dominant_foot.label')"/>
            <x-admin.admin-form-text label="身長" name="data[height]" :value="old('data.height', @$data['height'])" :attribute="['example' => 'cm']"/>
            <x-admin.admin-form-text label="体重" name="data[weight]" :value="old('data.weight', @$data['weight'])" :attribute="['example' => 'kg']"/>
            <x-admin.admin-form-text label="前所属チーム" name="data[former_team]" :value="old('data.former_team', @$data['former_team'])"/>
        </table>
        <div class="dFlex center">
            <button type="submit" name="submit" value="confirm" class="auto button inlineBlock blue2 mb0">確認画面へ</button>
        </div>
    </x-admin.admin-form>
</section>
@endsection
@push('script')
    <script type="module" src="{{ get_file_version('/assets/admin/js/views/member.js') }}"></script>
@endpush


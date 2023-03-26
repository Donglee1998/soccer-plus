@php
    $title        = 'お問い合わせ 登録/編集';
    $id           = $data['id'] ?? '';
    $status_opts  = Config::get('constants.contact.status.label');
    $type_opts    = Config::get('constants.contact.app_type.label');
    $purpose_opts = Config::get('constants.contact.purpose.label');
@endphp
@extends('admin.layouts.default', ['title' => $title])

@section('content')
<section class="section">
    <h2 class="headline headlineFix mb20"><span>{{ $title }}</span></h2>
    <x-admin.admin-form-errors :errors="$errors" />
    <x-admin.admin-form-confirm method="post" action="{{ route('admin.contact.store', ['id' => $id])}}">
        <input type="hidden" name="data[type]" value="{{ $data['type'] }}">
        <table class="sheet mb20">
            <x-admin.admin-form-confirm-field label="お名前" require="true" name="data[name]" :value="old('data.name', @$data['name'])"/>
            <x-admin.admin-form-confirm-field label="メールアドレス" require="true" name="data[email]" :value="old('data.email', @$data['email'])"/>
            <x-admin.admin-form-confirm-field label="所属チーム" name="data[team]" :value="old('data.team', @$data['team'])"/>
            <x-admin.admin-form-confirm-field type="select" label="お問い合わせ目的" name="data[purpose]" :value="old('data.purpose', @$data['purpose'])" :option="$purpose_opts"/>
            @if($data['purpose'] == config('constants.contact.purpose.key.app_using'))
            <tr class="titleTxt">
                <th class="left w20">ご利用アプリ</th>
                <td>
                    <input type="hidden" name="data[app_type]" value="{{ old('data.app_type', $data['app_type'] ?? '') }}">
                    {{ @$type_opts[$data['app_type']] }}
                </td>
            </tr>
            @endif
            @if($id)
            <tr class="titleTxt">
                <th class="left w20">お問い合わせ日時</th>
                <td>
                    {{ format_date(@$data['created_at'], 'Y/m/d H:i:s') }}
                </td>
            </tr>
            @endif
            <x-admin.admin-form-confirm-field require="{{$data['type'] == config('constants.contact.type.key.admin') ? true : false}}" label="お問い合わせ内容" name="data[content]" :value="old('data.content', $data['content'] ?? '')" type="textarea"/>
            <x-admin.admin-form-confirm-field type="radio" label="対応状況" require="true" name="data[status]" :value="old('data.status', $data['status'] ?? '')" :option="$status_opts"/>
            <x-admin.admin-form-confirm-field label="対応メモ" name="data[admin_memo]" :value="old('data.admin_memo', $data['admin_memo'] ?? '')" type="textarea"/>
        </table>
    </x-admin.admin-form-confirm>
</section>
@endsection

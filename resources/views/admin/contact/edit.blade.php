@php
    $title        = 'お問い合わせ 登録/編集';
    $status_opts  = Config::get('constants.contact.status.label');
    $type_opts    = Config::get('constants.contact.app_type.label');
    $purpose_opts = Config::get('constants.contact.purpose.label');
@endphp
@extends('admin.layouts.default', ['title' => $title])

@section('content')
<section class="section">
    <h2 class="headline headlineFix mb20"><span>{{ $title }}</span></h2>
    <x-admin.admin-form-errors :errors="$errors" />
    <x-admin.admin-form method="post" action="{{ route('admin.contact.confirm', ['id' => @$data['id']]) }}">
        <table class="sheet mb20">
            <input type="hidden" name="data[type]" value="{{ $data['type'] }}">
            <x-admin.admin-form-text label="お名前" require="true" name="data[name]" :value="old('data.name', $data['name'] ?? '')"/>
            <x-admin.admin-form-text label="メールアドレス" require="true" name="data[email]" :value="old('data.email', $data['email'] ?? '')"/>
            <x-admin.admin-form-text label="所属チーム" name="data[team]" :value="old('data.team', $data['team'] ?? '')"/>
            @if($data['type'] == config('constants.contact.type.key.admin'))
                <x-admin.admin-form-select label="お問い合わせ目的" name="data[purpose]" :value="old('data.purpose', @$data['purpose'])" :option="$purpose_opts"/>
                <tr class="titleTxt {{ old('data.purpose', @$data['purpose']) != config('constants.contact.purpose.key.app_using') ? 'noDisplay' : ''}}" id="appType">
                    <th class="left w20">ご利用アプリ</th>
                    <td>
                        <select name="data[app_type]" style="width:200px">
                            <option value="">選択してください</option>
                            @foreach($type_opts as $key => $type)
                            <option value="{{ $key }}" {{ old('data.purpose', @$data['purpose']) == $key ? 'selected' : ''}}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                @if(request()->id)
                    <x-admin.admin-form-confirm-field label="お問い合わせ日時" name="data[created_at]" :value="format_date(old('data.created_at', @$data['created_at']), 'Y/m/d H:i:s')"/>
                @endif
                <x-admin.admin-form-textarea label="お問い合わせ内容" name="data[content]" require="true" :value="old('data.content', @$data['content'])"/>
            @else
                <x-admin.admin-form-confirm-field type="select" label="お問い合わせ目的" name="data[purpose]" :value="old('data.purpose', @$data['purpose'])" :option="$purpose_opts"/>
                @if(@$data['purpose'] == config('constants.contact.purpose.key.app_using'))
                <x-admin.admin-form-confirm-field type="select" label="ご利用アプリ" name="data[app_type]" :value="old('data.app_type', @$data['app_type'])" :option="$type_opts"/>
                @endif
                <x-admin.admin-form-confirm-field label="お問い合わせ日時" name="data[created_at]" :value="format_date(old('data.created_at', @$data['created_at']), 'Y/m/d H:i:s')"/>
                <x-admin.admin-form-confirm-field type="textarea" label="お問い合わせ内容" name="data[content]" :value="old('data.content', $data['content'] ?? '')"/>
            @endif
            <x-admin.admin-form-radio label="対応状況" require="true" name="data[status]" :value="intval(old('data.status', @$data['status']) ?? '')" :option="$status_opts"/>
            <x-admin.admin-form-textarea label="対応メモ" name="data[admin_memo]" :value="old('data.admin_memo', $data['admin_memo'] ?? '')"/>
        </table>
    </x-admin-form>
</section>
@endsection

@push('script')
<script type="module" src="{{ get_file_version('/assets/admin/js/views/contact.js') }}"></script>
@endpush

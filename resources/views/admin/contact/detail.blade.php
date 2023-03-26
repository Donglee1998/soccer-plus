@php
$title        = 'お問い合わせ詳細';
$status_opts  = Config::get('constants.contact.status.label');
$type_opts    = Config::get('constants.contact.app_type.label');
$purpose_opts = Config::get('constants.contact.purpose.label');
@endphp
@extends('admin.layouts.default', ['title' => $title])

@section('content')
    <section class="section">
        <h2 class="headline headlineFix mb20"><span>{{ $title }}</span></h2>
        <table class="sheet mb20">
            <tr>
                <th style="width: 15%;">お名前</th>
                <td>{{ $contact->name}}</td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td>{{ $contact->email }}</td>
            </tr>
            <tr>
                <th>所属チーム</th>
                <td>{{ $contact->team }}</td>
            </tr>
            <tr>
                <th>お問い合わせ目的</th>
                <td>{{ $contact->purpose ? $purpose_opts[$contact->purpose] : '' }}</td>
            </tr>
            @if($contact->purpose == config('constants.contact.purpose.key.app_using'))
            <tr>
                <th>ご利用アプリ</th>
                <td>{{ $type_opts[$contact->app_type] ?? '' }}</td>
            </tr>
            @endif
            <tr>
                <th>お問い合わせ日時</th>
                <td>{{ format_date($contact->created_at, 'Y/m/d H:i:s') }}</td>
            </tr>
            <tr>
                <th>所属チーム</th>
                <td>
                    {{ $contact->content}}
                </td>
            </tr>
            <tr>
                <th>対応状況</th>
                <td>{{ $status_opts[$contact->status] ?? '' }}</td>
            </tr>
            <tr>
                <th>対応メモ</th>
                <td>
                    {{ $contact->admin_memo }}
                </td>
            </tr>
        </table>
        <div style="width:150px;" class="clearfix auto">
            <a href="{{ route('admin.contact.index') }}" class="leftBox button gray2 mr10 mb0">戻る</a>
        </div>
    </section>
@endsection

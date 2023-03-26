@php
$title = 'お問い合わせ一覧';
$status    = Config::get('constants.contact.status.label');
$app_type   = Config::get('constants.contact.app_type.label');
$class_contacts     = Config::get('constants.contact.status.class');
$status_opts = \Arr::prepend($status, 'すべて', '');
$purpose_opts = Config::get('constants.contact.purpose.label');
@endphp
@extends('admin.layouts.default', ['title' => $title])

@section('content')
    <section class="section">
        <h2 class="headline"><span>{{ $title }}</span></h2>
    </section>
     <p class="pl25 mb30">
        <a href="{{ route('admin.contact.edit') }}" class="leftBox blue mt10 button">新規登録</a>
    </p>
    <section class="section">
        <x-admin.admin-form-errors :errors="$errors" />
        <x-admin.admin-form method="get" class="searchBox pr0 pl0" showBtnSubmit="hide">
            <table class="sheet">
                <x-admin.admin-form-text label="検索" name="search" :value="old('search', request()->search)" centerLabel />
                <x-admin.admin-form-radio label="対応ステータス" name="status" :value="old('status', request()->status)" :option="$status_opts" centerLabel="true" />
                <tr>
                    <td colspan="2" class="pa10">
                        <button type="submit" class="button blue auto mb0">検索</button>
                    </td>
                </tr>
            </table>
        </x-admin-form>
    </section>
    <section class="section">
        @if (!empty($data) && count($data))
            <div class="searchBox pr0 pl0">
                @include('admin.includes.pagination_pager')
                <table class="sheet mt10">
                    <thead>
                        <tr>
                            <th class="w5"><span>ID</span></th>
                            <th class="w6"><span>対応状況</span></th>
                            <th class="w20"><span>所属チーム/お名前</span></th>
                            <th class="w20"><span>メールアドレス</span></th>
                            <th class="w20"><span>お問い合わせ目的</span></th>
                            <th class="w10"><span>ご利用アプリ</span></th>
                            <th class="w10"><span>お問い合わせ日時</span></th>
                            <th class="w6"><span>編集</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $contact)
                            <tr>
                                <td class="center">{{ $contact->id }}</td>
                                <td class="center"><span class="{{ $class_contacts[$contact->status] ?? '' }}">{{ $status[$contact->status] ?? '' }}</span></td>
                                <td class="center left">{{ ($contact->team ?  $contact->team. '/' : '') . $contact->name }}</td>
                                <td class="center">{{ $contact->email }}</td>
                                <td class="center">{{ $contact->purpose ? $purpose_opts[$contact->purpose] : '' }}</td>
                                <td class="center">{{ $app_type[$contact->app_type] ?? '' }}</td>
                                <td class="center">{{ format_date($contact->created_at, 'Y/m/d H:i:s') }}</td>
                                <td class="operate center">
                                    <a href="{{ route('admin.contact.edit', $contact->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>編集</a><br>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if ($data->total())
                {{ $data->appends(Request::query())->render('admin.common.pagination', ['paginator' => $data]) }}
            @endif
        @else
            <p class="alert">データがありません</p>
        @endif
    </section>
@endsection

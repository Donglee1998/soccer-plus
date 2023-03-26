@php
$title = '申し込み一覧';
@endphp
@extends('admin.layouts.default', ['title' => $title])

@section('content')
    <section class="section">
        <h2 class="headline"><span><i class="fas fa-teamspeak"></i> {{ $title }}</span></h2>
    </section>
    <p class="pl25 mb30">
        <a target="_blank" href="{{ route('web.entry.index') }}" class="leftBox blue mt10 button">新規登録</a>
    </p>
    <section class="section">
        <x-admin.admin-form-errors :errors="$errors" />
        <x-admin.admin-form method="get" class="searchBox pr0 pl0" showBtnSubmit="hide">
            <table class="sheet">
                <x-admin.admin-form-text label="検索" name="search" :value="old('search', request()->search)" centerLabel />
                <tr>
                    <td colspan="2" class="pa10">
                        <button type="submit" class="button blue auto mb0">検索</button>
                    </td>
                </tr>
            </table>
            </x-admin-form>
    </section>
    <section class="section">
        @if (!empty($data) && !!count($data))
            @include('admin.includes.pagination_pager')
            <div class="searchBox pr0 pl0">
                <table class="sheet">
                    <thead>
                        <tr>
                            <th class="w5"><span js-checkall>選択</span></th>
                            <th class="w5"><span>ID</span></th>
                            <th><span>チーム名</span></th>
                            <th><span>自チーム</span></th>
                            <th><span>選手一覧</span></th>
                            <th class="w15"><span>代表者</span></th>
                            <th class="w15"><span>最終更新</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $registration)
                            <tr class="{{ $key % 2 == 0 ? 'rowOdd' : '' }}">
                                <td class="center"><input js-checkitem="{{ $registration->id }}" type="checkbox">
                                </td>
                                <td class="center">{{ $registration->id }}</td>
                                <td class="center">
                                    <a
                                        href="{{ route('admin.registration.edit', ['id' => $registration->id]) }}">{{ $registration->corp_name }}</a>
                                </td>
                                <td class="center">
                                    <a href="{{ route('admin.team.edit', ['id' => $registration->team_id]) }}">編集</a>
                                </td>
                                <td class="center">
                                    <a href="{{ route('admin.team.member', ['id' => $registration->team_id]) }}">編集</a>
                                </td>
                                <td class="center">
                                    {{ $registration->name }}
                                </td>
                                <td class="center">{{ format_date($registration->updated_at, 'Y/m/d H:i') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if ($data->total())
                {{ $data->appends(Request::query())->render('admin.common.pagination', ['paginator' => $data]) }}
            @endif
            <div class="btn-group-act mt10 center">
                <button type="button" class="button blue inline" data-action="export-csv"
                    data-url="{{ route('admin.registration.exportCsv') }}">CSVダウンロード</button>
                <button type="button" class="button blue inline" data-action="mass-trash">チェックした項目を削除</button>
            </div>
        @else
            <p class="alert">データがありません</p>
        @endif
    </section>
@endsection
@push('script')
    <script type="module" src="{{ get_file_version('/assets/admin/js/views/registration.js') }}"></script>
@endpush

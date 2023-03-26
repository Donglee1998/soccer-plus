@php
$title = '選手一覧';
@endphp
@extends('admin.layouts.default', ['title' => $title])

@section('content')
    <section class="section">
        <h2 class="headline"><span><i class="fas fa-teamspeak"></i> {{ $title }}</span></h2>
    </section>
    <section class="section">
        <div class="btn-group-act">
            <a href="{{ route('admin.member.edit', ['team_id' => $team->id]) }}" class="button blue auto mb0">新規登録</a>
            <a href="#" class="button blue auto mb0 importCsv">CSVで選手情報インポート</a>
            <input type="file" name="csv" hidden class="csvFile" data-url="{{ route('admin.member.import', ['team_id' => $team->id])}}">
        </div>

        @if (!empty($data) && !!count($data))
            @include('admin.includes.pagination_pager')
            <div class="searchBox pr0 pl0">
                <table class="sheet">
                    <thead>
                        <tr>
                            <th class="w5"><span js-checkall>選択</span></th>
                            <th class="w10"><span>背番号</span></th>
                            <th><span>POS</span></th>
                            <th><span>選手</span></th>
                            <th><span></span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $member)
                            <tr class="{{ $key % 2 == 0 ? 'rowOdd' : '' }}">
                                <td class="center"><input js-checkitem="{{ $member->id }}" type="checkbox">
                                </td>
                                <td class="center">{{ $member->number_official }}</td>
                                <td class="center">
                                    {{ config('constants.member_position.label.' . $member->position) }}
                                </td>
                                
                                <td class="center">
                                    {{ $member->first_name . $member->last_name}}
                                </td>
                                <td class="center">
                                    <a href="{{ route('admin.member.edit', ['team_id' => $team->id, 'member_id' => $member->id]) }}">編集</a>
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
                <button type="button" class="button blue inline" data-action="mass-trash">チェックした項目を削除</button>
            </div>
        @else
            <p class="alert">データがありません</p>
        @endif
    </section>
@endsection
@push('script')
    <script type="module" src="{{ get_file_version('/assets/admin/js/views/member.js') }}"></script>
@endpush

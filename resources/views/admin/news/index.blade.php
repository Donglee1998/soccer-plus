@php
if (request()->route()->getName() == 'admin.news.index') {
    $category = 'news';
    $title = 'お知らせ一覧';
}else{
    $category = 'manual';
    $title = 'マニュアル一覧';
}
@endphp
@extends('admin.layouts.default', ['title' => $title])

@section('content')
    <section class="section">
        <h2 class="headline"><span>{{ $title }}</span></h2>
    </section>
    <p class="pl25 mb30">
        <a href="{{ route('admin.'.$category.'.edit') }}" class="leftBox blue mt10 button">新規登録</a>
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
        @if (!empty($data) && count($data))
            <div class="searchBox pr0 pl0">
                <div class="tableSelection mb10">
                    <select class="tableSelection-select">
                        <option value="0">-- 選択してしてください --</option>
                        <option value="1">公開</option>
                        <option value="2">非公開</option>
                        <option value="3">削除</option>
                    </select>
                    <button type="button" class="tableSelection-button">実行</button>
                </div>
                <p>※ 選択した項目を一括で公開にする、非公開にする、削除することができます</p>
                @include('admin.includes.pagination_pager')
                <table class="sheet mt10" id="formTable" data-sortable>
                    <thead>
                        <tr>
                            <th class="w5"><span js-checkall>選択</span></th>
                            <th class="w6"><span>ID</span></th>
                            <th class="w6"><span>公開</span></th>
                            @if($category == 'news')
                            <th class="w10"><span>公開日時</span></th>
                            @endif
                            <th class="w40"><span>タイトル</span></th>
                            @if($category == 'news')
                            <th class="w10"><span>カテゴリ</span></th>
                            @endif
                            <th class="w15"><span>最終更新</span></th>
                        </tr>
                    </thead>
                    <tbody id="{{ $category == 'manual' ? 'sort': ''}}">
                        @foreach ($data as $news)
                            <tr data-index="{{ $news->id }}" data-position="{{ $news->order }}">
                                <td class="center"><input js-checkitem="{{ $news->id }}" data-check-group="{{ \Request::get('page') ?? 1 }}" type="checkbox"></td>
                                <td class="center">{{ $news->id }}</td>
                                <td class="center">{{ convert_public($news->is_public) }}</td>
                                @if(request()->route()->getName() == 'admin.news.index')
                                <td class="center">
                                    {{ $news->public_date ? format_date($news->public_date, 'Y/m/d') : '' }}
                                </td>
                                @endif
                                <td class="center left">
                                    @php
                                    $text_draft = '（下書き）';
                                    if ($news->title) {
                                        $news_title = $news->is_draft == 1 ? $news->title . $text_draft : $news->title;
                                    } else {
                                        $news_title = $text_draft;
                                    }
                                    @endphp
                                    @if(request()->route()->getName() == 'admin.news.index')
                                    <a href="{{ route('admin.news.edit', ['id' => $news->id]) }}">{{ $news_title }}</a>
                                    @else
                                    <a href="{{ route('admin.manual.edit', ['id' => $news->id]) }}">{{ $news_title }}</a>
                                    @endif
                                </td>
                                @if($category == 'news')
                                <td class="center">{{ $news->sub_category ? config('constants.news_sub_category.label')[$news->sub_category] : '' }}</td>
                                @endif
                                <td class="center">{{ format_date($news->updated_at, 'Y/m/d H:i') }}</td>
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
@push('script')
    <script type="module" src="{{ get_file_version('/assets/admin/js/views/news.js') }}"></script>
@endpush

@push('css')
<style>
    .handle {
        min-width: 18px;
        background: #607D8B;
        height: 15px;
        display: inline-block;
        cursor: move;
    }
    .ui-sortable-helper{
        border-top: 1px solid #CCC
    }
</style>
@endpush

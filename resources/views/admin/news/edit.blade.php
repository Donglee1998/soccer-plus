@php
if ($data['category'] == config('constants.news_category.key.news')){
    $title = 'お知らせ 登録/編集';
    $route = 'admin.news.confirm';
}else{
    $route = 'admin.manual.confirm';
    $title = 'マニュアル 登録/編集';
}
@endphp
@extends('admin.layouts.default', ['title' => $title])

@section('content')
<section class="section">
    <h2 class="headline headlineFix mb20"><span>{{ $title }}</span></h2>
    <x-admin.admin-form-errors :errors="$errors" />
    <x-admin.admin-form method="post" showBtnSubmit='hidden' class="news_form" action="{{ route($route, ['id' => @$data['id']]) }}">
        <input type="hidden" name="data[category]" value="{{ @$data['category'] ?? '' }}">
        <table class="sheet mb20">
            @if(!empty($data['id']))
            <tr class="titleTxt">
                <th class="left">ID</th>
                <td>
                    {{ $data['id'] }}
                    <input type="hidden" name="data[id]" value="{{ $data['id'] ?? '' }}">
                </td>
            </tr>
            @endif
            @if($data['category'] == config('constants.news_category.key.news'))
            <x-admin.admin-form-text label="日付" require="true" name="data[public_date]" :value="old('data.public_date', $data['public_date'] ?? '')" class="datepicker" />
            <x-admin.admin-form-radio label="カテゴリ" require="true" name="data[sub_category]" :value="old('data.sub_category', $data['sub_category'] ?? '')" :option="config('constants.news_sub_category.label')" />
            @endif
            <x-admin.admin-form-text label="タイトル" require="true" name="data[title]" :value="old('data.title', $data['title'] ?? '')" />
            <input name= "data[editor_convert]" value= "" hidden/>
            <x-admin.admin-form-ckeditor label="本文" name="data[editor]" :value="old('data.editor', $data['editor'] ?? '')" id="editor"/>
            <x-admin.admin-form-radio label="公開設定" require="true" name="data[is_public]" :value="old('data.is_public', $data['is_public'] ?? '')" :option="config('constants.setting_public.label')" />
            @if($data['category'] == config('constants.news_category.key.news'))
            <x-admin.admin-form-text label="公開日時" name="data[start_date]" :value="old('data.start_date', @$data['start_date'])" class="datetimepicker" />
            <x-admin.admin-form-text label="公開終了日時" name="data[end_date]" :value="old('data.end_date', @$data['end_date'])" class="datetimepicker" />
            @endif
            <x-admin.admin-form-textarea label="更新コメント" name="data[update_comment]" :value="old('data.update_comment', $data['update_comment'] ?? '')" />
            @if(@$data['category'] == config('constants.news_category.key.manual'))
            <x-admin.admin-form-textarea label="概要" name="data[overview]" :value="old('data.overview', $data['overview'] ?? '')" />
            @endif
        </table>
        <div class="dFlex center">
            <button type="submit" name="submit" value="confirm" class="auto button inlineBlock blue2 mb0">確認画面へ</button>
            <button id="newPreview" class="auto button inlineBlock gray2 mb0">プレビュー</button>
            @if(!@$data['id'])
            <button type="submit" confirm-draft onclick="this.form.action='{{ route('admin.news.saveDraft') }}'" name="submit" value="draft" data-action="save-draft" class="auto button inlineBlock gray2 mb0">下書き保存</button>
            @endif
            @if(@$data['id'])
            <button type="button" data-url="{{ route('admin.news.trash', ['id' => $data['id']]) }}" data-action="trash" class="auto button inlineBlock gray2 mb0">削除</button>
            @endif
        </div>
    </x-admin-form>
</section>
@endsection
@push('script')
<script src="/assets/admin/js/jquery.datetimepicker.full.min.js"></script>
@include('admin.components.ckeditor-script')
<script>
    createEditor('[name="data[editor]"]');
</script>
<script type="module" src="{{ get_file_version('/assets/admin/js/views/news.js') }}"></script>
@endpush
@push('css')
<link rel="stylesheet" href="{{ get_file_version('/assets/admin/ckeditor/ckeditor.css') }}">
<link rel="stylesheet" href="/assets/admin/css/jquery.datetimepicker.min.css" media="all">
@endpush

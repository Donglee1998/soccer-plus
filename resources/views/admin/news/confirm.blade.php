@php
if ($data['category'] == config('constants.news_category.key.news')){
    $title = 'お知らせ 登録/編集';
}else{
    $title = 'マニュアル 登録/編集';
}
@endphp
@extends('admin.layouts.default', ['title' => $title])

@section('content')
    <section class="section">
        <h2 class="headline headlineFix mb20"><span>{{ $title }}</span></h2>
        <x-admin.admin-form-errors :errors="$errors" />
        <x-admin.admin-form-confirm  method="post" action="{{ route('admin.news.store', ['id' => isset($data['id']) ? $data['id'] : '']) }}" btn-submit="保存する">
            <table class="sheet mb20">
                <input type="hidden" name="data[category]" value="{{ @$data['category'] ?? '' }}">
                @if(!empty($data['id']))
                <x-admin.admin-form-confirm-field label="ID" name="data[id]" :value="old('data.id', $data['id'] ?? '')" class="validate[required]" />
                @endif
                @if($data['category'] == config('constants.news_category.key.news'))
                <x-admin.admin-form-confirm-field label="日付" require="true" name="data[public_date]" :value="old('data.public_date', $data['public_date'] ?? '')" class="validate[required]" />
                <x-admin.admin-form-confirm-field type="radio" label="カテゴリ" require="true" name="data[sub_category]" :value="old('data.sub_category', $data['sub_category'] ?? '')" :option="config('constants.news_sub_category.label')" class="validate[required]" />
                @endif
                <x-admin.admin-form-confirm-field label="タイトル" require="true" name="data[title]" :value="old('data.title', $data['title'] ?? '')" class="validate[required]" />
                <x-admin.admin-form-confirm-field type="textarea_ckeditor" label="本文" name="data[editor]" :value="old('data.editor', $data['editor'] ?? '')" />
                <x-admin.admin-form-confirm-field type="radio" label="公開設定" require="true" name="data[is_public]" :value="old('data.is_public', $data['is_public'] ?? '')" :option="config('constants.setting_public.label')" class="validate[required]" />
                @if($data['category'] == config('constants.news_category.key.news'))
                <x-admin.admin-form-confirm-field label="公開日時" name="data[start_date]" :value="old('data.start_date', $data['start_date'] ?? '')" class="datetimepicker" />
                <x-admin.admin-form-confirm-field label="公開終了日時" name="data[end_date]" :value="old('data.end_date', $data['end_date'] ?? '')" class="datetimepicker" />
                @endif
                <x-admin.admin-form-confirm-field type="textarea" label="更新コメント" name="data[update_comment]" :value="old('data.update_comment', $data['update_comment'] ?? '')" />
                @if(@$data['category'] == config('constants.news_category.key.manual'))
                <x-admin.admin-form-confirm-field type="textarea" label="概要" name="data[overview]" :value="old('data.overview', $data['overview'] ?? '')" />
                @endif
            </table>
        </x-admin-form-confirm>
    </section>
@endsection
@push('css')
<link rel="stylesheet" href="{{ get_file_version('/assets/admin/ckeditor/ckeditor.css') }}">
@endpush

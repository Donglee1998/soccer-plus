@extends('web.layouts.default', ['title' => $manual->title], ['pageName' => 'pageManual'])
@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="マニュアル">
        <h1 class="keyvTitle">マニュアル</h1>
    </div>
    <div class="content">
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a><span>/</span></li>
                <li><em><a href="{{ route('web.manual.list') }}">マニュアル</a><span>/</span></li>
                <li><em>{{ $manual->title }}</em></li>
            </ul>
            <div class="procedureBlock">
                <p class="procedureTxt01">SOCCER PLUS 操作説明マニュアル</p>
                <h2 class="headline12">{{ $manual->title }}</h2>
                <p class="procedureTxt02">{!! nl2br(e($manual->overview)) !!}</p>
            </div>
            <div class="ck-content">
                {!! $manual->editor !!}
            </div>
        </div>
    </div>
@endsection
@push('css')
<link rel="stylesheet" href="{{ get_file_version('/assets/admin/ckeditor/ckeditor.css') }}">
@endpush
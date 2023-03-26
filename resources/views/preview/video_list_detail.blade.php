@extends('web.layouts.default', ['title' => '動画一覧'], ['pageName' => 'videoList'])
@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="プレミアチームのご案内">
        <h1 class="keyvTitle">動画一覧</h1>
    </div>
    <div class="content pbSp30">
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt="home"></a><span>/</span></li>
                <li><em>動画一覧</em></li>
            </ul>
            <h2 class="headline4 style01">
                <span class="txt">test video</span>
                <span id="edit_name_folder" class="btnEdit">
                    <svg class="icon">
                        <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_pen" />
                    </svg>
                </span>
            </h2>
            <div class="blockVideo center">
                <div class="video">
                    <video controls="" id="myvideo">
                        <source src="{{ config('filesystems.disks.s3.url') }}/video/不具合No.256証跡.MP4" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </div>
@endsection

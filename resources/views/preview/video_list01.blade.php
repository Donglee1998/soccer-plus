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
            <div class="blockUpload mb30">
                <ul class="blockUpload__name">
                    <li>
                        <span class="ttl">フォルダ名</span>
                        <input type="text" placeholder="フォルダ名を入力して下さい">
                    </li>
                </ul>
                <span class="btnUpload">
                    <em class="add">フォルダを追加</em>
                </span>
            </div>
            <table class="tblList handledCheckCtrl">
                <tr>
                    <th class="wid48">
                        <label class="cbCustom">
                            <input type="checkbox">
                            <span class="checkmark jsCheckAll"></span>
                        </label>
                    </th>
                    <th>フォルダ名</th>
                </tr>
                <tr>
                    <td>
                        <label class="cbCustom jsChecked">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                    <td><a href="/preview/video_list02">フォルダA</a></td>
                </tr>
                <tr>
                    <td>
                        <label class="cbCustom jsChecked">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                    <td><a href="/preview/video_list02">フォルダB</a></td>
                </tr>
                <tr>
                    <td>
                        <label class="cbCustom jsChecked">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                    <td><a href="/preview/video_list02">フォルダC</a></td>
                </tr>
                <tr>
                    <td>
                        <label class="cbCustom jsChecked">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                    <td><a href="/preview/video_list02">フォルダD</a></td>
                </tr>
                <tr>
                    <td>
                        <label class="cbCustom jsChecked">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                    <td><a href="/preview/video_list02">フォルダE</a></td>
                </tr>
            </table>
            <p class="center">
                <a href="#" class="btnStrategy">
                    チェックしたフォルダを削除
                    <span>
                        <img src="/assets/img/svg/ic_circle_check.svg" alt="アイコン丸チェック">
                    </span>
                </a>
            </p>
            <div class="pager">
        <span class="pagerOlderLink">
            <a class="btnPagerCmn" href="#">
                <svg class="iconArrow">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_prev" />
                </svg>
                前へ
            </a>
        </span>

        <div class="pagerPagination">
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
        </div>

        <span class="pagerPaginationSP">
            <span>1</span> / <span>3</span>
        </span>

        <span class="pagerNewerLink">
            <a class="btnPagerCmn active" href="#">
                次へ
                <svg class="iconArrow">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_next" />
                </svg>
            </a>
        </span>
    </div>
        </div>
    </div>
@endsection

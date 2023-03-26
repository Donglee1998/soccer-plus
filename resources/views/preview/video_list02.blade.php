@extends('web.layouts.default', ['title' => '動画フォルダ'], ['pageName' => 'videoList'])
@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="プレミアチームのご案内">
        <h1 class="keyvTitle pcDisplay"><span>動画一覧</span>フォルダ情報</h1>
        <h1 class="keyvTitle spDisplay"><span>動画一覧</span>動画情報</h1>
    </div>
    <div class="content">
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt="home"></a><span>/</span></li>
                <li><a href="/preview/video_list01">動画一覧</a><span>/</span></li>
                <li class="pcDisplay"><em>フォルダA</em></li>
                <li class="spDisplay"><em>動画情報</em></li>
            </ul>
            <h2 class="headline4">フォルダA</h2>
            <div class="blockUpload">
                <ul class="blockUpload__name">
                    <li>
                        <span class="ttl">動画ファイル</span>
                        <span class="cusInputFile center active">
                            <input type="file" accept="video/*"></input>
                            <span class="subTxt">ファイルを選択</span>
                        </span>
                    </li>
                    <li>
                        <span class="ttl">動画タイトル</span>
                        <input type="text" class="center">
                    </li>
                </ul>
                <span class="btnUpload">
                    <em class="add">動画を追加</em>
                </span>
            </div>
            <div class="blockProgress">
                <div class="progressBar">
                    <span class="progressBar__ttl">ディスク使用状況</span>
                    <span class="progressBar__percent">
                        <span class="percent"></span>
                    </span>
                </div>
                <div class="progressDetail">
                    <span class="progressDetail__txt purple">使用領域：〇〇〇 MB</span> / <span class="progressDetail__txt">空き領域：〇〇〇〇〇 MB</span>
                </div>
            </div>
            <table class="tblList handledCheckCtrl">
                <tr>
                    <th class="wid48">
                        <label class="cbCustom">
                            <input type="checkbox">
                            <span class="checkmark jsCheckAll"></span>
                        </label>
                    </th>
                    <th class="wid110 center">サムネイル</th>
                    <th>動画タイトル</th>
                </tr>
                <tr>
                    <td>
                        <label class="cbCustom jsChecked">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                    <td class="rePadd">
                        <a href="#">
                            <img src="/assets/img/thumbnail/img_thumbnail01.jpg" alt="home">
                        </a>
                    </td>
                    <td>動画タイトルA</td>
                </tr>
                <tr>
                    <td>
                        <label class="cbCustom jsChecked">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                    <td class="rePadd">
                        <a href="#">
                            <img src="/assets/img/thumbnail/img_thumbnail01.jpg" alt="home">
                        </a>
                    </td>
                    <td>動画タイトルB</td>
                </tr>
                <tr>
                    <td>
                        <label class="cbCustom jsChecked">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                    <td class="rePadd">
                        <a href="#">
                            <img src="/assets/img/thumbnail/img_thumbnail01.jpg" alt="home">
                        </a>
                    </td>
                    <td>動画タイトルC</td>
                </tr>
                <tr>
                    <td>
                        <label class="cbCustom jsChecked">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                    <td class="rePadd">
                        <a href="#">
                            <img src="/assets/img/thumbnail/img_thumbnail01.jpg" alt="home">
                        </a>
                    </td>
                    <td>動画タイトルD</td>
                </tr>
                <tr>
                    <td>
                        <label class="cbCustom jsChecked">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                    <td class="rePadd">
                        <a href="#">
                            <img src="/assets/img/thumbnail/img_thumbnail01.jpg" alt="home">
                        </a>
                    </td>
                    <td>動画タイトルE</td>
                </tr>
            </table>
            <p class="center">
                <a href="#" class="btnStrategy">
                    チェックした動画を削除
                    <span>
                        <img src="/assets/img/svg/ic_circle_check.svg" alt="アイコン丸チェック">
                    </span>
                </a>
            </p>
        </div>
    </div>
@endsection

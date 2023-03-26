@extends('web.layouts.default', ['title' => 'Play by Play Video'], ['pageName' => 'playByPlay'])
@section('content')
<div class="keyv">
    <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="プレミアチームのご案内">
    <h1 class="keyvTitle"><span>ゲーム記録</span>Play by Play Video</h1>
</div>
<div class="content">
    <div class="inner01">
        <ul class="breadscrumb">
            <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a><span>/</span></li>
            <li><a href="/preview/scorebook01">ゲーム記録</a><span>/</span></li>
            <li><em>Play by Play Video</em></li>
        </ul>
        <div class="dateInfo">
            <p class="tag">練習試合</p>
            <p class="date">2022年7月4日</p>
        </div>
        <div class="teamInfo">
            <p class="teamInfoName">
                <span class="teamColor home">
                    <svg class="icon">
                        <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_color_team" /></svg>
                </span>
                <span class="name">池袋〇〇〇〇〇〇</span>
            </p>
            <p class="vsBox">VS</p>
            <p class="teamInfoName">
                <span class="teamColor away">
                    <svg class="icon">
                        <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_color_team" />
                    </svg>
                </span>
                <span class="name">池袋〇〇〇〇〇〇</span>
            </p>
        </div>
        <div class="scoreInfo">
            <p class="scoreBox">2</p>
            <div class="scoreDetail">
                <p class="item">
                    <span class="point">1</span>
                    <span class="time">1ST</span>
                    <span class="point">1</span>
                </p>
                <p class="item">
                    <span class="point">1</span>
                    <span class="time">2ND</span>
                    <span class="point">0</span>
                </p>
            </div>
            <p class="scoreBox">1</p>
        </div>
        <nav class="analysisNav">
            <a href="/preview/scorebook02">
                <svg class="icon icon01">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_report" />
                </svg>
                <span>試合レポート</span>
            </a>
            <a href="/preview/scorebook03">
                <svg class="icon icon02">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_ball" />
                </svg>
                <span>スタッツ</span>
            </a>
            <a href="/preview/scorebook05">
                <svg class="icon icon03">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_chart" />
                </svg>
                <span>比較表</span>
            </a>
            <a href="#" class="active">
                <svg class="icon icon04">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_ytb" />
                </svg>
                <span>Play by Play Video</span>
            </a>
        </nav>
        <div class="timeTab tabArea">
            <nav class="timeTabInfo tab">
                <a href="#tab01" class="active">
                    <svg class="icon">
                        <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_arrow_down" />
                    </svg>
                    <span>1ST</span>
                </a>
                <a href="#tab02">
                    <svg class="icon">
                        <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_arrow_down" />
                    </svg>
                    <span>2ND</span></a>
                <a href="#tab03">
                    <svg class="icon">
                        <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_arrow_down" />
                    </svg>
                    <span>3RD</span></a>
                <a href="#tab04">
                    <svg class="icon">
                        <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_arrow_down" />
                    </svg>
                    <span>4TH</span></a>
            </nav>
            <div class="timeTabContent tabContents">
                <div id="tab01" class="tabBox">
                    <div class="uploadBox">
                        <input id="uploadVideo" type="file" accept="video/*">
                        <p class="ttl pcDisplay">動画ファイルを<br>ドロップしてアップロード</p>
                        <p class="ttl spDisplay">動画ファイルをアップロード</p>
                        <p class="txt">または</p>
                        <label for="uploadVideo" class="fileUpload">
                            <span>ファイルを選択</span>
                        </label>
                        <p class="note">最大アップロードサイズ:<span>○○ MB</span></p>
                        <a href="javascript:void(0)" class="btnOpenPopup">アップロード済みの動画から選択する</a>
                    </div>
                    <form action="">
                        <div class="playControl col2">
                            <div class="item">
                                <div class="groupCtrl">
                                    <select name="" id="" class="formControl">
                                        <option value="">並び順を選択</option>
                                    </select>
                                    <select name="" id="" class="formControl">
                                        <option value="">選手を選択</option>
                                    </select>
                                </div>
                            </div>
                            <div class="item">
                                <div class="groupCtrl">
                                    <a class="btnCtrl" href="">チェックしたプレイを再生</a>
                                    <a class="btnCtrl" href="">再生時間の一括変更</a>
                                </div>
                            </div>
                        </div>
                        <!-- <video controls autoplay>
                            <source src="https://download.blender.org/peach/bigbuckbunny_movies/BigBuckBunny_320x180.mp4" type="video/mp4">
                            <source src="movie.ogg" type="video/ogg">
                            Your browser does not support the video tag.
                        </video> -->
                        <div class="dataTimeContent">
                            <p class="ttl">1ST</p>
                            <div class="blockScroll">
                                <table class="tblList style01 mb0 handledCheckCtrl">
                                    <tr>
                                        <th class="w5">
                                            <label class="cbCustom">
                                                <input type="checkbox">
                                                <span class="checkmark jsCheckAll"></span>
                                            </label>
                                        </th>
                                        <th class="w6">TIME</th>
                                        <th>池袋〇〇〇〇〇〇</th>
                                        <th class="w6 textCenter">GOAL</th>
                                        <th>東京〇〇〇〇〇〇</th>
                                        <th class="w10">再生時間</th>
                                        <th class="w10 textCenter">操作</th>
                                    </tr>
                                    <tr>
                                        <td class="rePadding jsChecked">
                                            <label class="cbCustom">
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td>00:50</td>
                                        <td>6 / 遠藤 航 / ドリブル成功</td>
                                        <td class="textCenter"><span><img src="/assets/img/svg/ic_ball.svg" alt=""></span></td>
                                        <td></td>
                                        <td>00:00:29</td>
                                        <td>
                                            <p class="btnPlay cusLay">
                                                <a href="#" class="playType01">
                                                    <svg class="icon iconPlay">
                                                        <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_play" />
                                                    </svg>
                                                </a>
                                               <a href="#" class="editLink">編集</a>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="rePadding jsChecked">
                                            <label class="cbCustom">
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td>00:50</td>
                                        <td>6 / 遠藤 航 / ドリブル成功</td>
                                        <td></td>
                                        <td></td>
                                        <td>00:00:29</td>
                                        <td>
                                            <p class="btnPlay cusLay">
                                                <a href="#" class="playType02">
                                                    <svg class="icon iconPlay">
                                                        <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_play" />
                                                    </svg>
                                                </a>
                                               <a href="#" class="editLink">編集</a>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="rePadding jsChecked">
                                            <label class="cbCustom">
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td>00:50</td>
                                        <td>6 / 遠藤 航 / ドリブル成功</td>
                                        <td></td>
                                        <td></td>
                                        <td>00:00:29</td>
                                        <td>
                                            <p class="btnPlay cusLay">
                                                <a href="#" class="playType03">
                                                    <svg class="icon iconPlay">
                                                        <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_play" />
                                                    </svg>
                                                </a>
                                               <a href="#" class="editLink">編集</a>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="rePadding jsChecked">
                                            <label class="cbCustom">
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td>00:50</td>
                                        <td>6 / 遠藤 航 / ドリブル成功</td>
                                        <td></td>
                                        <td></td>
                                        <td>00:00:29</td>
                                        <td>
                                            <a href="#" class="btnPlay">編集</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="rePadding jsChecked">
                                            <label class="cbCustom">
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td>00:50</td>
                                        <td>6 / 遠藤 航 / ドリブル成功</td>
                                        <td></td>
                                        <td></td>
                                        <td>00:00:29</td>
                                        <td>
                                            <a href="#" class="btnPlay">編集</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <p class="center">
                            <a href="#" class="btnStrategy cus-mw pcDisplayInlineFlex">
                                チェックしたプレイの動画を解除
                                <span>
                                    <img src="/assets/img/svg/ic_circle_check.svg" alt="アイコン丸チェック">
                                </span>
                            </a>
                            <a href="#" class="btnStrategy cus-mw spDisplayInlineFlex">
                                チェックしたプレイを削除
                                <span>
                                    <img src="/assets/img/svg/ic_circle_check.svg" alt="アイコン丸チェック">
                                </span>
                            </a>
                        </p>
                    </form>
                </div>
                <div id="tab02" class="tabBox">Tab content 02</div>
                <div id="tab03" class="tabBox">Tab content 03</div>
                <div id="tab04" class="tabBox">Tab content 04</div>
            </div>
        </div>
        <div class="modal" id="myModal" role="dialog">
            <div class="modal__content">
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
                <table class="tblList handledCheckCtrl mb0">
                    <tr>
                        <th>フォルダ名</th>
                    </tr>
                    <tr>
                        <td><a href="javascript:void(0);" id="folder01">フォルダA</a></td>
                    </tr>
                    <tr>
                        <td><a href="javascript:void(0);" id="folder02">フォルダB</a></td>
                    </tr>
                    <tr>
                        <td><a href="javascript:void(0);" id="folder03">フォルダC</a></td>
                    </tr>
                    <tr>
                        <td><a href="javascript:void(0);" id="folder04">フォルダD</a></td>
                    </tr>
                    <tr>
                        <td><a href="javascript:void(0);" id="folder05">フォルダE</a></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="modal" id="myModal1" role="dialog">
            <div class="modal__content">
                <table class="tblList handledCheckCtrl mb0">
                    <tr>
                        <th>フォルダ名</th>
                    </tr>
                    <tr>
                        <td><a href="javascript:void(0);" id="folder01">フォルダA</a></td>
                    </tr>
                    <tr>
                        <td><a href="javascript:void(0);" id="folder02">フォルダB</a></td>
                    </tr>
                    <tr>
                        <td><a href="javascript:void(0);" id="folder03">フォルダC</a></td>
                    </tr>
                    <tr>
                        <td><a href="javascript:void(0);" id="folder04">フォルダD</a></td>
                    </tr>
                    <tr>
                        <td><a href="javascript:void(0);" id="folder05">フォルダE</a></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="modal" id="myModal2" role="dialog">
            <div class="modal__content">
                <table class="tblList handledCheckCtrl mb0">
                    <tr>
                        <th class="wid110 center">サムネイル</th>
                        <th>動画タイトル</th>
                    </tr>
                    <tr>
                        <td class="rePadd">
                            <a href="#">
                                <img src="/assets/img/thumbnail/img_thumbnail01.jpg" alt="home">
                            </a>
                        </td>
                        <td>動画タイトルA</td>
                    </tr>
                    <tr>
                        <td class="rePadd">
                            <a href="#">
                                <img src="/assets/img/thumbnail/img_thumbnail01.jpg" alt="home">
                            </a>
                        </td>
                        <td>動画タイトルB</td>
                    </tr>
                    <tr>
                        <td class="rePadd">
                            <a href="#">
                                <img src="/assets/img/thumbnail/img_thumbnail01.jpg" alt="home">
                            </a>
                        </td>
                        <td>動画タイトルC</td>
                    </tr>
                    <tr>
                        <td class="rePadd">
                            <a href="#">
                                <img src="/assets/img/thumbnail/img_thumbnail01.jpg" alt="home">
                            </a>
                        </td>
                        <td>動画タイトルD</td>
                    </tr>
                    <tr>
                        <td class="rePadd">
                            <a href="#">
                                <img src="/assets/img/thumbnail/img_thumbnail01.jpg" alt="home">
                            </a>
                        </td>
                        <td>動画タイトルE</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

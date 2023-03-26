@extends('web.layouts.default', ['title' => '動画再生時の編集'], ['pageName' => 'playByPlay'])
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
            <li><a href="/preview/scorebook06">Play by Play Video</a><span>/</span></li>
            <li><em>動画再生時の編集</em></li>
        </ul>
        <div class="blockFilter">
            <ul class="blockFilter__name">
                <li>
                    <span class="ttl">フォルダ名</span>
                    <select name="" id="" class="select formControl">
                        <option value="">フォルダ名がはいります</option>
                    </select>
                </li>
                <li>
                    <span class="ttl">動画</span>
                    <select name="" id="" class="select formControl">
                        <option value="">動画タイトルがはいります</option>
                    </select>
                </li>
            </ul>
        </div>
        <div id="showVideo show">
            <div class="blockVideo">
                <p class="timeVideo">動画時間: <span class="time">23:40</span></p>
                <div class="video">
                    <video controls id="myvideo">
                        <source src="" type="video/mp4">
                        <source src="" type="video/ogg">
                    </video>
                </div>
                <button class="btnDelete">
                    <svg class="icon">
                        <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_close" />
                    </svg>
                    <span class="txt">動画を削除する</span>
                </button>
            </div>
        </div>
        <h2 class="headline9"><span>9番</span> / <span>林 大地</span> / <span>ドリブル失敗</span></h2>
        <div class="timeMatch">スコア入力時
            <span class="ml20">1ST</span>
            <span>02:20</span>
        </div>
        <form action="#">
            <div class="editPlayVid">
                    <div class="item">
                        <label class="labelTxt" for="">再生時</label>
                        <div class="inputBox">
                            <input type="text" class="formControl" value="00:00:19">
                            <p class="error">error error error error</p>
                        </div>
                    </div>
                    <div class="item">
                        <label class="cbCustom style01">
                            <input type="checkbox" name="">
                            <span class="checkmark"></span>
                        </label>
                        このプレイを基準に他のプレイの再生も設定する
                    </div>
                    <div class="item">
                        <label class="labelTxt" for="">再生時</label>
                        <div class="inputBox">
                            <input type="text" class="formControl" value="00:00:56">
                            <p class="error">error error error error</p>
                        </div>
                    </div>
                    <div class="item">
                        <textarea class="formControl" name="" id="" cols="30" rows="10" placeholder="コメント記入"></textarea>
                    </div>
            </div>
            <p class="dFlex cusLay">
                <a href="{{ url()->previous() }}" class="btnStrategy bgGray resetW300">
                    キャンセル
                    <span class="positionLeft">
                        <img src="/assets/img/svg/ic_circle_left.svg" alt="キャンセル">
                    </span>
                </a>
                <button type="submit" class="btnStrategy resetW300">
                    修正保存
                    <span>
                        <img src="/assets/img/svg/ic_circle_check.svg" alt="修正保存">
                    </span>
                </button>
            </p>
        </form>
    </div>
</div>
@endsection

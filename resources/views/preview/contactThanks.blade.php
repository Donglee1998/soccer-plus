@extends('web.layouts.default', ['title' => '動画一覧'], ['pageName' => 'pageThanks'])
@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="プレミアチームのご案内">
        <h1 class="keyvTitle">お問い合わせ</h1>
    </div>
    <div class="content pbSp30">
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt="home"></a><span>/</span></li>
                <li><em>お問い合わせ</em></li>
            </ul>
            <div class="section03">
                <div class="blockThanks">
                    <h2 class="ttl">お問い合わせ<br>ありがとうございました。</h2>
                    <p class="txt">メールでのお問い合わせは24時間受付けておりますが、回答にはお時間を頂く場合がございます。<br class="pcDisplay">（土日祝にお問い合わせ頂いた場合は翌日以降の回答となります。）<br class="pcDisplay">また、お問い合わせの内容によってはお答えできない場合があることをあらかじめご了承下さい。</p>
                    <p class="center">
                        <a href="#" class="btnStrategy resetW300">
                            ページトップに戻る
                            <span>
                                <img src="/assets/img/svg/ic_circle_right.svg" alt="アイコン丸右">
                            </span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

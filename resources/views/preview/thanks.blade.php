@extends('web.layouts.default', ['title' => '動画一覧'], ['pageName' => 'pageThanks'])
@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="プレミアチームのご案内">
        <h1 class="keyvTitle">お申込みフォーム</h1>
    </div>
    <div class="content pbSp30">
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt="home"></a><span>/</span></li>
                <li><em>お申込みフォーム</em></li>
            </ul>
            <div class="section03">
                <div class="blockThanks">
                    <h2 class="ttl">プレミアムチームの<br>
お申込みありがとうございました。</h2>
                    <p class="txt">この度は、サッカープラス プレミアムチームのお申込み誠にありがとうございます。<br class="pcDisplay">
お申込み内容を確認の上、改めて担当よりご連絡させていただきますので<br class="pcDisplay">
今しばらくお待ちくださいませ。</p>
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

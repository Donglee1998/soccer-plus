@extends('web.layouts.default2', ['title' => '個人情報保護方針'], ['pageName' => 'fullPage pagePrivacy'])
@section('content')
<div class="keyv">
    <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="スタッツ">
    <h1 class="keyvTitle"><span>PRIVACY</span>個人情報保護方針</h1>
</div>
<div class="content">
    <div class="inner02">
        <ul class="breadscrumb">
            <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a><span>/</span></li>
            <li><em>個人情報保護方針</em></li>
        </ul>
    </div>
    <section class="blockPrivacy">
        <div class="inner02">
            <div class="blockMb40Sp20">
                <h2 class="headline4">個人情報保護方針</h2>
                <p class="txtCm01 pb10">下記の文章をクリックして、ご覧くださいませ。</p>
                <p class="txtCm01"><a href="/pdf/privacy_policy.pdf" target="_blank">「個人情報保護方針」はこちら（PDF：851KB）</a></p>
            </div>
            <div class="blockMb40Sp20">
                <h2 class="headline4">個人情報開示申請書</h2>
                <p class="txtCm01 pb10">下記の文章をクリックして、ご覧くださいませ。</p>
                <p class="txtCm01"><a href="/pdf/disclosure_form.pdf" target="_blank">「個人情報開示申請書」はこちら（PDF：504KB）</a></p>
            </div>
            <p class="txtCm01">なお、PDFをご覧になるには下記のソフトが必要となります。<br>
                拝見できない場合は下記のURLよりダウンロードをお願い致します。<br>
                <a href="http://get.adobe.com/jp/reader/" target="_blank">【Acrobat Readerのダウンロード】</a></p>
        </div>
    </section>
</div>
@endsection

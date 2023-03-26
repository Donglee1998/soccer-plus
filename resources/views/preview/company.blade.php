@extends('web.layouts.default2', ['title' => '企業情報'], ['pageName' => 'fullPage pageCompany'])
@section('content')
<div class="keyv">
    <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="スタッツ">
    <h1 class="keyvTitle"><span>COMPANY</span>企業情報</h1>
</div>
<div class="content">
    <div class="inner02">
        <ul class="breadscrumb">
            <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a><span>/</span></li>
            <li><em>企業情報</em></li>
        </ul>
    </div>
    <section class="aboutOur mt0 mb0">
        <div class="inner02">
            <div class="aboutOurRow">
                <span>社名</span>
                <span>株式会社バスケプラス</span>
            </div>
            <div class="aboutOurRow">
                <span>本社所在地</span>
                <span>〒146-0083 東京都大田区千鳥2-17-7<br>Tel：03-4376-5171</span>
            </div>
            <div class="aboutOurRow">
                <span>代表者</span>
                <span>代表取締役　盛 透</span>
            </div>
            <div class="aboutOurRow">
                <span>資本金</span>
                <span>10,000,000円（2020年8月末現在）</span>
            </div>
            <div class="aboutOurRow">
                <span>設立</span>
                <span>2020年8月27日</span>
            </div>
            <div class="aboutOurRow">
                <span>事業内容</span>
                <span>インターネット関連事業<br>携帯電話等通信商材販売・取次事業<br>ソフトウェアの企画・開発・販売等事業<br>上記に付帯又は関連する事業</span>
            </div>
        </div>
    </section>
</div>
@endsection

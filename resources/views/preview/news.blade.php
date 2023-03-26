@extends('web.layouts.default', ['title' => 'test'], ['pageName' => 'pageNews'])
@section('content')
<div class="keyv">
    <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="お知らせ">
    <h1 class="keyvTitle">お知らせ</h1>
</div>
<div class="content">
    <div class="inner01">
        <ul class="breadscrumb">
            <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a><span>/</span></li>
            <li><em>お知らせ</em></li>
        </ul>

        <section>
            <h2 class="headline4">お知らせ一覧</h2>

            <ul class="newsList">
                <li class="newsItem">
                    <div class="postTime gap30">
                        <time>2022年07月07日</time>
                        <a href="#">お知らせ</a>
                    </div>
                    <a class="newsTitle" href="#">2022年7月1日『日刊工業新聞』に記事が掲載されました。</a>
                </li>

                <li class="newsItem">
                    <div class="postTime gap30">
                        <time>2022年06月26日</time>
                        <a href="#">カテゴリ</a>
                    </div>
                    <a class="newsTitle" href="#">2022年3月11日『神奈川新聞』に記事が掲載されました。</a>
                </li>

                <li class="newsItem">
                    <div class="postTime gap30">
                        <time>2022年05月25日</time>
                        <a href="#">カテゴリ</a>
                    </div>
                    <a class="newsTitle" href="#">Volley Pad2 iPadセットモデル 36か月レンタル版価格表</a>
                </li>

                <li class="newsItem">
                    <div class="postTime gap30">
                        <time>2022年06月24日</time>
                        <a href="#">カテゴリ</a>
                    </div>
                    <a class="newsTitle" href="#">オンラインでの商品をご案内について</a>
                </li>
            </ul>
        </section>
    </div>
</div>
@endsection
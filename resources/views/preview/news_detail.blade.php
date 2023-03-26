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

        <article class="post">
            <div class='headline4'>
                <div class="postTime">
                    <time>2022年07月07日</time>
                    <a href="#">お知らせ</a>
                </div>
                <h2>2022年7月1日『日刊工業新聞』に記事が掲載されました。</h2>
            </div>

            <div class="postContent">
                <div class="postContentRow">
                    <figure class="postThumbnail">
                        <img src="https://dummyimage.com/520x375/cccccc/000000" alt="ダミー画像">
                    </figure>

                    <p class="txtCm01">ここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入ります。 ここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入ります。</p>
                </div>

                <p class="txtCm01">ここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入ります。 ここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入ります。</p>
            </div>

            <p class="txtNote">※日刊工業新聞社の転載承認を受けています。</p>
        </article>

        <div class="textCenter">
            <a href="/news" class="btnStrategy">
                お知らせ一覧に戻る
                <span class="positionLeft">
                    <img src="/assets/img/svg/ic_circle_left.svg" alt="">
                </span>
            </a>
        </div>
    </div>
</div>
@endsection

@extends('web.layouts.default', ['title' => '作戦ボード詳細'], ['pageName' => 'pageTeam'])
@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="作戦ボード">
        <h1 class="keyvTitle">作戦ボード</h1>
    </div>
    <div class="content">
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a><span>/</span></li>
                <li><a href="/preview/board01">作戦ボード</a><span>/</span></li>
                <li><em>作戦ボード詳細</em></li>
            </ul>
            <div class="headline4">
                <h2>攻撃 | ショートパス型</h2>
            </div>
            <table class="tableInfo blockMb40Sp30">
                <tbody>
                    <tr>
                        <td class="fw500 center w200">説明</td>
                        <td>選手同士があまり距離を取らず細かくパスを交換しながらゴールを狙う</td>
                    </tr>
                    <tr>
                        <td class="fw500 center">作戦の種類</td>
                        <td>攻撃</td>
                    </tr>
                    <tr>
                        <td class="fw500 center">状況</td>
                        <td>通常時</td>
                    </tr>
                    <tr>
                        <td class="fw500 center">コートの種類</td>
                        <td>フルコート</td>
                    </tr>
                </tbody>
            </table>

            <div class="splide jsSplide" role="group" aria-label="Splide Basic HTML Example">
                <div class="splide__track">
                        <ul class="splide__list">
                            <li class="splide__slide"><img src="/assets/img/board/img_strategyboard.jpg" alt=""></li>
                            <li class="splide__slide"><img src="/assets/img/board/img_strategyboard.jpg" alt=""></li>
                            <li class="splide__slide"><img src="/assets/img/board/img_strategyboard.jpg" alt=""></li>
                            <li class="splide__slide"><img src="/assets/img/board/img_strategyboard.jpg" alt=""></li>
                            <li class="splide__slide"><img src="/assets/img/board/img_strategyboard.jpg" alt=""></li>
                            <li class="splide__slide"><img src="/assets/img/board/img_strategyboard.jpg" alt=""></li>
                        </ul>
                </div>
                <div>
                    <div class="ctPagination">
                        <span class="text">シーン</span>
                        <span id="numberSlide" class="bold">1 &nbsp;</span>/<span id="numberAllSlide"></span>
                    </div>
                </div>
            </div>
            <div class="splide jsSplideText" role="group" aria-label="Splide Basic HTML Example">
                <div class="splide__track">
                        <ul class="splide__list">
                        <li class="splide__slide txtCm01">1 ボードのメモがあればコート下にコメントがア入りますボードのメモがあればコート下にコメントがア入りますボードのメモがあればコート下にコメントがア入りますボードのメモがあればコート下にコメントがア入りますボードのメモがあればコート下にコメントがア入ります。</li>
                        <li class="splide__slide txtCm01">2 ボードのメモがあればコート下にコメントがア入りますボードのメモがあればコート下にコメントがア入りますボードのメモがあればコート下にコメントがア入りますボードのメモがあればコート下にコメントがア入りますボードのメモがあればコート下にコメントがア入ります。</li>
                        <li class="splide__slide txtCm01">3 ボードのメモがあればコート下にコメントがア入りますボードのメモがあればコート下にコメントがア入りますボードのメモがあればコート下にコメントがア入りますボードのメモがあればコート下にコメントがア入りますボードのメモがあればコート下にコメントがア入ります。</li>
                        <li class="splide__slide txtCm01">4 ボードのメモがあればコート下にコメントがア入りますボードのメモがあればコート下にコメントがア入りますボードのメモがあればコート下にコメントがア入りますボードのメモがあればコート下にコメントがア入りますボードのメモがあればコート下にコメントがア入ります。</li>
                        <li class="splide__slide txtCm01">5 ボードのメモがあればコート下にコメントがア入りますボードのメモがあればコート下にコメントがア入りますボードのメモがあればコート下にコメントがア入りますボードのメモがあればコート下にコメントがア入りますボードのメモがあればコート下にコメントがア入ります。</li>
                        <li class="splide__slide txtCm01">6 ボードのメモがあればコート下にコメントがア入りますボードのメモがあればコート下にコメントがア入りますボードのメモがあればコート下にコメントがア入りますボードのメモがあればコート下にコメントがア入りますボードのメモがあればコート下にコメントがア入ります。</li>
                        </ul>
                </div>
            </div>
            <p class="center">
                <a href="/preview/board01" class="btnStrategy">
                    作戦ボード一覧に戻る
                    <span class="positionLeft">
                        <img src="/assets/img/svg/ic_circle_left.svg" alt="チーム一覧に戻る">
                    </span>
                </a>
            </p>
        </div>
    </div>
@endsection

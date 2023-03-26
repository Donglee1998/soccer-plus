@extends('web.layouts.default', ['title' => '404 Not Found'], ['pageName' => 'page404'])
@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="プレミアチームのご案内">
        <h1 class="keyvTitle">404 Not Found</h1>
    </div>
    <div class="content pbSp30">
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt="home"></a><span>/</span></li>
                <li><em>404 Not Found</em></li>
            </ul>
            <div class="section03">
                <div class="blockThanks">
                    <h2 class="ttl">お探しのページは見つかりませんでした。</h2>
                    <p class="txt">お探しのページは削除されたか、一時的にご利用できない可能性があります。<br class="pcDisplay">URLをご確認の上再度お試しいただくか、トップページよりお探しください。</p>
                    <p class="center">
                        <a href="{{ route('web.top') }}" class="btnStrategy resetW300">
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


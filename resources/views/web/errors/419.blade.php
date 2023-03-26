@extends('web.layouts.default', ['title' => '419 Time out'], ['pageName' => 'pageTimeOut'])
@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="プレミアチームのご案内">
        <h1 class="keyvTitle">419 Time out</h1>
    </div>
    <div class="content pbSp30">
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt="home"></a><span>/</span></li>
                <li><em>419 Time out</em></li>
            </ul>
            <div class="section03">
                <div class="blockThanks">
                    <h2 class="ttl">タイムアウトしました。</h2>
                    <p class="txt">TOPページにお戻りのうえ再度ご入力ください。</p>
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


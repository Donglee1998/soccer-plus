<header id="header2">
    <a href="/" id="logo"><img src="/assets/img/svg/logo.svg" alt="SOCCER Plus"></a>
    <div class="boxLogo">
        @if(Auth::guard('web')->check())
        <a href="{{ route('web.team.index') }}" class="boxButton boxLogin">
            <span c" class="boxButton boxMyPage">
            <span class="txt">
                <svg>
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon-user"></use>
                </svg>
                <em>マイページ</em>
            </span>
        </a>
        @else
        <a href="{{ route('web.auth.showForm.login') }}" class="boxButton boxLogin">
            <span class="txt">
                <svg>
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon-login"></use>
                </svg>
                <em>ログイン</em>
            </span>
        </a>
        @endif
        <a href="{{ route('web.contact.create') }}" class="boxButton boxEmail">
            <span class="txt">
                <svg>
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon-email"></use>
                </svg>
                <em>お問い合わせ</em>
            </span>
        </a>
    </div>
    <div class="boxMenu not-active jsMenu">
        <div class="iconMenu">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="blockNavi jsContentMenu">
        <nav class="navTop">
            <a href="/?anc=sec01">サービス紹介</a>
            <a href="/?anc=sec02">機能概要</a>
            <a href="/?anc=sec03">商品紹介</a>
            <a href="/?anc=sec04">プレミアムチームのご案内</a>
        </nav>
    </div>
    <div class="overlay"></div>
</header>

<header id="header">
    <div class="boxLogo">
        <a href="/" id="logo"><img src="/assets/img/svg/logo.svg" alt="SOCCER Plus"></a>
        <a href="#" class="boxLogout spDisplay">
            <svg>
                <use xlink:href="/assets/img/svg/symbol-defs.svg#icon-logout" />
            </svg>
        </a>
        <div class="boxMenu not-active jsMenu">
            <div class="iconMenu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <div class="blockNavi jsContentMenu">
        @php
            $role_user = Auth::guard('web')->user() ?? null;
        @endphp
        <div class="scrollBlock">
            <div class="userNav">
                <div class="userNavInner">
                    @if (!empty($role_user))
                        <p class="username">{{ $role_user->teamIsHome()->name ?? null }}</p>
                        <a href="{{ route('web.auth.submit.logout') }}" class="btnLogout">ログアウト
                            <svg>
                                <use xlink:href="/assets/img/svg/symbol-defs.svg#icon-logout" />
                            </svg>
                        </a>
                    @elseif (empty($role_user))
                        <a href="{{ route('web.auth.showForm.login') }}" class="btnLogout">ログイン
                            <svg>
                                <use xlink:href="/assets/img/svg/symbol-defs.svg#icon-logout" />
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
            <nav id="main-navi">
                <ul class="listNavi">
                    @if (empty($role_user))
                    <li>
                        <a id="products" href="/products">プレミアムチームのご案内
                            <svg class="iconArrow">
                                <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_arrow_right" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a id="lineUp" href="/lineup">商品紹介
                            <svg class="iconArrow">
                                <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_arrow_right" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a id="compare" href="/compare">商品比較
                            <svg class="iconArrow">
                                <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_arrow_right" />
                            </svg>
                        </a>
                    </li>
                    @endif
                    <li><a id="news" href="{{ route('web.news.list') }}">お知らせ
                            <svg class="iconArrow">
                                <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_arrow_right" />
                            </svg>
                        </a></li>
                    @if (!empty($role_user))
                        <li><a id="playByPlay" href="{{ route('web.scorebook.list') }}">ゲーム記録
                                <svg class="iconArrow">
                                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_arrow_right" />
                                </svg>
                            </a></li>
                        <li><a id="period" href="{{ route('web.period_aggregation.index') }}">期間別集計
                                <svg class="iconArrow">
                                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_arrow_right" />
                                </svg>
                            </a></li>
                        <li><a id="teams" href="{{ route('web.team.index') }}">チーム一覧
                                <svg class="iconArrow">
                                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_arrow_right" />
                                </svg>
                            </a></li>
                        <li><a id="videoList" href="{{ route('web.team.album') }}">動画一覧
                                <svg class="iconArrow">
                                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_arrow_right" />
                                </svg>
                            </a>
                        </li>
                        <li><a id="board" href="{{ route('web.board.index') }}">作戦ボード
                                <svg class="iconArrow">
                                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_arrow_right" />
                                </svg>
                            </a></li>
                    @endif
                    <li><a id="news" href="{{ route('web.manual.list') }}">マニュアル
                            <svg class="iconArrow">
                                <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_arrow_right" />
                            </svg>
                        </a></li>
                    <li><a id="faq" href="/faq">よくあるご質問
                            <svg class="iconArrow">
                                <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_arrow_right" />
                            </svg>
                        </a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>

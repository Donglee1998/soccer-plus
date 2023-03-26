@extends('web.layouts.default', ['title' => '試合レポート'], ['pageName' => 'matchReport'])
@section('content')
<div class="keyv">
    <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="試合レポート">
    <h1 class="keyvTitle"><span>ゲーム記録</span>試合レポート</h1>
</div>
<div class="content">
    <div class="inner01">
        <ul class="breadscrumb">
            <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a><span>/</span></li>
            <li><a href="/preview/scorebook01">ゲーム記録</a><span>/</span></li>
            <li><em>試合レポート</em></li>
        </ul>
        <div class="dateInfo">
            <p class="tag">練習試合</p>
            <p class="date">2022年7月4日</p>
        </div>
        <div class="teamInfo">
            <p class="teamInfoName">
                <span class="teamColor home">
                    <svg class="icon">
                        <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_color_team" /></svg>
                </span>
                <span class="name">池袋〇〇〇〇〇〇</span>
            </p>
            <p class="vsBox">VS</p>
            <p class="teamInfoName">
                <span class="teamColor away">
                    <svg class="icon">
                        <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_color_team" />
                    </svg>
                </span>
                <span class="name">池袋〇〇〇〇〇〇</span>
            </p>
        </div>
        <div class="scoreInfo">
            <p class="scoreBox">2</p>
            <div class="scoreDetail">
                <p class="item">
                    <span class="point">1</span>
                    <span class="time">1ST</span>
                    <span class="point">1</span>
                </p>
                <p class="item">
                    <span class="point">1</span>
                    <span class="time">2ND</span>
                    <span class="point">0</span>
                </p>
            </div>
            <p class="scoreBox">1</p>
        </div>
        <div class="scoreInfoDetail">
            <div class="scoreBox">
                <p class="item">
                    <span class="playerName">?</span> /
                    <span class="time">2ND</span>
                    <span class="minute">01:51</span>
                </p>
                <p class="item">
                    <span class="playerName">Mi 14</span> /
                    <span class="time">EXT2</span>
                    <span class="minute">00:12</span>
                </p>
            </div>
            <p class="scoreDetail">得点<br>選手 / 時間</p>
            <div class="scoreBox">
                <p class="item">
                    <span class="playerName">Da Nang (8)</span> /
                    <span class="time">2ND</span>
                    <span class="minute">00:57</span>
                </p>
                <p class="item">
                    <span class="playerName">Da Nang (16)</span> /
                    <span class="time">EXT2</span>
                    <span class="minute">02:09</span>
                </p>
            </div>
        </div>
        <nav class="analysisNav">
            <a href="/preview/scorebook02" class="active">
                <svg class="icon icon01">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_report" />
                </svg>
                <span>試合レポート</span>
            </a>
            <a href="#">
                <svg class="icon icon02">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_ball" />
                </svg>
                <span>スタッツ</span>
            </a>
            <a href="/preview/scorebook05">
                <svg class="icon icon03">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_chart" />
                </svg>
                <span>比較表</span>
            </a>
            <a href="/preview/scorebook06">
                <svg class="icon icon04">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_ytb" />
                </svg>
                <span>Play by Play Video</span>
            </a>
        </nav>
        <div class="section01">
            <div class="tblScroll mb0 pb0">
                <div class="tblScroll__wrap">
                    <table class="tblReportMatch mwtblHead">
                        <thead>
                            <tr>
                                <th class="w170p" rowspan="2">選手名</th>
                                <th class="w50p" rowspan="2">番号</th>
                                <th colspan="3">シュート</th>
                                <th class="wGKHead" rowspan="2" colspan="2">ポジション</th>
                                <th colspan="4">シュート</th>
                                <th class="w50p" rowspan="2">番号</th>
                                <th class="w170p" rowspan="2">選手名</th>
                            </tr>
                            <tr>
                                <th class="w50p">1ST</th>
                                <th class="w50p">2ND</th>
                                {{-- <th class="w50p">3RD</th> --}}
                                {{-- <th class="w50p">4TH</th> --}}
                                <th class="w35p">計</th>
                                <th class="w35p">計</th>
                                {{-- <th class="w50p">4TH</th> --}}
                                {{-- <th class="w50p">3RD</th> --}}
                                <th class="w50p">2ND</th>
                                <th class="w50p">1ST</th>
                            </tr>
                        </thead>
                    </table>
                    <div class="tableGroup">
                        <table class="tblReportMatch w50">
                            <tbody>
                                <tr>
                                    <td class="w170p">川島永嗣</td>
                                    <td class="bgGray w50p">1</td>
                                    <td class="w50p">0</td>
                                    <td class="w50p">0</td>
                                    {{-- <td class="w50p">0</td> --}}
                                    {{-- <td class="w50p">0</td> --}}
                                    <td class="w35p">0</td>
                                    <td class="lineGrayL wGK">GK</td>
                                </tr>
                                <tr>
                                    <td>川島永嗣</td>
                                    <td class="bgGray">1</td>
                                    <td>0</td>
                                    <td>0</td>
                                    {{-- <td>0</td>
                                    <td>0</td> --}}
                                    <td>0</td>
                                    <td class="lineGrayL">GK</td>
                                </tr>
                                <tr>
                                    <td>川島永嗣</td>
                                    <td class="bgGray">1</td>
                                    <td>0</td>
                                    <td>0</td>
                                    {{-- <td>0</td>
                                    <td>0</td> --}}
                                    <td>0</td>
                                    <td class="lineGrayL">GK</td>
                                </tr>
                                <tr>
                                    <td>川島永嗣</td>
                                    <td class="bgGray">1</td>
                                    <td>0</td>
                                    <td>0</td>
                                    {{-- <td>0</td>
                                    <td>0</td> --}}
                                    <td>0</td>
                                    <td class="lineGrayL">GK</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="tblReportMatch w50">
                            <tbody>
                                <tr>
                                    <td class="wGK">GK</td>
                                    <td class="w35p">1</td>
                                    {{-- <td class="w50p">0</td> --}}
                                    {{-- <td class="w50p">0</td> --}}
                                    <td class="w50p">0</td>
                                    <td class="w50p">0</td>
                                    <td class="bgGray w50p">1</td>
                                    <td class="w170p">川島永嗣</td>
                                </tr>
                                <tr>
                                    <td>GK</td>
                                    <td>1</td>
                                    {{-- <td>0</td>
                                    <td>0</td> --}}
                                    <td>0</td>
                                    <td>0</td>
                                    <td class="bgGray">1</td>
                                    <td>川島永嗣</td>
                                </tr>
                                <tr>
                                    <td>GK</td>
                                    <td>1</td>
                                    {{-- <td>0</td>
                                    <td>0</td> --}}
                                    <td>0</td>
                                    <td>0</td>
                                    <td class="bgGray">1</td>
                                    <td>川島永嗣</td>
                                </tr>
                                <tr>
                                    <td>GK</td>
                                    <td>1</td>
                                    {{-- <td>0</td>
                                    <td>0</td> --}}
                                    <td>0</td>
                                    <td>0</td>
                                    <td class="bgGray">1</td>
                                    <td>川島永嗣</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="tblReportMatch lineGrayT w50">
                            <tbody>
                                <tr>
                                    <td class="w170p">川島永嗣</td>
                                    <td class="bgGray w50p">1</td>
                                    <td class="w50p">0</td>
                                    <td class="w50p">0</td>
                                    {{-- <td class="w50p">0</td> --}}
                                    {{-- <td class="w50p">0</td> --}}
                                    <td class="w35p">0</td>
                                    <td class="lineGrayL wGK">GK</td>
                                </tr>
                                <tr>
                                    <td>川島永嗣</td>
                                    <td class="bgGray">1</td>
                                    <td>0</td>
                                    <td>0</td>
                                    {{-- <td>0</td>
                                    <td>0</td> --}}
                                    <td>0</td>
                                    <td class="lineGrayL">GK</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="tblReportMatch lineGrayT w50">
                            <tbody>
                                <tr>
                                    <td class="wGK">GK</td>
                                    <td class="w35p">1</td>
                                    {{-- <td class="w50p">0</td> --}}
                                    {{-- <td class="w50p">0</td> --}}
                                    <td class="w50p">0</td>
                                    <td class="w50p">0</td>
                                    <td class="bgGray w50p">1</td>
                                    <td class="w170p">川島永嗣</td>
                                </tr>
                                <tr>
                                    <td>GK</td>
                                    <td>1</td>
                                    {{-- <td>0</td>
                                    <td>0</td> --}}
                                    <td>0</td>
                                    <td>0</td>
                                    <td class="bgGray">1</td>
                                    <td>川島永嗣</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="blockScroll mb0 pb0">
                <table class="tblReportMatch changePlayer">
                    <thead>
                        <tr>
                            <th class="mw100">時間</th>
                            <th class="mw100">OUT</th>
                            <th class="mw50"><span class="iconChange"></span></th>
                            <th class="mw100">IN</th>
                            <th class="mw200 w200p"></th>
                            <th class="mw100">IN</th>
                            <th class="mw50"><span class="iconChange01"></span></th>
                            <th class="mw100">OUT</th>
                            <th class="mw100">TIME</th>
                        </tr>
                    </thead>
                </table>
                <div class="tableGroup01">
                    <table class="tblReportMatch changePlayer">
                        <tbody>
                            <tr>
                                <td class="setW01">1ST：27分</td>
                                <td class="setW01">1 権田徹</td>
                                <td><span class="iconChange"></span></td>
                                <td class="setW01">12 権田徹</td>
                            </tr>
                            <tr>
                                <td>1ST：27分</td>
                                <td>1 権田徹</td>
                                <td ><span class="iconChange"></span></td>
                                <td>12 権田徹</td>
                            </tr>
                            <tr>
                                <td>1ST：27分</td>
                                <td>1 権田徹</td>
                                <td ><span class="iconChange"></span></td>
                                <td>12 権田徹</td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="ttl">選手交代</p>
                    <table class="tblReportMatch changePlayer">
                        <tbody>
                            <tr>
                                <td class="setW01">1 権田徹</td>
                                <td class=""><span class="iconChange01"></span></td>
                                <td class="setW01">12 権田徹</td>
                                <td class="setW01">1ST：27分</td>
                            </tr>
                            <tr>
                                <td>1 権田徹</td>
                                <td><span class="iconChange01"></span></td>
                                <td>12 権田徹</td>
                                <td>1ST：27分</td>
                            </tr>
                    </tbody>
                </table>
                </div>
            </div>
            <div class="blockScroll pb0 mb10">
                <table class="tblReportMatch matchParameter">
                    <thead>
                        <tr>
                            <th>計</th>
                            <th>4TH</th>
                            <th>3RD</th>
                            <th>2ND</th>
                            <th>1ST</th>
                            <th class="w25">チーム合計</th>
                            <th>1ST</th>
                            <th>2ND</th>
                            <th>3RD</th>
                            <th>4TH</th>
                            <th>計</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>4</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgGray">シュート</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgGray">枠内シュート</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgGray">GK</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgGray">CK</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgGray">直接FK</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgGray">間接FK</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgGray">オフサイド</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgGray">PK</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgGray">警告</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgGray">退場</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td class="bgWhite">1</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td class="w150p" colspan="3">池袋〇〇〇〇〇〇</td>
                            <td colspan="8" class="bgWhite left">
                                <div class="round">
                                    <span class="hf">1ST</span> :
                                    <span class="time">10分</span>
                                    <span class="yellowCard">C2</span>
                                    <span class="numberPlayer mr5">8</span>
                                    <span class="namePlayer">原口元気</span>
                                </div>
                                <div class="round">
                                    <span class="hf">2ND</span> :
                                    <span class="time">10分</span>
                                    <span class="redCard">S1</span>
                                    <span class="numberPlayer mr5">7</span>
                                    <span class="namePlayer">柴崎岳</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="w150p" colspan="3">東京〇〇〇〇〇〇</td>
                            <td colspan="8" class="bgWhite left">
                                <div class="round">
                                    <span class="hf">1ST</span> :
                                    <span class="time">10分</span>
                                    <span class="yellowCard">C2</span>
                                    <span class="numberPlayer mr5">8</span>
                                    <span class="namePlayer">原口元気</span>
                                </div>
                                <div class="round">
                                    <span class="hf">1ST</span> :
                                    <span class="time">40分</span>
                                    <span class="yellowCard">C1</span>
                                    <span class="numberPlayer mr5">8</span>
                                    <span class="namePlayer">原口元気</span>
                                </div>
                                <div class="round">
                                    <span class="hf">2ND</span> :
                                    <span class="time">10分</span>
                                    <span class="redCard">S1</span>
                                    <span class="numberPlayer mr5">7</span>
                                    <span class="namePlayer">柴崎岳</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="foulNoteList">
                <div class="item bg01">
                    <p class="ttl">警告理由</p>
                    <ul class="foulType">
                        <li>
                            <span class="yellowCard">C1</span>不明
                        </li>
                        <li>
                            <span class="yellowCard">C2</span>反スポーツ
                        </li>
                        <li>
                            <span class="yellowCard">C3</span>ラフプレイ
                        </li>
                        <li>
                            <span class="yellowCard">C4</span>異議
                        </li>
                        <li>
                            <span class="yellowCard">C5</span>繰返違反
                        </li>
                        <li>
                            <span class="yellowCard">C6</span>遅延行為
                        </li>
                        <li>
                            <span class="yellowCard">C7</span>距離不足
                        </li>
                        <li>
                            <span class="yellowCard">C8</span>無許可入去
                        </li>
                    </ul>
                </div>
                <div class="item bg02">
                    <p class="ttl">退場理由</p>
                    <ul class="foulType">
                        <li>
                            <span class="redCard">S1</span>不明
                        </li>
                        <li>
                            <span class="redCard">S2</span>著不正
                        </li>
                        <li>
                            <span class="redCard">S3</span>乱暴
                        </li>
                        <li>
                            <span class="redCard">S4</span>つば吐き
                        </li>
                        <li>
                            <span class="redCard">S5</span>阻止（手）
                        </li>
                        <li>
                            <span class="redCard">S6</span>阻止（他）
                        </li>
                        <li>
                            <span class="redCard">S7</span>暴言
                        </li>
                    </ul>
                </div>
            </div>
            <a href="#" class="btnDeal style01" target="_blank">
                <span>
                    <img src="/assets/img/svg/icon_pdf.svg" alt="価格一覧">
                </span>
                試合レポート詳細をダウンロード
            </a>
        </div>
        <div class="section01">
            <h2 class="headline5 mgb40 flexStyle">
                戦評
                <a href="#" class="btnCmn02 style01">戦評を記入する
                    <svg class="iconArrow"><use xlink:href="/assets/img/svg/symbol-defs.svg#icon_arrow_right"></use></svg>
                </a>
            </h2>
            <h2 class="headline5 mgb40 flexStyle">
                戦評
                <a href="#" class="btnCmn02 style01">編集する
                    <svg class="iconArrow"><use xlink:href="/assets/img/svg/symbol-defs.svg#icon_arrow_right"></use></svg>
                </a>
            </h2>
            <table class="tableInfo reSize">
                <tbody>
                    <tr>
                        <td class="fw500 w200 bgGray01">回戦</td>
                        <td class="bgWhite">2回戦</td>
                    </tr>
                    <tr>
                        <td class="fw500 bgGray01">戦評</td>
                        <td>戦評コメントが入ります戦評コメントが入ります戦評コメントが入ります戦評コメントが入ります戦評コメントが入ります戦評コメントが入ります戦評コメントが入ります戦評コメントが入ります戦評コメントが入ります戦評コメントが入ります戦評コメントが入ります戦評コメントが入ります戦評コメントが入ります戦評コメントが入ります。</td>
                    </tr>
                    <tr>
                        <td class="fw500 bgGray01">文責</td>
                        <td class="bgWhite"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="section01">
            <h2 class="headline5 mgb40">スターティングメンバー</h2>
            <div class="lineupBox">
                <div class="memBox home">
                    <p class="info">
                        <span class="team">池袋〇〇〇〇〇〇</span>
                        <span class="diagram">3-4-3</span>
                    </p>
                    <div class="mapBox">
                        <div class="row">
                            <p class="infoMem">
                                <span class="num">10</span>
                                <span class="name">室屋成</span>
                            </p>
                            <p class="infoMem">
                                <span class="num">10</span>
                                <span class="name">室屋成</span>
                            </p>
                            <p class="infoMem">
                                <span class="num">10</span>
                                <span class="name">室屋成</span>
                            </p>
                        </div>
                        <div class="row">
                            <p class="infoMem">
                                <span class="num">10</span>
                                <span class="name">室屋成</span>
                            </p>
                            <p class="infoMem">
                                <span class="num">10</span>
                                <span class="name">室屋成</span>
                            </p>
                            <p class="infoMem">
                                <span class="num">10</span>
                                <span class="name">室屋成</span>
                            </p>
                            <p class="infoMem">
                                <span class="num">10</span>
                                <span class="name">室屋成</span>
                            </p>
                        </div>
                        <div class="row">
                            <p class="infoMem">
                                <span class="num">10</span>
                                <span class="name">室屋成</span>
                            </p>
                            <p class="infoMem">
                                <span class="num">10</span>
                                <span class="name">室屋成</span>
                            </p>
                            <p class="infoMem">
                                <span class="num">10</span>
                                <span class="name">室屋成</span>
                            </p>
                        </div>
                        <div class="row">
                            <p class="infoMem">
                                <span class="num">10</span>
                                <span class="name">室屋成</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="memBox away">
                    <p class="info">
                        <span class="team">東京〇〇〇〇〇〇</span>
                        <span class="diagram">4-3-3</span>
                    </p>
                    <div class="mapBox">
                        <div class="row">
                            <p class="infoMem">
                                <span class="num">10</span>
                                <span class="name">室屋成</span>
                            </p>
                            <p class="infoMem">
                                <span class="num">10</span>
                                <span class="name">室屋成</span>
                            </p>
                            <p class="infoMem">
                                <span class="num">10</span>
                                <span class="name">室屋成</span>
                            </p>
                        </div>
                        <div class="row">
                            <p class="infoMem">
                                <span class="num">10</span>
                                <span class="name">室屋成</span>
                            </p>
                            <p class="infoMem">
                                <span class="num">10</span>
                                <span class="name">室屋成</span>
                            </p>
                            <p class="infoMem">
                                <span class="num">10</span>
                                <span class="name">室屋成</span>
                            </p>
                        </div>
                        <div class="row">
                            <p class="infoMem">
                                <span class="num">10</span>
                                <span class="name">室屋成</span>
                            </p>
                            <p class="infoMem">
                                <span class="num">10</span>
                                <span class="name">室屋成</span>
                            </p>
                            <p class="infoMem">
                                <span class="num">10</span>
                                <span class="name">室屋成</span>
                            </p>
                            <p class="infoMem">
                                <span class="num">10</span>
                                <span class="name">室屋成</span>
                            </p>
                        </div>
                        <div class="row">
                            <p class="infoMem">
                                <span class="num">10</span>
                                <span class="name">室屋成</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section01">
            <h2 class="headline5 mb20">チームスタッツ</h2>
            <div class="toggleDisplay">
                <span class="ttl">表示の切り替え /</span>
                <label class="rbCustom">
                    数値を見る
                    <input type="radio" name="toggle" checked>
                    <span class="checkmark"></span>
                </label>
                <label class="rbCustom">
                    確率を見る
                    <input type="radio" name="toggle">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="teamInfo line01">
                <p class="teamInfoName w29">
                    <span class="teamColor home">
                        <svg class="icon">
                            <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_color_team" /></svg>
                    </span>
                    <span class="name">池袋〇〇〇〇〇〇</span>
                </p>
                <p class="vsBox w42">VS</p>
                <p class="teamInfoName w29">
                    <span class="teamColor away">
                        <svg class="icon">
                            <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_color_team" />
                        </svg>
                    </span>
                    <span class="name">池袋〇〇〇〇〇〇</span>
                </p>
            </div>
            <ul class="listResult">
                <li class="listResult__item">
                    <span class="result team1">2</span>
                    <span class="ttl">得点</span>
                    <span class="result team2">1</span>
                </li>
                <li class="listResult__item">
                    <span class="result team1">1</span>
                    <span class="ttl">シュート</span>
                    <span class="result team2">2</span>
                </li>
                <li class="listResult__item">
                    <span class="result team1">2</span>
                    <span class="ttl">枠内シュート</span>
                    <span class="result team2">1</span>
                </li>
                <li class="listResult__item">
                    <span class="result team1">1</span>
                    <span class="ttl">アシスト</span>
                    <span class="result team2">2</span>
                </li>
                <li class="listResult__item">
                    <span class="result team1">2</span>
                    <span class="ttl">ラストパス</span>
                    <span class="result team2">1</span>
                </li>
                <li class="listResult__item">
                    <span class="result team1">2</span>
                    <span class="ttl">クロス</span>
                    <span class="result team2">1</span>
                </li>
                <li class="listResult__item">
                    <span class="result team1">1</span>
                    <span class="ttl">ドリブル成功</span>
                    <span class="result team2">2</span>
                </li>
                <li class="listResult__item">
                    <span class="result team1">2</span>
                    <span class="ttl">被ファウル</span>
                    <span class="result team2">1</span>
                </li>
                <li class="listResult__item">
                    <span class="result team1">1</span>
                    <span class="ttl">ファウル</span>
                    <span class="result team2">2</span>
                </li>
                <li class="listResult__item">
                    <span class="result team1">2</span>
                    <span class="ttl">カット</span>
                    <span class="result team2">1</span>
                </li>
                <li class="listResult__item">
                    <span class="result team1">2</span>
                    <span class="ttl">クリア</span>
                    <span class="result team2">1</span>
                </li>
                <li class="listResult__item">
                    <span class="result team1">1</span>
                    <span class="ttl">ブロック</span>
                    <span class="result team2">2</span>
                </li>
                <li class="listResult__item">
                    <span class="result team1">2</span>
                    <span class="ttl">こぼれ球奪取</span>
                    <span class="result team2">1</span>
                </li>
                <li class="listResult__item">
                    <span class="result team1">1</span>
                    <span class="ttl">PA侵入数</span>
                    <span class="result team2">2</span>
                </li>
                <li class="listResult__item">
                    <span class="result team1">2</span>
                    <span class="ttl">ゴールキック</span>
                    <span class="result team2">1</span>
                </li>
                <li class="listResult__item">
                    <span class="result team1">2</span>
                    <span class="ttl">フリーキック(直接フリーキック)</span>
                    <span class="result team2">1</span>
                </li>
                <li class="listResult__item">
                    <span class="result team1">1</span>
                    <span class="ttl">PK</span>
                    <span class="result team2">2</span>
                </li>
                <li class="listResult__item">
                    <span class="result team1">2</span>
                    <span class="ttl">自陣空中戦勝利</span>
                    <span class="result team2">1</span>
                </li>
                <li class="listResult__item">
                    <span class="result team1">1</span>
                    <span class="ttl">敵陣空中戦勝利</span>
                    <span class="result team2">2</span>
                </li>
                <li class="listResult__item">
                    <span class="result team1">2</span>
                    <span class="ttl">セーブ</span>
                    <span class="result team2">1</span>
                </li>
            </ul>
        </div>

    </div>
</div>
@endsection

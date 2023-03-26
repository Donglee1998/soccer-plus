<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>試合レポートPDF｜サッカープラス - Soccer-Plus -</title>
    @include('web.includes.meta')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Lato:ital,wght@0,400;0,700;1,400;1,700&family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ get_file_version('/assets/css/style_pdf.min.css') }}">
    @stack('css')
    @stack('js')
</head>
<body class="pageReport">
    <div class="wrapReport">
        <div class="inner03">
            <h2 class="headline13 mb30">両チームフォーメーション</h2>
            <div class="lineupBox mb30" style="page-break-after: always;">
                <div class="memBox memBox01 home">
                    <div class="teamInfo info">
                        <p class="teamInfoName">
                            <span class="teamColor home">
                                <svg class="icon">
                                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_color_team"></use></svg>
                            </span>
                            <span class="name">東京第一高校</span>
                        </p>
                        <span class="diagram">3-4-3</span>
                    </div>
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
                <div class="memBox memBox01 away">
                    <div class="teamInfo info">
                        <p class="teamInfoName">
                            <span class="teamColor away">
                                <svg class="icon">
                                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_color_team"></use></svg>
                            </span>
                            <span class="name">広島学園高校</span>
                        </p>
                        <span class="diagram">4-3-3</span>
                    </div>
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
            <h2 class="headline13 mb30">グラフで比較</h2>
            <div class="groupChartCompare">
                <div class="chartCompare jsChartCompare">
                    <div class="head">
                        <p class="ttl">シュート成功率</p>
                    </div>
                    <div class="contentBox">
                        <ul class="listPer">
                            <li>%</li>
                            <li>10</li>
                            <li>20</li>
                            <li>30</li>
                            <li>40</li>
                            <li>50</li>
                            <li>60</li>
                            <li>70</li>
                            <li>80</li>
                            <li>90</li>
                            <li>100</li>
                        </ul>
                        <div class="graph">
                            <div class="team1">
                                <p class="percent">
                                    <span class="num">50</span>
                                    <span class="sub">%</span>
                                </p>
                            </div>
                            <div class="team2">
                                <p class="percent">
                                    <span class="num">20</span>
                                    <span class="sub">%</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chartCompare jsChartCompare">
                    <div class="head">
                        <p class="ttl">枠内シュート成功率</p>
                    </div>
                    <div class="contentBox">
                        <ul class="listPer">
                            <li>%</li>
                            <li>10</li>
                            <li>20</li>
                            <li>30</li>
                            <li>40</li>
                            <li>50</li>
                            <li>60</li>
                            <li>70</li>
                            <li>80</li>
                            <li>90</li>
                            <li>100</li>
                        </ul>
                        <div class="graph">
                            <div class="team1">
                                <p class="percent">
                                    <span class="num">50</span>
                                    <span class="sub">%</span>
                                </p>
                            </div>
                            <div class="team2">
                                <p class="percent">
                                    <span class="num">20</span>
                                    <span class="sub">%</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chartCompare jsChartCompare">
                    <div class="head">
                        <p class="ttl">クロス成功率</p>
                    </div>
                    <div class="contentBox">
                        <ul class="listPer">
                            <li>%</li>
                            <li>10</li>
                            <li>20</li>
                            <li>30</li>
                            <li>40</li>
                            <li>50</li>
                            <li>60</li>
                            <li>70</li>
                            <li>80</li>
                            <li>90</li>
                            <li>100</li>
                        </ul>
                        <div class="graph">
                            <div class="team1">
                                <p class="percent">
                                    <span class="num">50</span>
                                    <span class="sub">%</span>
                                </p>
                            </div>
                            <div class="team2">
                                <p class="percent">
                                    <span class="num">20</span>
                                    <span class="sub">%</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chartCompare jsChartCompare">
                    <div class="head">
                        <p class="ttl">空中戦勝率</p>
                    </div>
                    <div class="contentBox">
                        <ul class="listPer">
                            <li>%</li>
                            <li>10</li>
                            <li>20</li>
                            <li>30</li>
                            <li>40</li>
                            <li>50</li>
                            <li>60</li>
                            <li>70</li>
                            <li>80</li>
                            <li>90</li>
                            <li>100</li>
                        </ul>
                        <div class="graph">
                            <div class="team1">
                                <p class="percent">
                                    <span class="num">50</span>
                                    <span class="sub">%</span>
                                </p>
                            </div>
                            <div class="team2">
                                <p class="percent">
                                    <span class="num">20</span>
                                    <span class="sub">%</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chartCompare jsChartCompare">
                    <div class="head">
                        <p class="ttl">ボール奪取率</p>
                    </div>
                    <div class="contentBox">
                        <ul class="listPer">
                            <li>%</li>
                            <li>10</li>
                            <li>20</li>
                            <li>30</li>
                            <li>40</li>
                            <li>50</li>
                            <li>60</li>
                            <li>70</li>
                            <li>80</li>
                            <li>90</li>
                            <li>100</li>
                        </ul>
                        <div class="graph">
                            <div class="team1">
                                <p class="percent">
                                    <span class="num">50</span>
                                    <span class="sub">%</span>
                                </p>
                            </div>
                            <div class="team2">
                                <p class="percent">
                                    <span class="num">20</span>
                                    <span class="sub">%</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chartCompare jsChartCompare">
                    <div class="head">
                        <p class="ttl">インターセプト成功率</p>
                    </div>
                    <div class="contentBox">
                        <ul class="listPer">
                            <li>%</li>
                            <li>10</li>
                            <li>20</li>
                            <li>30</li>
                            <li>40</li>
                            <li>50</li>
                            <li>60</li>
                            <li>70</li>
                            <li>80</li>
                            <li>90</li>
                            <li>100</li>
                        </ul>
                        <div class="graph">
                            <div class="team1">
                                <p class="percent">
                                    <span class="num">50</span>
                                    <span class="sub">%</span>
                                </p>
                            </div>
                            <div class="team2">
                                <p class="percent">
                                    <span class="num">20</span>
                                    <span class="sub">%</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chartCompare jsChartCompare">
                    <div class="head">
                        <p class="ttl">シュート セーブ率</p>
                    </div>
                    <div class="contentBox">
                        <ul class="listPer">
                            <li>%</li>
                            <li>10</li>
                            <li>20</li>
                            <li>30</li>
                            <li>40</li>
                            <li>50</li>
                            <li>60</li>
                            <li>70</li>
                            <li>80</li>
                            <li>90</li>
                            <li>100</li>
                        </ul>
                        <div class="graph">
                            <div class="team1">
                                <p class="percent">
                                    <span class="num">50</span>
                                    <span class="sub">%</span>
                                </p>
                            </div>
                            <div class="team2">
                                <p class="percent">
                                    <span class="num">20</span>
                                    <span class="sub">%</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chartCompare jsChartCompare">
                    <div class="head">
                        <p class="ttl">セカンドボール回収率</p>
                    </div>
                    <div class="contentBox">
                        <ul class="listPer">
                            <li>%</li>
                            <li>10</li>
                            <li>20</li>
                            <li>30</li>
                            <li>40</li>
                            <li>50</li>
                            <li>60</li>
                            <li>70</li>
                            <li>80</li>
                            <li>90</li>
                            <li>100</li>
                        </ul>
                        <div class="graph">
                            <div class="team1">
                                <p class="percent">
                                    <span class="num">50</span>
                                    <span class="sub">%</span>
                                </p>
                            </div>
                            <div class="team2">
                                <p class="percent">
                                    <span class="num">20</span>
                                    <span class="sub">%</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="noteTeams custom ">
                <p class="team1">東京第一高校</p>
                <p class="team2">広島学園高校</p>
            </div>
        </div>
    </div>
    <script src="{{ get_file_version('/assets/js/bundle.min.js') }}"></script>
</body>
</html>



























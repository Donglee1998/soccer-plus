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
            <div class="groupDateInfo">
                <div class="dateInfo mb20">
                    <p class="tagGray">練習試合</p>
                    <p class="date">2022年10月07日</p>
                </div>
                <div class="dateInfo mb20">
                    <p class="tagGray">更新日</p>
                    <p class="date">2022年12月23日 17:30</p>
                </div>
            </div>
            <div class="tblStyle03 blockScroll02">
                <table>
                    <tr>
                        <td class="ttl1 wCol1" rowspan="5">東京第一高校</td>
                        <td class="ttl3 wCol2" rowspan="5">2</td>
                        <td class="txt1 wCol3">1</td>
                        <td class="txt3 wCol4">1ST</td>
                        <td class="txt1 wCol3">1</td>
                        <td class="ttl3 wCol2" rowspan="5">2</td>
                        <td class="ttl1 wCol1" rowspan="5">広島学園高校</td>
                    </tr>
                    <tr>
                        <td class="txt1">1</td>
                        <td class="txt3">2ND</td>
                        <td class="txt1">1</td>
                    </tr>
                    <tr>
                        <td class="txt1">0</td>
                        <td class="txt3">EXT1</td>
                        <td class="txt1">0</td>
                    </tr>
                    <tr>
                        <td class="txt1">0</td>
                        <td class="txt3">EXT2</td>
                        <td class="txt1">0</td>
                    </tr>
                    <tr>
                        <td class="txt2">4</td>
                        <td class="txt3">PK</td>
                        <td class="txt2">2</td>
                    </tr>
                    <tr class="custom">
                        <td colspan="2">
                            <ul class="listTxt1">
                                <li>
                                    <p class="ttl">1ST：12分</p>
                                    <p class="txt">柴崎岳 / AST：中谷太郎</p>
                                </li>
                                <li>
                                    <p class="ttl">2ND：30分</p>
                                    <p class="txt">南野拓実 /  AST：中谷太郎</p>
                                </li>
                            </ul>
                        </td>
                        <td colspan="3" class="ttl2">得点者</td>
                        <td colspan="2">
                            <ul class="listTxt2">
                                <li>
                                    <p class="ttl">1ST：12分</p>
                                    <p class="txt">柴崎岳 / AST：中谷太郎</p>
                                </li>
                                <li>
                                    <p class="ttl">2ND：30分</p>
                                    <p class="txt">南野拓実 /  AST：中谷太郎</p>
                                </li>
                            </ul>
                        </td>
                    </tr>
                </table>
            </div>
            <h2 class="headline13">時間帯支配率・ゴール・シュート</h2>
            <div class="blockScroll" style="page-break-after: always;">
                <table class="tblStyle05">
                    <tr>
                        <th>
                            <p class="title1">
                                <span class="ttl">15</span>
                                <span class="sub">分</span>
                            </p>
                        </th>
                        <td>
                            <div class="chartRate jsChartRate">
                                <div class="team1">
                                    <p class="percent">
                                        <span class="num">60</span>
                                        <span class="sub">%</span>
                                    </p>
                                </div>
                                <div class="team2">
                                    <p class="percent">
                                        <span class="num"></span>
                                        <span class="sub">%</span>
                                    </p>
                                </div>
                            </div>
                            <div class="groupScore">
                                <ul class="score">
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </ul>
                                <ul class="score">
                                    <li></li>
                                    <li></li>
                                </ul>
                            </div>
                        </td>
                        <th>
                            <p class="title1">
                                <span class="ttl">60</span>
                                <span class="sub">分</span>
                            </p>
                        </th>
                        <td>
                            <div class="chartRate jsChartRate">
                                <div class="team1">
                                    <p class="percent">
                                        <span class="num">60</span>
                                        <span class="sub">%</span>
                                    </p>
                                </div>
                                <div class="team2">
                                    <p class="percent">
                                        <span class="num"></span>
                                        <span class="sub">%</span>
                                    </p>
                                </div>
                            </div>
                            <div class="groupScore">
                                <ul class="score">
                                    <li class="active"></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </ul>
                                <ul class="score">
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <p class="title1">
                                <span class="ttl">30</span>
                                <span class="sub">分</span>
                            </p>
                        </th>
                        <td>
                            <div class="chartRate jsChartRate">
                                <div class="team1">
                                    <p class="percent">
                                        <span class="num">50</span>
                                        <span class="sub">%</span>
                                    </p>
                                </div>
                                <div class="team2">
                                    <p class="percent">
                                        <span class="num"></span>
                                        <span class="sub">%</span>
                                    </p>
                                </div>
                            </div>
                            <div class="groupScore">
                                <ul class="score">
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </ul>
                                <ul class="score">
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </ul>
                            </div>
                        </td>
                        <th>
                            <p class="title1">
                                <span class="ttl">75</span>
                                <span class="sub">分</span>
                            </p>
                        </th>
                        <td>
                            <div class="chartRate jsChartRate">
                                <div class="team1">
                                    <p class="percent">
                                        <span class="num">40</span>
                                        <span class="sub">%</span>
                                    </p>
                                </div>
                                <div class="team2">
                                    <p class="percent">
                                        <span class="num"></span>
                                        <span class="sub">%</span>
                                    </p>
                                </div>
                            </div>
                            <div class="groupScore">
                                <ul class="score">
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </ul>
                                <ul class="score">
                                    <li></li>
                                    <li></li>
                                    <li class="active"></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <p class="title1">
                                <span class="ttl">45</span>
                                <span class="sub">分</span>
                            </p>
                        </th>
                        <td>
                            <div class="chartRate jsChartRate">
                                <div class="team1">
                                    <p class="percent">
                                        <span class="num">40</span>
                                        <span class="sub">%</span>
                                    </p>
                                </div>
                                <div class="team2">
                                    <p class="percent">
                                        <span class="num"></span>
                                        <span class="sub">%</span>
                                    </p>
                                </div>
                            </div>
                            <div class="groupScore">
                                <ul class="score">
                                    <li class="active"></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </ul>
                                <ul class="score">
                                    <li></li>
                                    <li></li>
                                </ul>
                            </div>
                        </td>
                        <th>
                            <p class="title1">
                                <span class="ttl">90</span>
                                <span class="sub">分</span>
                            </p>
                        </th>
                        <td>
                            <div class="chartRate jsChartRate">
                                <div class="team1">
                                    <p class="percent">
                                        <span class="num">60</span>
                                        <span class="sub">%</span>
                                    </p>
                                </div>
                                <div class="team2">
                                    <p class="percent">
                                        <span class="num"></span>
                                        <span class="sub">%</span>
                                    </p>
                                </div>
                            </div>
                            <div class="groupScore">
                                <ul class="score">
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </ul>
                                <ul class="score">
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th><p class="title2">総合</p></th>
                        <td colspan="3">
                            <div class="chartRate jsChartRateTotal">
                                <div class="team1">
                                    <p class="percent">
                                        <span class="num"></span>
                                        <span class="sub">%</span>
                                    </p>
                                </div>
                                <div class="team2">
                                    <p class="percent">
                                        <span class="num"></span>
                                        <span class="sub">%</span>
                                    </p>
                                </div>
                            </div>
                            <div class="groupScore">
                                <ul class="score">
                                    <li class="active"></li>
                                    <li class="active"></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </ul>
                                <ul class="score">
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li class="active"></li>
                                    <li class="active"></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="blockScroll02">
                <div class="blockCommon1">
                    <div class="blockCol1">
                        <p class="headline14 team1">東京第一高校</p>
                        <table class="tblStyle04">
                            <tr>
                                <th class="ttl1" colspan="3">出場選手</th>
                            </tr>
                            <tr>
                                <th class="ttl2">GK</th>
                                <td class="ttl3">1</td>
                                <td>権田 陽翔</td>
                            </tr>
                            <tr>
                                <th class="ttl2" rowspan="4">DF</th>
                                <td class="ttl3">12</td>
                                <td>伊藤 悠真</td>
                            </tr>
                            <tr>
                                <td class="ttl3">23</td>
                                <td>谷口 葵</td>
                            </tr>
                            <tr>
                                <td class="ttl3">30</td>
                                <td>冨安 大和</td>
                            </tr>
                            <tr>
                                <td class="ttl3">5</td>
                                <td>長友 瀬那</td>
                            </tr>
                            <tr>
                                <th class="ttl2" rowspan="3">MF</th>
                                <td class="ttl3">6</td>
                                <td>遠藤 颯</td>
                            </tr>
                            <tr>
                                <td class="ttl3">7</td>
                                <td>柴崎 智也</td>
                            </tr>
                            <tr>
                                <td class="ttl3">8</td>
                                <td>鎌田 蒼大</td>
                            </tr>
                            <tr>
                                <th class="ttl2" rowspan="3">FW</th>
                                <td class="ttl3">15</td>
                                <td>林 一颯</td>
                            </tr>
                            <tr>
                                <td class="ttl3">10</td>
                                <td>田中 結斗</td>
                            </tr>
                            <tr>
                                <td class="ttl3">9</td>
                                <td>浅野 瑠偉</td>
                            </tr>
                            <tr>
                                <th class="ttl1" colspan="3">リザーブ</th>
                            </tr>
                            <tr>
                                <th class="ttl2">GK</th>
                                <td class="ttl3">1</td>
                                <td>西川 修一</td>
                            </tr>
                            <tr>
                                <th class="ttl2" rowspan="2">DF</th>
                                <td class="ttl3">12</td>
                                <td>山根 連</td>
                            </tr>
                            <tr>
                                <td class="ttl3">23</td>
                                <td>瀬古 歩夢</td>
                            </tr>
                            <tr>
                                <th class="ttl2" rowspan="2">MF</th>
                                <td class="ttl3">30</td>
                                <td>吉田 陽翔</td>
                            </tr>
                            <tr>
                                <td class="ttl3">5</td>
                                <td>遠藤 朝陽</td>
                            </tr>
                            <tr>
                                <th class="ttl2" rowspan="2">FW</th>
                                <td class="ttl3">5</td>
                                <td>南野 大地</td>
                            </tr>
                            <tr>
                                <td class="ttl3">1</td>
                                <td>古橋 悠生</td>
                            </tr>
                        </table>
                    </div>
                    <div class="blockCol2">
                        <p class="headline13">チームスタッツ</p>
                        <table class="tblStyle04 custom">
                            <tr>
                                <td class="team1">1</td>
                                <th class="ttl5">得点</th>
                                <td class="team2">1</td>
                            </tr>
                            <tr>
                                <td class="team1">1</td>
                                <th class="ttl5">シュート</th>
                                <td class="team2">1</td>
                            </tr>
                            <tr>
                                <td class="team1">1</td>
                                <th class="ttl5">枠内シュート</th>
                                <td class="team2">1</td>
                            </tr>
                            <tr>
                                <td class="team1">1</td>
                                <th class="ttl5">アシスト</th>
                                <td class="team2">1</td>
                            </tr>
                            <tr>
                                <td class="team1">1</td>
                                <th class="ttl5">ラストパス</th>
                                <td class="team2">1</td>
                            </tr>
                            <tr>
                                <td class="team1">1</td>
                                <th class="ttl5">クロス</th>
                                <td class="team2">1</td>
                            </tr>
                            <tr>
                                <td class="team1">1</td>
                                <th class="ttl5">ドリブル成功</th>
                                <td class="team2">1</td>
                            </tr>
                            <tr>
                                <td class="team1">1</td>
                                <th class="ttl5">被ファウル</th>
                                <td class="team2">1</td>
                            </tr>
                            <tr>
                                <td class="team1">1</td>
                                <th class="ttl5">カット</th>
                                <td class="team2">1</td>
                            </tr>
                            <tr>
                                <td class="team1">1</td>
                                <th class="ttl5">クリア</th>
                                <td class="team2">1</td>
                            </tr>
                            <tr>
                                <td class="team1">1</td>
                                <th class="ttl5">ブロック</th>
                                <td class="team2">1</td>
                            </tr>
                            <tr>
                                <td class="team1">1</td>
                                <th class="ttl5">ファウル</th>
                                <td class="team2">1</td>
                            </tr>
                            <tr>
                                <td class="team1">1</td>
                                <th class="ttl5">こぼれ球奪取</th>
                                <td class="team2">1</td>
                            </tr>
                            <tr>
                                <td class="team1">1</td>
                                <th class="ttl5">PA侵入数</th>
                                <td class="team2">1</td>
                            </tr>
                            <tr>
                                <td class="team1">1</td>
                                <th class="ttl5">ゴールキック</th>
                                <td class="team2">1</td>
                            </tr>
                            <tr>
                                <td class="team1">1</td>
                                <th class="ttl5">フリーキック(直接フリーキック)</th>
                                <td class="team2">1</td>
                            </tr>
                            <tr>
                                <td class="team1">1</td>
                                <th class="ttl5">PK</th>
                                <td class="team2">1</td>
                            </tr>
                            <tr>
                                <td class="team1">1</td>
                                <th class="ttl5">自陣空中戦勝利</th>
                                <td class="team2">1</td>
                            </tr>
                            <tr>
                                <td class="team1">1</td>
                                <th class="ttl5">敵陣空中戦勝利</th>
                                <td class="team2">1</td>
                            </tr>
                            <tr>
                                <td class="team1">1</td>
                                <th class="ttl5">セーブ</th>
                                <td class="team2">1</td>
                            </tr>
                        </table>
                    </div>
                    <div class="blockCol1">
                        <p class="headline14 team2">東京第一高校</p>
                        <table class="tblStyle04">
                            <tr>
                                <th class="ttl1" colspan="3">出場選手</th>
                            </tr>
                            <tr>
                                <th class="ttl2">GK</th>
                                <td class="ttl3">1</td>
                                <td>西川 修一</td>
                            </tr>
                            <tr>
                                <th class="ttl2" rowspan="4">DF</th>
                                <td class="ttl3">1</td>
                                <td>山根 連</td>
                            </tr>
                            <tr>
                                <td class="ttl3">1</td>
                                <td>瀬古 歩夢</td>
                            </tr>
                            <tr>
                                <td class="ttl3">1</td>
                                <td>吉田 陽翔</td>
                            </tr>
                            <tr>
                                <td class="ttl3">1</td>
                                <td>中山 翔</td>
                            </tr>
                            <tr>
                                <th class="ttl2" rowspan="3">MF</th>
                                <td class="ttl3">1</td>
                                <td>遠藤 朝陽</td>
                            </tr>
                            <tr>
                                <td class="ttl3">1</td>
                                <td>南野 大地</td>
                            </tr>
                            <tr>
                                <td class="ttl3">1</td>
                                <td>原口 大翔</td>
                            </tr>
                            <tr>
                                <th class="ttl2" rowspan="3">FW</th>
                                <td class="ttl3">1</td>
                                <td>古橋 悠生</td>
                            </tr>
                            <tr>
                                <td class="ttl3">1</td>
                                <td>上田 広大</td>
                            </tr>
                            <tr>
                                <td class="ttl3">1</td>
                                <td>浅野 律</td>
                            </tr>
                            <tr>
                                <th class="ttl1" colspan="3">リザーブ</th>
                            </tr>
                            <tr>
                                <th class="ttl2">GK</th>
                                <td class="ttl3">1</td>
                                <td>川島 一誠</td>
                            </tr>
                            <tr>
                                <th class="ttl2" rowspan="2">DF</th>
                                <td class="ttl3">1</td>
                                <td>権田 隆</td>
                            </tr>
                            <tr>
                                <td class="ttl3">1</td>
                                <td>浅野 楓</td>
                            </tr>
                            <tr>
                                <th class="ttl2" rowspan="2">MF</th>
                                <td class="ttl3">1</td>
                                <td>板倉 滉</td>
                            </tr>
                            <tr>
                                <td class="ttl3">1</td>
                                <td>長友 一樹</td>
                            </tr>
                            <tr>
                                <th class="ttl2" rowspan="2">FW</th>
                                <td class="ttl3">1</td>
                                <td>上田綺世</td>
                            </tr>
                            <tr>
                                <td class="ttl3">1</td>
                                <td>田中碧</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="blockScroll">
                <table class="tblStyle04">
                    <tr>
                        <th class="ttl1 custom">戦評</th>
                        <td class="custom"></td>
                    </tr>
                    <tr>
                        <th class="ttl4">回戦</th>
                        <td>2回戦</td>
                    </tr>
                    <tr>
                        <th class="ttl4">戦評</th>
                        <td>戦評コメントが入ります戦評コメントが入ります戦評コメントが入ります戦評コメントが入ります戦評コメントが入ります戦評コメントが入ります戦評コメントが入ります戦評コメントが入ります戦評コメントが入ります戦評コメントが入ります戦評コメントが入ります戦評コメントが入ります。</td>
                    </tr>
                    <tr>
                        <th class="ttl4">文責</th>
                        <td>2回戦</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script src="{{ get_file_version('/assets/js/bundle.min.js') }}"></script>
</body>
</html>



























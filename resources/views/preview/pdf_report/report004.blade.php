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
            <h2 class="headline13 mb20">シュート情報（相手チーム）</h2>
            <div class="blockCommon2">
                <div class="headBox">
                    <h3 class="headline3">シュートマップ（マップ）</h3>
                    <p class="shootRate__ttl">シュート成功率</p>
                    <div class="shootRate__level">
                        <span>0~20%<em class="level level1"></em></span>
                        <span>21~40%<em class="level level2"></em></span>
                        <span>41~60%<em class="level level3"></em></span>
                        <span>61~80%<em class="level level4"></em></span>
                        <span>81~100%<em class="level level5"></em></span>
                    </div>
                </div>  
                <div class="contentBox">
                    <div class="chartStatMap1">
                        <div class="boxLeft">
                            <div class="txtCm02 posText1">
                                <p class="per">
                                    <span class="num">0</span>
                                    <span class="sub">%</span>
                                </p>
                                <span class="text">(0/1)</span>
                            </div>
                            <div class="txtCm02 posText2">
                                <p class="per">
                                    <span class="num">0</span>
                                    <span class="sub">%</span>
                                </p>
                                <span class="text">(0/1)</span>
                            </div>
                        </div>
                        <div class="boxRight">
                            <div class="txtCm02 posText1">
                                <p class="per">
                                    <span class="num">0</span>
                                    <span class="sub">%</span>
                                </p>
                                <span class="text">(0/2)</span>
                            </div>
                            <div class="txtCm02 posText2">
                                <p class="per">
                                    <span class="num">0</span>
                                    <span class="sub">%</span>
                                </p>
                                <span class="text">(0/1)</span>
                            </div>
                        </div>
                        <ul class="chartStat1">
                            <li class="boxItem level5">
                                <div class="txtCm02">
                                    <p class="per">
                                        <span class="num">100</span>
                                        <span class="sub">%</span>
                                    </p>
                                    <span class="text">(1/1)</span>
                                </div>
                            </li>
                            <li class="boxItem level2">
                                <div class="txtCm02">
                                    <p class="per">
                                        <span class="num">33</span>
                                        <span class="sub">%</span>
                                    </p>
                                    <span class="text">(1/3)</span>
                                </div>
                            </li>
                            <li class="boxItem">
                                <div class="txtCm02">
                                    <p class="per">
                                        <span class="num">0</span>
                                        <span class="sub">%</span>
                                    </p>
                                    <span class="text">(0/0)</span>
                                </div>
                            </li>
                            <li class="boxItem">
                                <div class="txtCm02">
                                    <p class="per">
                                        <span class="num">0</span>
                                        <span class="sub">%</span>
                                    </p>
                                    <span class="text">(0/0)</span>
                                </div>
                            </li>
                            <li class="boxItem level5">
                                <div class="txtCm02">
                                    <p class="per">
                                        <span class="num">100</span>
                                        <span class="sub">%</span>
                                    </p>
                                    <span class="text">(1/1)</span>
                                </div>
                            </li>
                            <li class="boxItem">
                                <div class="txtCm02">
                                    <p class="per">
                                        <span class="num">0</span>
                                        <span class="sub">%</span>
                                    </p>
                                    <span class="text">(0/0)</span>
                                </div>
                            </li>
                            <li class="boxItem">
                                <div class="txtCm02">
                                    <p class="per">
                                        <span class="num">0</span>
                                        <span class="sub">%</span>
                                    </p>
                                    <span class="text">(0/0)</span>
                                </div>
                            </li>
                            <li class="boxItem">
                                <div class="txtCm02">
                                    <p class="per">
                                        <span class="num">0</span>
                                        <span class="sub">%</span>
                                    </p>
                                    <span class="text">(0/0)</span>
                                </div>
                            </li>
                            <li class="boxItem">
                                <div class="txtCm02">
                                    <p class="per">
                                        <span class="num">0</span>
                                        <span class="sub">%</span>
                                    </p>
                                    <span class="text">(0/0)</span>
                                </div>
                            </li>
                            <li class="boxItem level4">
                                <div class="txtCm02">
                                    <p class="per">
                                        <span class="num">75</span>
                                        <span class="sub">%</span>
                                    </p>
                                    <span class="text">(3/4)</span>
                                </div>
                            </li>
                            <li class="boxItem level2">
                                <div class="txtCm02">
                                    <p class="per">
                                        <span class="num">33</span>
                                        <span class="sub">%</span>
                                    </p>
                                    <span class="text">(1/3)</span>
                                </div>
                            </li>
                            <li class="boxItem">
                                <div class="txtCm02">
                                    <p class="per">
                                        <span class="num">0</span>
                                        <span class="sub">%</span>
                                    </p>
                                    <span class="text">(0/0)</span>
                                </div>
                            </li>
                            <li class="boxItem">
                                <div class="txtCm02">
                                    <p class="per">
                                        <span class="num">0</span>
                                        <span class="sub">%</span>
                                    </p>
                                    <span class="text">(0/0)</span>
                                </div>
                            </li>
                            <li class="boxItem">
                                <div class="txtCm02">
                                    <p class="per">
                                        <span class="num">0</span>
                                        <span class="sub">%</span>
                                    </p>
                                    <span class="text">(0/0)</span>
                                </div>
                            </li>
                            <li class="boxItem level3">
                                <div class="txtCm02">
                                    <p class="per">
                                        <span class="num">50</span>
                                        <span class="sub">%</span>
                                    </p>
                                    <span class="text">(1/2)</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="blockCommon2">
                <div class="headBox">
                    <h3 class="headline3 mb0">シュートマップ（座標）</h3>
                </div>  
                <div class="contentBox">
                    <div class="chartStatMap1">
                        <div class="boxLeft"></div>
                        <div class="boxRight"></div>
                        <span class="coordinate" style="top: 74px;left: 219px;"></span>
                        <span class="coordinate" style="top: 94px;left: 145px;"></span>
                        <span class="coordinate" style="top: 118px;left: 270px;"></span>
                        <span class="coordinate" style="top: 197px;left: 188px;"></span>
                        <span class="coordinate" style="top: 197px;left: 213px;"></span>
                        <span class="coordinate" style="top: 197px;left: 213px;"></span>
                        <span class="coordinate" style="top: 35px;left: 623px;"></span>
                        <span class="coordinate" style="top: 74px;left: 644px;"></span>
                        <span class="coordinate" style="top: 94px;left: 596px;"></span>
                        <span class="coordinate" style="top: 113px;left: 685px;"></span>
                        <span class="coordinate" style="top: 140px;left: 622px;"></span>
                        <span class="coordinate" style="top: 196px;left: 591px;"></span>
                    </div>
                </div>
            </div>
            <div class="blockCommon2" style="page-break-after: always;">
                <div class="headBox">
                    <h3 class="headline3">シュートチャート</h3>
                    <ul class="listDots">
                        <li class="dotRed">ゴール：1本</li>
                        <li class="dotBlue">セーブ：3本</li>
                        <li class="dotGreen">ブロック：２本</li>
                        <li>枠外：6本</li>
                    </ul>
                </div>  
                <div class="contentBox">
                    <div class="chartStatMap1">
                        <div class="chartStat2">
                            <span class="arrow" style="width: 90px;transform: rotate(-39deg);left: 169px;top: 57px;"></span>
                            <span class="arrow" style="width: 41px;transform: rotate(-59deg);left: 221px;top: 46px;"></span>
                            <span class="arrowBlue" style="width: 22px;transform: rotate(-48deg);left: 246px;top: 37px;"></span>
                            <span class="arrowGreen" style="width: 88px;transform: rotate(-82deg);left: 223px;top: 74px;"></span>
                            <span class="arrow" style="width: 88px;transform: rotate(-90deg);left: 237px;top: 74px;"></span>
                            <span class="arrowBlue" style="width: 64px;transform: rotate(-114deg);left: 251px;top: 58px;"></span>
                            <span class="arrowGreen" style="width: 38px;transform: rotate(-109deg);left: 278px;top: 49px;"></span>
                            <span class="arrow" style="width: 91px;transform: rotate(-107deg);left: 273px;top: 73px;"></span>
                            <span class="arrowBlue" style="width: 38px;transform: rotate(-135deg);left: 296px;top: 44px;"></span>
                            <span class="arrowRed" style="width: 65px;transform: rotate(-135deg);left: 300px;top: 53px;"></span>
                            <span class="arrow" style="width: 121px;transform: rotate(-136deg);left: 312px;top: 74px;"></span>
                            <span class="arrow" style="width: 90px;transform: rotate(-33deg);left: 236px;top: 55px;"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="blockCommon2 custom">
                <h3 class="headline3">ゴールパターン（棒グラフ・円グラフ）</h3>
                <div class="blockCommon3">
                    <div class="wrap">
                        <div class="colLeft">
                            <div class="chartCompare2">
                                <ul class="listTtl">
                                    <li>PK</li>
                                    <li>セットプレー直接</li>
                                    <li>セットプレーから</li>
                                    <li>クロスから</li>
                                    <li>スルーパスから</li>
                                    <li>ショートパスから</li>
                                    <li>ロングパスから</li>
                                    <li>ドリブルから</li>
                                    <li>こぼれ球から</li>
                                    <li>その他</li>
                                </ul>
                                <div class="graph">
                                    <div class="item">
                                        <span class="bar" style="width: 28%;"></span>
                                        <span class="sub" style="width: 21%;"></span>
                                    </div>
                                    <div class="item">
                                        <span class="bar" style="width: 21%;"></span>
                                        <span class="sub" style="width: 7%;"></span>
                                    </div>
                                    <div class="item">
                                        <span class="bar" style="width: 64%;"></span>
                                        <span class="sub" style="width: 35%;"></span>
                                    </div>
                                    <div class="item">
                                        <span class="bar" style="width: 64%;"></span>
                                        <span class="sub" style="width: 35%;"></span>
                                    </div>
                                    <div class="item">
                                        <span class="bar" style="width: 21%;"></span>
                                        <span class="sub" style="width: 7%;"></span>
                                    </div>
                                    <div class="item">
                                        <span class="bar" style="width: 78%;"></span>
                                        <span class="sub" style="width: 43%;"></span>
                                    </div>
                                    <div class="item">
                                        <span class="bar" style="width: 14%;"></span>
                                        <span class="sub" style="width: 7%;"></span>
                                    </div>
                                    <div class="item">
                                        <span class="bar" style="width: 7%;"></span>
                                        <span class="sub" style="width: 0%;"></span>
                                    </div>
                                    <div class="item">
                                        <span class="bar" style="width: 7%;"></span>
                                        <span class="sub" style="width: 7%;"></span>
                                    </div>
                                    <div class="item">
                                        <span class="bar" style="width: 14%;"></span>
                                        <span class="sub" style="width: 0%;"></span>
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <div class="colRight">
                            <div class="blockChartCircle">
                                <ul class="listDots2">
                                    <li class="item1">PK</li>
                                    <li class="item2">セットプレー直接</li>
                                    <li class="item3">セットプレーから</li>
                                    <li class="item4">クロスから</li>
                                    <li class="item5">スルーパスから</li>
                                    <li class="item6">ショートパスから</li>
                                    <li class="item7">ロングパスから</li>
                                    <li class="item8">ドリブルから</li>
                                    <li class="item9">こぼれ球から</li>
                                    <li>その他</li>
                                </ul>
                                <div class="chartCircle">
                                    <canvas id="chartCirclePie1"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="blockCommon2 custom">
                <h3 class="headline3">チャンスパターン（棒グラフ・円グラフ）</h3>
                <div class="blockCommon3">
                    <div class="wrap">
                        <div class="colLeft">
                            <div class="chartCompare2">
                                <ul class="listTtl">
                                    <li>PK</li>
                                    <li>セットプレー直接</li>
                                    <li>セットプレーから</li>
                                    <li>クロスから</li>
                                    <li>スルーパスから</li>
                                    <li>ショートパスから</li>
                                    <li>ロングパスから</li>
                                    <li>ドリブルから</li>
                                    <li>こぼれ球から</li>
                                    <li>その他</li>
                                </ul>
                                <div class="graph">
                                    <div class="item">
                                        <span class="bar" style="width: 28%;"></span>
                                        <span class="sub" style="width: 21%;"></span>
                                    </div>
                                    <div class="item">
                                        <span class="bar" style="width: 21%;"></span>
                                        <span class="sub" style="width: 7%;"></span>
                                    </div>
                                    <div class="item">
                                        <span class="bar" style="width: 64%;"></span>
                                        <span class="sub" style="width: 35%;"></span>
                                    </div>
                                    <div class="item">
                                        <span class="bar" style="width: 64%;"></span>
                                        <span class="sub" style="width: 35%;"></span>
                                    </div>
                                    <div class="item">
                                        <span class="bar" style="width: 21%;"></span>
                                        <span class="sub" style="width: 7%;"></span>
                                    </div>
                                    <div class="item">
                                        <span class="bar" style="width: 78%;"></span>
                                        <span class="sub" style="width: 43%;"></span>
                                    </div>
                                    <div class="item">
                                        <span class="bar" style="width: 14%;"></span>
                                        <span class="sub" style="width: 7%;"></span>
                                    </div>
                                    <div class="item">
                                        <span class="bar" style="width: 7%;"></span>
                                        <span class="sub" style="width: 0%;"></span>
                                    </div>
                                    <div class="item">
                                        <span class="bar" style="width: 7%;"></span>
                                        <span class="sub" style="width: 7%;"></span>
                                    </div>
                                    <div class="item">
                                        <span class="bar" style="width: 14%;"></span>
                                        <span class="sub" style="width: 0%;"></span>
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <div class="colRight">
                            <div class="blockChartCircle">
                                <ul class="listDots2">
                                    <li class="item1">PK</li>
                                    <li class="item2">セットプレー直接</li>
                                    <li class="item3">セットプレーから</li>
                                    <li class="item4">クロスから</li>
                                    <li class="item5">スルーパスから</li>
                                    <li class="item6">ショートパスから</li>
                                    <li class="item7">ロングパスから</li>
                                    <li class="item8">ドリブルから</li>
                                    <li class="item9">こぼれ球から</li>
                                    <li>その他</li>
                                </ul>
                                <div class="chartCircle">
                                    <canvas id="chartCirclePie2"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ get_file_version('/assets/js/bundle.min.js') }}"></script>
</body>
</html>



























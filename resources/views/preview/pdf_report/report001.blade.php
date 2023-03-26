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
            <div class="blockScroll mb0 pb0">
                <table class="tblReport">
                    <tbody>
                        <tr>
                            <th>試合種類</th>
                            <td>公式</td>
                            <th>大会名</th>
                            <td>○○○○○○○○○○</td>
                            <th>日時</th>
                            <td>2022/01/05 / 10:00</td>
                        </tr>
                        <tr>
                            <th>場所</th>
                            <td>○○○○○○○○○○</td>
                            <th>試合時間</th>
                            <td>1st：45分 / 2ND：45分</td>
                            <th>人数</th>
                            <td>11人</td>
                        </tr>
                        <tr>
                            <th>PK戦</th>
                            <td>有り</td>
                            <th>ピッチ</th>
                            <td>人工芝</td>
                            <th>状態</th>
                            <td>良い</td>
                        </tr>
                        <tr>
                            <th>主審</th>
                            <td>○○○○○</td>
                            <th>副審</th>
                            <td>○○○○○</td>
                            <th>第四審判</th>
                            <td>○○○○○</td>
                        </tr>
                    </tbody>
                </table>
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
            <div class="tblScroll mb0 pb0"">
                <div class="tblScroll__wrap">
                    <table class="tblReportMatch tdBg01 setFz">
                        <thead>
                            <tr>
                                <th class="w17 mw150" rowspan="2">選手名</th>
                                <th class="mw50" rowspan="2">番号</th>
                                <th colspan="5">シュート</th>
                                <th class="mw150" rowspan="2" colspan="2">ポジション</th>
                                <th colspan="5">シュート</th>
                                <th class="mw50" rowspan="2">番号</th>
                                <th class="w17 mw150" rowspan="2">選手名</th>
                            </tr>
                            <tr>
                                <th>1ST</th>
                                <th>2ND</th>
                                <th>3RD</th>
                                <th>4TH</th>
                                <th>計</th>
                                <th>計</th>
                                <th>4TH</th>
                                <th>3RD</th>
                                <th>2ND</th>
                                <th>1ST</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>川島永嗣</td>
                                <td class="bgGray01">1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="lineGrayL bgGray01">GK</td>
                                <td class="bgGray01">GK</td>
                                <td>1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="bgGray01">1</td>
                                <td>川島永嗣</td>
                            </tr>
                            <tr>
                                <td>川島永嗣</td>
                                <td class="bgGray01">1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="lineGrayL bgGray01">GK</td>
                                <td class="bgGray01">GK</td>
                                <td>1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="bgGray01">1</td>
                                <td>川島永嗣</td>
                            </tr>
                            <tr>
                                <td>川島永嗣</td>
                                <td class="bgGray01">1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="lineGrayL bgGray01">GK</td>
                                <td class="bgGray01">GK</td>
                                <td>1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="bgGray01">1</td>
                                <td>川島永嗣</td>
                            </tr>
                            <tr>
                                <td>川島永嗣</td>
                                <td class="bgGray01">1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="lineGrayL bgGray01">GK</td>
                                <td class="bgGray01">GK</td>
                                <td>1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="bgGray01">1</td>
                                <td>川島永嗣</td>
                            </tr>
                            <tr>
                                <td>川島永嗣</td>
                                <td class="bgGray01">1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="lineGrayL bgGray01">GK</td>
                                <td class="bgGray01">GK</td>
                                <td>1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="bgGray01">1</td>
                                <td>川島永嗣</td>
                            </tr>
                            <tr>
                                <td>川島永嗣</td>
                                <td class="bgGray01">1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="lineGrayL bgGray01">GK</td>
                                <td class="bgGray01">GK</td>
                                <td>1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="bgGray01">1</td>
                                <td>川島永嗣</td>
                            </tr>
                            <tr>
                                <td>川島永嗣</td>
                                <td class="bgGray01">1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="lineGrayL bgGray01">GK</td>
                                <td class="bgGray01">GK</td>
                                <td>1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="bgGray01">1</td>
                                <td>川島永嗣</td>
                            </tr>
                            <tr>
                                <td>川島永嗣</td>
                                <td class="bgGray01">1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="lineGrayL bgGray01">GK</td>
                                <td class="bgGray01">GK</td>
                                <td>1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="bgGray01">1</td>
                                <td>川島永嗣</td>
                            </tr>
                            <tr>
                                <td>川島永嗣</td>
                                <td class="bgGray01">1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="lineGrayL bgGray01">GK</td>
                                <td class="bgGray01">GK</td>
                                <td>1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="bgGray01">1</td>
                                <td>川島永嗣</td>
                            </tr>
                            <tr>
                                <td>川島永嗣</td>
                                <td class="bgGray01">1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="lineGrayL bgGray01">GK</td>
                                <td class="bgGray01">GK</td>
                                <td>1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="bgGray01">1</td>
                                <td>川島永嗣</td>
                            </tr>
                            <tr class="lineGrayB">
                                <td>川島永嗣</td>
                                <td class="bgGray01">1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="lineGrayL bgGray01">GK</td>
                                <td class="bgGray01">GK</td>
                                <td>1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="bgGray01">1</td>
                                <td>川島永嗣</td>
                            </tr>
                            <tr>
                                <td>川島永嗣</td>
                                <td class="bgGray01">1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="lineGrayL bgGray01">GK</td>
                                <td class="bgGray01">GK</td>
                                <td>1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="bgGray01">1</td>
                                <td>川島永嗣</td>
                            </tr>
                            <tr>
                                <td>川島永嗣</td>
                                <td class="bgGray01">1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="lineGrayL bgGray01">GK</td>
                                <td class="bgGray01">GK</td>
                                <td>1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="bgGray01">1</td>
                                <td>川島永嗣</td>
                            </tr>
                            <tr>
                                <td>川島永嗣</td>
                                <td class="bgGray01">1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="lineGrayL bgGray01">GK</td>
                                <td class="bgGray01">GK</td>
                                <td>1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="bgGray01">1</td>
                                <td>川島永嗣</td>
                            </tr>
                            <tr>
                                <td>川島永嗣</td>
                                <td class="bgGray01">1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="lineGrayL bgGray01">GK</td>
                                <td class="bgGray01">GK</td>
                                <td>1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="bgGray01">1</td>
                                <td>川島永嗣</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="blockScroll mb0 pb0">
                <table class="tblReportMatch changePlayer tdBg01 setFz">
                    <thead>
                        <tr>
                            <th class="w13">時間</th>
                            <th colspan="2">OUT</th>
                            <th><span class="iconChange"></span></th>
                            <th colspan="2">IN</th>
                            <th></th>
                            <th colspan="2">IN</th>
                            <th><span class="iconChange01"></span></th>
                            <th colspan="2">OUT</th>
                            <th>TIME</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1ST：27分</td>
                            <td class="bgGray01">1</td>
                            <td>権田徹</td>
                            <td><span class="iconChange"></span></td>
                            <td class="bgGray01">12</td>
                            <td>権田徹</td>
                            <td class="bgGray01" rowspan="5">選手交代</td>
                            <td class="bgGray01">1</td>
                            <td>権田徹</td>
                            <td><span class="iconChange01"></span></td>
                            <td class="bgGray01">12</td>
                            <td>権田徹</td>
                            <td>1ST：27分</td>
                        </tr>
                        <tr>
                            <td>1ST：27分</td>
                            <td class="bgGray01">1</td>
                            <td>権田徹</td>
                            <td><span class="iconChange"></span></td>
                            <td class="bgGray01">12</td>
                            <td>権田徹</td>
                            <td class="bgGray01">1</td>
                            <td>権田徹</td>
                            <td><span class="iconChange01"></span></td>
                            <td class="bgGray01">12</td>
                            <td>権田徹</td>
                            <td>1ST：27分</td>
                        </tr>
                        <tr>
                            <td>1ST：27分</td>
                            <td class="bgGray01">1</td>
                            <td>権田徹</td>
                            <td><span class="iconChange"></span></td>
                            <td class="bgGray01">12</td>
                            <td>権田徹</td>
                            <td class="bgGray01">1</td>
                            <td>権田徹</td>
                            <td><span class="iconChange01"></span></td>
                            <td class="bgGray01">12</td>
                            <td>権田徹</td>
                            <td>1ST：27分</td>
                        </tr>
                        <tr>
                            <td>1ST：27分</td>
                            <td class="bgGray01">1</td>
                            <td>権田徹</td>
                            <td><span class="iconChange"></span></td>
                            <td class="bgGray01">12</td>
                            <td>権田徹</td>
                            <td class="bgGray01">1</td>
                            <td>権田徹</td>
                            <td><span class="iconChange01"></span></td>
                            <td class="bgGray01">12</td>
                            <td>権田徹</td>
                            <td>1ST：27分</td>
                        </tr>
                        <tr>
                            <td>1ST：27分</td>
                            <td class="bgGray01">1</td>
                            <td>権田徹</td>
                            <td><span class="iconChange"></span></td>
                            <td class="bgGray01">12</td>
                            <td>権田徹</td>
                            <td class="bgGray01">1</td>
                            <td>権田徹</td>
                            <td><span class="iconChange01"></span></td>
                            <td class="bgGray01">12</td>
                            <td>権田徹</td>
                            <td>1ST：27分</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="blockScroll pb0 mb10">
                <table class="tblReportMatch matchParameter tdBg01 setFz">
                    <thead>
                        <tr>
                            <th>計</th>
                            <th>4TH</th>
                            <th>3RD</th>
                            <th>2ND</th>
                            <th>1ST</th>
                            <th class="w50">チーム合計</th>
                            <th>1ST</th>
                            <th>2ND</th>
                            <th>3RD</th>
                            <th>4TH</th>
                            <th>計</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="bgGray01">4</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td class="bgGray01">シュート</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td class="bgGray01">4</td>
                        </tr>
                        <tr>
                            <td class="bgGray01">4</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td class="bgGray01">枠内シュート</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td class="bgGray01">4</td>
                        </tr>
                        <tr>
                            <td class="bgGray01">4</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td class="bgGray01">GK</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td class="bgGray01">4</td>
                        </tr>
                        <tr>
                            <td class="bgGray01">4</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td class="bgGray01">CK</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td class="bgGray01">4</td>
                        </tr>
                        <tr>
                            <td class="bgGray01">4</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td class="bgGray01">直接FK</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td class="bgGray01">4</td>
                        </tr>
                        <tr>
                            <td class="bgGray01">4</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td class="bgGray01">間接FK</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td class="bgGray01">4</td>
                        </tr>
                        <tr>
                            <td class="bgGray01">4</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td class="bgGray01">オフサイド</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td class="bgGray01">4</td>
                        </tr>
                        <tr>
                            <td class="bgGray01">4</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td class="bgGray01">PK</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td class="bgGray01">4</td>
                        </tr>
                        <tr>
                            <td class="bgGray01">4</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td class="bgGray01">警告</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td class="bgGray01">4</td>
                        </tr>
                        <tr>
                            <td class="bgGray01">4</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td class="bgGray01">退場</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td class="bgGray01">4</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="{{ get_file_version('/assets/js/bundle.min.js') }}"></script>
</body>
</html>



























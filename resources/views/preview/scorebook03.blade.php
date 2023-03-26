@extends('web.layouts.default', ['title' => 'スタッツ（チーム/個人）'], ['pageName' => 'playByPlay'])
@section('content')
<div class="keyv">
    <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="スタッツ">
    <h1 class="keyvTitle"><span>ゲーム記録</span>スタッツ</h1>
</div>
<div class="content">
    <div class="inner01">
        <ul class="breadscrumb">
            <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a><span>/</span></li>
            <li><a href="/preview/scorebook01">ゲーム記録</a><span>/</span></li>
            <li><em>スタッツ</em></li>
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
        <nav class="analysisNav">
            <a href="/preview/scorebook02">
                <svg class="icon icon01">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_report" />
                </svg>
                <span>試合レポート</span>
            </a>
            <a href="#" class="active">
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
        <div class="timeTab tabArea">
            <div class="col2 itemCenter blockMb40Sp20 tab">
                <nav class="timeTabInfo timeTabCol2 blockMb0Sp25 fS16">
                    <a href="#tab01" class="active">
                        <svg class="icon">
                            <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_arrow_down" />
                        </svg>
                        <span>個人スタッツ</span>
                    </a>
                    <a href="#tab02">
                        <svg class="icon">
                            <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_arrow_down" />
                        </svg>
                        <span>チームスタッツ</span></a>
                </nav>
            </div>
            <div class="timeTabContent tabContents">
                <div id="tab01" class="tabBox">
                    <div class="playControl mb">
                        <div class="item">
                            <div class="groupCtrl">
                                <select name="" id="" class="formControl large">
                                    <option value="">自チーム</option>
                                </select>
                                <select name="" id="" class="formControl large">
                                    <option value="">全ての選手</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="tblTime jsViewOption">
                        <div class="itemHead">時間別で見る</div>
                        <div class="item">
                            <label class="rbCustom">TOTAL
                                <input type="radio" name="toggle1" checked="checked">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="item">
                            <label class="rbCustom">1ST
                                <input class="jsInput" type="radio" name="toggle1">
                                <span class="checkmark"></span>
                            </label>
                            <div class="groupOption ml10">
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time1" value="0" checked="checked">
                                    <span class="checkmark">ALL</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time1" value="1">
                                    <span class="checkmark">3/1</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time1" value="2">
                                    <span class="checkmark">3/2</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time1" value="3">
                                    <span class="checkmark">3/3</span>
                                </label>
                            </div>
                        </div>
                        <div class="item">
                            <label class="rbCustom">2ND
                                <input class="jsInput" type="radio" name="toggle1">
                                <span class="checkmark"></span>
                            </label>
                            <div class="groupOption ml10">
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time2" value="0" checked="checked">
                                    <span class="checkmark">ALL</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time2" value="1">
                                    <span class="checkmark">3/1</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time2" value="2">
                                    <span class="checkmark">3/2</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time2" value="3">
                                    <span class="checkmark">3/3</span>
                                </label>
                            </div>
                        </div>
                        <div class="item">
                            <label class="rbCustom">3RD
                                <input class="jsInput" type="radio" name="toggle1">
                                <span class="checkmark"></span>
                            </label>
                            <div class="groupOption ml10">
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time3" value="0" checked="checked">
                                    <span class="checkmark">ALL</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time3" value="1">
                                    <span class="checkmark">3/1</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time3" value="2">
                                    <span class="checkmark">3/2</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time3" value="3">
                                    <span class="checkmark">3/3</span>
                                </label>
                            </div>
                        </div>
                        <div class="item">
                            <label class="rbCustom">4TH
                                <input class="jsInput" type="radio" name="toggle1">
                                <span class="checkmark"></span>
                            </label>
                            <div class="groupOption ml10">
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time4" value="0" checked="checked">
                                    <span class="checkmark">ALL</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time4" value="1">
                                    <span class="checkmark">3/1</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time4" value="2">
                                    <span class="checkmark">3/2</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time4" value="3">
                                    <span class="checkmark">3/3</span>
                                </label>
                            </div>
                        </div>
                        <div class="item">
                            <label class="rbCustom">EXT1
                                <input class="jsInput" type="radio" name="toggle1">
                                <span class="checkmark"></span>
                            </label>
                            <div class="groupOption ml10">
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time5" value="0" checked="checked">
                                    <span class="checkmark">ALL</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time5" value="1">
                                    <span class="checkmark">3/1</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time5" value="2">
                                    <span class="checkmark">3/2</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time5" value="3">
                                    <span class="checkmark">3/3</span>
                                </label>
                            </div>
                        </div>
                        <div class="item">
                            <label class="rbCustom">EXT2
                                <input class="jsInput" type="radio" name="toggle1">
                                <span class="checkmark"></span>
                            </label>
                            <div class="groupOption ml10">
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time6" value="0" checked="checked">
                                    <span class="checkmark">ALL</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time6" value="1">
                                    <span class="checkmark">3/1</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time6" value="2">
                                    <span class="checkmark">3/2</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time6" value="3">
                                    <span class="checkmark">3/3</span>
                                </label>
                            </div>
                        </div>
                        <div class="item spNone"></div>
                    </div>
                    <div class="tblScroll">
                        <div class="tblScroll__wrap">
                            <table class="tblList fixed4Col mb0" id="tblScroll011">
                                <thead>
                                    <tr>
                                        <th class="wid86 bg01 fixed-side">
                                            <div class="groupSort">
                                                No.
                                                <div class="groupSort__button">
                                                    <span class="groupSort__button-arrUp"></span>
                                                    <span class="groupSort__button-arrDown"></span>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="wid100 bg01 fixed-side">
                                            <div class="groupSort">
                                                POS
                                                <div class="groupSort__button">
                                                    <span class="groupSort__button-arrUp"></span>
                                                    <span class="groupSort__button-arrDown"></span>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="wid120 bg01 fixed-side">
                                            <div class="groupSort">
                                                選手名
                                                <div class="groupSort__button">
                                                    <span class="groupSort__button-arrUp"></span>
                                                    <span class="groupSort__button-arrDown"></span>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="wid120 bg01 fixed-side">
                                            <div class="groupSort">
                                                出場時間
                                                <div class="groupSort__button">
                                                    <span class="groupSort__button-arrUp"></span>
                                                    <span class="groupSort__button-arrDown"></span>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="w10">
                                            <div class="groupSort">
                                                ゴール
                                                <div class="groupSort__button">
                                                    <span class="groupSort__button-arrUp"></span>
                                                    <span class="groupSort__button-arrDown"></span>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="w10">
                                            <div class="groupSort">
                                                失点
                                                <div class="groupSort__button">
                                                    <span class="groupSort__button-arrUp"></span>
                                                    <span class="groupSort__button-arrDown"></span>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="w10">
                                            <div class="groupSort">
                                                シュート
                                                <div class="groupSort__button">
                                                    <span class="groupSort__button-arrUp"></span>
                                                    <span class="groupSort__button-arrDown"></span>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="w10">
                                            <div class="groupSort">
                                                枠内シュート
                                                <div class="groupSort__button">
                                                    <span class="groupSort__button-arrUp"></span>
                                                    <span class="groupSort__button-arrDown"></span>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="w10">
                                            <div class="groupSort">
                                                アシスト
                                                <div class="groupSort__button">
                                                    <span class="groupSort__button-arrUp"></span>
                                                    <span class="groupSort__button-arrDown"></span>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="w10">
                                            <div class="groupSort">
                                                ラストパス
                                                <div class="groupSort__button">
                                                    <span class="groupSort__button-arrUp"></span>
                                                    <span class="groupSort__button-arrDown"></span>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="w10">
                                            <div class="groupSort">
                                                カット
                                                <div class="groupSort__button">
                                                    <span class="groupSort__button-arrUp"></span>
                                                    <span class="groupSort__button-arrDown"></span>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="w10">
                                            <div class="groupSort">
                                                クロス
                                                <div class="groupSort__button">
                                                    <span class="groupSort__button-arrUp"></span>
                                                    <span class="groupSort__button-arrDown"></span>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="w10">
                                            <div class="groupSort">
                                                ファウル
                                                <div class="groupSort__button">
                                                    <span class="groupSort__button-arrUp"></span>
                                                    <span class="groupSort__button-arrDown"></span>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="w10">
                                            <div class="groupSort">
                                                被ファウル
                                                <div class="groupSort__button">
                                                    <span class="groupSort__button-arrUp"></span>
                                                    <span class="groupSort__button-arrDown"></span>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="w10">
                                            <div class="groupSort">
                                                クリア
                                                <div class="groupSort__button">
                                                    <span class="groupSort__button-arrUp"></span>
                                                    <span class="groupSort__button-arrDown"></span>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="w10">
                                            <div class="groupSort">
                                                ブロック
                                                <div class="groupSort__button">
                                                    <span class="groupSort__button-arrUp"></span>
                                                    <span class="groupSort__button-arrDown"></span>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="w10">
                                            <div class="groupSort">
                                                こぼれ球奪取
                                                <div class="groupSort__button">
                                                    <span class="groupSort__button-arrUp"></span>
                                                    <span class="groupSort__button-arrDown"></span>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="w10">
                                            <div class="groupSort">
                                                ゴールキック
                                                <div class="groupSort__button">
                                                    <span class="groupSort__button-arrUp"></span>
                                                    <span class="groupSort__button-arrDown"></span>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="w10">
                                            <div class="groupSort">
                                                フリーキック数
                                                <div class="groupSort__button">
                                                    <span class="groupSort__button-arrUp"></span>
                                                    <span class="groupSort__button-arrDown"></span>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="w10">
                                            <div class="groupSort">
                                                1対1勝利数
                                                <div class="groupSort__button">
                                                    <span class="groupSort__button-arrUp"></span>
                                                    <span class="groupSort__button-arrDown"></span>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="w10">
                                            <div class="groupSort">
                                                空中戦勝利数
                                                <div class="groupSort__button">
                                                    <span class="groupSort__button-arrUp"></span>
                                                    <span class="groupSort__button-arrDown"></span>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="w10">
                                            <div class="groupSort">
                                                キャッチ
                                                <div class="groupSort__button">
                                                    <span class="groupSort__button-arrUp"></span>
                                                    <span class="groupSort__button-arrDown"></span>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="w10">
                                            <div class="groupSort">
                                                パンチング
                                                <div class="groupSort__button">
                                                    <span class="groupSort__button-arrUp"></span>
                                                    <span class="groupSort__button-arrDown"></span>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="w10">
                                            <div class="groupSort">
                                                セーブ
                                                <div class="groupSort__button">
                                                    <span class="groupSort__button-arrUp"></span>
                                                    <span class="groupSort__button-arrDown"></span>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="fixed-side">1</td>
                                        <td class="fixed-side">GK</td>
                                        <td class="fixed-side">川島永嗣</td>
                                        <td class="fixed-side">45分</td>
                                        <td>0</td>
                                        <td>1</td>
                                        <td>7</td>
                                        <td>5</td>
                                        <td>3</td>
                                        <td>1</td>
                                        <td>5</td>
                                        <td>2</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>6</td>
                                        <td>3</td>
                                        <td>2</td>
                                    </tr>
                                    <tr>
                                        <td class="fixed-side">2</td>
                                        <td class="fixed-side">DF</td>
                                        <td class="fixed-side">植田直通</td>
                                        <td class="fixed-side">90分</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td class="fixed-side">3</td>
                                        <td class="fixed-side">DF</td>
                                        <td class="fixed-side">室屋成</td>
                                        <td class="fixed-side">45分</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td class="fixed-side">4</td>
                                        <td class="fixed-side">DF</td>
                                        <td class="fixed-side">板倉滉</td>
                                        <td class="fixed-side">45分</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td class="fixed-side">5</td>
                                        <td class="fixed-side">DF</td>
                                        <td class="fixed-side">長友佑都</td>
                                        <td class="fixed-side">45分</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td class="fixed-side">6</td>
                                        <td class="fixed-side">MF</td>
                                        <td class="fixed-side">遠藤航</td>
                                        <td class="fixed-side">90分</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td class="fixed-side">7</td>
                                        <td class="fixed-side">MF</td>
                                        <td class="fixed-side">柴崎岳</td>
                                        <td class="fixed-side">90分</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                    </tr>
                                    <tr>
                                        <td class="fixed-side">8</td>
                                        <td class="fixed-side">FW</td>
                                        <td class="fixed-side">原口元気</td>
                                        <td class="fixed-side">90分</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                    </tr>
                                    <tr>
                                        <td class="fixed-side">9</td>
                                        <td class="fixed-side">FW</td>
                                        <td class="fixed-side">鎌田大地</td>
                                        <td class="fixed-side">90分</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td class="fixed-side">10</td>
                                        <td class="fixed-side">FW</td>
                                        <td class="fixed-side">南野拓実</td>
                                        <td class="fixed-side">90分</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td class="fixed-side">11</td>
                                        <td class="fixed-side">FW</td>
                                        <td class="fixed-side">古橋亨梧</td>
                                        <td class="fixed-side">90分</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td class="fixed-side">12</td>
                                        <td class="fixed-side">GF</td>
                                        <td class="fixed-side">権田徹</td>
                                        <td class="fixed-side">45分</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td class="fixed-side">13</td>
                                        <td class="fixed-side">DF</td>
                                        <td class="fixed-side">中谷太郎</td>
                                        <td class="fixed-side">45分</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td class="fixed-side">14</td>
                                        <td class="fixed-side">DF</td>
                                        <td class="fixed-side">酒井和人</td>
                                        <td class="fixed-side">45分</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td class="fixed-side">15</td>
                                        <td class="fixed-side">DF</td>
                                        <td class="fixed-side">久保和也</td>
                                        <td class="fixed-side">0分</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr class="bg02">
                                        <td class="fixed-side"></td>
                                        <td class="fixed-side"></td>
                                        <td class="fixed-side">TOTAL</td>
                                        <td class="fixed-side"></td>
                                        <td>6</td>
                                        <td>6</td>
                                        <td>6</td>
                                        <td>6</td>
                                        <td>6</td>
                                        <td>6</td>
                                        <td>6</td>
                                        <td>6</td>
                                        <td>6</td>
                                        <td>6</td>
                                        <td>6</td>
                                        <td>6</td>
                                        <td>6</td>
                                        <td>6</td>
                                        <td>6</td>
                                        <td>6</td>
                                        <td>6</td>
                                        <td>6</td>
                                        <td>6</td>
                                        <td>6</td>
                                    </tr>
                                    <tr class="bg03">
                                        <td class="fixed-side"></td>
                                        <td class="fixed-side"></td>
                                        <td class="fixed-side">AVG</td>
                                        <td class="fixed-side"></td>
                                        <td>0.4</td>
                                        <td>0.4</td>
                                        <td>0.4</td>
                                        <td>0.4</td>
                                        <td>0.4</td>
                                        <td>0.4</td>
                                        <td>0.4</td>
                                        <td>0.4</td>
                                        <td>0.4</td>
                                        <td>0.4</td>
                                        <td>0.4</td>
                                        <td>0.4</td>
                                        <td>0.4</td>
                                        <td>0.4</td>
                                        <td>0.4</td>
                                        <td>0.4</td>
                                        <td>0.4</td>
                                        <td>0.4</td>
                                        <td>0.4</td>
                                        <td>0.4</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="tab02" class="tabBox">
                    <div class="playControl mb">
                        <div class="item">
                            <div class="groupCtrl">
                                <select name="" id="" class="formControl large">
                                    <option value="">自チーム</option>
                                </select>
                                <select name="" id="" class="formControl large">
                                    <option value="">全ての選手</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="tblTime jsViewOption">
                        <div class="itemHead">時間別で見る</div>
                        <div class="item">
                            <label class="rbCustom">TOTAL
                                <input type="radio" name="toggle2" checked="checked">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="item">
                            <label class="rbCustom">1ST
                                <input class="jsInput" type="radio" name="toggle2">
                                <span class="checkmark"></span>
                            </label>
                            <div class="groupOption ml10">
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time7" value="0" checked="checked">
                                    <span class="checkmark">ALL</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time7" value="1">
                                    <span class="checkmark">3/1</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time7" value="2">
                                    <span class="checkmark">3/2</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time7" value="3">
                                    <span class="checkmark">3/3</span>
                                </label>
                            </div>
                        </div>
                        <div class="item">
                            <label class="rbCustom">2ND
                                <input class="jsInput" type="radio" name="toggle2">
                                <span class="checkmark"></span>
                            </label>
                            <div class="groupOption ml10">
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time8" value="0" checked="checked">
                                    <span class="checkmark">ALL</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time8" value="1">
                                    <span class="checkmark">3/1</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time8" value="2">
                                    <span class="checkmark">3/2</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time8" value="3">
                                    <span class="checkmark">3/3</span>
                                </label>
                            </div>
                        </div>
                        <div class="item">
                            <label class="rbCustom">3RD
                                <input class="jsInput" type="radio" name="toggle2">
                                <span class="checkmark"></span>
                            </label>
                            <div class="groupOption ml10">
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time9" value="0" checked="checked">
                                    <span class="checkmark">ALL</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time9" value="1">
                                    <span class="checkmark">3/1</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time9" value="2">
                                    <span class="checkmark">3/2</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time9" value="3">
                                    <span class="checkmark">3/3</span>
                                </label>
                            </div>
                        </div>
                        <div class="item">
                            <label class="rbCustom">4TH
                                <input class="jsInput" type="radio" name="toggle2">
                                <span class="checkmark"></span>
                            </label>
                            <div class="groupOption ml10">
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time10" value="0" checked="checked">
                                    <span class="checkmark">ALL</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time10" value="1">
                                    <span class="checkmark">3/1</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time10" value="2">
                                    <span class="checkmark">3/2</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time10" value="3">
                                    <span class="checkmark">3/3</span>
                                </label>
                            </div>
                        </div>
                        <div class="item">
                            <label class="rbCustom">EXT1
                                <input class="jsInput" type="radio" name="toggle2">
                                <span class="checkmark"></span>
                            </label>
                            <div class="groupOption ml10">
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time11" value="0" checked="checked">
                                    <span class="checkmark">ALL</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time11" value="1">
                                    <span class="checkmark">3/1</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time11" value="2">
                                    <span class="checkmark">3/2</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time11" value="3">
                                    <span class="checkmark">3/3</span>
                                </label>
                            </div>
                        </div>
                        <div class="item">
                            <label class="rbCustom">EXT2
                                <input class="jsInput" type="radio" name="toggle2">
                                <span class="checkmark"></span>
                            </label>
                            <div class="groupOption ml10">
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time12" value="0" checked="checked">
                                    <span class="checkmark">ALL</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time12" value="1">
                                    <span class="checkmark">3/1</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time12" value="2">
                                    <span class="checkmark">3/2</span>
                                </label>
                                <label class="rbCustom2">
                                    <input type="radio" name="sub_time12" value="3">
                                    <span class="checkmark">3/3</span>
                                </label>
                            </div>
                        </div>
                        <div class="item spNone"></div>
                    </div>
                    <ul class="listResult">
                        <li class="listResult__item">
                            <span class="result team1">2</span>
                            <span class="ttl">ゴール</span>
                            <span class="result team2">1</span>
                        </li>
                        <li class="listResult__item">
                            <span class="result team1">1</span>
                            <span class="ttl">ゴール</span>
                            <span class="result team2">2</span>
                        </li>
                        <li class="listResult__item">
                            <span class="result team1">2</span>
                            <span class="ttl">シュート</span>
                            <span class="result team2">1</span>
                        </li>
                        <li class="listResult__item">
                            <span class="result team1">1</span>
                            <span class="ttl">枠内シュート</span>
                            <span class="result team2">2</span>
                        </li>
                        <li class="listResult__item">
                            <span class="result team1">2</span>
                            <span class="ttl">アシスト</span>
                            <span class="result team2">1</span>
                        </li>
                        <li class="listResult__item">
                            <span class="result team1">1</span>
                            <span class="ttl">ラストパス</span>
                            <span class="result team2">2</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection

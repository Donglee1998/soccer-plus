@extends('web.layouts.default', ['title' => 'test'], ['pageName' =>
'playByPlay']) @section('content')
<div class="keyv">
    <img
        class="keyvImage"
        src="/assets/img/common/keyv_detail.jpg"
        alt="プレミアチームのご案内"
    />
    <h1 class="keyvTitle"><span>ゲーム記録</span>比較表</h1>
</div>
<div class="contentt">
    <div class="inner01">
        <ul class="breadscrumb">
            <li>
                <a href="/"
                    ><img src="/assets/img/svg/icon_home.svg" alt="" /></a
                ><span>/</span>
            </li>
            <li><a href="/">ゲーム記録</a><span>/</span></li>
            <li><em>比較表</em></li>
        </ul>
        <div class="dateInfo">
            <p class="tag">練習試合</p>
            <p class="date">2022年7月4日</p>
        </div>
        <div class="teamInfo">
            <p class="teamInfoName">
                <span class="teamColor home">
                    <svg class="icon">
                        <use
                            xlink:href="/assets/img/svg/symbol-defs.svg#icon_color_team"
                        />
                    </svg>
                </span>
                <span class="name">池袋〇〇〇〇〇〇</span>
            </p>
            <p class="vsBox">VS</p>
            <p class="teamInfoName">
                <span class="teamColor away">
                    <svg class="icon">
                        <use
                            xlink:href="/assets/img/svg/symbol-defs.svg#icon_color_team"
                        />
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
            <a href="#">
                <svg class="icon icon01">
                    <use
                        xlink:href="/assets/img/svg/symbol-defs.svg#icon_report"
                    />
                </svg>
                <span>試合レポート</span>
            </a>
            <a href="#">
                <svg class="icon icon02">
                    <use
                        xlink:href="/assets/img/svg/symbol-defs.svg#icon_ball"
                    />
                </svg>
                <span>スタッツ</span>
            </a>
            <a href="#" class="active">
                <svg class="icon icon03">
                    <use
                        xlink:href="/assets/img/svg/symbol-defs.svg#icon_chart"
                    />
                </svg>
                <span>比較表</span>
            </a>
            <a href="#">
                <svg class="icon icon04">
                    <use
                        xlink:href="/assets/img/svg/symbol-defs.svg#icon_ytb"
                    />
                </svg>
                <span>Play by Play Video</span>
            </a>
        </nav>
        <div class="section01">
            <h2 class="headline5 mgb30">比較表</h2>
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
            <div class="blockChart">
                <div class="blockChart__item">
                    <canvas id="myChart" width="494" height="560"></canvas>
                </div>
                <div class="blockChart__item">
                    <canvas id="myChart2" width="494" height="560"></canvas>
                </div>
            </div>
        </div>
        <div class="section02">
            <h2 class="headline5 mgb30">シュートマップ</h2>
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
                        <input type="radio" name="toggle2">
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
                        <input class="jsInput" type="radio" name="toggle2" checked="checked">
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
            <div class="shootRate">
                <span class="shootRate__ttl">シュート成功率</span>
                <div class="shootRate__level box">
                    <span>
                        0~20%
                        <em class="level level1"></em>
                    </span>
                    <span>
                        21~40%
                        <em class="level level2"></em>
                    </span>
                    <span>
                        41~60%
                        <em class="level level3"></em>
                    </span>
                    <span>
                        61~80%
                        <em class="level level4"></em>
                    </span>
                    <span>
                        81~100%
                        <em class="level level5"></em>
                    </span>
                </div>
            </div>
            <div class="mapScroll">
                <div class="blockMap blockMap01">
                    <div class="blockMapStats__goal">
                        <div class="layoutLeft">
                            <div class="layoutItem__zone layout-item__lef">
                                <div class="goalNumbers__item" style="background-color: rgb(204, 204, 204);">
                                    <div class="goalRatio">0 <span class="goal-value">%</span></div>
                                    <div class="goalValue font-barlow-semi">(0/0)</div>
                                </div>
                            </div>
                        </div>
                        <div class="layoutTop">
                            <div class="layoutItem__zone layoutItem__lef">
                                <div class="goalNumbers__item" style="background-color: rgb(204, 204, 204);">
                                    <div class="goalRatio">0 <span class="goalValue">%</span></div>
                                    <div class="goalValue font-barlow-semi">(0/0)</div>
                                </div>
                            </div>
                            <div class="layoutItem__zone layoutItem__right">
                                <div class="goalNumbers__item" style="background-color: rgb(204, 204, 204);">
                                    <div class="goalRatio">0 <span class="goal-value">%</span></div>
                                    <div class="goalValue font-barlow-semi">(0/0)</div>
                                </div>
                            </div>
                        </div>
                        <div class="layoutRight">
                            <div class="layoutItem__zone layout-item__bottom">
                                <div class="goalNumbers__item" style="background-color: rgb(204, 204, 204);">
                                    <div class="goalRatio">0 <span class="goalValue">%</span></div>
                                    <div class="goalValue font-barlow-semi">(0/0)</div>
                                </div>
                            </div>
                        </div>
                        <div class="layoutMiddle">
                            <div class="goalNumbers">
                                <div class="goalNumbers__wrap">
                                    <div class="goalNumbers__item">
                                        <div class="goalRatio">
                                            0 <span class="goalValue">%</span>
                                        </div>
                                        <div class="goalValue">(0/0)</div>
                                    </div>
                                    <div class="goalNumbers__item">
                                        <div class="goalRatio">
                                            0 <span class="goalValue">%</span>
                                        </div>
                                        <div class="goalValue">(0/0)</div>
                                    </div>
                                    <div class="goalNumbers__item active">
                                        <div class="goalRatio">
                                            100
                                            <span class="goalValue">%</span>
                                        </div>
                                        <div class="goalValue">(1/1)</div>
                                    </div>
                                    <div class="goalNumbers__item">
                                        <div class="goalRatio">
                                            0 <span class="goalValue">%</span>
                                        </div>
                                        <div class="goalValue">(0/0)</div>
                                    </div>
                                    <div class="goalNumbers__item">
                                        <div class="goalRatio">
                                            0 <span class="goalValue">%</span>
                                        </div>
                                        <div class="goalValue">(0/1)</div>
                                    </div>
                                    <div class="goalNumbers__item">
                                        <div class="goalRatio">
                                            0 <span class="goalValue">%</span>
                                        </div>
                                        <div class="goalValue">(0/0)</div>
                                    </div>
                                    <div class="goalNumbers__item">
                                        <div class="goalRatio">
                                            0 <span class="goalValue">%</span>
                                        </div>
                                        <div class="goalValue">(0/0)</div>
                                    </div>
                                    <div class="goalNumbers__item">
                                        <div class="goalRatio">
                                            0 <span class="goalValue">%</span>
                                        </div>
                                        <div class="goalValue">(0/0)</div>
                                    </div>
                                    <div class="goalNumbers__item">
                                        <div class="goalRatio">
                                            0 <span class="goalValue">%</span>
                                        </div>
                                        <div class="goalValue">(0/0)</div>
                                    </div>
                                    <div class="goalNumbers__item">
                                        <div class="goalRatio">
                                            0 <span class="goalValue">%</span>
                                        </div>
                                        <div class="goalValue">(0/0)</div>
                                    </div>
                                    <div class="goalNumbers__item">
                                        <div class="goalRatio">
                                            0 <span class="goalValue">%</span>
                                        </div>
                                        <div class="goalValue">(0/0)</div>
                                    </div>
                                    <div class="goalNumbers__item">
                                        <div class="goalRatio">
                                            0 <span class="goalValue">%</span>
                                        </div>
                                        <div class="goalValue">(0/0)</div>
                                    </div>
                                    <div class="goalNumbers__item">
                                        <div class="goalRatio">
                                            0 <span class="goalValue">%</span>
                                        </div>
                                        <div class="goalValue">(0/0)</div>
                                    </div>
                                    <div class="goalNumbers__item">
                                        <div class="goalRatio">
                                            0 <span class="goalValue">%</span>
                                        </div>
                                        <div class="goalValue">(0/0)</div>
                                    </div>
                                    <div class="goalNumbers__item">
                                        <div class="goalRatio">
                                            0 <span class="goalValue">%</span>
                                        </div>
                                        <div class="goalValue">(0/0)</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="blockMap__picture">
                        <div class="picture__outside">
                            <div
                                class="item handledZone"
                                data-action="dataZone"
                            >
                                <span class="zone">zone <em>I</em></span>
                            </div>
                        </div>
                        <div class="picture__main">
                            <div
                                class="item handledZone active"
                                data-action="dataZone"
                            >
                                <span class="zone">zone<em>A</em></span>
                            </div>
                            <div
                                class="item handledZone"
                                data-action="dataZone"
                            >
                                <span class="zone">zone<em>B</em></span>
                            </div>
                            <div
                                class="item handledZone"
                                data-action="dataZone"
                            >
                                <span class="zone">zone<em>C</em></span>
                            </div>
                            <div
                                class="item handledZone"
                                data-action="dataZone"
                            >
                                <span class="zone">zone<em>D</em></span>
                            </div>
                            <div
                                class="item handledZone"
                                data-action="dataZone"
                            >
                                <span class="zone">zone<em>E</em></span>
                            </div>
                            <div
                                class="item handledZone"
                                data-action="dataZone"
                            >
                                <span class="zone">zone<em>F</em></span>
                            </div>
                            <div
                                class="item handledZone"
                                data-action="dataZone"
                            >
                                <span class="zone">zone<em>G</em></span>
                            </div>
                            <div
                                class="item handledZone"
                                data-action="dataZone"
                            >
                                <span class="zone">zone<em>H</em></span>
                            </div>
                            <div class="picture__outside w100">
                                <div
                                    class="item handledZone posLeft active"
                                    data-action="dataZone"
                                >
                                    <div class="ml40">
                                        <span class="zone">zone<em>J</em></span>
                                    </div>
                                </div>
                                <div
                                    class="item handledZone posRight right active"
                                    data-action="dataZone"
                                >
                                    <div class="left auto mr40">
                                        <span class="zone">zone<em>K</em></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="picture__outside">
                            <div
                                class="item handledZone"
                                data-action="dataZone"
                            >
                                <span class="zone">zone<em>L</em></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btnGroupList01">
                <a
                    href="#"
                    class="btnScorebook green handledRemoveZone"
                    data-action="show"
                >
                    <img src="/assets/img/svg/ic_checked.svg" alt="" />
                    <span>全てのZONEを解除</span>
                </a>
                <a
                    href="#"
                    class="btnScorebook purple handledSwitchMode"
                    data-action="ratio"
                >
                    <img src="/assets/img/svg/ic_coordinate.svg" alt="" />
                    <span>座標表示に切り替え</span>
                </a>
            </div>
        </div>
        <div class="section02">
            <h2 class="headline5 mgb40">シュートチャート</h2>
            <form action="">
                <div class="playControl">
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
                <div class="blockScroll01 section03">
                    <div class="toggleDisplay checkLstBox">
                        <p class="ttl">ゴール種別 /</p>
                        <p class="ckCustomBox checkNote01">
                            <label class="ckCustom">
                                <input type="checkbox" name="toggle">
                                <span class="checkmark"></span>
                                ゴール
                            </label>
                        </p>
                        <p class="ckCustomBox checkNote02">
                            <label class="ckCustom">
                                <input type="checkbox" name="toggle">
                                <span class="checkmark"></span>
                                セーブ
                            </label>
                        </p>
                        <p class="ckCustomBox checkNote03">
                            <label class="ckCustom">
                                <input type="checkbox" name="toggle">
                                <span class="checkmark"></span>
                                ブロック
                            </label>
                        </p>
                        <p class="ckCustomBox checkNote04">
                            <label class="ckCustom">
                                <input type="checkbox" name="toggle">
                                <span class="checkmark"></span>
                                枠外
                            </label>
                        </p>
                    </div>
                </div>
                <div class="chartStatMap2">
                    <p class="imgGoal"><img src="/assets/img/svg/bg_match_goal_2.svg" alt=""></p>
                    <div class="wrap">
                        <svg class="mapSvg">
                            <defs>
                                <marker id="pointStartGray" markerWidth="4" markerHeight="4" viewBox="0 0 8 8" refX="5" refY="4" markerUnits="strokeWidth" orient="auto">
                                    <circle cx="4" cy="4" r="2" stroke="#CCC" fill="#CCC"></circle>
                                </marker>
                                <marker id="pointEndGray" markerWidth="4" markerHeight="2.8" viewBox="0 0 10 10" refX="0" refY="5" markerUnits="strokeWidth" orient="auto">
                                    <path d="M 0 2 L 10 5 L 0 8 z" stroke="#CCC" fill="#CCC"></path>
                                </marker>
                                <marker id="pointStartGreen" markerWidth="4" markerHeight="4" viewBox="0 0 8 8" refX="5" refY="4" markerUnits="strokeWidth" orient="auto">
                                    <circle cx="4" cy="4" r="2" stroke="#9BF237" fill="#9BF237"></circle>
                                </marker>
                                <marker id="pointEndGreen" markerWidth="4" markerHeight="2.8" viewBox="0 0 10 10" refX="0" refY="5" markerUnits="strokeWidth" orient="auto">
                                    <path d="M 0 2 L 10 5 L 0 8 z" stroke="#9BF237" fill="#9BF237"></path>
                                </marker>
                                <marker id="pointStartBlue" markerWidth="4" markerHeight="4" viewBox="0 0 8 8" refX="5" refY="4" markerUnits="strokeWidth" orient="auto">
                                    <circle cx="4" cy="4" r="2" stroke="#37B7F0" fill="#37B7F0"></circle>
                                </marker>
                                <marker id="pointEndBlue" markerWidth="4" markerHeight="2.8" viewBox="0 0 10 10" refX="0" refY="5" markerUnits="strokeWidth" orient="auto">
                                    <path d="M 0 2 L 10 5 L 0 8 z" stroke="#37B7F0" fill="#37B7F0"></path>
                                </marker>
                                <marker id="pointStartRed" markerWidth="4" markerHeight="4" viewBox="0 0 8 8" refX="5" refY="4" markerUnits="strokeWidth" orient="auto">
                                    <circle cx="4" cy="4" r="2" stroke="#FF6565" fill="#FF6565"></circle>
                                </marker>
                                <marker id="pointEndRed" markerWidth="4" markerHeight="2.8" viewBox="0 0 10 10" refX="0" refY="5" markerUnits="strokeWidth" orient="auto">
                                    <path d="M 0 2 L 10 5 L 0 8 z" stroke="#FF6565" fill="#FF6565"></path>
                                </marker>
                            </defs>
                            <line class="gray" x1="20%" y1="50%" x2="45%" y2="14%" marker-end="url(#pointEndGray)" marker-start="url(#pointStartGray)"/>
                            <line class="green" x1="40%" y1="40%" x2="47%" y2="14%" marker-end="url(#pointEndGreen)" marker-start="url(#pointStartGreen)"/>
                            <line class="blue" x1="60%" y1="50%" x2="50%" y2="14%" marker-end="url(#pointEndBlue)" marker-start="url(#pointStartBlue)"/>
                            <line class="red" x1="50%" y1="25%" x2="54%" y2="14%" marker-end="url(#pointEndRed)" marker-start="url(#pointStartRed)"/>
                        </svg>
                        <p class="imgMap"><img src="/assets/img/svg/bg_match_2.svg" alt=""></p>
                    </div>
                </div>
                <ul class="noteShoot">
                    <li class="line01">ゴール：<span>1本</span></li>
                    <li class="line02">セーブ：<span>3本</span></li>
                    <li class="line03">ブロック：<span>２本</span></li>
                    <li class="line04">枠外：<span>6本</span></li>
                </ul>
                <p class="center">
                    <a href="/preview/teams01" class="btnStrategy resetW300">
                        期間別集計トップに戻る
                        <span class="positionLeft">
                            <img src="/assets/img/svg/ic_circle_left.svg" alt="期間別集計トップに戻る">
                        </span>
                    </a>
                </p>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    window.current_page = "preview_scorebook05";
</script>
@endsection

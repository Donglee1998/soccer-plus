@extends('web.layouts.default', ['title' => '期間別集計（スタッツ）'], ['pageName' => 'pagePeriod'])
@section('content')
<div class="keyv">
    <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="プレミアチームのご案内">
    <h1 class="keyvTitle"><span>期間別集計</span>スタッツ</h1>
</div>
<div class="content">
    <div class="inner01">
        <ul class="breadscrumb">
            <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a><span>/</span></li>
            <li><a href="/preview/period_aggregation01">期間別集計</a><span>/</span></li>
            <li><em>スタッツ</em></li>
        </ul>

        <h2 class="headline4">スタッツ</h2>
        <section class="section02">
            <table class="matchTableInfo tableInfo style01">
                <tbody>
                    <tr>
                        <th colspan="2" class="thFull thFullSP">検索条件</th>
                    </tr>
                    <tr>
                        <th rowspan="3" class="thFull thFullPC">検索条件</th>
                        <th class="w200">期間</th>
                        <td>2022/06/01 ~ 2022/07/10</td>
                    </tr>
                    <tr>
                        <th>対戦チーム</th>
                        <td>チームA</td>
                    </tr>
                    <tr>
                        <th>試合の種類</th>
                        <td>公式試合</td>
                    </tr>
                </tbody>
            </table>
        </section>
        <section class="section01">
            <h2 class="headline5 mb20">試合別集計</h2>
            <div class="toggleDisplay">
                <span class="ttl">表示の切り替え /</span>
                <label class="rbCustom">
                    数値を見る
                    <input type="radio" name="toggle">
                    <span class="checkmark"></span>
                </label>
                <label class="rbCustom">
                    確率を見る
                    <input type="radio" name="toggle">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="tblScroll">
                <div class="tblScroll__wrap">
                    <table class="tblList mb0 fixed1Col" id="tblScroll01">
                        <thead>
                            <tr>
                                <th class="wid308 bg01 fixed-side">
                                    VS チームA
                                </th>
                                <th>
                                    <div class="groupSort">
                                        ゴール
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        失点
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        シュート
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        枠内シュート
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        アシスト
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        ラストパス
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        カット
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        クロス
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        ファウル
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        被ファウル
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        クリア
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        ブロック
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        こぼれ球奪取
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        ゴールキック
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        フリーキック数
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        1対1勝利数
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        空中戦勝利数
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        キャッチ
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        パンチング
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
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
                        <tr>
                            <td class="wid308 fixed-side">
                                <p class="ttl">
                                    <span class="date">2022/06/01</span>
                                    マイチーム VS チームA
                                </p>
                            </td>
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
                            <td class="wid308 fixed-side">
                                <p class="ttl">
                                    <span class="date">2022/06/03</span>
                                    マイチーム VS チームA
                                </p>
                            </td>
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
                        <tr class="bg02">
                            <td class="wid308 fixed-side">
                                <p class="ttl">TOTAL</p>
                            </td>
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
                        <tr class="bg03">
                            <td class="wid308 fixed-side">
                                <p class="ttl">AVG</p>
                            </td>
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
                    </table>
                </div>
            </div>
        </section>
        <section class="section01">
            <h2 class="headline5 mb20">選手別集計</h2>
            <div class="toggleDisplay">
                <span class="ttl">表示の切り替え /</span>
                <label class="rbCustom">
                    数値を見る
                    <input type="radio" name="toggle">
                    <span class="checkmark"></span>
                </label>
                <label class="rbCustom">
                    確率を見る
                    <input type="radio" name="toggle">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="tblScroll">
                <div class="tblScroll__wrap">
                    <table class="tblList mb0 fixed3Col" id="tblScroll02">
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
                                <th>
                                    <div class="groupSort">
                                        ゴール
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        失点
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        シュート
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        枠内シュート
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        アシスト
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        ラストパス
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        カット
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        クロス
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        ファウル
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        被ファウル
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        クリア
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        ブロック
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        こぼれ球奪取
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        ゴールキック
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        フリーキック数
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        1対1勝利数
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        空中戦勝利数
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        キャッチ
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        パンチング
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
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
                            <tr class="bg02">
                                <td class="fixed-side"></td>
                                <td class="fixed-side"></td>
                                <td class="fixed-side">TOTAL</td>
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
                            <tr class="bg03">
                                <td class="fixed-side"></td>
                                <td class="fixed-side"></td>
                                <td class="fixed-side">AVG</td>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <section class="section01">
            <h2 class="headline5 mb20">試合で見る選手別集計</h2>
            <div class="toggleDisplay">
                <span class="ttl">表示の切り替え /</span>
                <label class="rbCustom">
                    数値を見る
                    <input type="radio" name="toggle">
                    <span class="checkmark"></span>
                </label>
                <label class="rbCustom">
                    確率を見る
                    <input type="radio" name="toggle">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="tblScroll">
                <div class="tblScroll__wrap">
                    <table class="tblList mb0 fixed1Col fixedTtl3" id="tblScroll03">
                        <thead>
                            <tr>
                                <th class="wid50 bg01 center fixed-side">1</th>
                                <th class="wid62 center fixed-side bg01">GK</th>
                                <th class="wid252 fixed-side bg01">川島永嗣</th>
                                <th>
                                    <div class="groupSort">
                                        ゴール
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        失点
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        シュート
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        枠内シュート
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        アシスト
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        ラストパス
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        カット
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        クロス
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        ファウル
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        被ファウル
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        クリア
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        ブロック
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        こぼれ球奪取
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        ゴールキック
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        フリーキック数
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        1対1勝利数
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        空中戦勝利数
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        キャッチ
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        パンチング
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
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
                                <td colspan="3" class="fixed-side">
                                    <p class="ttl">
                                        <span class="date">2022/06/01</span>
                                        マイチーム VS チームA
                                    </p>
                                </td>
                                <td style="display: none"></td>
                                <td style="display: none"></td>
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
                                <td>0</td>
                                <td>6</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="fixed-side">
                                    <p class="ttl">
                                        <span class="date">2022/06/03</span>
                                        マイチーム VS チームA
                                    </p>
                                </td>
                                <td style="display: none"></td>
                                <td style="display: none"></td>
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
                                <td>0</td>
                                <td>6</td>
                            </tr>
                            <tr class="bg02">
                                <td  colspan="3" class="fixed-side">
                                    <p class="ttl">TOTAL</p>
                                </td>
                                <td style="display: none"></td>
                                <td style="display: none"></td>
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
                                <td>0</td>
                                <td>6</td>
                            </tr>
                            <tr class="bg03">
                                <td  colspan="3" class="fixed-side">
                                    <p class="ttl">AVG</p>
                                </td>
                                <td style="display: none"></td>
                                <td style="display: none"></td>
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
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="toggleDisplay">
                <span class="ttl">表示の切り替え /</span>
                <label class="rbCustom">
                    数値を見る
                    <input type="radio" name="toggle">
                    <span class="checkmark"></span>
                </label>
                <label class="rbCustom">
                    確率を見る
                    <input type="radio" name="toggle">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="tblScroll">
                <div class="tblScroll__wrap">
                    <table class="tblList mb0 fixed1Col fixedTtl3" id="tblScroll04">
                        <thead>
                            <tr>
                                <th class="wid50 bg01 center fixed-side">2</th>
                                <th class="wid62 center fixed-side bg01">DF</th>
                                <th class="wid252 fixed-side bg01">川島永嗣</th>
                                <th>
                                    <div class="groupSort">
                                        ゴール
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        失点
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        シュート
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        枠内シュート
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        アシスト
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        ラストパス
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        カット
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        クロス
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        ファウル
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        被ファウル
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        クリア
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        ブロック
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        こぼれ球奪取
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        ゴールキック
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        フリーキック数
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        1対1勝利数
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        空中戦勝利数
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        キャッチ
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        パンチング
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
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
                                <td colspan="3" class="fixed-side">
                                    <p class="ttl">
                                        <span class="date">2022/06/01</span>
                                        マイチーム VS チームA
                                    </p>
                                </td>
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
                                <td>0</td>
                                <td>6</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="fixed-side">
                                    <p class="ttl">
                                        <span class="date">2022/06/03</span>
                                        マイチーム VS チームA
                                    </p>
                                </td>
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
                                <td>0</td>
                                <td>6</td>
                            </tr>
                            <tr class="bg02">
                                <td  colspan="3" class="fixed-side">
                                    <p class="ttl">TOTAL</p>
                                </td>
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
                                <td>0</td>
                                <td>6</td>
                            </tr>
                            <tr class="bg03">
                                <td  colspan="3" class="fixed-side">
                                    <p class="ttl">AVG</p>
                                </td>
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
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="toggleDisplay">
                <span class="ttl">表示の切り替え /</span>
                <label class="rbCustom">
                    数値を見る
                    <input type="radio" name="toggle">
                    <span class="checkmark"></span>
                </label>
                <label class="rbCustom">
                    確率を見る
                    <input type="radio" name="toggle">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="tblScroll">
                <div class="tblScroll__wrap">
                    <table class="tblList mb0 fixed1Col fixedTtl3" id="tblScroll05">
                        <thead>
                            <tr>
                                <th class="wid50 bg01 center fixed-side">3</th>
                                <th class="wid62 center fixed-side bg01">DF</th>
                                <th class="wid252 fixed-side bg01">川島永嗣</th>
                                <th>
                                    <div class="groupSort">
                                        ゴール
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        失点
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        シュート
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        枠内シュート
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        アシスト
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        ラストパス
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        カット
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        クロス
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        ファウル
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        被ファウル
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        クリア
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        ブロック
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        こぼれ球奪取
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        ゴールキック
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        フリーキック数
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        1対1勝利数
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        空中戦勝利数
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        キャッチ
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="groupSort">
                                        パンチング
                                        <div class="groupSort__button">
                                            <span class="groupSort__button-arrUp"></span>
                                            <span class="groupSort__button-arrDown"></span>
                                        </div>
                                    </div>
                                </th>
                                <th>
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
                                <td colspan="3" class="fixed-side">
                                    <p class="ttl">
                                        <span class="date">2022/06/01</span>
                                        マイチーム VS チームA
                                    </p>
                                </td>
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
                                <td>0</td>
                                <td>6</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="fixed-side">
                                    <p class="ttl">
                                        <span class="date">2022/06/03</span>
                                        マイチーム VS チームA
                                    </p>
                                </td>
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
                                <td>0</td>
                                <td>6</td>
                            </tr>
                            <tr class="bg02">
                                <td  colspan="3" class="fixed-side">
                                    <p class="ttl">TOTAL</p>
                                </td>
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
                                <td>0</td>
                                <td>6</td>
                            </tr>
                            <tr class="bg03">
                                <td  colspan="3" class="fixed-side">
                                    <p class="ttl">AVG</p>
                                </td>
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
                        </tbody>
                    </table>
                </div>
            </div>
            <p class="center">
                <a href="/period_aggregation01" class="btnStrategy cus-mw">
                    チェックしたプレイの動画を解除
                    <span class="positionLeft">
                        <img src="/assets/img/svg/ic_circle_left.svg" alt="アイコン丸チェック">
                    </span>
                </a>
            </p>
        </section>
    </div>
</div>
@endsection

@extends('web.layouts.default', ['title' => '　　期間別集計（シュートチャート）'], ['pageName' => 'pagePeriod'])
@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="プレミアチームのご案内">
        <h1 class="keyvTitle"><span>期間別集計</span>シュートチャート</h1>
    </div>
    <div class="content">
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a><span>/</span></li>
                <li><a href="/preview/period_aggregation01">期間別集計</a><span>/</span></li>
                <li><em>シュートチャート</em></li>
            </ul>
            <h2 class="headline4">シュートチャート</h2>
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
            <section class="section02">
                <h2 class="headline5 mb20">試合で見る選手別集計</h2>
                <div class="playControl">
                    <div class="item">
                        <div class="groupCtrl spFull">
                            <select name="" id="" class="formControl">
                                <option value="">並び順を選択</option>
                            </select>
                            <select name="" id="" class="formControl">
                                <option value="">選手を選択</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mapScroll">
                    <div class="blockMap">
                        <div class="blockMap__goal shootRate__level">
                            <div class="goal">
                                <div class="goalNumber">
                                    <div class="number">
                                        <p class="percent"><span>0</span>%</p>
                                        <p class="rate">(0/0)</p>
                                    </div>
                                    <div class="number">
                                        <p class="percent"><span>0</span>%</p>
                                        <p class="rate">(0/0)</p>
                                    </div>
                                    <div class="number">
                                        <p class="percent"><span>0</span>%</p>
                                        <p class="rate">(0/0)</p>
                                    </div>
                                    <div class="number">
                                        <p class="percent"><span>0</span>%</p>
                                        <p class="rate">(0/0)</p>
                                    </div>
                                    <div class="number level5">
                                        <p class="percent"><span>100</span>%</p>
                                        <p class="rate">(1/1)</p>
                                    </div>
                                    <div class="number">
                                        <p class="percent"><span>0</span>%</p>
                                        <p class="rate">(0/0)</p>
                                    </div>
                                    <div class="number">
                                        <p class="percent"><span>0</span>%</p>
                                        <p class="rate">(0/0)</p>
                                    </div>
                                    <div class="number">
                                        <p class="percent"><span>0</span>%</p>
                                        <p class="rate">(0/0)</p>
                                    </div>
                                    <div class="number">
                                        <p class="percent"><span>0</span>%</p>
                                        <p class="rate">(0/0)</p>
                                    </div>
                                    <div class="number level4">
                                        <p class="percent"><span>75</span>%</p>
                                        <p class="rate">(3/4)</p>
                                    </div>
                                    <div class="number level2">
                                        <p class="percent"><span>33</span>%</p>
                                        <p class="rate">(1/3)</p>
                                    </div>
                                    <div class="number">
                                        <p class="percent"><span>0</span>%</p>
                                        <p class="rate">(0/0)</p>
                                    </div>
                                    <div class="number">
                                        <p class="percent"><span>0</span>%</p>
                                        <p class="rate">(0/0)</p>
                                    </div>
                                    <div class="number">
                                        <p class="percent"><span>0</span>%</p>
                                        <p class="rate">(0/0)</p>
                                    </div>
                                    <div class="number level3">
                                        <p class="percent"><span>50</span>%</p>
                                        <p class="rate">(1/2)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blockMap__picture">
                            <div class="picture__outside">
                                <div class="item">
                                    <span class="zone">zone:I</span>
                                    <p class="txt">総シュート数</p>
                                    <p class="txt"><span class="num">0</span>本</p>
                                </div>
                            </div>
                            <div class="picture__main">
                                <div class="item active">
                                    <span class="zone">zone:A</span>
                                    <p class="txt">総シュート数</p>
                                    <p class="txt"><span class="num">10</span>本</p>
                                </div>
                                <div class="item">
                                    <span class="zone">zone:B</span>
                                    <p class="txt">総シュート数</p>
                                    <p class="txt"><span class="num">10</span>本</p>
                                </div>
                                <div class="item">
                                    <span class="zone">zone:C</span>
                                    <p class="txt">総シュート数</p>
                                    <p class="txt"><span class="num">10</span>本</p>
                                </div>
                                <div class="item">
                                    <span class="zone">zone:D</span>
                                    <p class="txt">総シュート数</p>
                                    <p class="txt"><span class="num">10</span>本</p>
                                </div>
                                <div class="item">
                                    <span class="zone">zone:E</span>
                                    <p class="txt">総シュート数</p>
                                    <p class="txt"><span class="num">10</span>本</p>
                                </div>
                                <div class="item">
                                    <span class="zone">zone:F</span>
                                    <p class="txt">総シュート数</p>
                                    <p class="txt"><span class="num">10</span>本</p>
                                </div>
                                <div class="item">
                                    <span class="zone">zone:G</span>
                                    <p class="txt">総シュート数</p>
                                    <p class="txt"><span class="num">10</span>本</p>
                                </div>
                                <div class="item">
                                    <span class="zone">zone:H</span>
                                    <p class="txt">総シュート数</p>
                                    <p class="txt"><span class="num">10</span>本</p>
                                </div>
                                <div class="picture__outside w100">
                                    <div class="item posLeft">
                                        <div class="ml40">
                                            <span class="zone">zone:J</span>
                                            <p class="txt">総シュート数</p>
                                            <p class="txt"><span class="num">0</span>本</p>
                                        </div>
                                    </div>
                                    <div class="item posRight right">
                                        <div class="left auto mr40">
                                            <span class="zone">zone:K</span>
                                            <p class="txt">総シュート数</p>
                                            <p class="txt"><span class="num">0</span>本</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="picture__outside">
                                <div class="item">
                                    <span class="zone">zone:L</span>
                                    <p class="txt">総シュート数</p>
                                    <p class="txt"><span class="num">0</span>本</p>
                                </div>
                            </div>
                        </div>
                    </div>
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
            </section>
            <p class="center">
                <a href="#" class="btnStrategy cus-mw">
                    チェックしたプレイの動画を解除
                    <span class="positionLeft">
                        <img src="/assets/img/svg/ic_circle_left.svg" alt="アイコン丸チェック">
                    </span>
                </a>
            </p>
        </div>
    </div>
@endsection

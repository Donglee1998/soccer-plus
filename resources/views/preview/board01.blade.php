@extends('web.layouts.default', ['title' => '作戦ボード一覧'], ['pageName' => 'pageTeam'])
@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="作戦ボード">
        <h1 class="keyvTitle">作戦ボード</h1>
    </div>
    <div class="content pbSp30">
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a><span>/</span></li>
                <li><em>作戦ボード</em></li>
            </ul>

           <form action="#" class="handledCheckCtrl">
                <div class="hdrAllCheck">
                    <label class="ctrCheckbox">
                        <input type="checkbox">
                        <span class="checkmark jsCheckAll">一括削除</span>
                    </label>
                </div>

                <div class="listStrategyBoard">
                    <div class="item">
                        <div class="blockImg">
                            <label class="ctrCheckbox jsChecked">
                                <input type="checkbox" name="strategy">
                                <span class="checkmark"></span>
                            </label>
                            <img src="/assets/img/board/img_match01.jpg" alt="攻撃：攻撃の作戦ボードタイトルが入ます攻撃の作戦ボードタイトルが入ます">
                        </div>
                        <div class="blockContent">
                            <p class="textDateTime">
                                <span class="date">2022/03/09</span>
                                <span class="time">14:20</span>
                            </p>
                            <a href="#" class="nameMatch">攻撃：攻撃の作戦ボードタイトルが入ます攻撃の作戦ボードタイトルが入ます</a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="blockImg">
                            <label class="ctrCheckbox jsChecked">
                                <input type="checkbox" name="strategy">
                                <span class="checkmark"></span>
                            </label>
                            <img src="/assets/img/board/img_match02.jpg" alt="守備：ハイプレス型 A">
                        </div>
                        <div class="blockContent">
                            <p class="textDateTime">
                                <span class="date">2022/03/09</span>
                                <span class="time">14:20</span>
                            </p>
                            <a href="#" class="nameMatch">守備：ハイプレス型 A</a>
                        </div>
                    </div>

                    <div class="item">
                        <div class="blockImg">
                            <label class="ctrCheckbox jsChecked">
                                <input type="checkbox" name="strategy">
                                <span class="checkmark"></span>
                            </label>
                            <img src="/assets/img/board/img_match01.jpg" alt="攻撃：カウンター型 A">
                        </div>
                        <div class="blockContent">
                            <p class="textDateTime">
                                <span class="date">2022/03/09</span>
                                <span class="time">14:20</span>
                            </p>
                            <a href="#" class="nameMatch">攻撃：カウンター型 A</a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="blockImg">
                            <label class="ctrCheckbox jsChecked">
                                <input type="checkbox" name="strategy">
                                <span class="checkmark"></span>
                            </label>
                            <img src="/assets/img/board/img_match02.jpg" alt="攻撃：ショートパス型 A">
                        </div>
                        <div class="blockContent">
                            <p class="textDateTime">
                                <span class="date">2022/03/09</span>
                                <span class="time">14:20</span>
                            </p>
                            <a href="#" class="nameMatch">攻撃：ショートパス型 A</a>
                        </div>
                    </div>

                    <div class="item">
                        <div class="blockImg">
                            <label class="ctrCheckbox jsChecked">
                                <input type="checkbox" name="strategy">
                                <span class="checkmark"></span>
                            </label>
                            <img src="/assets/img/board/img_match01.jpg" alt="守備：リリート型 A">
                        </div>
                        <div class="blockContent">
                            <p class="textDateTime">
                                <span class="date">2022/03/09</span>
                                <span class="time">14:20</span>
                            </p>
                            <a href="#" class="nameMatch">守備：リリート型 A</a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="blockImg">
                            <label class="ctrCheckbox jsChecked">
                                <input type="checkbox" name="strategy">
                                <span class="checkmark"></span>
                            </label>
                            <img src="/assets/img/board/img_match02.jpg" alt="攻撃：カウンター型 B">
                        </div>
                        <div class="blockContent">
                            <p class="textDateTime">
                                <span class="date">2022/03/09</span>
                                <span class="time">14:20</span>
                            </p>
                            <a href="#" class="nameMatch">攻撃：カウンター型 B</a>
                        </div>
                    </div>

                    <div class="item">
                        <div class="blockImg">
                            <label class="ctrCheckbox jsChecked">
                                <input type="checkbox" name="strategy">
                                <span class="checkmark"></span>
                            </label>
                            <img src="/assets/img/board/img_match01.jpg" alt="攻撃：攻撃の作戦ボードタイトルが入ます攻撃の作戦ボードタイトルが入ます">
                        </div>
                        <div class="blockContent">
                            <p class="textDateTime">
                                <span class="date">2022/03/09</span>
                                <span class="time">14:20</span>
                            </p>
                            <a href="#" class="nameMatch">攻撃：攻撃の作戦ボードタイトルが入ます攻撃の作戦ボードタイトルが入ます</a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="blockImg">
                            <label class="ctrCheckbox jsChecked">
                                <input type="checkbox" name="strategy">
                                <span class="checkmark"></span>
                            </label>
                            <img src="/assets/img/board/img_match02.jpg" alt="守備：ハイプレス型 B">
                        </div>
                        <div class="blockContent">
                            <p class="textDateTime">
                                <span class="date">2022/03/09</span>
                                <span class="time">14:20</span>
                            </p>
                            <a href="#" class="nameMatch">守備：ハイプレス型 B</a>
                        </div>
                    </div>

                    <div class="item">
                        <div class="blockImg">
                            <label class="ctrCheckbox jsChecked">
                                <input type="checkbox" name="strategy">
                                <span class="checkmark"></span>
                            </label>
                            <img src="/assets/img/board/img_match01.jpg" alt="攻撃：カウンター型 C">
                        </div>
                        <div class="blockContent">
                            <p class="textDateTime">
                                <span class="date">2022/03/09</span>
                                <span class="time">14:20</span>
                            </p>
                            <a href="#" class="nameMatch">攻撃：カウンター型 C</a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="blockImg">
                            <label class="ctrCheckbox jsChecked">
                                <input type="checkbox" name="strategy">
                                <span class="checkmark"></span>
                            </label>
                            <img src="/assets/img/board/img_match02.jpg" alt="攻撃：攻撃の作戦ボードタイトルが入ます攻撃の作戦ボードタイトルが入ます">
                        </div>
                        <div class="blockContent">
                            <p class="textDateTime">
                                <span class="date">2022/03/09</span>
                                <span class="time">14:20</span>
                            </p>
                            <a href="#" class="nameMatch">攻撃：攻撃の作戦ボードタイトルが入ます攻撃の作戦ボードタイトルが入ます</a>
                        </div>
                    </div>

                    <div class="item">
                        <div class="blockImg">
                            <label class="ctrCheckbox jsChecked">
                                <input type="checkbox" name="strategy">
                                <span class="checkmark"></span>
                            </label>
                            <img src="/assets/img/board/img_match01.jpg" alt="守備：ハイプレス型 C">
                        </div>
                        <div class="blockContent">
                            <p class="textDateTime">
                                <span class="date">2022/03/09</span>
                                <span class="time">14:20</span>
                            </p>
                            <a href="#" class="nameMatch">守備：ハイプレス型 C</a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="blockImg">
                            <label class="ctrCheckbox jsChecked">
                                <input type="checkbox" name="strategy">
                                <span class="checkmark"></span>
                            </label>
                            <img src="/assets/img/board/img_match02.jpg" alt="攻撃：カウンター型 D">
                        </div>
                        <div class="blockContent">
                            <p class="textDateTime">
                                <span class="date">2022/03/09</span>
                                <span class="time">14:20</span>
                            </p>
                            <a href="#" class="nameMatch">攻撃：カウンター型 D</a>
                        </div>
                    </div>

                    <div class="item">
                        <div class="blockImg">
                            <label class="ctrCheckbox jsChecked">
                                <input type="checkbox" name="strategy">
                                <span class="checkmark"></span>
                            </label>
                            <img src="/assets/img/board/img_match01.jpg" alt="攻撃：ショートパス型 C">
                        </div>
                        <div class="blockContent">
                            <p class="textDateTime">
                                <span class="date">2022/03/09</span>
                                <span class="time">14:20</span>
                            </p>
                            <a href="#" class="nameMatch">攻撃：ショートパス型 C</a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="blockImg">
                            <label class="ctrCheckbox jsChecked">
                                <input type="checkbox" name="strategy">
                                <span class="checkmark"></span>
                            </label>
                            <img src="/assets/img/board/img_match02.jpg" alt="守備：リリート型 B">
                        </div>
                        <div class="blockContent">
                            <p class="textDateTime">
                                <span class="date">2022/03/09</span>
                                <span class="time">14:20</span>
                            </p>
                            <a href="#" class="nameMatch">守備：リリート型 B</a>
                        </div>
                    </div>

                    <div class="item">
                        <div class="blockImg">
                            <label class="ctrCheckbox jsChecked">
                                <input type="checkbox" name="strategy">
                                <span class="checkmark"></span>
                            </label>
                            <img src="/assets/img/board/img_match01.jpg" alt="守備：リリート型 C">
                        </div>
                        <div class="blockContent">
                            <p class="textDateTime">
                                <span class="date">2022/03/09</span>
                                <span class="time">14:20</span>
                            </p>
                            <a href="#" class="nameMatch">守備：リリート型 C</a>
                        </div>
                    </div>
                </div>
                <p class="center">
                    <a href="#" class="btnStrategy spW300">
                        チェックした作戦を削除
                        <span>
                            <img src="/assets/img/svg/ic_circle_check.svg" alt="アイコン丸チェック">
                        </span>
                    </a>
                </p>
           </form>

            <div class="pager">
                <span class="pagerOlderLink">
                    <a class="btnPagerCmn" href="#">
                        <svg class="iconArrow">
                            <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_prev" />
                        </svg>
                        前へ
                    </a>
                </span>

                <div class="pagerPagination">
                    <a href="#" class="active">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                </div>

                <span class="pagerPaginationSP">
                    <span>1</span> / <span>3</span>
                </span>

                <span class="pagerNewerLink">
                    <a class="btnPagerCmn active" href="#">
                        次へ
                        <svg class="iconArrow">
                            <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_next" />
                        </svg>
                    </a>
                </span>
            </div>
        </div>
    </div>
@endsection

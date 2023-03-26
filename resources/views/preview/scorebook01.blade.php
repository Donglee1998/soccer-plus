@extends('web.layouts.default', ['title' => '試合一覧'], ['pageName' => 'playByPlay'])
@push('css')
<link rel="stylesheet" href="{{ get_file_version('/css/datepicker.css') }}">
@endpush

@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="ゲーム記録">
        <h1 class="keyvTitle">ゲーム記録</h1>
    </div>
    <div class="content pbSp30">
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt="home"></a><span>/</span></li>
                <li><em>ゲーム記録</em></li>
            </ul>
            <form action="#">
                <div class="blockMb40Sp30">
                    <div class="blockSearch">
                        <input type="text" class="searchTerm" placeholder="キーワードで検索">
                        <button type="submit" class="searchBtn">
                            <img src="/assets/img/svg/icon_search.svg" alt="search">
                       </button>
                    </div>
                     <div class="blockGameType">
                        <div class="item">
                            <select name="" id="" class="formControl">
                                <option value="">並び順を選択</option>
                            </select>
                        </div>
                        <div class="item">
                            <div class="datepickerWrapper">
                                <p class="datepickerInput">
                                    <input class="styleSelect" type="text" id="startDate" placeholder="開始日"/>
                                </p>
                                <p class="datepickerInput">
                                    <input class="styleSelect" type="text" id="endDate" placeholder="終了日"/>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="blockScroll">
                    <table class="tblList tbCenter reset02 handledCheckCtrl">
                        <tr>
                            <th class="wid48">
                                <label class="cbCustom">
                                    <input type="checkbox">
                                    <span class="checkmark jsCheckAll"></span>
                                </label>
                            </th>
                            <th class="wid120Sp95">試合日</th>
                            <th class="wid95">試合種類</th>
                            <th colspan="3">スコア</th>
                            <th class="wid100">詳細</th>
                        </tr>
                        <tr>
                            <td class="rePadding jsChecked">
                                <label class="cbCustom">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            <td>2022年7月4日</td>
                            <td>練習試合</td>
                            <td>池袋〇〇〇〇〇〇</td>
                            <td class="wid80"><span class="fS20">2 - 1</span></td>
                            <td>東京〇〇〇〇〇〇</td>
                            <td>
                                <a href="#" class="btnPlay">詳細</a>
                            </td>
                        </tr>

                        <tr>
                            <td class="rePadding jsChecked">
                                <label class="cbCustom">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            <td>2022年7月4日</td>
                            <td>練習試合</td>
                            <td>池袋〇〇〇〇〇〇</td>
                            <td class="wid80"><span class="fS20">2 - 2</span></td>
                            <td>東京〇〇〇〇〇〇</td>
                            <td>
                                <a href="#" class="btnPlay">詳細</a>
                            </td>
                        </tr>

                        <tr>
                            <td class="rePadding jsChecked">
                                <label class="cbCustom">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            <td>2022年7月4日</td>
                            <td>練習試合</td>
                            <td>池袋〇〇〇〇〇〇</td>
                            <td class="wid80"><span class="fS20">1 - 2</span></td>
                            <td>東京〇〇〇〇〇〇</td>
                            <td>
                                <a href="#" class="btnPlay">詳細</a>
                            </td>
                        </tr>

                        <tr>
                            <td class="rePadding jsChecked">
                                <label class="cbCustom">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            <td>2022年7月4日</td>
                            <td>練習試合</td>
                            <td>池袋〇〇〇〇〇〇</td>
                            <td class="wid80"><span class="fS20">4 - 2</span></td>
                            <td>東京〇〇〇〇〇〇</td>
                            <td>
                                <a href="#" class="btnPlay">詳細</a>
                            </td>
                        </tr>

                        <tr>
                            <td class="rePadding jsChecked">
                                <label class="cbCustom">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            <td>2022年7月4日</td>
                            <td>練習試合</td>
                            <td>池袋〇〇〇〇〇〇</td>
                            <td class="wid80"><span class="fS20">0 - 2</span></td>
                            <td>東京〇〇〇〇〇〇</td>
                            <td>
                                <a href="#" class="btnPlay">詳細</a>
                            </td>
                        </tr>

                        <tr>
                            <td class="rePadding jsChecked">
                                <label class="cbCustom">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            <td>2022年7月4日</td>
                            <td>練習試合</td>
                            <td>池袋〇〇〇〇〇〇</td>
                            <td class="wid80"><span class="fS20">2 - 2</span></td>
                            <td>東京〇〇〇〇〇〇</td>
                            <td>
                                <a href="#" class="btnPlay">詳細</a>
                            </td>
                        </tr>

                        <tr>
                            <td class="rePadding jsChecked">
                                <label class="cbCustom">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            <td>2022年7月4日</td>
                            <td>練習試合</td>
                            <td>池袋〇〇〇〇〇〇</td>
                            <td class="wid80"><span class="fS20">0 - 0</span></td>
                            <td>東京〇〇〇〇〇〇</td>
                            <td>
                                <a href="#" class="btnPlay">詳細</a>
                            </td>
                        </tr>

                        <tr>
                            <td class="rePadding jsChecked">
                                <label class="cbCustom">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            <td>2022年7月4日</td>
                            <td>練習試合</td>
                            <td>池袋〇〇〇〇〇〇</td>
                            <td class="wid80"><span class="fS20">2 - 1</span></td>
                            <td>東京〇〇〇〇〇〇</td>
                            <td>
                                <a href="#" class="btnPlay">詳細</a>
                            </td>
                        </tr>

                        <tr>
                            <td class="rePadding jsChecked">
                                <label class="cbCustom">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            <td>2022年7月4日</td>
                            <td>練習試合</td>
                            <td>池袋〇〇〇〇〇〇</td>
                            <td class="wid80"><span class="fS20">2 - 2</span></td>
                            <td>東京〇〇〇〇〇〇</td>
                            <td>
                                <a href="#" class="btnPlay">詳細</a>
                            </td>
                        </tr>

                        <tr>
                            <td class="rePadding jsChecked">
                                <label class="cbCustom">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            <td>2022年7月4日</td>
                            <td>練習試合</td>
                            <td>池袋〇〇〇〇〇〇</td>
                            <td class="wid80"><span class="fS20">2 - 2</span></td>
                            <td>東京〇〇〇〇〇〇</td>
                            <td>
                                <a href="#" class="btnPlay">詳細</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="rePadding jsChecked">
                                <label class="cbCustom">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            <td>2022年7月4日</td>
                            <td>練習試合</td>
                            <td>池袋〇〇〇〇〇〇</td>
                            <td class="wid80"><span class="fS20">2 - 2</span></td>
                            <td>東京〇〇〇〇〇〇</td>
                            <td>
                                <a href="#" class="btnPlay">詳細</a>
                            </td>
                        </tr>

                        <tr>
                            <td class="rePadding jsChecked">
                                <label class="cbCustom">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            <td>2022年7月4日</td>
                            <td>練習試合</td>
                            <td>池袋〇〇〇〇〇〇</td>
                            <td class="wid80"><span class="fS20">2 - 2</span></td>
                            <td>東京〇〇〇〇〇〇</td>
                            <td>
                                <a href="#" class="btnPlay">詳細</a>
                            </td>
                        </tr>

                        <tr>
                            <td class="rePadding jsChecked">
                                <label class="cbCustom">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            <td>2022年7月4日</td>
                            <td>練習試合</td>
                            <td>池袋〇〇〇〇〇〇</td>
                            <td class="wid80"><span class="fS20">2 - 2</span></td>
                            <td>東京〇〇〇〇〇〇</td>
                            <td>
                                <a href="#" class="btnPlay">詳細</a>
                            </td>
                        </tr>

                        <tr>
                            <td class="rePadding jsChecked">
                                <label class="cbCustom">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            <td>2022年7月4日</td>
                            <td>練習試合</td>
                            <td>池袋〇〇〇〇〇〇</td>
                            <td class="wid80"><span class="fS20">2 - 2</span></td>
                            <td>東京〇〇〇〇〇〇</td>
                            <td>
                                <a href="#" class="btnPlay">詳細</a>
                            </td>
                        </tr>

                        <tr>
                            <td class="rePadding jsChecked">
                                <label class="cbCustom">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            <td>2022年7月4日</td>
                            <td>練習試合</td>
                            <td>池袋〇〇〇〇〇〇</td>
                            <td class="wid80"><span class="fS20">2 - 2</span></td>
                            <td>東京〇〇〇〇〇〇</td>
                            <td>
                                <a href="#" class="btnPlay">詳細</a>
                            </td>
                        </tr>
                    </table>
                </div>
                <p class="center">
                <button class="btnStrategy jsModalPassword">
                    チェックしたフォルダを削除
                    <span>
                        <img src="/assets/img/svg/ic_circle_check.svg" alt="アイコン丸チェック">
                    </span>
                </button>
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
            <div class="modal" id="modalPassword" role="dialog">
                <div class="modal__wrapper">
                    <span class="jsCloseModal btnClose">
                        <svg class="icon">
                            <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_close" />
                        </svg>
                    </span>
                    <div class="modal__content">
                        <p class="headline6 mb30 center">
                            Submit your username
                        </p>
                        <div class="blockUpload mb30">
                            <ul class="blockUpload__name fullWidth">
                                <li class="pr0">
                                    <input type="text" placeholder="フォルダ名を入力して下さい">
                                </li>
                            </ul>
                        </div>
                        <p class="error">※input not null</p>
                        <div class="btnGroup style01">
                            <button type="submit" class="btnSubmit style01 pLeft">ログイン</button>
                            <button class="btnSubmit style01 gray pRight jsCloseModal" href="#">cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

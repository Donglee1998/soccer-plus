@extends('web.layouts.default', ['title' => '動画一覧'], ['pageName' => 'videoList'])
@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="プレミアチームのご案内">
        <h1 class="keyvTitle">お申込みフォーム</h1>
    </div>
    <div class="content pbSp30">
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt="home"></a><span>/</span></li>
                <li><em>お申込みフォーム</em></li>
            </ul>
            <div class="headline4">
                <h2>サッカープラス プレミアムチームのお申込み</h2>
            </div>
            <div class="btnDealWrapper section02">
                <a href="#" class="btnDeal">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26">
                            <g id="Group_28602" data-name="Group 28602" transform="translate(12866 2726)">
                                <g id="Group_28600" data-name="Group 28600" transform="translate(-13932 -4145)">
                                    <circle id="Ellipse_157" data-name="Ellipse 157" cx="13" cy="13" r="13" transform="translate(1066 1419)" fill="#6b64c1"></circle>
                                    <path id="Path_25970" data-name="Path 25970" d="M9.2,4.794H2.15L4.609,7.253a.63.63,0,1,1-.89.891L.185,4.61a.625.625,0,0,1-.042-.047L.127,4.542.106,4.513C.1,4.5.1,4.5.09,4.487L.074,4.461.061,4.433c0-.009-.009-.018-.013-.028s-.007-.019-.01-.028-.007-.02-.011-.03S.022,4.328.02,4.318.014,4.3.012,4.287s0-.023-.005-.034,0-.018,0-.027A.636.636,0,0,1,0,4.1c0-.009,0-.018,0-.027s0-.023.005-.034,0-.021.008-.031,0-.019.007-.029.007-.02.011-.03.006-.019.01-.028L.061,3.9c0-.009.009-.019.014-.028L.09,3.841C.1,3.832.1,3.823.106,3.814l.021-.029.015-.021a.625.625,0,0,1,.042-.047L3.719.184a.63.63,0,0,1,.891.891L2.15,3.534H9.2a.63.63,0,1,1,0,1.259Z" transform="translate(1083.479 1435.931) rotate(180)" fill="#fff"></path>
                                </g>
                            </g>
                        </svg>
                    </span>
                    プレミアムチームとは
                </a>
                <a href="#" class="btnDeal">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26">
                            <g id="Group_28602" data-name="Group 28602" transform="translate(12866 2726)">
                                <g id="Group_28600" data-name="Group 28600" transform="translate(-13932 -4145)">
                                    <circle id="Ellipse_157" data-name="Ellipse 157" cx="13" cy="13" r="13" transform="translate(1066 1419)" fill="#6b64c1"></circle>
                                    <path id="Path_25970" data-name="Path 25970" d="M9.2,4.794H2.15L4.609,7.253a.63.63,0,1,1-.89.891L.185,4.61a.625.625,0,0,1-.042-.047L.127,4.542.106,4.513C.1,4.5.1,4.5.09,4.487L.074,4.461.061,4.433c0-.009-.009-.018-.013-.028s-.007-.019-.01-.028-.007-.02-.011-.03S.022,4.328.02,4.318.014,4.3.012,4.287s0-.023-.005-.034,0-.018,0-.027A.636.636,0,0,1,0,4.1c0-.009,0-.018,0-.027s0-.023.005-.034,0-.021.008-.031,0-.019.007-.029.007-.02.011-.03.006-.019.01-.028L.061,3.9c0-.009.009-.019.014-.028L.09,3.841C.1,3.832.1,3.823.106,3.814l.021-.029.015-.021a.625.625,0,0,1,.042-.047L3.719.184a.63.63,0,0,1,.891.891L2.15,3.534H9.2a.63.63,0,1,1,0,1.259Z" transform="translate(1083.479 1435.931) rotate(180)" fill="#fff"></path>
                                </g>
                            </g>
                        </svg>
                    </span>
                    利用料金について
                </a>
            </div>
            <form action="/preview/confirm">
                <div class="section03">
                    <h3 class="headline8">チーム情報</h3>
                    <ul class="form">
                        <li>
                            <span class="err">未選択です。</span>
                            <div class="formInput">
                                <p class="ttl">
                                    チーム代表者氏名
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" placeholder="例）山田太郎">
                            </div>
                        </li>
                        <li>
                            <span class="err">未選択です。</span>
                            <div class="formInput">
                                <p class="ttl">
                                    チーム代表者氏名(フリガナ)
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="" placeholder="例）ヤマダタロウ">
                            </div>
                        </li>
                        <li>
                            <span class="err">未選択です。</span>
                            <div class="formInput">
                                <p class="ttl">
                                    メールアドレス
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="" placeholder="例）info@soccer--plus.jp">
                            </div>
                        </li>
                        <li>
                            <span class="err">未選択です。</span>
                            <div class="formInput">
                                <p class="ttl">
                                    団体名
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="">
                            </div>
                        </li>
                        <li>
                            <span class="err">未選択です。</span>
                            <div class="formInput">
                                <p class="ttl">
                                    団体名(フリガナ)
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="">
                            </div>
                        </li>
                        <li>
                            <span class="err">未選択です。</span>
                            <div class="formInput">
                                <p class="ttl">
                                    郵便番号
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="">
                            </div>
                        </li>
                        <li>
                            <span class="err">未選択です。</span>
                            <div class="formInput">
                                <p class="ttl">
                                    ご住所
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="">
                            </div>
                        </li>
                        <li>
                            <span class="err">未選択です。</span>
                            <div class="formInput">
                                <p class="ttl">
                                    お電話番号
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="">
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="section03">
                    <h3 class="headline8">担当者情報</h3>
                    <ul class="form">
                        <li>
                            <span class="err">未選択です。</span>
                            <div class="formInput">
                                <p class="ttl">
                                    担当者名
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" placeholder="例）山田太郎">
                            </div>
                        </li>
                        <li>
                            <span class="err">未選択です。</span>
                            <div class="formInput">
                                <p class="ttl">
                                    担当者名(フリガナ)
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="" placeholder="例）ヤマダタロウ">
                            </div>
                        </li>
                        <li>
                            <span class="err">未選択です。</span>
                            <div class="formInput">
                                <p class="ttl">
                                    メールアドレス
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="" placeholder="例）info@soccer--plus.jp">
                            </div>
                        </li>
                        <li>
                            <span class="err">未選択です。</span>
                            <div class="formInput">
                                <p class="ttl">
                                    連絡先(携帯電話)
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="">
                            </div>
                        </li>
                        <li>
                            <span class="err">未選択です。</span>
                            <div class="formInput">
                                <p class="ttl">
                                    生年月日
                                    <span class="require">必須</span>
                                </p>
                                <div class="dFlex">
                                    <select name="" id="#" class="formControl">
                                        <option value="">年</option>
                                    </select>/
                                    <select name="" id="#" class="formControl">
                                        <option value="">月</option>
                                    </select>/
                                    <select name="" id="#" class="formControl">
                                        <option value="">日</option>
                                    </select>
                                </div>
                            </div>
                        </li>
                        <li>
                            <span class="err">未選択です。</span>
                            <div class="formInput">
                                <p class="ttl">
                                    性別
                                    <span class="require">必須</span>
                                </p>
                                <div class="dFlex">
                                    <label class="rbCustom">
                                        男性
                                        <input type="radio" name="toggle">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="rbCustom">
                                        女性
                                        <input type="radio" name="toggle">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <span class="err">未選択です。</span>
                            <div class="formInput">
                                <p class="ttl">
                                    郵便番号
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="">
                            </div>
                        </li>
                        <li>
                            <span class="err">未選択です。</span>
                            <div class="formInput">
                                <p class="ttl">
                                    住所
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="">
                            </div>
                        </li>
                        <li>
                            <span class="err">未選択です。</span>
                            <div class="formInput">
                                <p class="ttl">
                                    お電話番号
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="">
                            </div>
                        </li>
                        <li>
                            <span class="err">未選択です。</span>
                            <div class="formInput">
                                <p class="ttl">
                                    プレミアム契約
                                    <span class="require">必須</span>
                                </p>
                                <div class="listRadio">
                                    <div class="dFlex">
                                        <span class="ttl">1台目</span>
                                        <label class="rbCustom">
                                            ホワイト
                                            <input type="radio" name="contract1">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="rbCustom">
                                            ブラック
                                            <input type="radio" name="contract1">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="dFlex">
                                        <span class="ttl">2台目</span>
                                        <label class="rbCustom">
                                            希望しない
                                            <input type="radio" name="contract2">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="rbCustom">
                                            ホワイト
                                            <input type="radio" name="contract2">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="rbCustom">
                                            ブラック
                                            <input type="radio" name="contract2">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="dFlex">
                                        <span class="ttl">3台目</span>
                                        <label class="rbCustom">
                                            希望しない
                                            <input type="radio" name="contract3">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="rbCustom">
                                            ホワイト
                                            <input type="radio" name="contract3">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="rbCustom">
                                            ブラック
                                            <input type="radio" name="contract3">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <span class="err">未選択です。</span>
                            <div class="formInput">
                                <p class="ttl">
                                    オプション契約
                                </p>
                                <ul class="dFlex listCheckBox">
                                    <li>
                                        <label class="cbCustom style01">
                                            オリジナルipadカバー
                                            <input type="checkbox" name="contract3">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="cbCustom style01">
                                            エキスパートサーバーモデル
                                            <input type="checkbox" name="contract3">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="cbCustom style01">
                                            タブレットサポート
                                            <input type="checkbox" name="contract3">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="cbCustom style01">
                                            タブレット安心サポート
                                            <input type="checkbox" name="contract3">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="cbCustom style01">
                                            Play by Play Video
                                            <input type="checkbox" name="contract3">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="cbCustom style01">
                                            Play by Play Videoライト
                                            <input type="checkbox" name="contract3">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="cbCustom style01">
                                            請求書発行サービス（電子メール）
                                            <input type="checkbox" name="contract3">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="cbCustom style01">
                                            領収書発行サービス（電子メール）
                                            <input type="checkbox" name="contract3">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <span class="err">未選択です。</span>
                            <div class="formInput">
                                <p class="ttl">
                                    支払い方法 1
                                    <span class="require">必須</span>
                                </p>
                                <div class="dFlex">
                                    <label class="rbCustom">
                                        年払い
                                        <input type="radio" name="payment1">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="rbCustom">
                                        半年払い
                                        <input type="radio" name="payment1">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="rbCustom">
                                        月払い
                                        <input type="radio" name="payment1">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <span class="err">未選択です。</span>
                            <div class="formInput">
                                <p class="ttl">
                                    支払い方法 2
                                    <span class="require">必須</span>
                                </p>
                                <div class="dFlex">
                                    <label class="rbCustom">
                                        クレジットカード
                                        <input type="radio" name="payment2">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="rbCustom">
                                        銀行口座自動振替
                                        <input type="radio" name="payment2">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="rbCustom">
                                        銀行振込
                                        <input type="radio" name="payment2">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="section03">
                    <h3 class="headline8">第二連絡先</h3>
                    <ul class="form">
                        <li>
                            <span class="err">未選択です。</span>
                            <div class="formInput">
                                <p class="ttl">担当者名</p>
                                <input type="text" placeholder="例）山田太郎">
                            </div>
                        </li>
                        <li>
                            <span class="err">未選択です。</span>
                            <div class="formInput">
                                <p class="ttl">郵便番号(フリガナ)</p>
                                <input type="text" name="" placeholder="例）ヤマダタロウ">
                            </div>
                        </li>
                        <li>
                            <span class="err">未選択です。</span>
                            <div class="formInput">
                                <p class="ttl">メールアドレス</p>
                                <input type="text" name="" placeholder="例）info@soccer--plus.jp">
                            </div>
                        </li>
                        <li>
                            <span class="err">未選択です。</span>
                            <div class="formInput">
                                <p class="ttl">連絡先(携帯電話)</p>
                                <input type="text" name="">
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="section01">
                    <h3 class="headline8">送付先</h3>
                    <ul class="form">
                        <li>
                            <span class="err">未選択です。</span>
                            <div class="formInput">
                                <p class="ttl">
                                    担当者名
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" placeholder="例）山田太郎">
                            </div>
                        </li>
                        <li>
                            <span class="err">未選択です。</span>
                            <div class="formInput">
                                <p class="ttl">
                                    郵便番号
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="">
                            </div>
                        </li>
                        <li>
                            <span class="err">未選択です。</span>
                            <div class="formInput">
                                <p class="ttl">
                                    住所
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="">
                            </div>
                        </li>
                    </ul>
                </div>
                <p class="confirmForm">
                    <label class="cbCustom style01">
                            <a href="#">
                            「プレミアムチーム」利用規約
                            </a>
                            <input type="checkbox" name="contract3">
                            <span class="checkmark"></span>
                        </label>
                    に同意する
                </p>
                <p class="center">
                    <button type="submit" class="btnStrategy">
                        確認する
                        <span>
                            <img src="/assets/img/svg/ic_circle_right.svg" alt="アイコン丸右">
                        </span>
                    </button>
                </p>
            </form>
        </div>
    </div>
@endsection

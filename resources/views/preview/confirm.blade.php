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
            <div class="section03">
                <p class="txtNote">ご記入いただいた内容に、お間違いがないかご確認の上、問題なければ「送信する」ボタンを、<br class="pcDisplay">
            内容を変更される場合は「変更する」ボタンをクリックしてください。</p>
            </div>
            <form action="/preview/thanks">
                <div class="section03">
                    <h3 class="headline8 mb0">チーム情報</h3>
                    <div class="tblStyle02">
                        <table>
                            <tbody>
                                <tr>
                                    <th>チーム代表者氏名</th>
                                    <td>山田太郎</td>
                                </tr>
                                <tr>
                                    <th>チーム代表者氏名(フリガナ)</th>
                                    <td>ヤマダタロウ</td>
                                </tr>
                                <tr>
                                    <th>メールアドレス</th>
                                    <td>info@soccer--plus.jp</td>
                                </tr>
                                <tr>
                                    <th>団体名</th>
                                    <td>株式会社バスケプラス</td>
                                </tr>
                                <tr>
                                    <th>団体名(フリガナ)</th>
                                    <td>バスケプラス</td>
                                </tr>
                                <tr>
                                    <th>郵便番号</th>
                                    <td>146-0083</td>
                                </tr>
                                <tr>
                                    <th>お電話番号</th>
                                    <td>03-4376-5171</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="section03">
                    <h3 class="headline8 mb0">担当者情報</h3>
                    <div class="tblStyle02">
                        <table>
                            <tbody>
                                <tr>
                                    <th>担当者名</th>
                                    <td>山田太郎</td>
                                </tr>
                                <tr>
                                    <th>担当者名(フリガナ)</th>
                                    <td>ヤマダタロウ</td>
                                </tr>
                                <tr>
                                    <th>メールアドレス</th>
                                    <td>info@soccer--plus.jp</td>
                                </tr>
                                <tr>
                                    <th>連絡先(携帯電話)</th>
                                    <td>090-1234-5678</td>
                                </tr>
                                <tr>
                                    <th>生年月日</th>
                                    <td>1984年08月20日</td>
                                </tr>
                                <tr>
                                    <th>性別</th>
                                    <td>男性</td>
                                </tr>
                                <tr>
                                    <th>郵便番号</th>
                                    <td>146-0083</td>
                                </tr>
                                <tr>
                                    <th>住所</th>
                                    <td>東京都大田区千鳥2-17-7</td>
                                </tr>
                                <tr>
                                    <th>お電話番号</th>
                                    <td>03-4376-5171</td>
                                </tr>
                                <tr>
                                    <th>プレミアム契約</th>
                                    <td>
                                        <span class="mr10 inlineBlock">1台目　ホワイト</span>
                                        <span class="mr10 inlineBlock">2台目　希望しない</span>
                                        <span class="inlineBlock">3台目　希望しない</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>オプション契約</th>
                                    <td>オリジナルipadカバー、タブレットサポート、Play by Play Video、請求書発行サービス（電子メール）</td>
                                </tr>
                                <tr>
                                    <th>支払い方法 1</th>
                                    <td>年払い</td>
                                </tr>
                                <tr>
                                    <th>支払い方法 2</th>
                                    <td>クレジットカード</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="section03">
                    <h3 class="headline8 mb0">第二連絡先</h3>
                    <div class="tblStyle02">
                        <table>
                            <tbody>
                                <tr>
                                    <th>担当者名</th>
                                    <td>山田太郎</td>
                                </tr>
                                <tr>
                                    <th>担当者名(フリガナ)</th>
                                    <td>ヤマダタロウ</td>
                                </tr>
                                <tr>
                                    <th>メールアドレス</th>
                                    <td>info@soccer--plus.jp</td>
                                </tr>
                                <tr>
                                    <th>連絡先(携帯電話)</th>
                                    <td>090-1234-5678</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="section03">
                    <h3 class="headline8 mb0">担当者情報</h3>
                    <div class="tblStyle02">
                        <table>
                            <tbody>
                                <tr>
                                    <th>担当者名</th>
                                    <td>山田太郎</td>
                                </tr>
                                <tr>
                                    <th>郵便番号</th>
                                    <td>146-0083</td>
                                </tr>
                                <tr>
                                    <th>住所</th>
                                    <td>東京都大田区千鳥2-17-7</td>
                                </tr>
                                <tr>
                                    <th>連絡先(携帯電話)</th>
                                    <td>090-1234-5678</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <p class="center mb20">
                    <button type="submit" class="btnStrategy big">
                        送信する
                        <span>
                            <img src="/assets/img/svg/ic_circle_right.svg" alt="送信する">
                        </span>
                    </button>
                </p>
                <p class="center">
                    <button type="submit" class="btnStrategy bgGray">
                        変更する
                        <span class="positionLeft">
                            <img src="/assets/img/svg/ic_circle_left_gray.svg" alt="アイコンサークル左">
                        </span>
                    </button>
                </p>
            </form>
        </div>
    </div>
@endsection

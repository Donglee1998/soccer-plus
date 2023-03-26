@extends('web.layouts.default', ['title' => '動画一覧'], ['pageName' => 'videoList'])
@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="プレミアチームのご案内">
        <h1 class="keyvTitle">お問い合わせ</h1>
    </div>
    <div class="content pbSp30">
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt="home"></a><span>/</span></li>
                <li><em>お問い合わせ</em></li>
            </ul>
            <div class="section03">
                <p class="txtNote">ご記入いただいた内容に、お間違いがないかご確認の上、問題なければ「送信する」ボタンを、<br class="pcDisplay">内容を変更される場合は「変更する」ボタンをクリックしてください。</p>
            </div>
            <form action="/preview/contactThanks">
                <div class="section03">
                    <div class="tblStyle02">
                        <table>
                            <tbody>
                                <tr>
                                    <th>お名前</th>
                                    <td>山田太郎</td>
                                </tr>
                                <tr>
                                    <th>メールアドレス</th>
                                    <td>info@soccer--plus.jp</td>
                                </tr>
                                <tr>
                                    <th>メールアドレス（確認）</th>
                                    <td>info@soccer--plus.jp</td>
                                </tr>
                                <tr>
                                    <th>所属チーム</th>
                                    <td>チーム0/0</td>
                                </tr>
                                <tr>
                                    <th>ご利用アプリ</th>
                                    <td>iPadレンタル版アプリ</td>
                                </tr>
                                <tr>
                                    <th>お問い合わせ内容</th>
                                    <td>お問い合わせ内容がここに入りますお問い合わせ内容がここに入りますお問い合わせ内容がここに入りますお問い合わせ内容がここに入りますお問い合わせ内容がここに入りますお問い合わせ内容がここに入りますお問い合わせ内容がここに入りますお問い合わせ内容がここに入りますお問い合わせ内容がここに入りますお問い合わせ内容がここに入ります。</td>
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

@extends('web.layouts.default', ['title' => 'マニュアル'], ['pageName' => 'pageManual'])
@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="マニュアル">
        <h1 class="keyvTitle">マニュアル</h1>
    </div>
    <div class="content">
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a><span>/</span></li>
                <li><em>マニュアル</em></li>
            </ul>
            <div class='headline4'>
                <h2>SOCCER PLUS マニュアル一覧</h2>
            </div>
            <p class="txtCm01 pb60Sp30">SOCCER PLUSをすでにご利用の方向けの各種マニュアルを用意しております。</p>
            <table class="tblList">
                <thead>
                    <tr>
                        <th class="wid308">マニュアル名</th>
                        <th>説明</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="/preview/manual_detail">Play by Play Video 登録手順</a></td>
                        <td>Play by Play Video 操作マニュアルの簡単な概要説明が入りますPlay by Play Video 操作マニュアルの簡単な概要説明が入ります。</td>
                    </tr>
                    <tr>
                        <td><a href="#">データ入力手順</a></td>
                        <td>データ入力手順の簡単な概要説明が入りますデータ入力手順の簡単な概要説明が入りますデータ入力手順の簡単な概要説明が入ります。</td>
                    </tr>
                    <tr>
                        <td><a href="#">バックアップ手順</a></td>
                        <td>バックアップ手順の簡単な概要説明が入りますバックアップ手順の簡単な概要説明が入ります。</td>
                    </tr>
                    <tr>
                        <td><a href="#">対戦相手 名称設定</a></td>
                        <td>対戦相手 名称設定の簡単な概要説明が入ります対戦相手 名称設定の簡単な概要説明が入ります。</td>
                    </tr>
                    <tr>
                        <td><a href="#">webデータ閲覧方法</a></td>
                        <td>webデータ閲覧方法の簡単な概要説明が入りますwebデータ閲覧方法の簡単な概要説明が入ります。</td>
                    </tr>
                    <tr>
                        <td><a href="#">メンバーの編集・追加・削除</a></td>
                        <td>メンバーの編集・追加・削除の簡単な概要説明が入ります。</td>
                    </tr>
                    <tr>
                        <td><a href="#">チーム作成手順</a></td>
                        <td>チーム作成手順の簡単な概要説明が入りますチーム作成手順の簡単な概要説明が入ります。</td>
                    </tr>
                    <tr>
                        <td><a href="#">基本設定用入力テキスト</a></td>
                        <td>メンバーの編集・追加・削除の簡単な概要説明が入ります。</td>
                    </tr>
                    <tr>
                        <td><a href="#">スコアの送信・閲覧方法について</a></td>
                        <td>スコアの送信・閲覧方法についての簡単な概要説明が入ります。</td>
                    </tr>
                    <tr>
                        <td><a href="#">基本設定用入力テキスト</a></td>
                        <td>スコア送信後の活用方法の簡単な概要説明が入ります。</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

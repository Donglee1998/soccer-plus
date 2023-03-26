@extends('web.layouts.default', ['title' => 'チーム一覧'], ['pageName' => 'pageTeam'])
@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="チーム一覧 チーム情報">
        <h1 class="keyvTitle"><span class="subTitle">チーム一覧</span> チーム情報</h1>
    </div>
    <div class="content">
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a><span>/</span></li>
                <li><a href="/preview/teams01">チーム一覧</a><span>/</span></li>
                <li><em>チーム情報</em></li>
            </ul>
            <h2 class="headline7">
                <svg class="imgShirt colorGreen"><use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams" /></svg>
                チームサッカープラス1
            </h2>
            <div class="tableTeam">
                <table>
                    <tbody>
                        <tr>
                            <th>チーム名</th>
                            <td>チームサッカープラス1</td>
                        </tr>
                        <tr>
                            <th>略称</th>
                            <td>TSP1</td>
                        </tr>
                        <tr>
                            <th>チームカラー</th>
                            <td>
                                <div class="boxTeamColor">
                                    <div class="item">
                                        <span>ホーム</span>
                                        <svg class="imgShirt colorGreen"><use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams" /></svg>
                                    </div>
                                    <div class="item">
                                        <span>/　アウェイ</span>
                                        <svg class="imgShirt colorGreen"><use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams-white" /></svg>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>チーム性別</th>
                            <td>男子</td>
                        </tr>
                        <tr>
                            <th>ホームタウン</th>
                            <td>池袋</td>
                        </tr>
                        <tr>
                            <th>監督</th>
                            <td>山田太郎</td>
                        </tr>
                        <tr>
                            <th>コーチ</th>
                            <td>鈴木一郎</td>
                        </tr>
                        <tr>
                            <th>マネージャー</th>
                            <td>山田太　/　鈴木一郎</td>
                        </tr>
                        <tr>
                            <th>トレーナー</th>
                            <td>鈴木一郎　/　高橋三郎</td>
                        </tr>
                        <tr>
                            <th>説明</th>
                            <td class="h140">ここにテキスト入りますここにテキスト入りますここにテキスト入りますここにテキスト入りますここにテキスト入りますここにテキスト入りますここにテキスト入りますここにテキスト入りますここにテキスト入りますここにテキスト入ります。</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p class="center">
                <a href="/preview/teams01" class="btnStrategy resetW300">
                    チーム一覧に戻る
                    <span class="positionLeft">
                        <img src="/assets/img/svg/ic_circle_left.svg" alt="チーム一覧に戻る">
                    </span>
                </a>
            </p>
        </div>
    </div>
@endsection

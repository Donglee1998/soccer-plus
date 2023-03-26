@extends('web.layouts.default', ['title' => 'チーム一覧'], ['pageName' => 'pageTeam'])
@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="チーム一覧 選手情報 ">
        <h1 class="keyvTitle"><span class="subTitle">チーム一覧</span> 選手情報</h1>
    </div>
    <div class="content">
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a><span>/</span></li>
                <li><a href="/preview/teams01">チーム一覧</a><span>/</span></li>
                <li><em>選手情報</em></li>
            </ul>
            <table class="tblList tbCenter">
                <tbody>
                    <tr>
                        <th class="wid50">No.</td>
                        <th class="wid57">POS</th>
                        <th class="title left">選手</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>GK</td>
                        <td class="left">
                            <a href="#">川島永嗣</a>
                        </td>
                    </tr>
                        <tr>
                        <td>2</td>
                        <td>DF</td>
                        <td class="left">
                            <a href="#">植田直通</a>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>DF</td>
                        <td class="left">
                            <a href="#">室屋成</a>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>DF</td>
                        <td class="left">
                            <a href="#">板倉滉</a>
                        </td>
                    </tr>
                        <tr>
                        <td>5</td>
                        <td>DF</td>
                        <td class="left">
                            <a href="#">長友佑都</a>
                        </td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>MF</td>
                        <td class="left">
                            <a href="#">遠藤航</a>
                        </td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>MF</td>
                        <td class="left">
                            <a href="#">柴崎岳</a>
                        </td>
                    </tr>
                        <tr>
                        <td>8</td>
                        <td>MF</td>
                        <td class="left">
                            <a href="#">原口元気</a>
                        </td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>FW</td>
                        <td class="left">
                            <a href="#">鎌田大地</a>
                        </td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>FW</td>
                        <td class="left">
                            <a href="#">南野拓実</a>
                        </td>
                    </tr>
                        <tr>
                        <td>11</td>
                        <td>FW</td>
                        <td class="left">
                            <a href="#">古橋亨梧</a>
                        </td>
                    </tr>
                </tbody>
            </table>
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

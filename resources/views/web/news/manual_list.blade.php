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
                    @foreach($manuals as $manual)
                    <tr>
                        <td><a href="{{ route('web.manual.detail', ['id' => $manual->id]) }}">{{ $manual->title }}</a></td>
                        <td>{!! nl2br(e($manual->overview)) !!}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

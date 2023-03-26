@extends('web.layouts.login', ['title' => 'パスワード再設定｜サッカープラス'])
@section('content')
    <div class="hdgTop">
        <div class="inner">
            <h1 class="logo"><a href="/"><img src="/assets/img/svg/logo.svg" alt="SOCCER PLUS"></a></h1>
        </div>
    </div>
    <div class="inner">
        <h1 class="headline1"><span>パスワードを忘れた方</span></h1>
        <ul class="hNavi">
            <li class="item active">入力</li>
            <li class="item active">確認</li>
            <li class="item active">新パスワード入力</li>
            <li class="item active">完了</li>
        </ul>
        <p class="txtCmn">パスワードがリセットされました。再度ログインしてください。</p>
        {{-- <div class="formForgot">
            <p class="center">
                <a href="{{ route('web.auth.showForm.login') }}" type="submit" class="btnCmn">
                    ログイン画面へ戻る<span class="iconArrow"></span>
                </a>
            </p>
        </div> --}}
    </div>
@endsection

@extends('web.layouts.login', ['title' => 'パスワードを忘れた方｜サッカープラス'])
@section('content')
<div class="hdgTop">
    <div class="inner">
        <h1 class="logo"><a href="/"><img src="/assets/img/svg/logo.svg" alt="SOCCER PLUS"></a></h1>
    </div>
</div>
<div class="inner">
    <h1 class="headline1"><span>パスワードを忘れた方</span></h1>
    {{-- <ul class="hNavi">
        <li class="item active">入力</li>
        <li class="item">確認</li>
        <li class="item">新パスワード入力</li>
        <li class="item">完了</li>
    </ul> --}}
    <div class="forgotBlock">
        <div>
            @if(session('send_mail_reset_pass_success'))
            <ul class="hNavi">
                <li class="item active">入力</li>
                <li class="item active">確認</li>
                <li class="item">新パスワード入力</li>
                <li class="item">完了</li>
            </ul>
            <h3 class="headline3">メールを送信しました。</h3>
            @php
                $data = \Session::get('send_mail_reset_pass_success');
            @endphp
            <div class="txtCmn" role="alert">
                {{ $data['message'] }}
            </div>
            <div class="boxSubmitEmail">
                <p class="center"><a href="{{ route('web.auth.showForm.forgotPassword') }}" class="btnCmn">メールを再送信する<span class="iconArrow"></a></p>
            </div>
            @else
        </div>
        <form class="formForgot" method="POST" action="{{ route('web.auth.submit.forgotPassword') }}" data-form="forgot-password" class="form-wrapper">
            <ul class="hNavi">
                <li class="item active">入力</li>
                <li class="item">確認</li>
                <li class="item">新パスワード入力</li>
                <li class="item">完了</li>
            </ul>
            <p class="txtCmn">ご登録のメールアドレスを入力し[送信する]を押してください。パスワードをリセットするメールをお送りします。</p>
            <h2 class="headline2"><span>メールアドレス</span></h2>
            @csrf
            <div class="formGroup mb20">
                <input
                    type="text"
                    class="styleInput w300 @error('email') error @enderror"
                    id="email"
                    name="email"
                    placeholder="test@soccerplus.jp"
                    value="{{ old('email', '') }}"
                >
                @error('email')
                    <span class="error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <p class="txtCmn">英文字、記号<br>
                例：test@soccerplus.jp
                </p>
                <p class="center"><button type="submit" class="btnCmn">送信する<span class="iconArrow"></span></button></p>
        </form>
        @endif
    </div>
</div>
@endsection

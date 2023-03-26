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
            <li class="item">完了</li>
        </ul>
        <p class="txtCmn">新パスワードを入力し[パスワードを再設定する]を押してください。</p>
        <h2 class="headline2"><span>パスワード再設定</span></h2>
        <div class="formForgot">
            <div class="tabs-container">
                <form method="POST" action="{{ route('web.auth.submit.resetPassword') }}" data-form="reset-password" class="form-wrapper">
                    @csrf
                    @error('token')
                        <span class="error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input type="hidden" name="_token_reset_pass" value="{{ $token }}">
                    <div class="formGroup flexBox">
                        <label class="txtLabel" for="password">新パスワード <sup>*</sup></label>
                        <div>
                            <input
                            type="password"
                            class="styleInput w300 @error('data.password') error @enderror"
                            id="password"
                            name="data[password]"
                            value="{{ old('data.password') }}"
                            >
                            @error('data.password')
                                <span class="error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="formGroup flexBox mb40">
                        <label class="txtLabel" for="password_confirmation">新パスワード（確認）<sup>*</sup></label>
                        <input type="password" class="styleInput w300" id="password_confirmation" name="data[password_confirmation]" value="{{ old('data.password_confirmation') }}">
                    </div>
                    <p class="center"><button type="submit" class="btnCmn">パスワードを再設定する<span class="iconArrow"></span></button></p>
                </form>
            </div>
        </div>
    </div>
@endsection

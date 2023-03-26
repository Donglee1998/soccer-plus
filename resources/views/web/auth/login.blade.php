@extends('web.layouts.login', ['title' => 'ログイン'])
@push('css')
<style>
    .wrapperInputPassword {
        position: relative;
    }
    .icon-showpass {
        width: 18px;
        height: auto;
        position: absolute;
        top: 50%;
        right: 15px;
        transform: translateY(-50%);
        z-index: 9;
        cursor: pointer;
    }
</style>
@endpush
@section('content')
    <div class="headLogin">
        <div class="inner">
            <a href="{{ route('web.top') }}">
                <h1 class="logo"><img src="/assets/img/svg/logo.svg" alt="SOCCER PLUS"></h1>
            </a>
        </div>
    </div>
    <div class="containerLogin">
        <div class="formContent">
            <form method="POST" action="{{ route('web.auth.submit.login') }}" class="formWrapper" data-form="login">
                @csrf
                <h2 class="title">ログイン</h2>
                <div class="formGroup">
                    <label class="txtLabel" for="username">ID</label>
                    <input
                        type="text"
                        class="styleInput  @error('username') error @enderror"
                        id="username"
                        name="username"
                        {{-- placeholder="Enter username" --}}
                        value="{{ old('username', '') }}"
                    >
                    @error('username')
                        <span class="error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="formGroup mb15">
                    <label class="txtLabel" for="password-login">パスワード</label>
                    <input
                        type="password"
                        class="styleInput @error('password') error @enderror"
                        id="password-login"
                        name="password"
                        {{-- placeholder="Enter password" --}}
                    >
                    @error('password')
                        <span class="error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="formGroup">
                    @error('credentials_incorrect')
                        <span class="error d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <a class="linkForgot" href="{{ route('web.auth.showForm.forgotPassword') }}">パスワードを忘れた方はこちら</a>
                <button type="submit" class="btnSubmit">ログイン</button>
            </form>
        </div>
    </div>
    <div class="footerLogin">
        <div class="inner">
            <p class="copy-right">&copy;SOCCER PLUS All rights reserved.</p>
        </div>
    </div>
@endsection